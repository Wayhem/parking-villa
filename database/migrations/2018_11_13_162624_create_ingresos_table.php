<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate', 10);
            $table->string('brand', 20)->nullable();
            $table->bigInteger('preciofinal')->unsigned()->default(0);
            $table->bigInteger('tiempofinal')->unsigned()->default(0);
            $table->boolean('egresado')->default(0);
            $table->string('initc', 5);
            $table->string('currentc', 5);
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
        Schema::dropIfExists('ingresos');
    }
}
