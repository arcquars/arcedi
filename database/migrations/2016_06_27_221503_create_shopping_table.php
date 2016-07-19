<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping', function (Blueprint $table) {
            $table->increments('shopping_id');
            $table->string('detail', 700);
            $table->date('date');
            $table->bigInteger('nit');
            $table->double('total', 15, 2);
            $table->string('num_doc', 700);
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
        Schema::drop('shopping');
    }
}
