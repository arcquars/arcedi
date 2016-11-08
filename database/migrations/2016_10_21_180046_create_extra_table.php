<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra', function (Blueprint $table) {
            $table->increments('extra_id');
            $table->string('detail', 500);
            $table->decimal('total', 5, 2);

            $table->timestamps();
        });

        Schema::table('extra', function ($table) {
            $table->integer('contract_id')->unsigned();
            $table->foreign('contract_id')->references('contract_id')->on('contract');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('extra');
    }
}
