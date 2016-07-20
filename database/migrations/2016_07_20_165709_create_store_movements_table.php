<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_movements', function (Blueprint $table) {
            $table->increments('sm_id');
            $table->bigInteger('buy_detail')->nullable();
            $table->bigInteger('sale_detail')->nullable();
            $table->bigInteger('delivery_detail')->nullable();
            $table->bigInteger('refund_detail')->nullable();

            $table->integer('amount');
            $table->integer('total');
            $table->boolean('active')->default(true);

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('store_movements', function ($table) {
            $table->integer('product_id')->unsigned();
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
        Schema::drop('store_movements');
    }
}
