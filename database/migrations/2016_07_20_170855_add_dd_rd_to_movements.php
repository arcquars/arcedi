<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDdRdToMovements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->bigInteger('delivery_detail')->nullable()->after('sale_detail');
            $table->bigInteger('refund_detail')->nullable()->after('delivery_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dropColumn("delivery_detail");
            $table->dropColumn("refund_detail");
        });
    }
}
