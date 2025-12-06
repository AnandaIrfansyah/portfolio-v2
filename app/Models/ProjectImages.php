<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    use HasFactory;

    protected $table = 'project_images';

    protected $fillable = [
        'project_id',
        'image_path',
        'order',
        'caption'
    ];

    protected $casts = [
        'project_id' => 'integer',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
