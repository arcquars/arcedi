<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateAndIduserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('extra', function (Blueprint $table) {
            $table->datetime('date_extra')->after('total');
            $table->bigInteger('user_id')->after('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('extra', function (Blueprint $table) {
            $table->dropColumn("date_extra");
            $table->dropColumn("user_id");
        });
    }
}
