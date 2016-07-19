<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchingAntiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('arching_anti', function (Blueprint $table) {
    		$table->increments('arch_anti_id');
    		
    		$table->double("larder", 10, 2)->default(0);
    		$table->double("penality", 10, 2)->default(0);
    		$table->double("total", 10, 2)->default(0);
    		 
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		 
    	});
    		 
    		Schema::table('arching_anti', function ($table) {
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
    	Schema::drop('arching_anti');
    }
}
