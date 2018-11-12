<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->integer('workshop_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('courier_id')->unsigned()->default(1);
            $table->integer('product_id')->unsigned();
            $table->string('order_number')->unique();           //FORMAT XX999999
            $table->timestampTz('order_date')->useCurrent();
            $table->enum('type_management', array_keys(trans('globals.type_management')))->default('warranty');
            $table->enum('personal_retreat', array_keys(trans('globals.verification')))->default('no');
            
            $table->string('client_invoice_number')->nullable();
            $table->date('client_invoice_date')->nullable();
            $table->string('client_invoice_doc')->nullable();

            //For GP Dinamics
            $table->string('gp_imei', 20);                      //SERLTNUM
            $table->string('gp_num_doc', 20)->nullable();       //SOPNUMBE
            $table->string('gp_item_code')->nullable();         //ITEMNMBR
            $table->string('gp_item_description')->nullable();  //ITEMDESC
            $table->string('gp_brand')->nullable();             //USCATVLS_1
            $table->string('gp_part_number')->nullable();       //USCATVLS_2
            $table->string('gp_model')->nullable();             //USCATVLS_4
            $table->date('gp_invoice_date')->nullable();        //DOCDATE
            $table->date('gp_purchase_date')->nullable();       //DATERECD
            $table->string('gp_customer_code')->nullable();     //CUSTNMBR
            $table->string('gp_customer_name')->nullable();     //CUSTNAME
            $table->string('gp_country_name', 20)->nullable();  //COUNTRY

            $table->string('tracking', 25)->nullable();
            $table->mediumText('failure_description');
            $table->text('accesories_received')->nullable();
            $table->string('devolution_zip_code')->nullable();
            $table->string('devolution_address')->nullable();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('workshop_id')->references('id')->on('workshops');
            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
