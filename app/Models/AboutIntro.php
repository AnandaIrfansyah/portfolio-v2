<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutIntro extends Model
{
    use HasFactory;

    protected $table = 'about_intros';

    protected $fillable = [
        'bio',
        'status',
        'cv_pdf_file',
        'cv_word_url',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Helper methods
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'open_to_work'
            ? '<span class="badge badge-success">Open to Work</span>'
            : '<span class="badge badge-secondary">Not Available</span>';
    }

    public function hasCvPdfAttribute()
    {
        return !empty($this->cv_pdf_file);
    }

    public function hasCvWordAttribute()
    {
        return !empty($this->cv_word_url);
    }
}
