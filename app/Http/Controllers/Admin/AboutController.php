<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutIntro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        return view('admin.about.index');
    }

    public function showIntro()
    {
        $intro = AboutIntro::first();

        if (!$intro) {
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true, 'data' => $intro]);
    }

    public function updateIntro(Request $request)
    {
        try {
            Log::info('About Intro Update Request:', $request->all());

            $validation = Validator::make($request->all(), [
                'bio' => 'required|string',
                'status' => 'required|in:open_to_work,not_available',
                'cv_pdf_file' => 'nullable|file|mimes:pdf|max:5120', // 5MB
                'cv_word_url' => 'nullable|url',
            ]);

            if ($validation->fails()) {
                Log::error('Validation failed:', $validation->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Get or create intro (only 1 record)
            $intro = AboutIntro::first();

            if (!$intro) {
                $intro = new AboutIntro();
            }

            // Handle PDF upload
            $pdfPath = $intro->cv_pdf_file;
            if ($request->hasFile('cv_pdf_file')) {
                // Delete old PDF
                if ($pdfPath) {
                    Storage::disk('public')->delete($pdfPath);
                }
                $pdfPath = $request->file('cv_pdf_file')->store('cv', 'public');
            }

            // Update data
            $intro->bio = $request->bio;
            $intro->status = $request->status;
            $intro->cv_pdf_file = $pdfPath;
            $intro->cv_word_url = $request->cv_word_url;
            $intro->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil memperbarui intro & CV.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('About Intro Update Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
