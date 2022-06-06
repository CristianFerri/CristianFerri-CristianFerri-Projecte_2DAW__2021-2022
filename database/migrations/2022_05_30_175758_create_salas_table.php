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
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->integer('cine_id')->unsigned();
            $table->integer('rows')->default(10);
            $table->integer('cols')->default(15);
        });

        DB::table('salas')->insert([
            ['cine_id' => 1, 'rows' => 15, 'cols' => 12],
            ['cine_id' => 1, 'rows' => 12, 'cols' => 8],
            ['cine_id' => 2, 'rows' => 13, 'cols' => 9],
            ['cine_id' => 2, 'rows' => 10, 'cols' => 6],
            ['cine_id' => 3, 'rows' => 15, 'cols' => 14],
            ['cine_id' => 3, 'rows' => 15, 'cols' => 10],
            ['cine_id' => 4, 'rows' => 8, 'cols' => 10],
            ['cine_id' => 4, 'rows' => 7, 'cols' => 5],
            ['cine_id' => 5, 'rows' => 11, 'cols' => 12],
            ['cine_id' => 5, 'rows' => 13, 'cols' => 6],
            ['cine_id' => 6, 'rows' => 8, 'cols' => 5],
            ['cine_id' => 7, 'rows' => 14, 'cols' => 10],
            ['cine_id' => 8, 'rows' => 10, 'cols' => 8],

        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
};
