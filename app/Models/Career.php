<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'status',
        'availability',
        'employment_type',
        'remote_work',
        'relocation',
        'preferred_roles',
        'skills',
        'experience_level',
        'salary_expectation',
        'notice_period',
        'work_authorization',
        'languages',
        'contact_preference',
        'interview_availability',
        'work_arrangements',
        'onsite_locations',
        'remote_locations',
        'tools_technologies',
        'is_visible',
    ];

    protected $casts = [
        'preferred_roles'    => 'array',
        'skills'             => 'array',
        'work_arrangements'  => 'array',
        'onsite_locations'   => 'array',
        'remote_locations'   => 'array',
        'tools_technologies' => 'array',
        'is_visible'         => 'boolean',
    ];

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'actively_looking' => 'Actively Looking',
            'open'             => 'Open to Opportunities',
            'not_available'    => 'Not Available',
            default            => 'Unknown',
        };
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'actively_looking' => '#10b981',
            'open'             => '#3b82f6',
            'not_available'    => '#6b7280',
            default            => '#6b7280',
        };
    }
}
