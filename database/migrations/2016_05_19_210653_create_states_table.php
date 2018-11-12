<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->boolean('close_order')->default(false);
            $table->text('roles')->nullable();
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('state_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['state_id','locale']);
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_translations');
        Schema::dropIfExists('states');
    }
}
