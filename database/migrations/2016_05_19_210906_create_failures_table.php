<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('failure_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('failure_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['failure_id','locale']);
            $table->foreign('failure_id')->references('id')->on('failures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failure_translations');
        Schema::dropIfExists('failures');
    }
}
