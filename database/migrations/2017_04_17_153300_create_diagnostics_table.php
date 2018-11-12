<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();
        });

        //Used for translations
        Schema::create('diagnostic_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('diagnostic_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['diagnostic_id','locale']);
            $table->foreign('diagnostic_id')->references('id')->on('diagnostics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostic_translations');
        Schema::dropIfExists('diagnostics');
    }
}
