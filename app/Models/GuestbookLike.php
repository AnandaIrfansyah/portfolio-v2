<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookLike extends Model
{
    protected $fillable = ['guestbook_message_id', 'guestbook_user_id'];
}
