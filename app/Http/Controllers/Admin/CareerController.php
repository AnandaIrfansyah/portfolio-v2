<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CareerController extends Controller
{
    public function index()
    {
        $career = Career::first();
        return view('admin.career.index', compact('career'));
    }

    public function store(Request $request)
    {
        try {
            $data = $this->processRequest($request);

            $career = Career::first();
            if ($career) {
                $career->update($data);
            } else {
                Career::create($data);
            }

            return response()->json(['success' => true, 'message' => 'Career berhasil disimpan.']);
        } catch (\Exception $e) {
            Log::error('Career Store Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function processRequest(Request $request)
    {
        // Process tools_technologies dari format form ke JSON
        $tools = [];
        if ($request->tools_category && $request->tools_list) {
            foreach ($request->tools_category as $i => $category) {
                if (!empty($category) && !empty($request->tools_list[$i])) {
                    $tools[] = [
                        'category' => $category,
                        'tools'    => $request->tools_list[$i],
                    ];
                }
            }
        }

        return [
            'status'               => $request->status,
            'availability'         => $request->availability,
            'employment_type'      => $request->employment_type,
            'remote_work'          => $request->remote_work,
            'relocation'           => $request->relocation,
            'preferred_roles'      => $request->preferred_roles
                ? array_filter(explode(',', $request->preferred_roles))
                : [],
            'skills'               => $request->skills
                ? array_filter(explode(',', $request->skills))
                : [],
            'experience_level'     => $request->experience_level,
            'salary_expectation'   => $request->salary_expectation,
            'notice_period'        => $request->notice_period,
            'work_authorization'   => $request->work_authorization,
            'languages'            => $request->languages,
            'contact_preference'   => $request->contact_preference,
            'interview_availability' => $request->interview_availability,
            'work_arrangements'    => $request->work_arrangements ?? [],
            'onsite_locations'     => $request->onsite_locations
                ? array_filter(explode(',', $request->onsite_locations))
                : [],
            'remote_locations'     => $request->remote_locations
                ? array_filter(explode(',', $request->remote_locations))
                : [],
            'tools_technologies'   => $tools,
            'is_visible'           => $request->boolean('is_visible', true),
        ];
    }
}
