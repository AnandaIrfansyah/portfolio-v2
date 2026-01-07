<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certifications';

    protected $fillable = [
        'title',
        'issuing_organization',
        'organization_logo',
        'issue_date',
        'credential_url',
        'linkedin_certifications_url',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'order' => 'integer',
        'is_visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function achievements()
    {
        return $this->hasMany(CertificationAchievement::class)->orderBy('order', 'asc');
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
    public function getFormattedIssueDateAttribute()
    {
        return Carbon::parse($this->issue_date)->format('M Y');
    }

    public function hasCredentialAttribute()
    {
        return !empty($this->credential_url);
    }
}
