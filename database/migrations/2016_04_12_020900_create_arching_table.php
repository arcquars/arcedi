<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('archings', function (Blueprint $table) {
    		$table->increments('arch_id');
    	
    		$table->dateTime("date_start");
    		$table->dateTime("date_end");
    		
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    	
    	});
    	
    	Schema::table('archings', function ($table) {
    		$table->integer('user_id')->unsigned();
    		$table->integer('per_id')->unsigned();
    				
    		$table->foreign('per_id')->references('id')->on('persons');
    		$table->foreign('user_id')->references('id')->on('users');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('archings');
    }
}
