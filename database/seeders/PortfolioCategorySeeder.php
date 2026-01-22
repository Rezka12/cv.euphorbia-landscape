<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Softscape', 'Pemeliharaan', 'Softscape & Hardscape', 'Perancangan & Pembangunan'];
        foreach ($names as $name) {
            PortfolioCategory::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
