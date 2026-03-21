<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestbookMessage;
use App\Models\GuestbookUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestbookController extends Controller
{
    public function index(Request $request)
    {
        $messages = GuestbookMessage::with(['user', 'replies.user', 'likes'])
            ->whereNull('parent_id')
            ->orderByDesc('is_pinned')
            ->latest()
            ->paginate(20);

        $stats = [
            'total'   => GuestbookMessage::whereNull('parent_id')->count(),
            'replies' => GuestbookMessage::whereNotNull('parent_id')->count(),
            'users'   => GuestbookUser::count(),
            'pinned'  => GuestbookMessage::whereNull('parent_id')->where('is_pinned', true)->count(),
            'hidden'  => GuestbookMessage::whereNull('parent_id')->where('is_hidden', true)->count(),
        ];

        return view('admin.guestbook.index', compact('messages', 'stats'));
    }

    // Admin post message sendiri
    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $user = Auth::user();

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

        GuestbookMessage::create([
            'guestbook_user_id' => $adminUser->id,
            'parent_id'         => null,
            'message'           => $request->message,
            'is_author'         => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Message posted.']);
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:1000']);

        $parent = GuestbookMessage::find($id);
        if (!$parent) {
            return response()->json(['success' => false, 'message' => 'Message not found.'], 404);
        }

        $user = Auth::user();

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

    public function togglePin($id)
    {
        $message = GuestbookMessage::find($id);
        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        }

        $message->update(['is_pinned' => !$message->is_pinned]);

        return response()->json([
            'success'   => true,
            'is_pinned' => $message->is_pinned,
            'message'   => $message->is_pinned ? 'Message pinned.' : 'Message unpinned.',
        ]);
    }

    public function toggleHidden($id)
    {
        $message = GuestbookMessage::find($id);
        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        }

        $message->update(['is_hidden' => !$message->is_hidden]);

        return response()->json([
            'success'   => true,
            'is_hidden' => $message->is_hidden,
            'message'   => $message->is_hidden ? 'Message hidden.' : 'Message visible.',
        ]);
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
