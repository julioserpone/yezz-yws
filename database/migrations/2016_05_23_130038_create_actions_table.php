<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('action_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('action_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['action_id','locale']);
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_translations');
        Schema::dropIfExists('actions');
    }
}
