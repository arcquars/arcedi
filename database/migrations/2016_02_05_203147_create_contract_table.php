<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('contract', function (Blueprint $table) {
    		$table->increments('contract_id');
    		
    		$table->integer("rental_m_id")->nullable();
    		$table->integer("rental_h_id")->nullable();
    		$table->integer("anticrisis_id")->nullable();
    		$table->enum('status', ['Vigente', 'Cancelado']);
    		$table->boolean('delete')->default(false);
    		$table->timestamps();
    		
    	});
    	
		Schema::table('contract', function ($table) {
			$table->integer('env_id')->unsigned();
			$table->integer('per_id')->unsigned();
			
			$table->foreign('env_id')->references('env_id')->on('environments');
			$table->foreign('per_id')->references('id')->on('persons');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('contract');
    }
}
