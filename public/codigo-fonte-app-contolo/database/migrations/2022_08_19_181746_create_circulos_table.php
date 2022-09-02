<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCirculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('circulos', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_circulo');
            $table->string('circulo', 20)->unique();
            $table->bigInteger('regiao_id')->unsigned();
            $table->bigInteger('provincia_id')->unsigned();

            $table->timestamps();
            //Set up of foreign key
            $table->foreign('regiao_id')->references('id')->on('regiaos');
            $table->foreign('provincia_id')->references('id')->on('provincias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('circulos');
    }
}
