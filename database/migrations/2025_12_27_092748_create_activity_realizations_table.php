<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityRealizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_realizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_plan_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Yang mencatat
            $table->date('actual_date');
            $table->string('actual_location')->nullable();
            $table->integer('participants_count')->default(0);
            $table->text('attendance_list')->nullable(); // JSON or comma-separated
            $table->text('report')->nullable();
            $table->text('achievements')->nullable(); // Hasil yang dicapai
            $table->text('obstacles')->nullable(); // Kendala
            $table->decimal('actual_budget', 15, 2)->nullable();
            $table->enum('status', ['draft', 'submitted', 'verified', 'rejected'])->default('draft');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Ketua yang verifikasi
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_realizations');
    }
}
