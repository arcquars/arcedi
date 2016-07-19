<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('env_images', function (Blueprint $table) {
            $table->increments('env_image_id');
            $table->string('url_image', 700);
            $table->string('url_image_thumbnail', 700);
            $table->integer('weight')->default(0);
            $table->boolean('delete')->default(false);

            $table->timestamps();

            //$table->primary('id');
        });

        Schema::table('env_images', function ($table) {
            $table->integer('env_id')->unsigned();
            $table->foreign('env_id')->references('env_id')->on('environments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('env_images');
    }
}
