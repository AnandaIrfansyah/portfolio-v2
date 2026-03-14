<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookMessage extends Model
{
    protected $fillable = ['guestbook_user_id', 'parent_id', 'message', 'is_author'];

    public function user()
    {
        return $this->belongsTo(GuestbookUser::class, 'guestbook_user_id');
    }

    public function replies()
    {
        return $this->hasMany(GuestbookMessage::class, 'parent_id')->with('user', 'likes');
    }

    public function likes()
    {
        return $this->hasMany(GuestbookLike::class);
    }

    public function parent()
    {
        return $this->belongsTo(GuestbookMessage::class, 'parent_id');
    }
}
