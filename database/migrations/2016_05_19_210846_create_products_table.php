<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producttype_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('family_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->integer('scale_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->string('code', 20)->unique();
            $table->string('model', 50);
            $table->string('part_number', 50)->nullable();
            $table->string('description', 100);
            $table->enum('state', array_keys(trans('globals.type_state')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();

            $table->foreign('producttype_id')->references('id')->on('product_types');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('family_id')->references('id')->on('families');
            $table->foreign('technology_id')->references('id')->on('technologies');
            $table->foreign('scale_id')->references('id')->on('scales');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
