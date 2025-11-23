<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        
        $user = Auth::user();

        $validation = Validator::make($request->all(), [
            "name"   => "required|string|max:255",
            "email"  => "required|email|max:255|unique:users,email," . $user->id,
            "job_title" => "nullable|string|max:255",
            "bio" => "nullable|string",
            "location" => "nullable|string|max:255",

            // Sosial media
            "github_url"   => "nullable|url",
            "linkedin_url" => "nullable|url",
            "twitter_url"  => "nullable|url",
            "website_url"  => "nullable|url",
            "support_url"  => "nullable|url",

            // Avatar
            "avatar" => "nullable|image|mimes:jpg,jpeg,png|max:2048",
        ]);

        $validation->setAttributeNames([
            "name" => "Nama",
            "email" => "Email",
            "job_title" => "Pekerjaan",
            "bio" => "Bio",
            "location" => "Lokasi",
            "avatar" => "Foto Profil",
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        // Upload avatar
        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Update normal fields
        $user->fill($request->except('avatar'));
        $user->save();

        return back()->with('success', 'Profile berhasil diperbarui.');
    }
}
