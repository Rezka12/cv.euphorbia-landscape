<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('abouts') && ! Schema::hasColumn('abouts', 'profil_excel')) {
            Schema::table('abouts', function (Blueprint $table) {
                $table->string('profil_excel')->nullable()->after('image'); // sesuaikan posisi kolom jika perlu
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('abouts') && Schema::hasColumn('abouts', 'profil_excel')) {
            Schema::table('abouts', function (Blueprint $table) {
                $table->dropColumn('profil_excel');
            });
        }
    }
};
