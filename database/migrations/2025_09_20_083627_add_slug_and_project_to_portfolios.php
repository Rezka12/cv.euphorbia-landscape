<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'slug')) {
                $table->string('slug')->nullable();
                $table->unique('slug', 'portfolios_slug_unique');
            }
            if (!Schema::hasColumn('portfolios', 'project_id')) {
                $table->foreignId('project_id')->nullable()
                      ->constrained()->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('portfolios', 'project_id')) {
                $table->dropConstrainedForeignId('project_id');
            }
            if (Schema::hasColumn('portfolios', 'slug')) {
                $table->dropUnique('portfolios_slug_unique');
                $table->dropColumn('slug');
            }
        });
    }
};
