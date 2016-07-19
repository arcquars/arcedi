<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentATable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('payment_a', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('ci');
    		$table->double("total", 10, 2)->default(0);
    		$table->text("description");
    		$table->boolean('recojo')->default(false);
    		$table->dateTime('payment_date');
    		
    		// Total de meses a pagar
    		$table->double("month_total", 10, 2)->default(0);
    		// Total de dias de multa
    		$table->integer("penalty_day")->default(0);
    		// Multa por dia, despensas 
    		$table->double("penalty_fee", 10, 2)->default(0);
    		$table->double("payment_larder", 10, 2)->default(0);
    	
    		$table->date('date_start');
    		$table->date('date_end');
    	
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    		 
    		Schema::table('payment_a', function ($table) {
    			$table->integer('rental_a_id')->unsigned();
    			$table->foreign('rental_a_id')->references('ra_id')->on('rental_anti');
    		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('payment_a');
    }
}
