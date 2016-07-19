<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLarderMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('larder_month', function (Blueprint $table) {
    		$table->increments('lm_id');
    		$table->date('date');
    		$table->date('payment_date');
    		$table->double("payment", 10, 2)->default(0);
    		$table->text("description");
    		 
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    	
    		Schema::table('larder_month', function ($table) {
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
    	Schema::drop('larder_month');
    }
}
