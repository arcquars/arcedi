<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsRentalAnti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_anti', function (Blueprint $table) {
            $table->boolean("state")->default(false)->after('penalty_fee');
            $table->dateTime("date_payment_warranty")->default(null)->after('penalty_fee');
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
            $table->dropColumn("state");
            $table->dropColumn("date_payment_warranty");
        });
    }
}
