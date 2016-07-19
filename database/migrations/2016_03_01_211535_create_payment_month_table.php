<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('payment_month', function (Blueprint $table) {
    		$table->increments('id');
    		$table->date('date');
    		$table->double("payment", 10, 2)->default(0);
    		$table->double("payment_penalty", 10, 2)->default(0);
    		$table->double("payment_larder", 10, 2)->default(0);
    		$table->text("description");
    		 
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    	});
    		 
    		Schema::table('payment_month', function ($table) {
    			$table->integer('payment_m_id')->unsigned();
    			$table->foreign('payment_m_id')->references('id')->on('payment_m');
    		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('payment_month');
    }
}
