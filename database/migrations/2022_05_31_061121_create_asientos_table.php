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
        Schema::create('asientos', function (Blueprint $table) {
            $table->id();
            $table->integer('sala_id')->unsigned();
            $table->integer('sillon');
            $table->integer('row');
            $table->integer('col');
            $table->decimal('precio', 3, 2);
            $table->boolean('reservado')->default(false);
            $table->timestamp('expira')->nullable();
        });

        $salas = DB::table('salas')
            ->select('*')
            ->get();

        foreach ($salas as $s) {
            $asientos_totales = $s->rows * $s->cols;
            $cntRow = 1;
            $cntCol = 1;
            for ($i = 1; $i <= $asientos_totales; $i++) {
                $comprobar = DB::table('asientos')
                    ->where('asientos.sala_id', $s->id)
                    ->where('asientos.sillon', $i)
                    ->value('asientos.id');
                if ($comprobar == null) {
                    DB::table('asientos')->insert(array('sala_id' => $s->id, 'sillon' => $i, 'row' => $cntRow, 'col' => $cntCol, 'precio' => 5.45, 'reservado' => false));
                }

                if ($cntCol == $s->cols) {
                    $cntCol = 1;
                    $cntRow++;
                } else {
                    $cntCol++;
                }
            }
        }
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asientos');
    }
};
