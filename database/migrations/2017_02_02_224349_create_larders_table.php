<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLardersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_person_may');
            $table->integer('num_person_men');
            $table->decimal('larder_may', 10, 2);
            $table->decimal('larder_men', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('larders');
    }
}
