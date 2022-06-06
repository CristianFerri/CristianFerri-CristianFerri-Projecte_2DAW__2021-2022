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
        Schema::create('cines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id');
            $table->string('localidad');
            $table->string('direccion');
            $table->string('telefono')->unique()->nullable();
            $table->string('email')->nullable();
            $table->decimal(column: 'latitude', total: 8, places: 6);
            $table->decimal(column: 'longitude', total: 9, places: 6);
            $table->string('img')->nullable();
        });

        DB::table('cines')->insert([
            ['empresa_id' => '1', 'localidad' => 'Alzira', 'direccion' => 'Avinguda de la Llibertat, 6, 46600', 'telefono' => '962455060', 'email' => 'info.espana@kinepolis.com', 'latitude' => 39.163704, 'longitude' => -0.427237, 'img' => 'images/pIiHCa5pMetVoqH724tZQV9Kp1ppCqbSVACxFtGK.jpg'],
            ['empresa_id' => '1', 'localidad' => 'Valencia', 'direccion' => 'Avinguda de Francisco Tomàs I Valiente, s/n, 46980', 'telefono' => '961379400', 'email' => 'info.espana@kinepolis.com', 'latitude' => 39.5303268, 'longitude' => -0.4428797, 'img' => 'images/XIH40TwQ5Dm21CQILt3gW11vm62YRxPxe1r4ZWEL.jpg'],
            ['empresa_id' => '2', 'localidad' => 'Gandia', 'direccion' => 'Avinguda de la Vital, 10, 46701', 'telefono' => '962860303', 'email' => 'abcgandia@cinesabc.com', 'latitude' => 38.9686579, 'longitude' => -0.1707858, 'img' => 'images/oaxjkfVZKCHhsVPjyhI7HV62sr7sr4BU91RH5ebU.jpg'],
            ['empresa_id' => '1', 'localidad' => 'Alicante', 'direccion' => 'Plaza Mar 2, 03016', 'telefono' => '915127000', 'email' => 'info.espana@kinepolis.com', 'latitude' => 38.3544676, 'longitude' => -0.4741266, 'img' => 'images/u2Ept6NaVsghLRgVtYyo1eBgY6pMabFfsnnXF5cm.jpg'],
            ['empresa_id' => '3', 'localidad' => 'Alcoy', 'direccion' => 'Centro Comercial Alzamora, Carrer els Alçamora, 44, 03802', 'telefono' => '965331864', 'email' => 'alcoy@cinesaxion.com', 'latitude' => 38.697635, 'longitude' => -0.480732, 'img' => 'images/5bJfRlWiXIxqNZQa9k6vAVyPkN9yXZKA76gXDh1B.jpg'],
            ['empresa_id' => '3', 'localidad' => 'Xátiva', 'direccion' => 'C.C. Plaza Mayor N-340, s/n, 46800', 'telefono' => '962259189', 'email' => 'xativa@cinesaxion.com', 'latitude' => 39.003973, 'longitude' => -0.527156, 'img' => 'images/186hXt0SfNwCCsLOA6Dr4Kot4J6TLnpBrQXgxnCk.jpg'],
            ['empresa_id' => '3', 'localidad' => 'Gandia', 'direccion' => 'Avinguda de Blasco Ibáñez, 6, 46701', 'telefono' => '963694153', 'email' => 'gandia@cinesaxion.com', 'latitude' => 38.975815, 'longitude' => -0.180893, 'img' => 'images/6piYNje5RR8yzfPaNNInnwuBJ0Gh8h68tl41jYtI.jpg'],
            ['empresa_id' => '4', 'localidad' => 'Cullera', 'direccion' => 'Carrer Sueca, s/n, 46400', 'telefono' => '961724113', 'email' => 'cullera@compraentradas.com', 'latitude' => 39.1777409, 'longitude' => -0.2602948, 'img' => 'images/vHzVgdzgfjJNRq7Y8laajstzf6iJy59ka4BiJRMe.jpg'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cines');
    }
};
