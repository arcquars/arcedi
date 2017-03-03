<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLarderIdRentalAnti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_anti', function (Blueprint $table) {
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
        Schema::table('rental_anti', function (Blueprint $table) {
            $table->dropColumn("larder_id");
        });
    }
}
