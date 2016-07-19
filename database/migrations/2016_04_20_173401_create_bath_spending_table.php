<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBathSpendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacth_spending', function (Blueprint $table) {
            $table->increments('bs_id');
            $table->date('date_spending');
            $table->double('amount', 10, 2);
            $table->string('code_envoice', 250);
            $table->text('detail');
            $table->boolean('flat')->default(false);
            $table->bigInteger('ci')->nullable();

            $table->boolean('delete')->default(false);
            $table->timestamps();

        });
        Schema::table('bacth_spending', function ($table) {
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bacth_spending');
    }
}
