<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->string('ssn')->primary();
            $table->string('fullName');
            $table->string('mobile')->unique();
            $table->string('email')->unique();
            $table->string('motherName');
            $table->string('gender');
            $table->date('birthDate');
            $table->string('eduQual');
            $table->string('governorate');
            $table->string('city');
            $table->string('Street');
            $table->string('building');
            $table->string('socialState');
            $table->date('marriageDate')->nullable();
            $table->smallInteger('numOfChildren')->nullable();
            $table->string('servingType')->nullable();
            $table->string('deaconLevel')->nullable();
            $table->string('church');
            $table->string('confessFather');
            $table->string('img_url')->unique();
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
        Schema::dropIfExists('people');
    }
}
