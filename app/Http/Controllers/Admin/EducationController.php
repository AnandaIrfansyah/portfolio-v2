<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationAchievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $educations = Education::with('achievements')
            ->when($search, function ($query, $search) {
                $query->where('institution_name', 'like', "%{$search}%")
                    ->orWhere('degree', 'like', "%{$search}%")
                    ->orWhere('field_of_study', 'like', "%{$search}%");
            })
            ->ordered()
            ->get();

        return response()->json(['data' => $educations]);
    }

    public function store(Request $request)
    {
        try {
            Log::info('Education Store Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'institution_name' => 'required|string|max:255',
                'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'gpa' => 'nullable|string|max:10',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'achievements' => 'nullable|array',
                'achievements.*' => 'required|string',
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
            if ($request->hasFile('institution_logo')) {
                $logoPath = $request->file('institution_logo')->store('educations', 'public');
            }

            // Create education
            $education = Education::create([
                'institution_name' => $request->institution_name,
                'institution_logo' => $logoPath,
                'degree' => $request->degree,
                'field_of_study' => $request->field_of_study,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'gpa' => $request->gpa,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            Log::info('Education created:', ['id' => $education->id]);

            // Create achievements
            if ($request->has('achievements') && is_array($request->achievements)) {
                foreach ($request->achievements as $index => $achievement) {
                    EducationAchievement::create([
                        'education_id' => $education->id,
                        'achievement_text' => $achievement,
                        'order' => $index + 1,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan education.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Education Store Error:', [
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
        $education = Education::with('achievements')->find($id);

        if (!$education) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $education]);
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Education Update Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'institution_name' => 'required|string|max:255',
                'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after:start_date',
                'gpa' => 'nullable|string|max:10',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'achievements' => 'nullable|array',
                'achievements.*' => 'required|string',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            $education = Education::find($id);

            if (!$education) {
                return response()->json([
                    'success' => false,
                    'message' => 'Education tidak ditemukan.'
                ], 404);
            }

            // Handle logo
            $logoPath = $education->institution_logo;
            if ($request->hasFile('institution_logo')) {
                if ($logoPath) {
                    Storage::disk('public')->delete($logoPath);
                }
                $logoPath = $request->file('institution_logo')->store('educations', 'public');
            }

            // Update education
            $education->update([
                'institution_name' => $request->institution_name,
                'institution_logo' => $logoPath,
                'degree' => $request->degree,
                'field_of_study' => $request->field_of_study,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'gpa' => $request->gpa,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            // Delete existing achievements
            $education->achievements()->delete();

            // Recreate achievements
            if ($request->has('achievements') && is_array($request->achievements)) {
                foreach ($request->achievements as $index => $achievement) {
                    EducationAchievement::create([
                        'education_id' => $education->id,
                        'achievement_text' => $achievement,
                        'order' => $index + 1,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui education.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Education Update Error:', [
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
        $education = Education::find($id);

        if (!$education) {
            return response()->json(['status' => false, 'message' => 'Education tidak ditemukan.'], 404);
        }

        // Delete logo
        if ($education->institution_logo) {
            Storage::disk('public')->delete($education->institution_logo);
        }

        $education->delete();

        return response()->json(['message' => 'Berhasil menghapus education.']);
    }

    public function storeAchievement(Request $request, $education_id)
    {
        $validation = Validator::make($request->all(), [
            'achievement_text' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $achievement = EducationAchievement::create([
            'education_id' => $education_id,
            'achievement_text' => $request->achievement_text,
            'order' => EducationAchievement::where('education_id', $education_id)->count() + 1,
        ]);

        return response()->json([
            'message' => 'Berhasil menambah achievement.',
            'data' => $achievement
        ]);
    }

    public function destroyAchievement($id)
    {
        $achievement = EducationAchievement::find($id);

        if (!$achievement) {
            return response()->json(['status' => false, 'message' => 'Achievement tidak ditemukan.'], 404);
        }

        $achievement->delete();

        return response()->json(['message' => 'Berhasil menghapus achievement.']);
    }
}
