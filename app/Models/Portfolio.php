<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'client',
        'location',
        'description',
        'image',
        'started_at',
        'finished_at',
    ];

    /**
     * Foto-foto portofolio
     */
    public function photos()
    {
        return $this->hasMany(PortfolioPhoto::class);
    }

    /**
     * Kategori portofolio (many-to-many)
     */
    public function categories()
    {
        return $this->belongsToMany(
            PortfolioCategory::class,
            'portfolio_portfolio_category',
            'portfolio_id',
            'portfolio_category_id'
        )->withTimestamps();
    }
}
