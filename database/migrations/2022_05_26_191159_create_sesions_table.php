<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesions', function (Blueprint $table) {
            $table->id();
            $table->integer('pelicula_id')->unsigned();
            $table->time('hora_sesion');
        });

        DB::table('sesions')->insert([
            ['pelicula_id' => '1', 'hora_sesion' => '18:15:00'],
            ['pelicula_id' => '2', 'hora_sesion' => '14:45:00'],
            ['pelicula_id' => '3', 'hora_sesion' => '11:30:00'],
            ['pelicula_id' => '4', 'hora_sesion' => '22:15:00'],
            ['pelicula_id' => '5', 'hora_sesion' => '21:00:00'],
            ['pelicula_id' => '6', 'hora_sesion' => '16:45:00'],
            ['pelicula_id' => '7', 'hora_sesion' => '17:10:00'],
            ['pelicula_id' => '8', 'hora_sesion' => '19:35:00'],
            ['pelicula_id' => '9', 'hora_sesion' => '20:15:00'],
            ['pelicula_id' => '10', 'hora_sesion' => '10:30:00'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesions');
    }
};
