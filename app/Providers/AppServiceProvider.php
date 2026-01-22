<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ⛔ Nonaktifkan sementara query ke tabel projects saat migrasi
        $projectCategories = collect();
        $portfolioCategories = collect();

        // Share ke view supaya aplikasi tetap bisa jalan
        View::share([
            'navProjectCategories'   => $projectCategories,
            'navPortfolioCategories' => $portfolioCategories,
        ]);
    }
}
