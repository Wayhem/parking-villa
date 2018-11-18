<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCeldasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celdas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('idingreso')->unsigned()->nullable();
            $table->bigInteger('a_time')->unsigned()->default(0);
            $table->boolean('libre')->default(1);
            $table->boolean('posicion');
            $table->string('codename', 5)->unique();

            $table->foreign('idingreso')->references('id')->on('ingresos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('celdas');
    }
}
