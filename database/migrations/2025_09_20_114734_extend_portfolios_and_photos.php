<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'slug'))         $table->string('slug')->unique()->nullable();
            if (!Schema::hasColumn('portfolios', 'client'))       $table->string('client')->nullable();
            if (!Schema::hasColumn('portfolios', 'location'))     $table->string('location')->nullable();
            if (!Schema::hasColumn('portfolios', 'published_at')) $table->timestamp('published_at')->nullable();
        });

        if (!Schema::hasTable('portfolio_photos')) {
            Schema::create('portfolio_photos', function (Blueprint $t) {
                $t->id();
                $t->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
                $t->string('path');
                $t->timestamps();
            });
        }
    }

    public function down(): void
    {
        // balik minimal aman
        if (Schema::hasTable('portfolio_photos')) {
            Schema::dropIfExists('portfolio_photos');
        }
        Schema::table('portfolios', function (Blueprint $table) {
            foreach (['slug','client','location','published_at'] as $col) {
                if (Schema::hasColumn('portfolios',$col)) $table->dropColumn($col);
            }
        });
    }
};
