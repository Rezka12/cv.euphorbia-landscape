<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Pastikan kolom "name"
        if (Schema::hasColumn('projects', 'judul') && !Schema::hasColumn('projects', 'name')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->string('name')->after('id');
            });
            DB::statement("UPDATE projects SET name = judul WHERE name IS NULL OR name = ''");
            Schema::table('projects', function (Blueprint $t) {
                $t->dropColumn('judul');
            });
        }

        // 2) Pastikan kolom "description"
        if (Schema::hasColumn('projects', 'deskripsi') && !Schema::hasColumn('projects', 'description')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->text('description')->nullable()->after('name');
            });
            DB::statement("UPDATE projects SET description = deskripsi WHERE description IS NULL");
            Schema::table('projects', function (Blueprint $t) {
                $t->dropColumn('deskripsi');
            });
        }

        // 3) Pastikan kolom "image"
        if (!Schema::hasColumn('projects', 'image')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->string('image')->nullable()->after('description');
            });
        }
        // Jika masih ada kolom 'gambar', salin lalu hapus
        if (Schema::hasColumn('projects', 'gambar')) {
            DB::statement("UPDATE projects SET image = COALESCE(image, gambar)");
            Schema::table('projects', function (Blueprint $t) {
                $t->dropColumn('gambar');
            });
        }

        // 4) Normalisasi ENUM status -> in_progress/done
        // (tanpa Doctrine; gunakan raw SQL)
        DB::statement("ALTER TABLE projects MODIFY COLUMN status ENUM('in_progress','done') NOT NULL DEFAULT 'in_progress'");

        // Migrasi nilai lama ke nilai baru
        DB::statement("UPDATE projects SET status = 'in_progress' WHERE status IN ('on_progress','progress','progres')");
        DB::statement("UPDATE projects SET status = 'done'        WHERE status IN ('selesai','finished')");

        // 5) Kolom finished_at biar nullable (kalau belum ada)
        if (!Schema::hasColumn('projects', 'finished_at')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->timestamp('finished_at')->nullable()->after('image');
            });
        }

        // 6) Kolom relasi (kalau mau, biarkan nullable)
        if (!Schema::hasColumn('projects', 'service_id')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            });
        }
        if (!Schema::hasColumn('projects', 'portfolio_id')) {
            Schema::table('projects', function (Blueprint $t) {
                $t->foreignId('portfolio_id')->nullable()->constrained()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Tidak perlu rollback detail (opsional)
    }
};
