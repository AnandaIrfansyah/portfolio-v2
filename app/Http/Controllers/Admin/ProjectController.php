<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFeatures;
use App\Models\ProjectImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort = $request->sort ?? 10;
        $status = $request->status ?? null;
        $category = $request->category ?? null;

        $projects = Project::with(['category', 'techStacks', 'images', 'features'])
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->latest()
            ->paginate($sort)
            ->appends(request()->query());

        return view('admin.project.index', compact('projects'));
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        try {
            Log::info('Project Store Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'nullable|string',
                'category_id' => 'nullable|exists:project_categories,id',
                'role' => 'nullable|string|max:255',
                'status' => 'required|in:active,completed,archived,on_hold,in_development',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
                'month' => 'nullable|integer|min:1|max:12',
                'github_url' => 'nullable|url',
                'demo_url' => 'nullable|url',
                'is_featured' => 'nullable|boolean',
                'order' => 'nullable|integer',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'tech_stacks' => 'nullable|array',
                'tech_stacks.*' => 'exists:tech_stacks,id',
                'features' => 'nullable|array',
                'features.*.title' => 'required|string|max:255',
                'features.*.description' => 'required|string',
                'features.*.icon_class' => 'nullable|string',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Handle featured image upload
            $imagePath = null;
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('projects', 'public');
            }

            // Create project
            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'role' => $request->role,
                'status' => $request->status,
                'year' => $request->year,
                'month' => $request->month,
                'github_url' => $request->github_url,
                'demo_url' => $request->demo_url,
                'featured_image' => $imagePath,
                'is_featured' => $request->boolean('is_featured'),
                'order' => $request->order ?? 0,
            ]);

            Log::info('Project created:', ['id' => $project->id]);

            // Attach tech stacks
            if ($request->has('tech_stacks') && is_array($request->tech_stacks)) {
                $project->techStacks()->attach($request->tech_stacks);
            }

            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $image) {
                    $galleryPath = $image->store('projects/gallery', 'public');
                    ProjectImages::create([
                        'project_id' => $project->id,
                        'image_path' => $galleryPath,
                        'order' => $index + 1,
                    ]);
                }
            }

            // Create features
            if ($request->has('features') && is_array($request->features)) {
                foreach ($request->features as $index => $feature) {
                    ProjectFeatures::create([
                        'project_id' => $project->id,
                        'title' => $feature['title'],
                        'description' => $feature['description'],
                        'icon_class' => $feature['icon_class'] ?? null,
                        'order' => $index + 1,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil menyimpan project.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Project Store Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show project detail
     */
    public function show($id)
    {
        $data = Project::with(['category', 'techStacks', 'images', 'features'])->find($id);

        if (!$data) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $data]);
    }

    /**
     * Update project
     */
    public function update(Request $request, $id)
    {
        try {
            Log::info('Project Update Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'nullable|string',
                'category_id' => 'nullable|exists:project_categories,id',
                'role' => 'nullable|string|max:255',
                'status' => 'required|in:active,completed,archived,on_hold,in_development',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
                'month' => 'nullable|integer|min:1|max:12',
                'github_url' => 'nullable|url',
                'demo_url' => 'nullable|url',
                'is_featured' => 'nullable|boolean',
                'order' => 'nullable|integer',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'tech_stacks' => 'nullable|array',
                'tech_stacks.*' => 'exists:tech_stacks,id',
                'features' => 'nullable|array',
                'features.*.title' => 'required|string|max:255',
                'features.*.description' => 'required|string',
                'features.*.icon_class' => 'nullable|string',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project tidak ditemukan.'
                ], 404);
            }

            // Handle featured image
            $imagePath = $project->featured_image;
            if ($request->hasFile('featured_image')) {
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
                $imagePath = $request->file('featured_image')->store('projects', 'public');
            }

            // Update project
            $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'role' => $request->role,
                'status' => $request->status,
                'year' => $request->year,
                'month' => $request->month,
                'github_url' => $request->github_url,
                'demo_url' => $request->demo_url,
                'featured_image' => $imagePath,
                'is_featured' => $request->boolean('is_featured'),
                'order' => $request->order ?? 0,
            ]);

            // Sync tech stacks
            $project->techStacks()->sync($request->tech_stacks ?? []);

            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                // Delete old gallery images
                foreach ($project->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image_path);
                    $oldImage->delete();
                }

                // Upload new gallery images
                foreach ($request->file('gallery_images') as $index => $image) {
                    $galleryPath = $image->store('projects/gallery', 'public');
                    ProjectImages::create([
                        'project_id' => $project->id,
                        'image_path' => $galleryPath,
                        'order' => $index + 1,
                    ]);
                }
            }

            // Sync features
            // Delete old features
            $project->features()->delete();

            // Create new features
            if ($request->has('features') && is_array($request->features)) {
                foreach ($request->features as $index => $feature) {
                    ProjectFeatures::create([
                        'project_id' => $project->id,
                        'title' => $feature['title'],
                        'description' => $feature['description'],
                        'icon_class' => $feature['icon_class'] ?? null,
                        'order' => $index + 1,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui project.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Project Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete project
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['status' => false, 'message' => 'Project tidak ditemukan.'], 404);
        }

        // Delete featured image
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }

        // Delete gallery images
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $project->delete();

        return response()->json(['message' => 'Berhasil menghapus project.']);
    }
}
