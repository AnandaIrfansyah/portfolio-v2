<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationAchievement extends Model
{
    use HasFactory;

    protected $table = 'education_achievements';

    protected $fillable = [
        'education_id',
        'achievement_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
