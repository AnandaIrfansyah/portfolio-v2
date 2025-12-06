<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectCategories extends Model
{
    use HasFactory;

    protected $table = 'project_categories';

    protected $fillable = [
        'name',
        'slug',
        'icon_class',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }


    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }
}
