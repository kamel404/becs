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
        return $this->hasMany(ProjectImage::class)->orderBy('order')->orderBy('id');
    }


    protected static function booted(): void
    {
        // Delete gallery rows through Eloquent (not just the DB cascade) so their files are removed too.
        static::deleting(function (Project $project) {
            $project->images()->get()->each->delete();
        });

        static::deleted(function (Project $project) {
            static::deleteStoredFile($project->featured_image);
        });
    }


    /**
     * Remove an uploaded file from the public disk. External URLs (seeded images) are ignored.
     */
    public static function deleteStoredFile(?string $path): void
    {
        if (blank($path) || preg_match('#^(https?:)?//#', $path) || str_starts_with($path, '/')) {
            return;
        }

        \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
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