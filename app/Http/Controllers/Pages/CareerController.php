<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $user = User::first();
        $intro = AboutIntro::first();
        $career = Career::where('is_visible', true)->first();
        return view('pages.career.index', compact('user', 'career', 'intro'));
    }
}
