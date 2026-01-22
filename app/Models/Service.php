<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    // IKUTI nama kolom di database
    protected $fillable = ['name', 'description', 'image'];

    // Relasi: 1 service punya banyak project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
