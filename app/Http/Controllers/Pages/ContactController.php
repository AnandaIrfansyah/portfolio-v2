<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        // Get user data (admin/owner)
        $user = User::first();
        return view('pages.contact.index', compact('user'));
    }

    public function store(Request $request)
    {
        try {
            // ✅ LOG REQUEST DATA
            Log::info('========================================');
            Log::info('📥 CONTACT FORM REQUEST RECEIVED');
            Log::info('========================================');
            Log::info('Request Method: ' . $request->method());
            Log::info('Request URL: ' . $request->fullUrl());
            Log::info('Request IP: ' . $request->ip());
            Log::info('Request Data:', $request->all());

            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:5000',
            ]);

            if ($validation->fails()) {
                // ✅ LOG VALIDATION ERRORS
                Log::warning('❌ VALIDATION FAILED');
                Log::warning('Validation Errors:', $validation->errors()->toArray());
                Log::info('========================================');

                return response()->json([
                    'success' => false,
                    'errors' => $validation->errors()
                ], 422);
            }

            // Store contact message
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // ✅ LOG SUCCESS
            Log::info('✅ CONTACT MESSAGE SAVED');
            Log::info('Contact ID: ' . $contact->id);
            Log::info('========================================');

            return response()->json([
                'success' => true,
                'message' => 'Thank you for reaching out! I\'ll get back to you soon.'
            ], 200);
        } catch (\Exception $e) {
            // ✅ LOG EXCEPTION
            Log::error('💥 CONTACT FORM ERROR');
            Log::error('Error Message: ' . $e->getMessage());
            Log::error('Error File: ' . $e->getFile() . ':' . $e->getLine());
            Log::error('Stack Trace:', [$e->getTraceAsString()]);
            Log::info('========================================');

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
