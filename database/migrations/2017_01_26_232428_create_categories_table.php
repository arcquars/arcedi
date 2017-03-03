<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_env', function (Blueprint $table) {
            $table->increments('cat_env_id');
            $table->char('name', 1);
            $table->integer('bedrooms_num');
            $table->integer('bath_num');
            $table->decimal('area', 5, 2);
            $table->string('detail', 700);

            $table->boolean('delete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories_env');
    }
}
