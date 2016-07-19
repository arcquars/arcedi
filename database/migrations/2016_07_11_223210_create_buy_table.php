<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy', function (Blueprint $table) {
            $table->increments('buy_id');
            $table->string('detail', 500);
            $table->date('date_buy');
            $table->bigInteger('nit');
            $table->string('razon_social', 500);
            $table->double('total', 10, 2);
            $table->bigInteger('user_id');
            $table->string('num_doc', 150);

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
        Schema::drop('buy');
    }
}
