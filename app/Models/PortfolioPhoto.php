<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioPhoto extends Model
{
    protected $fillable = ['portfolio_id', 'path'];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    /**
     * URL publik untuk <img src="..."> di blade.
     * - Kalau path sudah absolute (http/https atau diawali /), pakai apa adanya
     * - Kalau path diawali "public/", buang prefix-nya
     * - Sisanya keluarkan via /storage/... (disk public)
     */
    public function getUrlAttribute(): string
    {
        $path = (string) ($this->path ?? '');

        if ($path === '') {
            return asset('images/placeholder.jpg');
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        // normalisasi kalau ada "public/" tersimpan di DB
        $path = preg_replace('#^public/#', '', $path);

        // hasil akhirnya /storage/xxx
        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Hapus file fisik saat record dihapus, kecuali kalau path absolute.
     */
    protected static function booted(): void
    {
        static::deleting(function (self $model) {
            $p = (string) $model->path;

            if ($p === '' || Str::startsWith($p, ['http://', 'https://', '/'])) {
                return; // jangan hapus kalau absolute
            }

            $p = preg_replace('#^public/#', '', $p);
            Storage::disk('public')->delete($p);
        });
    }
}
