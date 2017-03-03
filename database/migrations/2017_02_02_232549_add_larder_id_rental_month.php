<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLarderIdRentalMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_month', function (Blueprint $table) {
            $table->integer('larder_id')->nullable()->after('larder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_month', function (Blueprint $table) {
            $table->dropColumn("larder_id");
        });
    }
}
