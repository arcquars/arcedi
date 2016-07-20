<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refund_detail', function (Blueprint $table) {
            $table->increments('rd_id');
            $table->integer('amount');
            $table->string('detail');

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('refund_detail', function ($table) {
            $table->integer('refund_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('refund_id')->references('refund_id')->on('refunds');
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
        Schema::drop('refund_detail');
    }
}
