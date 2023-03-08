<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title', 255)->nullable();
            $table->string('photo_path', 255)->nullable();
            $table->boolean('intro_flag')->default(false);
            $table->text('intro')->nullable();
            $table->boolean('job_flag')->default(false);
            $table->string('company', 255)->nullable();
            $table->string('director', 255)->nullable();
            $table->boolean('edu_flag')->default(false);
            $table->string('edu', 255)->nullable();
            $table->string('major', 255)->nullable();
            $table->boolean('address_flag')->default(false);
            $table->string('address', 500)->nullable();
            $table->boolean('skill_flag')->default(false);
            $table->string('skill', 255)->nullable();
            $table->boolean('sns_flag')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
