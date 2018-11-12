<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 20);
            $table->string('name_attribute', 100);
            $table->enum('type_data', array_keys(trans('globals.type_data')))->default('string');
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
        Schema::dropIfExists('attributes');
    }
}
