<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperiencePosition extends Model
{
    use HasFactory;

    protected $table = 'experience_positions';

    protected $fillable = [
        'experience_id',
        'position_title',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'badge_type',
        'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function achievements()
    {
        return $this->hasMany(ExperienceAchievement::class)->orderBy('order', 'asc');
    }

    // Helper methods
    public function getFormattedDateRangeAttribute()
    {
        $start = Carbon::parse($this->start_date)->format('M Y');
        $end = $this->is_current ? 'Present' : Carbon::parse($this->end_date)->format('M Y');
        return "{$start} - {$end}";
    }

    public function getEmploymentTypeLabel()
    {
        $labels = [
            'full_time' => 'Full-time',
            'part_time' => 'Part-time',
            'self_employed' => 'Self-employed',
            'internship' => 'Internship',
            'contract' => 'Contract',
            'scholarship' => 'Scholarship',
        ];
        return $labels[$this->employment_type] ?? 'Full-time';
    }
}
