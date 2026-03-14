<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestbookUser extends Model
{
    protected $fillable = ['name', 'email', 'avatar', 'provider', 'provider_id'];

    public function messages()
    {
        return $this->hasMany(GuestbookMessage::class);
    }

    public function likes()
    {
        return $this->hasMany(GuestbookLike::class);
    }
}
