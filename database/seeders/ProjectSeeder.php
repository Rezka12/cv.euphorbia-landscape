<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::insert([
            [
                'name'        => 'Taman Kota Mini',
                'description' => 'Penataan softscape area publik.',
                'status'      => 'active', // ✅ diganti dari on_progress
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Taman Rumah Jepang',
                'description' => 'Konsep zen garden, material batu & kayu.',
                'status'      => 'completed', // ✅ diganti dari done
                'finished_at' => now()->subDays(7),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
