<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\TechStack;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::first();
        $techStacks = TechStack::orderBy('category')->get();

        // Ambil 3 publications terbaru
        $publications = Publication::with(['authors', 'tags'])
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(3)
            ->get();

        return view('pages.home.index', compact('user', 'techStacks', 'publications'));
    }
}
