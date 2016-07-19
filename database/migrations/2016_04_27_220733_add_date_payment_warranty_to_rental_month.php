<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatePaymentWarrantyToRentalMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_month', function (Blueprint $table) {
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
        Schema::table('rental_month', function (Blueprint $table) {
            $table->dropColumn("date_payment_warranty");
        });
    }
}
