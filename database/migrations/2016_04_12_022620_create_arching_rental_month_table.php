<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchingRentalMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('arching_rental_month', function (Blueprint $table) {
    		$table->increments('arch_month_id');
    		 
    		$table->double("rental", 10, 2)->default(0);
    		$table->double("larder", 10, 2)->default(0);
    		$table->double("penality", 10, 2)->default(0);
    		$table->double("total", 10, 2)->default(0);
    	
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    		 
    		Schema::table('arching_rental_month', function ($table) {
    			$table->integer('arch_id')->unsigned();
    	
    			$table->foreign('arch_id')->references('arch_id')->on('archings');
    		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('arching_rental_month');
    }
}
