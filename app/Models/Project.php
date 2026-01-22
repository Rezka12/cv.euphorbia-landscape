<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE = 'done';

    public const CATEGORY_DESIGN_BUILD = 'design-build';
    public const CATEGORY_MAINTENANCE = 'pemeliharaan';

    protected $fillable = [
        'name',
        'description',
        'client',
        'location',
        'status',
        'category',
        'slug',
        'image',
    ];

    public function photos()
    {
        return $this->hasMany(ProjectPhoto::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_DONE => 'Completed',
            default => '-',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            self::CATEGORY_DESIGN_BUILD => 'Perancangan & Pembangunan',
            self::CATEGORY_MAINTENANCE => 'Pemeliharaan',
            default => '-',
        };
    }

    public function setStatusAttribute($value): void
    {
        $this->attributes['status'] =
            in_array($value, [self::STATUS_IN_PROGRESS, self::STATUS_DONE])
            ? $value
            : self::STATUS_IN_PROGRESS;
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/placeholder.png');
    }
}

