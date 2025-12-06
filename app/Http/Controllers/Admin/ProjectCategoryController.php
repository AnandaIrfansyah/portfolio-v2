<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectFeatures;
use App\Models\ProjectImages;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProjectCategoryController extends Controller
{
    /**
     * Get list of categories for dropdown
     */
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $categories = ProjectCategories::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'icon_class']);

        return response()->json(['data' => $categories]);
    }

    /**
     * Quick create category (from modal)
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:project_categories,name',
            'icon_class' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $category = ProjectCategories::create([
            'name' => $request->name,
            'icon_class' => $request->icon_class,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Berhasil menambah kategori.',
            'data' => $category
        ]);
    }
}
