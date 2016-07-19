<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->increments('movements_id');
            $table->bigInteger('shopping_detail')->nullable();
            $table->bigInteger('sale_detail')->nullable();

            $table->integer('amount');
            $table->integer('total');
            $table->boolean('active')->default(true);

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });

        Schema::table('movements', function ($table) {
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
        Schema::drop('movements');
    }
}
