<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_sector');
            $table->string('sector', 191)->unique();

            $table->bigInteger('regiao_id')->unsigned();
            $table->bigInteger('provincia_id')->unsigned();
            $table->bigInteger('circulo_id')->unsigned();
            //Set up of foreign key
            $table->foreign('regiao_id')->references('id')->on('regiaos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('circulo_id')->references('id')->on('circulos');
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
        Schema::dropIfExists('sectors');
    }
}
