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
        Schema::create('cine_pelicula', function (Blueprint $table) {
            $table->id();
            $table->integer('cine_id')->unsigned();
            $table->integer('pelicula_id')->unsigned();
        });

        DB::table('cine_pelicula')->insert([
            ['cine_id' => 1, 'pelicula_id' => 1],
            ['cine_id' => 2, 'pelicula_id' => 1],
            ['cine_id' => 1, 'pelicula_id' => 2],
            ['cine_id' => 1, 'pelicula_id' => 3],
            ['cine_id' => 1, 'pelicula_id' => 4],
            ['cine_id' => 1, 'pelicula_id' => 5],
            ['cine_id' => 1, 'pelicula_id' => 6],
            ['cine_id' => 1, 'pelicula_id' => 7],
            ['cine_id' => 1, 'pelicula_id' => 8],
            ['cine_id' => 2, 'pelicula_id' => 2],
            ['cine_id' => 2, 'pelicula_id' => 9],
            ['cine_id' => 2, 'pelicula_id' => 5],
            ['cine_id' => 3, 'pelicula_id' => 10],
            ['cine_id' => 7, 'pelicula_id' => 11],
            ['cine_id' => 7, 'pelicula_id' => 12],
            ['cine_id' => 3, 'pelicula_id' => 7],
            ['cine_id' => 8, 'pelicula_id' => 1],
            ['cine_id' => 8, 'pelicula_id' => 11],
            ['cine_id' => 8, 'pelicula_id' => 4],
            ['cine_id' => 6, 'pelicula_id' => 9],
            ['cine_id' => 5, 'pelicula_id' => 8],
            ['cine_id' => 5, 'pelicula_id' => 6],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cine_pelicula');
    }
};
