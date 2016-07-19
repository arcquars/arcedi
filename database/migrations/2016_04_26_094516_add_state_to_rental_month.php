<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStateToRentalMonth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rental_month', function (Blueprint $table) {
            $table->boolean("state")->default(false)->after('penalty_fee');
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
            $table->dropColumn("state");
        });
    }
}
