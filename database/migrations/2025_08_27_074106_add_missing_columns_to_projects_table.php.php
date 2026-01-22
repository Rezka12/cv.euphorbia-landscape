<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Tambah kolom image kalau belum ada
            if (!Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable(); // jangan pakai ->after(...) biar aman
            }

            // Tambah finished_at kalau belum ada (dipakai saat status = done)
            if (!Schema::hasColumn('projects', 'finished_at')) {
                $table->timestamp('finished_at')->nullable();
            }

            // Tambah portfolio_id kalau belum ada (kalau nanti proyek dipindah ke portofolio)
            if (!Schema::hasColumn('projects', 'portfolio_id')) {
                $table->foreignId('portfolio_id')->nullable()->constrained()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'portfolio_id')) {
                $table->dropConstrainedForeignId('portfolio_id');
            }
            if (Schema::hasColumn('projects', 'finished_at')) {
                $table->dropColumn('finished_at');
            }
            if (Schema::hasColumn('projects', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
