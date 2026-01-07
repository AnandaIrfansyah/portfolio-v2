<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceAchievement extends Model
{
    use HasFactory;

    protected $table = 'experience_achievements';

    protected $fillable = [
        'experience_position_id',
        'achievement_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship
    public function position()
    {
        return $this->belongsTo(ExperiencePosition::class, 'experience_position_id');
    }
}
