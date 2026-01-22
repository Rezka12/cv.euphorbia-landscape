<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ubah judul→name, deskripsi→description, gambar→image jika kolom2 lama itu masih ada
        Schema::table('portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('portfolios', 'judul') && !Schema::hasColumn('portfolios', 'name')) {
                $table->renameColumn('judul', 'name');
            }
            if (Schema::hasColumn('portfolios', 'deskripsi') && !Schema::hasColumn('portfolios', 'description')) {
                $table->renameColumn('deskripsi', 'description');
            }
            if (Schema::hasColumn('portfolios', 'gambar') && !Schema::hasColumn('portfolios', 'image')) {
                $table->renameColumn('gambar', 'image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('portfolios', 'name')) {
                $table->renameColumn('name', 'judul');
            }
            if (Schema::hasColumn('portfolios', 'description')) {
                $table->renameColumn('description', 'deskripsi');
            }
            if (Schema::hasColumn('portfolios', 'image')) {
                $table->renameColumn('image', 'gambar');
            }
        });
    }
};
