<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->increments('env_id');
            $table->enum('type', ['Departamento', 'Oficina', 'Deposito', 'Tienda', 'Area Social'])->default('Departamento');
            $table->double('area', 10, 2);
            $table->integer('flat');
            $table->string('code');
            $table->boolean('busy')->default(false);
            $table->boolean('delete')->default(false);
            $table->timestamps();
            
            //$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('environments');
    }
}
