<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('code', 50);
            $table->string('route', 200)->nullable();
            $table->string('icon')->nullable();
            $table->string('roles')->nullable();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('menu_route_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('menu_route_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['menu_route_id','locale']);
            $table->foreign('menu_route_id')->references('id')->on('menu_routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_route_translations');
        Schema::dropIfExists('menu_routes');
    }
}
