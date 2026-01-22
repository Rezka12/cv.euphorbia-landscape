<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('project_images')) {
            Schema::create('project_images', function (Blueprint $t) {
                $t->id();
                $t->foreignId('project_id')->constrained()->cascadeOnDelete();
                $t->string('path');
                $t->unsignedInteger('sort_order')->default(0);
                $t->timestamps();
            });
        }
    }
    public function down(): void
    {
        if (Schema::hasTable('project_images')) {
            Schema::dropIfExists('project_images');
        }
    }
};
