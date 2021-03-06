<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalMonthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('rental_month', function (Blueprint $table) {
    		$table->increments('rm_id');
    		$table->date("date_admission");
    		$table->date("date_end");
    		$table->double("warranty", 10, 2);
    		$table->double("payment", 10, 2);
    		$table->double("larder", 10, 2);
    		$table->double("penalty_fee", 10, 2);
    		
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		
    		//$table->primary('rm_id');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('rental_month');
    }
}
