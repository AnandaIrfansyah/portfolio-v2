<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'category_id',
        'role',
        'status',
        'date',
        'year',
        'month',
        'github_url',
        'demo_url',
        'is_featured',
        'views',
        'order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'year' => 'integer',
        'month' => 'integer',
        'views' => 'integer',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
            if (empty($project->date) && $project->year) {
                $monthName = $project->month ? date('M', mktime(0, 0, 0, $project->month, 1)) : '';
                $project->date = trim($monthName . ' ' . $project->year);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }
            if ($project->isDirty(['year', 'month'])) {
                $monthName = $project->month ? date('M', mktime(0, 0, 0, $project->month, 1)) : '';
                $project->date = trim($monthName . ' ' . $project->year);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategories::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProjectImages::class, 'project_id')->orderBy('order');
    }

    public function features()
    {
        return $this->hasMany(ProjectFeatures::class, 'project_id')->orderBy('order');
    }

    public function techStacks()
    {
        return $this->belongsToMany(TechStack::class, 'project_tech_stacks', 'project_id', 'tech_stack_id')
            ->withTimestamps();
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('description', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%");
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getFormattedDateAttribute()
    {
        if ($this->date) {
            return $this->date;
        }
        if ($this->month) {
            $monthName = date('M', mktime(0, 0, 0, $this->month, 1));
            return $monthName . ' ' . $this->year;
        }
        return (string) $this->year;
    }

    public function getShortDescriptionAttribute()
    {
        return Str::limit(strip_tags($this->description), 150);
    }

    public function getStatusBadgeClassAttribute()
    {
        $badges = [
            'active' => 'status-active',
            'completed' => 'status-completed',
            'archived' => 'status-archived',
            'on_hold' => 'status-on-hold',
            'in_development' => 'status-in-development'
        ];
        return $badges[$this->status] ?? 'status-in-development';
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
