<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_time', function (Blueprint $table) {
        	$table->increments('rt_id');
        	$table->date("date_contract");
        	$table->double("rental_payment", 10, 2);
        	$table->double("time_total", 10, 2);
        	$table->double("penalty", 10, 2)->default(0);
        	$table->double("warranty", 10, 2);
        	$table->double("payment", 10, 2);
        	$table->string("detail_time", 100);
        	
        	$table->boolean('canceled')->default(false);
        	$table->boolean('delete')->default(false);
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
    	Schema::drop('rental_time');
    }
}
