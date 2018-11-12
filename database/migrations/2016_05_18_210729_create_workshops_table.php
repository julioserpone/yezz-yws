<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('route_id')->unsigned();
            $table->string('identification')->nullable();
            $table->string('description', 150);
            $table->text('address');
            $table->text('comment')->nullable();
            $table->string('contact_name', 150)->nullable();
            $table->string('officephone_number', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('work_schedule', 100)->nullable();
            $table->enum('type', array_keys(trans('globals.type_workshop')))->default('both');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');

            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('route_id')->references('id')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
