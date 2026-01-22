<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('abouts', 'description')) {
            Schema::table('abouts', function (Blueprint $table) {
                $table->longText('description')->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('abouts', 'description')) {
            Schema::table('abouts', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
};
