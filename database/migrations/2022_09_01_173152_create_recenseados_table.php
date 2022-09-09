<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecenseadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recenseados', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data')->nullable(false);
            $table->integer('homen');
            $table->integer('mulher');

            $table->bigInteger('recenseamento_id')->unsigned();
            $table->bigInteger('provincia_id')->unsigned();
            $table->bigInteger('regiao_id')->unsigned();
            $table->bigInteger('circulo_id')->unsigned();
            $table->bigInteger('sector_id')->unsigned();
            $table->bigInteger('kit_id')->unsigned();
            
            //Set up of foreign key
            $table->foreign('recenseamento_id')->references('id')->on('recenseamentos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('regiao_id')->references('id')->on('regiaos');
            $table->foreign('circulo_id')->references('id')->on('circulos');
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('kit_id')->references('id')->on('kits');
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
        Schema::dropIfExists('recenseados');
    }
}
