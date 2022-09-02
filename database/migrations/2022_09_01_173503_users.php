<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(false);
            
            $table->bigInteger('provincia_id')->unsigned()->nullable();
            $table->bigInteger('regiao_id')->unsigned()->nullable();
            $table->bigInteger('circulo_id')->unsigned()->nullable();
            $table->bigInteger('sector_id')->unsigned()->nullable();

            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('regiao_id')->references('id')->on('regiaos');
            $table->foreign('circulo_id')->references('id')->on('circulos');
            $table->foreign('sector_id')->references('id')->on('sectors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
