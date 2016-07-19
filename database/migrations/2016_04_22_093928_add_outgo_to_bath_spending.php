<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOutgoToBathSpending extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bacth_spending', function (Blueprint $table) {
            $table->double("outgo", 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bacth_spending', function (Blueprint $table) {
            $table->dropColumn("outgo");
        });
    }
}
