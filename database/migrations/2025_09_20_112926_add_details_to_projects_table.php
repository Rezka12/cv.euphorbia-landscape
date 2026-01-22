<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'category')) $table->string('category')->nullable()->after('status');
            if (!Schema::hasColumn('projects', 'client'))   $table->string('client')->nullable()->after('category');
            if (!Schema::hasColumn('projects', 'location')) $table->string('location')->nullable()->after('client');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'location')) $table->dropColumn('location');
            if (Schema::hasColumn('projects', 'client'))   $table->dropColumn('client');
            if (Schema::hasColumn('projects', 'category')) $table->dropColumn('category');
        });
    }
};
