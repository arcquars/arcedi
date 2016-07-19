<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchingTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('arching_time', function (Blueprint $table) {
    		$table->increments('arch_time_id');
    	
    		$table->double("total_time", 10, 2)->default(0);
    		$table->double("total", 10, 2)->default(0);
    		 
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    		 
   		Schema::table('arching_time', function ($table) {
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
    	Schema::drop('arching_time');
    }
}
