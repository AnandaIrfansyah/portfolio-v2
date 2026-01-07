<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationAchievement extends Model
{
    use HasFactory;

    protected $table = 'certification_achievements';

    protected $fillable = [
        'certification_id',
        'achievement_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship
    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }
}
