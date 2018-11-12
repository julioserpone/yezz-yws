<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('workshop_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
            $table->string('role', 20)->default('callcenter');
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->string('username')->unique();
            $table->string('pic_url', 150)->nullable();
            $table->enum('gender', array_keys(trans('globals.gender')))->default('male');
            $table->string('identification', 50)->unique();
            $table->date('birth_date', 50)->nullable();
            $table->string('cellphone_number', 20)->nullable();
            $table->string('homephone_number', 20)->nullable();
            $table->string('email', '100')->unique();
            $table->string('password', 60);
            $table->enum('verified', array_keys(trans('globals.verification')))->default('yes');
            $table->enum('status', array_keys(trans('globals.type_status')))->default('active');
            $table->enum('language', array_keys(trans('globals.language')))->default('es');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('disabled_at')->nullable();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
