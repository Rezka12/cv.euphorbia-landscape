<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('portfolio_portfolio_category')) {
            Schema::table('portfolio_portfolio_category', function (Blueprint $table) {
                if (!Schema::hasColumn('portfolio_portfolio_category', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('portfolio_portfolio_category')) {
            Schema::table('portfolio_portfolio_category', function (Blueprint $table) {
                if (Schema::hasColumn('portfolio_portfolio_category', 'created_at')) {
                    $table->dropColumn(['created_at','updated_at']);
                }
            });
        }
    }
};
