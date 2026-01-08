<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get Intro data (only 1 record)
        $intro = AboutIntro::first();

        // Get Experiences with positions and achievements (visible only, ordered)
        $experiences = Experience::with(['positions.achievements'])
            ->visible()
            ->ordered()
            ->get();

        // Get Educations with achievements (visible only, ordered)
        $educations = Education::with('achievements')
            ->visible()
            ->ordered()
            ->get();

        // Get Certifications with achievements (visible only, ordered)
        $certifications = Certification::with('achievements')
            ->visible()
            ->ordered()
            ->get();

        // Get first certification's linkedin URL (for "View All" button)
        $linkedinCertUrl = $certifications->first()?->linkedin_certifications_url;

        return view('pages.about.index', compact(
            'intro',
            'experiences',
            'educations',
            'certifications',
            'linkedinCertUrl'
        ));
    }
}
