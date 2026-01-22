<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'profil_excel',
    ];

    /**
     * AUTO DEFAULT DESCRIPTION
     * Jika kolom description NULL / kosong
     */
    public function getDescriptionAttribute($value)
    {
        return $value ?: '
            <p><b>CV. Euphorbia Landscape</b> adalah perusahaan yang bergerak di bidang
            Landscape Construction, Design & Build, Maintenance, serta Nursery.</p>

            <p>Kami berkomitmen menghadirkan kualitas tanaman terbaik,
            hasil kerja rapi, dan ketepatan waktu dalam setiap proyek.</p>
        ';
    }
}
