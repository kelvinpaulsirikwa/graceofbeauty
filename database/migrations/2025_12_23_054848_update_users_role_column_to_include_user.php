<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change role column from ENUM to string to allow 'user' role
        DB::statement("ALTER TABLE `users` MODIFY COLUMN `role` VARCHAR(255) DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to ENUM (you may need to adjust this based on your needs)
        DB::statement("ALTER TABLE `users` MODIFY COLUMN `role` ENUM('admin', 'owner', 'workers') DEFAULT 'workers'");
    }
};
