<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE `projects`
            MODIFY `status` ENUM('on_progress','done') NOT NULL DEFAULT 'on_progress'");
    }
    public function down(): void
    {
        DB::statement("ALTER TABLE `projects`
            MODIFY `status` ENUM('in_progress','done') NOT NULL DEFAULT 'in_progress'");
    }
};
