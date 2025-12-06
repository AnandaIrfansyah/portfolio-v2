<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeatures extends Model
{
    use HasFactory;

    protected $table = 'project_features';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'icon_class',
        'order'
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
}
