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
        // First, migrate existing data to new status values
        DB::statement("UPDATE activity_realizations SET status = 'sedang_berjalan' WHERE status IN ('draft', 'submitted')");
        DB::statement("UPDATE activity_realizations SET status = 'final' WHERE status = 'verified'");
        DB::statement("UPDATE activity_realizations SET status = 'batal' WHERE status = 'rejected'");

        // Drop and recreate the column with new enum values
        Schema::table('activity_realizations', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('activity_realizations', function (Blueprint $table) {
            $table->enum('status', ['sedang_berjalan', 'batal', 'final'])
                ->default('sedang_berjalan')
                ->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop and recreate with old values
        Schema::table('activity_realizations', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('activity_realizations', function (Blueprint $table) {
            $table->enum('status', ['draft', 'submitted', 'verified', 'rejected'])
                ->default('draft')
                ->after('user_id');
        });

        // Revert data back to old status values
        DB::statement("UPDATE activity_realizations SET status = 'draft' WHERE status = 'sedang_berjalan'");
        DB::statement("UPDATE activity_realizations SET status = 'verified' WHERE status = 'final'");
        DB::statement("UPDATE activity_realizations SET status = 'rejected' WHERE status = 'batal'");
    }
};
