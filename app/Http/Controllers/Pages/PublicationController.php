<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\PublicationTag;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Publication::with(['authors', 'tags'])
            ->published()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc');

        if ($request->has('type') && $request->type) {
            $query->where('publication_type', $request->type);
        }

        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $publications = $query->paginate(6);

        $featured = Publication::with(['authors', 'tags'])
            ->published()
            ->featured()
            ->orderBy('year', 'desc')
            ->limit(3)
            ->get();

        $popularTags = PublicationTag::popular(10)->get();

        return view('pages.publication.index', compact('publications', 'featured', 'popularTags'));
    }

    public function show($slug)
    {
        $publication = Publication::with(['authors', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $publication->incrementViews();

        $related = Publication::with(['authors', 'tags'])
            ->published()
            ->where('id', '!=', $publication->id)
            ->where(function ($query) use ($publication) {
                $query->where('publication_type', $publication->publication_type)
                    ->orWhereHas('tags', function ($q) use ($publication) {
                        $q->whereIn('publication_tags.id', $publication->tags->pluck('id'));
                    });
            })
            ->orderBy('year', 'desc')
            ->limit(3)
            ->get();

        return view('pages.publication.show', compact('publication', 'related'));
    }
}
