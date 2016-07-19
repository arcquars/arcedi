<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchingsBathTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archings_bath', function (Blueprint $table) {
            $table->increments('ab_id');

            $table->dateTime("date_start");
            $table->dateTime("date_end");

            $table->double("outgo", 10, 2)->default(0);
            $table->double("entry", 10, 2)->default(0);


            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('archings_bath', function ($table) {
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
        Schema::drop('archings_bath');
    }
}
