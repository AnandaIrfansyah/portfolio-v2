<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->search ?? null;

        $authors = Authors::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json(['data' => $authors]);
    }

    /**
     * Quick create author (from modal)
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $author = Authors::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Berhasil menambah author.',
            'data' => $author
        ]);
    }
}
