<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHistoryCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_history_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->mediumText('comment')->nullable();
            $table->timestampTz('log_date')->useCurrent();
            $table->timestamps();

            $table->foreign('order_history_id')->references('id')->on('order_histories');
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
        Schema::dropIfExists('order_history_comments');
    }
}
