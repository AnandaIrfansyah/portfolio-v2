<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    protected $fillable = [
        'company_name',
        'company_logo',
        'company_url',
        'position_count',
        'location',
        'location_type',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'position_count' => 'integer',
        'order' => 'integer',
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function positions()
    {
        return $this->hasMany(ExperiencePosition::class)->orderBy('order', 'asc');
    }

    // Scopes
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Helper
    public function getLocationTypeLabel()
    {
        $labels = [
            'on_site' => 'On-site',
            'remote' => 'Remote',
            'hybrid' => 'Hybrid',
        ];
        return $labels[$this->location_type] ?? 'On-site';
    }
}
