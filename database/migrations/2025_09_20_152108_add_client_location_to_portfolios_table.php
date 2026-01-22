<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'client')) {
                $table->string('client')->nullable()->after('image');
            }
            if (!Schema::hasColumn('portfolios', 'location')) {
                $table->string('location')->nullable()->after('client');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('portfolios', 'location')) {
                $table->dropColumn('location');
            }
            if (Schema::hasColumn('portfolios', 'client')) {
                $table->dropColumn('client');
            }
        });
    }
};