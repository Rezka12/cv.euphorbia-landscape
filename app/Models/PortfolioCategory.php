<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi ke portofolio
     */
    public function portfolios()
    {
        return $this->belongsToMany(
            Portfolio::class,
            'portfolio_portfolio_category',
            'portfolio_category_id',
            'portfolio_id'
        )->withTimestamps();
    }
}
