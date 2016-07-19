<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_detail', function (Blueprint $table) {
            $table->increments('bd_id');
            $table->double('price', 10, 2);
            $table->integer('amount');
            $table->integer('available');

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('buy_detail', function ($table) {
            $table->integer('buy_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('buy_id')->references('buy_id')->on('buy');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('buy_detail');
    }
}
