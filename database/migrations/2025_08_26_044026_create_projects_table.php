<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('client')->nullable();       // ✅ tambahkan ini
            $table->string('location')->nullable();     // ✅ tambahkan ini
            $table->string('slug')->nullable();         // ✅ tambahkan ini
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
