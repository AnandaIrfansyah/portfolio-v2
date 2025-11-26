<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationAuthors extends Model
{
    protected $table = 'publication_authors'; // ✅ Sesuaikan dengan migration

    public $incrementing = false;

    protected $fillable = [
        'publication_id',
        'author_id',
        'author_order'
    ];

    protected $casts = [
        'publication_id' => 'integer',
        'author_id' => 'integer',
        'author_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function author()
    {
        return $this->belongsTo(Authors::class);
    }

    public function scopeFirstAuthors($query)
    {
        return $query->where('author_order', 1);
    }

    public function scopeOrderedByAuthor($query)
    {
        return $query->orderBy('author_order', 'asc');
    }
}
