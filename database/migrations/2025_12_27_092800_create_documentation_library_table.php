<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationLibraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentation_library', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Uploader
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('activity_realization_id')->nullable()->constrained()->onDelete('cascade'); // Relasi ke kegiatan
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['photo', 'video', 'document'])->default('photo');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type'); // mime type
            $table->integer('file_size'); // in bytes
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
        Schema::dropIfExists('documentation_library');
    }
}
