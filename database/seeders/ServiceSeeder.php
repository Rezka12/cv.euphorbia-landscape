<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'nama' => 'Desain Taman',
            'deskripsi' => 'Pembuatan desain taman sesuai kebutuhan klien.'
        ]);

        Service::create([
            'nama' => 'Perawatan Taman',
            'deskripsi' => 'Layanan pemeliharaan dan perawatan taman.'
        ]);

        Service::create([
            'nama' => 'Pembuatan Kolam',
            'deskripsi' => 'Membangun kolam hias dan kolam ikan.'
        ]);
    }
}
