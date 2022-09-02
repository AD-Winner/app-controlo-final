<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kits', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->nullable(true);
            $table->string('descricao', 125)->nullable(true);

            $table->bigInteger('provincia_id')->unsigned()->nullable(true);
            $table->bigInteger('regiao_id')->unsigned()->nullable(true);
            $table->bigInteger('circulo_id')->unsigned()->nullable(true);
            $table->bigInteger('sector_id')->unsigned()->nullable(true);
            $table->bigInteger('recenseamento_id')->unsigned()->nullable(true);

            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('regiao_id')->references('id')->on('regiaos');
            $table->foreign('circulo_id')->references('id')->on('circulos');
            $table->foreign('sector_id')->references('id')->on('sectors');
            $table->foreign('recenseamento_id')->references('id')->on('recenseamentos');

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
        Schema::dropIfExists('kits');
    }
}
