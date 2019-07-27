<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related', function (Blueprint $table) {
            $table->string('fatherssn')->primary();
            $table->string('memberssn')->unique();
            $table->string('memberType');
            $table->timestamps();
        });
        Schema::table('related', function (Blueprint $table) {
            $table->foreign('fatherssn')->references('ssn')->on('people');
            $table->foreign('memberssn')->references('ssn')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related');
    }
}
