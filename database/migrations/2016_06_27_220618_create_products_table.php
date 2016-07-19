<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('code', 700);
            $table->string('name', 700);
            $table->double('price_reference', 15, 2);
            $table->string('category', 200);
            $table->string('factory', 200);

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
        Schema::drop('products');
    }
}
