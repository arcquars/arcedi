<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('delivery_id');
            $table->string('detail', 500);
            $table->date('date_delivery');
            $table->bigInteger('ci');
            $table->bigInteger('user_id');

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
        Schema::drop('delivery');
    }
}
