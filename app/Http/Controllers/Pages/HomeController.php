<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::first();
        $techStacks = TechStack::orderBy('category')->get();

        return view('pages.home.index', compact('user', 'techStacks'));
    }
}
