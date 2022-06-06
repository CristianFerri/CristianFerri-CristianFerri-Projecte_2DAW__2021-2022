<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('numero_asientos')->unsigned();
            $table->integer('cine_id')->unsigned();
            $table->integer('movie_id')->unsigned();
            $table->integer('sala_id')->unsigned();
            $table->timestamp('dia_expiracion');
            $table->integer('precio_total');
            $table->string('pedido')->unique();
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
        Schema::dropIfExists('entradas');
    }
};
