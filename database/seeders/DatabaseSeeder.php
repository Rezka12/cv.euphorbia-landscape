<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::create([
        'name' => 'Admin',
        'email' => 'admin@company.com',
        'password' => Hash::make('password123'), // ganti nanti biar aman
        'role' => 'admin',
    ]);
        $this->call(CategorySeeder::class);
    }
}
