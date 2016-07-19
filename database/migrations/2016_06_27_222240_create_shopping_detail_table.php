<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_detail', function (Blueprint $table) {
            $table->increments('sd_id');
            $table->integer('amount');
            $table->double('price_shopping', 15, 2);
            $table->integer('available');

            $table->boolean('delete')->default(false);
            $table->timestamps();

            //$table->primary('id');
        });

        Schema::table('shopping_detail', function ($table) {
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('product_id')->on('products');

            $table->integer('shopping_id')->unsigned();
            $table->foreign('shopping_id')->references('shopping_id')->on('shopping');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shopping_detail');
    }
}
