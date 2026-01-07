<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['category', 'techStacks'])
            ->orderBy('is_featured', 'desc')
            ->orderBy('order', 'asc')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc');

        // Search
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Category Filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Status Filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $projects = $query->paginate(6);
        $categories = ProjectCategories::all();

        return view('pages.project.index', compact('projects', 'categories'));
    }

    public function show($slug)
    {
        $project = Project::with([
            'category',
            'techStacks',
            'features',
            'images' => function ($query) {
                $query->orderBy('order', 'asc');
            }
        ])->where('slug', $slug)->firstOrFail();

        // Increment views
        $project->incrementViews();

        // Related projects
        $related = Project::with(['category', 'techStacks'])
            ->whereIn('status', ['active', 'completed'])
            ->where('id', '!=', $project->id)
            ->where(function ($query) use ($project) {
                $query->where('category_id', $project->category_id)
                    ->orWhereHas('techStacks', function ($q) use ($project) {
                        $q->whereIn('tech_stacks.id', $project->techStacks->pluck('id'));
                    });
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('year', 'desc')
            ->limit(3)
            ->get();

        return view('pages.project.show', compact('project', 'related'));
    }
}
