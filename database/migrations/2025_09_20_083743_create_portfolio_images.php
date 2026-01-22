<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('portfolio_images')) {
            Schema::create('portfolio_images', function (Blueprint $t) {
                $t->id();
                $t->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
                $t->string('path');
                $t->unsignedInteger('sort_order')->default(0);
                $t->timestamps();
            });
        }
    }
    public function down(): void
    {
        if (Schema::hasTable('portfolio_images')) {
            Schema::dropIfExists('portfolio_images');
        }
    }
};
