<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }

    public function scopeVisible($query)
    {
        return $query->whereNotIn('slug', config('portfolio.hidden_category_slugs', []));
    }
}
