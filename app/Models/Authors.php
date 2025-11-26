<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'publication_authors') // ✅ Ganti ke publication_authors
            ->withPivot('author_order')
            ->withTimestamps()
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc');
    }
}
