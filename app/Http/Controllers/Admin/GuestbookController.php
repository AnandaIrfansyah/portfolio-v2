<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestbookMessage;
use App\Models\GuestbookUser;
use App\Models\User;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index(Request $request)
    {
        $messages = GuestbookMessage::with(['user', 'replies.user', 'likes'])
            ->whereNull('parent_id')
            ->latest()
            ->paginate(20);

        $stats = [
            'total'    => GuestbookMessage::whereNull('parent_id')->count(),
            'replies'  => GuestbookMessage::whereNotNull('parent_id')->count(),
            'users'    => GuestbookUser::count(),
        ];

        return view('admin.guestbook.index', compact('messages', 'stats'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $parent = GuestbookMessage::find($id);
        if (!$parent) {
            return response()->json(['success' => false, 'message' => 'Message not found.'], 404);
        }

        // Ambil data dari tabel users
        $user = User::first(); // atau Auth::user()

        $adminUser = GuestbookUser::firstOrCreate(
            ['provider' => 'admin', 'provider_id' => 'admin'],
            [
                'name'   => $user->name,
                'email'  => $user->email,
                'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
            ]
        );

        $adminUser->update([
            'name'   => $user->name,
            'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
        ]);

        $reply = GuestbookMessage::create([
            'guestbook_user_id' => $adminUser->id,
            'parent_id'         => $id,
            'message'           => $request->message,
            'is_author'         => true,
        ]);

        $reply->load('user');

        return response()->json(['success' => true, 'data' => $reply]);
    }

    public function destroy($id)
    {
        $message = GuestbookMessage::find($id);
        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        }

        $message->replies()->delete();
        $message->likes()->delete();
        $message->delete();

        return response()->json(['success' => true, 'message' => 'Message deleted.']);
    }
}
