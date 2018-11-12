<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHistoryActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_history_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('order_history_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('deleted_by')->nullable()->unsigned();
            $table->mediumText('comment')->nullable();
            $table->timestampTz('log_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('order_history_id')->references('id')->on('order_histories');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_history_actions');
    }
}
