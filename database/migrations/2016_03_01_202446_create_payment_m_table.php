<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('payment_m', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('ci');
    		$table->double("total", 10, 2)->default(0);
    		$table->text("description");
    		$table->boolean('recojo')->default(false);
    		$table->dateTime('payment_date');
    		 
    		$table->double("month_total", 10, 2)->default(0);
    		$table->double("penalty_fee", 10, 2)->default(0);
    		$table->double("payment_rental", 10, 2)->default(0);
    		$table->double("payment_larder", 10, 2)->default(0);
    		
    		$table->date('date_start');
    		$table->date('date_end');
    		
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    		 
		Schema::table('payment_m', function ($table) {
			$table->integer('rental_m_id')->unsigned();
			$table->foreign('rental_m_id')->references('rm_id')->on('rental_month');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('payment_m');
    }
}
