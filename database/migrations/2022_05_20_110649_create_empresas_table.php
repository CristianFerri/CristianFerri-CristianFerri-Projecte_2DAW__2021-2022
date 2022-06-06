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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('director')->nullable();
        });

        DB::table('empresas')->insert([
            ['nombre' => 'Kinépolis', 'director' => 'Eddy Duquenne'],
            ['nombre' => 'Cines ABC', 'director' => NULL],
            ['nombre' => 'Cines Axion', 'director' => NULL],
            ['nombre' => 'Cines Victoria', 'director' => NULL],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
};
