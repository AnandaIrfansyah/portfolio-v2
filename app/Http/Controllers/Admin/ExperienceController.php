<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\ExperienceAchievement;
use App\Models\ExperiencePosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $experiences = Experience::with(['positions.achievements'])
            ->when($search, function ($query, $search) {
                $query->where('company_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->ordered()
            ->get();

        return response()->json(['data' => $experiences]);
    }

    public function store(Request $request)
    {
        try {
            Log::info('Experience Store Request:', $request->all());

            // ✅ DECODE JSON positions dulu sebelum validasi
            $positions = json_decode($request->positions, true);

            $validation = Validator::make($request->all(), [
                'company_name' => 'required|string|max:255',
                'company_url' => 'nullable|url',
                'location' => 'required|string|max:255',
                'location_type' => 'required|in:on_site,remote,hybrid',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                // ✅ Jangan validasi positions sebagai array dulu
            ]);

            // ✅ Validasi positions secara manual setelah di-decode
            if (!$positions || !is_array($positions)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['positions' => ['Minimal harus ada 1 position.']]
                ], 422);
            }

            // ✅ Validasi setiap position
            foreach ($positions as $index => $position) {
                if (empty($position['position_title'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya title."]]
                    ], 422);
                }
                if (empty($position['employment_type'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya employment type."]]
                    ], 422);
                }
                if (empty($position['start_date'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya start date."]]
                    ], 422);
                }
            }

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Handle logo upload
            $logoPath = null;
            if ($request->hasFile('company_logo')) {
                $logoPath = $request->file('company_logo')->store('experiences', 'public');
            }

            // Create experience
            $experience = Experience::create([
                'company_name' => $request->company_name,
                'company_logo' => $logoPath,
                'company_url' => $request->company_url,
                'location' => $request->location,
                'location_type' => $request->location_type,
                'position_count' => count($positions), // ✅ Hitung dari decoded array
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            Log::info('Experience created:', ['id' => $experience->id]);

            // ✅ Loop positions dari decoded array
            foreach ($positions as $index => $posData) {
                $position = $experience->positions()->create([
                    'position_title' => $posData['position_title'],
                    'employment_type' => $posData['employment_type'],
                    'start_date' => $posData['start_date'],
                    'end_date' => $posData['end_date'] ?? null,
                    'is_current' => $posData['is_current'] ?? false,
                    'badge_type' => $posData['badge_type'] ?? null,
                    'order' => $index + 1,
                ]);

                Log::info('Position created:', ['id' => $position->id]);

                // Create achievements for this position
                if (isset($posData['achievements']) && is_array($posData['achievements'])) {
                    foreach ($posData['achievements'] as $achIndex => $achievementText) {
                        if (!empty($achievementText)) {
                            $position->achievements()->create([
                                'achievement_text' => $achievementText,
                                'order' => $achIndex + 1,
                            ]);
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan experience.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Experience Store Error:', [
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
        $experience = Experience::with(['positions.achievements'])->find($id);

        if (!$experience) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $experience]);
    }

    public function update(Request $request, $id)
    {
        try {
            Log::info('Experience Update Request:', $request->all());

            // ✅ DECODE JSON positions dulu
            $positions = json_decode($request->positions, true);

            $validation = Validator::make($request->all(), [
                'company_name' => 'required|string|max:255',
                'company_url' => 'nullable|url',
                'location' => 'required|string|max:255',
                'location_type' => 'required|in:on_site,remote,hybrid',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // ✅ Validasi positions manual
            if (!$positions || !is_array($positions)) {
                return response()->json([
                    'success' => false,
                    'errors' => ['positions' => ['Minimal harus ada 1 position.']]
                ], 422);
            }

            foreach ($positions as $index => $position) {
                if (empty($position['position_title'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya title."]]
                    ], 422);
                }
                if (empty($position['employment_type'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya employment type."]]
                    ], 422);
                }
                if (empty($position['start_date'])) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['positions' => ["Position #" . ($index + 1) . " harus punya start date."]]
                    ], 422);
                }
            }

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            $experience = Experience::find($id);
            if (!$experience) {
                return response()->json([
                    'success' => false,
                    'message' => 'Experience tidak ditemukan.'
                ], 404);
            }

            // Handle logo
            $logoPath = $experience->company_logo;
            if ($request->hasFile('company_logo')) {
                if ($logoPath) {
                    Storage::disk('public')->delete($logoPath);
                }
                $logoPath = $request->file('company_logo')->store('experiences', 'public');
            }

            // Update experience
            $experience->update([
                'company_name' => $request->company_name,
                'company_logo' => $logoPath,
                'company_url' => $request->company_url,
                'location' => $request->location,
                'location_type' => $request->location_type,
                'position_count' => count($positions),
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            // Delete old positions and achievements
            foreach ($experience->positions as $oldPosition) {
                $oldPosition->achievements()->delete();
            }
            $experience->positions()->delete();

            // Create new positions
            foreach ($positions as $index => $posData) {
                $position = $experience->positions()->create([
                    'position_title' => $posData['position_title'],
                    'employment_type' => $posData['employment_type'],
                    'start_date' => $posData['start_date'],
                    'end_date' => $posData['end_date'] ?? null,
                    'is_current' => $posData['is_current'] ?? false,
                    'badge_type' => $posData['badge_type'] ?? null,
                    'order' => $index + 1,
                ]);

                // Create achievements
                if (isset($posData['achievements']) && is_array($posData['achievements'])) {
                    foreach ($posData['achievements'] as $achIndex => $achievementText) {
                        if (!empty($achievementText)) {
                            $position->achievements()->create([
                                'achievement_text' => $achievementText,
                                'order' => $achIndex + 1,
                            ]);
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui experience.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Experience Update Error:', [
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
        $experience = Experience::find($id);

        if (!$experience) {
            return response()->json(['status' => false, 'message' => 'Experience tidak ditemukan.'], 404);
        }

        // Delete logo
        if ($experience->company_logo) {
            Storage::disk('public')->delete($experience->company_logo);
        }

        $experience->delete();

        return response()->json(['message' => 'Berhasil menghapus experience.']);
    }
}
