<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->longText('about')->nullable();
            $table->longText('vision')->nullable(); // Visi
            $table->longText('mission')->nullable(); // Misi
            $table->longText('history')->nullable();
            $table->json('structure')->nullable(); // Struktur kepengurusan (JSON)
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('social_media')->nullable(); // JSON: facebook, instagram, etc
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
        Schema::dropIfExists('organization_profiles');
    }
}
