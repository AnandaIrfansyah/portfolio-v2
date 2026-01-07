<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'institution_name',
        'institution_logo',
        'degree',
        'field_of_study',
        'location',
        'start_date',
        'end_date',
        'gpa',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'order' => 'integer',
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function achievements()
    {
        return $this->hasMany(EducationAchievement::class)->orderBy('order', 'asc');
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
    public function getFormattedDateRangeAttribute()
    {
        $start = Carbon::parse($this->start_date)->format('Y');
        $end = $this->end_date ? Carbon::parse($this->end_date)->format('Y') : 'Present';
        return "{$start} - {$end}";
    }
}
