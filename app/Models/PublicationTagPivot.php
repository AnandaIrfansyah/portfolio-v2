<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationTagPivot extends Model
{
    protected $table = 'publication_tag_pivots'; // ✅ Sesuaikan dengan migration (ada s)

    public $incrementing = false;

    protected $fillable = [
        'publication_id',
        'tag_id'
    ];

    protected $casts = [
        'publication_id' => 'integer',
        'tag_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function tag()
    {
        return $this->belongsTo(PublicationTag::class, 'tag_id');
    }
}
