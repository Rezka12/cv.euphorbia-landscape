<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPhoto extends Model
{
    protected $fillable = ['project_id', 'path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // accessor opsional untuk URL
    public function getUrlAttribute(): string
    {
        $p = $this->path;
        if (str_starts_with($p, 'http://') || str_starts_with($p, 'https://') || str_starts_with($p, '/storage')) {
            return $p;
        }
        return asset('storage/'.$p);
    }
}
