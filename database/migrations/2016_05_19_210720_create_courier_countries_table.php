<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourierCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courier_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_countries');
    }
}
