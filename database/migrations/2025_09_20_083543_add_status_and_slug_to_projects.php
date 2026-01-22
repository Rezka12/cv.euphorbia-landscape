<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambah kolom hanya jika belum ada
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('on_progress')->index();
            }
            if (!Schema::hasColumn('projects', 'slug')) {
                $table->string('slug')->nullable();
                // pakai unique terpisah & cek index dulu
                $table->unique('slug', 'projects_slug_unique');
            }
        });
    }

    public function down(): void
    {
        // Drop unique + kolom hanya jika ada
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'slug')) {
                // nama index mengikuti yang di up()
                $table->dropUnique('projects_slug_unique');
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('projects', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
