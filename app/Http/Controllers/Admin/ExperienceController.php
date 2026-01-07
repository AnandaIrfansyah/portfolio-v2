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

            $validation = Validator::make($request->all(), [
                'company_name' => 'required|string|max:255',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'company_url' => 'nullable|url',
                'location' => 'required|string|max:255',
                'location_type' => 'required|in:on_site,remote,hybrid',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'positions' => 'required|array|min:1',
                'positions.*.position_title' => 'required|string|max:255',
                'positions.*.employment_type' => 'required|in:full_time,part_time,self_employed,internship,contract,scholarship',
                'positions.*.start_date' => 'required|date',
                'positions.*.end_date' => 'nullable|date|after:positions.*.start_date',
                'positions.*.is_current' => 'nullable|boolean',
                'positions.*.badge_type' => 'nullable|in:current,scholarship',
                'positions.*.achievements' => 'nullable|array',
                'positions.*.achievements.*' => 'required|string',
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
            if ($request->hasFile('company_logo')) {
                $logoPath = $request->file('company_logo')->store('experiences', 'public');
            }

            // Create experience
            $experience = Experience::create([
                'company_name' => $request->company_name,
                'company_logo' => $logoPath,
                'company_url' => $request->company_url,
                'position_count' => count($request->positions),
                'location' => $request->location,
                'location_type' => $request->location_type,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            Log::info('Experience created:', ['id' => $experience->id]);

            // Create positions
            if ($request->has('positions') && is_array($request->positions)) {
                foreach ($request->positions as $index => $positionData) {
                    $position = ExperiencePosition::create([
                        'experience_id' => $experience->id,
                        'position_title' => $positionData['position_title'],
                        'employment_type' => $positionData['employment_type'],
                        'start_date' => $positionData['start_date'],
                        'end_date' => $positionData['end_date'] ?? null,
                        'is_current' => $positionData['is_current'] ?? false,
                        'badge_type' => $positionData['badge_type'] ?? null,
                        'order' => $index + 1,
                    ]);

                    // Create achievements for this position
                    if (isset($positionData['achievements']) && is_array($positionData['achievements'])) {
                        foreach ($positionData['achievements'] as $achIndex => $achievement) {
                            ExperienceAchievement::create([
                                'experience_position_id' => $position->id,
                                'achievement_text' => $achievement,
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

            $validation = Validator::make($request->all(), [
                'company_name' => 'required|string|max:255',
                'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'company_url' => 'nullable|url',
                'location' => 'required|string|max:255',
                'location_type' => 'required|in:on_site,remote,hybrid',
                'order' => 'nullable|integer|min:0',
                'is_visible' => 'nullable|boolean',
                'positions' => 'required|array|min:1',
                'positions.*.id' => 'nullable|exists:experience_positions,id',
                'positions.*.position_title' => 'required|string|max:255',
                'positions.*.employment_type' => 'required|in:full_time,part_time,self_employed,internship,contract,scholarship',
                'positions.*.start_date' => 'required|date',
                'positions.*.end_date' => 'nullable|date|after:positions.*.start_date',
                'positions.*.is_current' => 'nullable|boolean',
                'positions.*.badge_type' => 'nullable|in:current,scholarship',
                'positions.*.achievements' => 'nullable|array',
                'positions.*.achievements.*' => 'required|string',
            ]);

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
                'position_count' => count($request->positions),
                'location' => $request->location,
                'location_type' => $request->location_type,
                'order' => $request->order ?? 0,
                'is_visible' => $request->boolean('is_visible', true),
            ]);

            // Delete existing positions (cascade will delete achievements)
            $experience->positions()->delete();

            // Recreate positions
            if ($request->has('positions') && is_array($request->positions)) {
                foreach ($request->positions as $index => $positionData) {
                    $position = ExperiencePosition::create([
                        'experience_id' => $experience->id,
                        'position_title' => $positionData['position_title'],
                        'employment_type' => $positionData['employment_type'],
                        'start_date' => $positionData['start_date'],
                        'end_date' => $positionData['end_date'] ?? null,
                        'is_current' => $positionData['is_current'] ?? false,
                        'badge_type' => $positionData['badge_type'] ?? null,
                        'order' => $index + 1,
                    ]);

                    // Create achievements
                    if (isset($positionData['achievements']) && is_array($positionData['achievements'])) {
                        foreach ($positionData['achievements'] as $achIndex => $achievement) {
                            ExperienceAchievement::create([
                                'experience_position_id' => $position->id,
                                'achievement_text' => $achievement,
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
