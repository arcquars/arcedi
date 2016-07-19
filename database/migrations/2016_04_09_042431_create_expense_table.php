<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('expenses', function (Blueprint $table) {
    		$table->increments('exp_id');
    		$table->dateTime("date_expense");
    		$table->string("concept", 250);
    		$table->double("expense", 10, 2);
    		$table->double("amount", 10, 2);
    		$table->double("total", 10, 2)->default(0);
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    	});
    	
		Schema::table('expenses', function ($table) {
			$table->integer('user_id')->unsigned();
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
    	Schema::drop('expenses');
    }
}
