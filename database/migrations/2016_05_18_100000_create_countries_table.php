<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 100);
            $table->string('iso_code', 2)->nullable();
            $table->string('calling_code', 5)->nullable();
            $table->string('coin_code', 4)->nullable();
            $table->string('coin_name', 20)->nullable();
            $table->enum('language', array_keys(trans('globals.language')))->default('en');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
