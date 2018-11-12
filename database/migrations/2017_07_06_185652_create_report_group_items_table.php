<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportGroupItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_group_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_group_id')->unsigned();
            $table->foreign('report_group_id')->references('id')->on('report_groups');
            $table->string('code',250);
            $table->string('value',50)->nullable();
            $table->integer('order');
            $table->timestamps();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('report_group_item_trans', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('report_group_item_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['report_group_item_id','locale']);
            $table->foreign('report_group_item_id')->references('id')->on('report_group_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_group_item_trans');
        Schema::dropIfExists('report_group_items');
    }
}
