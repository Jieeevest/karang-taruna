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
        // Drop and recreate the column with updated enum values
        Schema::table('activity_plans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('activity_plans', function (Blueprint $table) {
            $table->enum('status', ['draft', 'pending_review', 'proposed', 'approved', 'rejected'])
                ->default('draft')
                ->after('budget');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        Schema::table('activity_plans', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('activity_plans', function (Blueprint $table) {
            $table->enum('status', ['draft', 'proposed', 'approved', 'rejected'])
                ->default('draft')
                ->after('budget');
        });
    }
};
