<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicationTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationTagController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $tags = PublicationTag::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        return response()->json(['data' => $tags]);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:publication_tags,name',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $tag = PublicationTag::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Berhasil menambah tag.',
            'data' => $tag
        ]);
    }
}
