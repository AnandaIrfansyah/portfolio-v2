<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TechStack extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon_class',
        'category',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->slug = Str::slug($item->name);
        });

        static::updating(function ($item) {
            $item->slug = Str::slug($item->name);
        });
    }
}
