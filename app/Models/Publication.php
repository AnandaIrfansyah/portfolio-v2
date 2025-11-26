<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';

    protected $fillable = [
        'title',
        'slug',
        'publication_type',
        'venue',
        'year',
        'month',
        'abstract',
        'content',
        'featured_image',
        'doi',
        'url',
        'pdf_url',
        'citation_count',
        'status',
        'is_featured',
        'views'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'year' => 'integer',
        'month' => 'integer',
        'citation_count' => 'integer',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($publication) {
            if (empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
            }
        });

        static::updating(function ($publication) {
            if ($publication->isDirty('title')) {
                $publication->slug = Str::slug($publication->title);
            }
        });
    }


    public function authors()
    {
        return $this->belongsToMany(Authors::class, 'publication_authors')
            ->withPivot('author_order')
            ->withTimestamps()
            ->orderBy('author_order');
    }

    public function tags()
    {
        return $this->belongsToMany(PublicationTag::class, 'publication_tag_pivots');
    }


    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('publication_type', $type);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('abstract', 'LIKE', "%{$keyword}%")
                ->orWhere('venue', 'LIKE', "%{$keyword}%");
        });
    }

    public function getFormattedDateAttribute()
    {
        if ($this->month) {
            $monthName = date('F', mktime(0, 0, 0, $this->month, 1));
            return $monthName . ' ' . $this->year;
        }
        return (string) $this->year;
    }

    public function getShortAbstractAttribute()
    {
        return Str::limit($this->abstract, 150);
    }

    public function getFirstAuthorAttribute()
    {
        return $this->authors()->orderBy('author_order')->first();
    }

    public function getAuthorsStringAttribute()
    {
        return $this->authors->pluck('name')->implode(', ');
    }

    public function getReadTimeAttribute()
    {
        $text = strip_tags($this->content ?? $this->abstract);
        $wordCount = str_word_count($text);
        $minutes = ceil($wordCount / 200);
        return $minutes . ' min read';
    }

    public function getHasPdfAttribute()
    {
        return !empty($this->pdf_url);
    }

    public function getHasDoiAttribute()
    {
        return !empty($this->doi);
    }


    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementCitations()
    {
        $this->increment('citation_count');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
