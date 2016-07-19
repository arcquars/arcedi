<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('persons', function (Blueprint $table) {
    		$table->increments('id');
    		$table->integer('user_id')->nullable();
    		$table->bigInteger('ci')->unique();
    		$table->enum('expedido', ['BNI', 'CHQ', 'CBA', 'LPZ', 'ORU', 'PND', 'PSI', 'SCZ', 'TJA']);
    		$table->string('names', 250);
    		$table->string('last_name_f', 250);
    		$table->string('last_name_m', 250)->nullable();
    		$table->string('phone', 15);
    		$table->string('phone_cel', 15);
    		$table->string('email')->nullable();
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		
    		//$table->primary('id');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('persons');
    }
}
