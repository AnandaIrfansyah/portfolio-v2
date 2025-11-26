<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PublicationTag extends Model
{
    use HasFactory;

    protected $table = 'publication_tags';

    protected $fillable = [
        'name',
        'slug',
        'count'
    ];

    protected $casts = [
        'count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name')) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }


    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'publication_tag_pivots', 'tag_id', 'publication_id') // ✅ Ganti ke publication_tag_pivots
            ->withTimestamps()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc');
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('count', 'desc')->limit($limit);
    }


    public function incrementCount()
    {
        $this->increment('count');
    }

    public function decrementCount()
    {
        if ($this->count > 0) {
            $this->decrement('count');
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
