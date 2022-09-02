<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegiaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('regiaos', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_regiao');
            $table->string('regiao', 20)->unique();
            $table->bigInteger('provincia_id')->unsigned();
            $table->timestamps();
            //Set up of foreign key
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
        Schema::dropIfExists('regiaos');
    }
}
