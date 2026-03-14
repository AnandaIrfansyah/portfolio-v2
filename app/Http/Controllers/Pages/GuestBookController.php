<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\GuestbookLike;
use App\Models\GuestbookMessage;
use App\Models\GuestbookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GuestBookController extends Controller
{
    public function index()
    {
        $messages = GuestbookMessage::with(['user', 'replies.user', 'replies.likes', 'likes'])
            ->whereNull('parent_id')
            ->latest()
            ->paginate(20);

        $totalMessages = GuestbookMessage::whereNull('parent_id')->count();
        $guestUser = Session::get('guestbook_user');

        return view('pages.guestbook.index', compact('messages', 'totalMessages', 'guestUser'));
    }

    // ===== AUTH =====
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $guestUser = GuestbookUser::updateOrCreate(
                ['provider' => $provider, 'provider_id' => $socialUser->getId()],
                [
                    'name'   => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email'  => $socialUser->getEmail(),
                    'avatar' => $socialUser->getAvatar(),
                ]
            );

            Session::put('guestbook_user', $guestUser);

            return redirect()->route('guestbook.index');
        } catch (\Exception $e) {
            return redirect()->route('guestbook.index')->with('error', 'Login failed. Please try again.');
        }
    }

    public function logout()
    {
        Session::forget('guestbook_user');
        return redirect()->route('guestbook.index');
    }

    // ===== MESSAGES =====
    public function store(Request $request)
    {
        $guestUser = Session::get('guestbook_user');
        if (!$guestUser) {
            return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
        }

        $request->validate(['message' => 'required|string|max:1000']);

        $message = GuestbookMessage::create([
            'guestbook_user_id' => $guestUser->id,
            'message'           => $request->message,
            'is_author'         => false,
        ]);

        $message->load('user', 'likes');

        return response()->json(['success' => true, 'data' => $message]);
    }

    public function update(Request $request, $id)
    {
        $guestUser = Session::get('guestbook_user');
        if (!$guestUser) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        $message = GuestbookMessage::find($id);

        if (!$message || $message->guestbook_user_id !== $guestUser->id) {
            return response()->json(['success' => false, 'message' => 'Not allowed.'], 403);
        }

        $request->validate(['message' => 'required|string|max:1000']);
        $message->update(['message' => $request->message]);

        return response()->json(['success' => true, 'message' => 'Message updated.']);
    }

    public function destroy($id)
    {
        $guestUser = Session::get('guestbook_user');
        if (!$guestUser) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
        }

        $message = GuestbookMessage::find($id);

        if (!$message || $message->guestbook_user_id !== $guestUser->id) {
            return response()->json(['success' => false, 'message' => 'Not allowed.'], 403);
        }

        $message->replies()->delete();
        $message->delete();

        return response()->json(['success' => true, 'message' => 'Message deleted.']);
    }

    // ===== LIKES =====
    public function toggleLike($id)
    {
        $guestUser = Session::get('guestbook_user');
        if (!$guestUser) {
            return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
        }

        $message = GuestbookMessage::find($id);
        if (!$message) {
            return response()->json(['success' => false, 'message' => 'Message not found.'], 404);
        }

        $existing = GuestbookLike::where('guestbook_message_id', $id)
            ->where('guestbook_user_id', $guestUser->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            GuestbookLike::create([
                'guestbook_message_id' => $id,
                'guestbook_user_id'    => $guestUser->id,
            ]);
            $liked = true;
        }

        $likeCount = GuestbookLike::where('guestbook_message_id', $id)->count();

        return response()->json(['success' => true, 'liked' => $liked, 'count' => $likeCount]);
    }
}
