<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cviebrock\EloquentSluggable\Sluggable;

class Project extends Model
{

    use Sluggable;

    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'location',
        'client',
        'completion_date',
        'featured_image',
        'status',
        'is_featured',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    protected $casts = [
        'completion_date' => 'date',
        'is_featured' => 'boolean',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }


    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }
}