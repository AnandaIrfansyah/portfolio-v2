<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\CertificationAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificationController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $certifications = Certification::with('achievements')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('issuing_organization', 'like', "%{$search}%");
            })
            ->ordered()
            ->get();

        return response()->json(['data' => $certifications]);
    }

    public function store(Request $request)
    {
        try {
            Log::info('Certification Store Request:', $request->all());

            // ✅ DECODE JSON achievements dulu
            $achievements = json_decode($request->achievements, true);

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'issue_date' => 'required|date',
                'credential_url' => 'nullable|url',
                'linkedin_certifications_url' => 'nullable|url',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'organization_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('organization_logo')) {
                $logoPath = $request->file('organization_logo')->store('certifications', 'public');
            }

            // Create certification
            $certification = Certification::create([
                'title' => $request->title,
                'issuing_organization' => $request->issuing_organization,
                'organization_logo' => $logoPath,
                'issue_date' => $request->issue_date,
                'credential_url' => $request->credential_url,
                'linkedin_certifications_url' => $request->linkedin_certifications_url,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            Log::info('Certification created:', ['id' => $certification->id]);

            // ✅ Create achievements dari decoded array
            if ($achievements && is_array($achievements)) {
                foreach ($achievements as $index => $achievementText) {
                    if (!empty($achievementText)) {
                        $certification->achievements()->create([
                            'achievement_text' => $achievementText,
                            'order' => $index + 1,
                        ]);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan certification.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Certification Store Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $certification = Certification::with('achievements')->find($id);

        if (!$certification) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $certification]);
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Certification Update Request:', $request->all());

            // ✅ DECODE JSON achievements dulu
            $achievements = json_decode($request->achievements, true);

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'issue_date' => 'required|date',
                'credential_url' => 'nullable|url',
                'linkedin_certifications_url' => 'nullable|url',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'organization_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            $certification = Certification::find($id);
            if (!$certification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Certification tidak ditemukan.'
                ], 404);
            }

            // Handle logo
            $logoPath = $certification->organization_logo;
            if ($request->hasFile('organization_logo')) {
                if ($logoPath) {
                    Storage::disk('public')->delete($logoPath);
                }
                $logoPath = $request->file('organization_logo')->store('certifications', 'public');
            }

            // Update certification
            $certification->update([
                'title' => $request->title,
                'issuing_organization' => $request->issuing_organization,
                'organization_logo' => $logoPath,
                'issue_date' => $request->issue_date,
                'credential_url' => $request->credential_url,
                'linkedin_certifications_url' => $request->linkedin_certifications_url,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            // Delete old achievements
            $certification->achievements()->delete();

            // Create new achievements
            if ($achievements && is_array($achievements)) {
                foreach ($achievements as $index => $achievementText) {
                    if (!empty($achievementText)) {
                        $certification->achievements()->create([
                            'achievement_text' => $achievementText,
                            'order' => $index + 1,
                        ]);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui certification.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Certification Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $certification = Certification::find($id);

        if (!$certification) {
            return response()->json(['status' => false, 'message' => 'Certification tidak ditemukan.'], 404);
        }

        // Delete logo
        if ($certification->organization_logo) {
            Storage::disk('public')->delete($certification->organization_logo);
        }

        $certification->delete();

        return response()->json(['message' => 'Berhasil menghapuscertification.']);
    }
    public function storeAchievement(Request $request, $certification_id)
    {
        $validation = Validator::make($request->all(), [
            'achievement_text' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $achievement = CertificationAchievement::create([
            'certification_id' => $certification_id,
            'achievement_text' => $request->achievement_text,
            'order' => CertificationAchievement::where('certification_id', $certification_id)->count() + 1,
        ]);

        return response()->json([
            'message' => 'Berhasil menambah achievement.',
            'data' => $achievement
        ]);
    }

    public function destroyAchievement($id)
    {
        $achievement = CertificationAchievement::find($id);

        if (!$achievement) {
            return response()->json(['status' => false, 'message' => 'Achievement tidak ditemukan.'], 404);
        }

        $achievement->delete();

        return response()->json(['message' => 'Berhasil menghapus achievement.']);
    }
}
