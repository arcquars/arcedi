<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->increments('sd_id');
            $table->double('price_sale', 10, 2);
            $table->double('price_buy', 10, 2);
            $table->integer('amount');

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('sale_detail', function ($table) {
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('sale_id')->references('sale_id')->on('sale');
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
