<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_detail', function (Blueprint $table) {
            $table->increments('dd_id');
            $table->integer('amount');

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('delivery_detail', function ($table) {
            $table->integer('delivery_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('delivery_id')->references('delivery_id')->on('deliveries');
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
        Schema::drop('delivery_detail');
    }
}
