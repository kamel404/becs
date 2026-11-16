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


    /**
     * Turn a stored image value into a usable URL.
     * Seeded images are full URLs; admin uploads are paths on the "public" disk.
     */
    public static function imageUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '/')) {
            return $path;
        }

        return asset('storage/' . ltrim($path, '/'));
    }


    public function getFeaturedImageUrlAttribute(): ?string
    {
        return static::imageUrl($this->featured_image);
    }
}