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
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id');
            $table->string('title');
            $table->text('poster');
            $table->text('backdrop');
            $table->double('votes');
            $table->text('overview');
            $table->string('releases');
            $table->timestamps();
        });

        DB::table('peliculas')->insert([
            ['api_id' => 752623, 'title' => 'La ciudad perdida', 'poster' => 'https://image.tmdb.org/t/p/w500/grEVYkBAVIzQ4JmZ7ydceN9DFQR.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/1Ds7xy7ILo8u2WWxdnkJth1jQVT.jpg', 'votes' => 6.7, 'overview' => 'Una solitaria novelista romántica de gira con el modelo de la portada de su último libro se ve envuelta en un intento de secuestro que llevará a ambos a una feroz aventura en la jungla.', 'releases' => '2022-03-24', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 526896, 'title' => 'Morbius', 'poster' => 'https://image.tmdb.org/t/p/w500/6WmTdYNoSinBAXs0AfTTCSaV5lw.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/gG9fTyDL03fiKnOpf2tr01sncnt.jpg', 'votes' => 6.4, 'overview' => 'Peligrosamente enfermo de un extraño trastorno sanguíneo, y determinado a salvar a otras personas que padecen su mismo destino, el doctor Morbius intenta una apuesta desesperada. Lo que en un principio parece ser un éxito radical, pronto se revela como un remedio potencialmente peor que la enfermedad.', 'releases' => '2022-03-30', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 639933, 'title' => 'El Hombre del Norte', 'poster' => 'https://image.tmdb.org/t/p/w500/rdx0bIkwxW3EHvWn5kxZBFUT1Am.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/cqnVuxXe6vA7wfNWubak3x36DKJ.jpg', 'votes' => 7.4, 'overview' => 'El príncipe Amleth está a punto de convertirse en hombre pero, en ese momento, su tío asesina brutalmente a su padre y secuestra a la madre del niño. Dos décadas después, Amleth es un vikingo que tiene la misión de salvar a su madre.', 'releases' => '2022-04-07', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 675353, 'title' => 'Sonic 2: La película', 'poster' => 'https://image.tmdb.org/t/p/w500/sJiHVM0A3OXDVxl4Z6a7ihMPHfm.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/egoyMDLqCxzjnSrWOz50uLlJWmD.jpg', 'votes' => 7.7, 'overview' => 'Después de establecerse en Green Hills, Sonic se muere por demostrar que tiene madera de auténtico héroe, pero Robotnik regresa con nuevo compañero Knuckles, en busca de una esmeralda que tiene el poder de destruir civilizaciones, pero Sonic no está solo, le ayudará Tails.', 'releases' => '2022-03-30', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 629542, 'title' => 'Los Tipos Malos', 'poster' => 'https://image.tmdb.org/t/p/w500/wFdwJh3fbhp5aiRbQelVz1mbbwP.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/fEe5fe82qHzjO4yej0o79etqsWV.jpg', 'votes' => 7.8, 'overview' => 'Cinco villanos notorios: el Sr. Wolf, Mr. Snake, Mr. Piranha, Mr. Shark y Ms. Tarantula, que han pasado toda una vida juntos realizando grandes atracos.', 'releases' => '2022-03-17', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 676705, 'title' => 'Las aventuras de Pil', 'poster' => 'https://image.tmdb.org/t/p/w500/xIMqbFYkZx0pfgOLMXDdgsY6dA4.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/tq3klWQevRK0Or0cGhsw0h3FDWQ.jpg', 'votes' => 6.8, 'overview' => 'Pil es una pequeña huérfana que vive en la calle, en la ciudad medieval de Roc-en-Brume. Junto a sus tres comadrejas amaestradas, Pil sobrevive robando comida en el castillo del siniestro rey Tristain, que ha usurpado el trono.', 'releases' => '2021-08-11', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 646385, 'title' => 'Scream', 'poster' => 'https://image.tmdb.org/t/p/w500/cIgmdAhesIqn2ykJfbNFMQYdxkO.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/ifUfE79O1raUwbaQRIB7XnFz5ZC.jpg', 'votes' => 6.8, 'overview' => 'Una nueva entrega de la saga de terror "Scream" que seguirá a una mujer que regresa a su ciudad natal para intentar descubrir quién ha estado cometiendo una serie de crímenes atroces.', 'releases' => '2022-01-12', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 763285, 'title' => 'Ambulance: Plan de Huida', 'poster' => 'https://image.tmdb.org/t/p/w500/hUbgg3mMSbY9PlpTxBo4IFUVSd6.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/dW3fQJrshh2wYDoW4HUA7ZabsN1.jpg', 'votes' => 7, 'overview' => 'Dos hermanos roban una ambulancia tras un atraco que sale mal y deberán de trabajar juntos para escapar de la policía que los persigue.', 'releases' => '2022-03-16', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 414906, 'title' => 'The Batman', 'poster' => 'https://image.tmdb.org/t/p/w500/zFTLPipninMF4THDbdkQUZLWMEw.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/xHrp2pq73oi9D64xigPjWW1wcz1.jpg', 'votes' => 7.8, 'overview' => 'Cuando un asesino se dirige a la élite de Gotham con una serie de maquinaciones sádicas, un rastro de pistas crípticas envía Batman a una investigación en los bajos fondos. A medida que las pruebas comienzan a acercarse a su casa y se hace evidente la magnitud de los planes del autor, Batman debe forjar nuevas relaciones, desenmascarar al culpable y hacer justicia al abuso de poder y la corrupción que durante mucho tiempo han asolado Gotham City.', 'releases' => '2022-03-01', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 361743, 'title' => 'Top Gun: Maverick', 'poster' => 'https://image.tmdb.org/t/p/w500/AlWpEpQq0RgZIXVHAHZtFhEvRgd.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/odJ4hx6g6vBt4lBWKFD1tI8WS4x.jpg', 'votes' => 8.2, 'overview' => 'Después de más de 30 años de servicio como uno de los mejores aviadores de la Armada, Pete "Mavericks" Mitchel (Tom Cruise) se encuentra dónde siempre quiso estar, empujando los límites como un valiente piloto de prueba y esquivando el alcance en su rango, que no le dejaría volar emplazándolo en tierra. Cuando se encuentra entrenando a un destacamento de graduados de Top Gun para una misión especializada, Maverick se encuentra allí con el teniente Bradley Bradshaw (Miles Teller), el hijo de su difunto amigo "Goose"... Secuela de Top Gun.', 'releases' => '2022-05-24', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 338953, 'title' => 'Animales Fantásticos: Los Secretos de Dumbledore', 'poster' => 'https://image.tmdb.org/t/p/w500/yOeuJdwag4bAlnvgrdweRoiuXGC.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/lQxZLeWNdZINBzyzdPr5NbRHL8m.jpg', 'votes' => 6.7, 'overview' => 'El profesor Albus Dumbledore sabe que el poderoso mago oscuro Gellert Grindelwald está haciendo planes para apoderarse del mundo mágico. Incapaz de detenerlo él solo, confía en el Magizoólogo Newt Scamander para dirigir un intrépido equipo de magos, brujas y un valiente panadero Muggle en una misión peligrosa, donde se encuentran con antiguos y nuevos animales y se enfrentan a una legión cada vez más numerosa de seguidores de Grindelwald.', 'releases' => '2022-04-06', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
            ['api_id' => 883502, 'title' => "Fortress: Sniper's Eye", 'poster' => 'https://image.tmdb.org/t/p/w500/9y2ymS09bqTSM7L2DZJi7aIxor6.jpg', 'backdrop' => 'https://image.tmdb.org/t/p/original/qNRkfXBdAuXk9Qs3BEDIfmbAK9w.jpg', 'votes' => 6, 'overview' => 'Semanas después del asalto mortal a Fortress Camp, Robert realiza un atrevido rescate para salvar a Sasha, la viuda de su antiguo némesis Balzary. Pero de vuelta en el búnker de mando del campamento, parece que Sasha puede tener sus propios planes tortuosos. Cuando estalla un nuevo ataque, Robert se enfrenta a un rostro familiar que pensó que nunca volvería a ver.', 'releases' => '2022-04-29', 'created_at' => DB::raw('CURRENT_TIMESTAMP'), 'updated_at' => DB::raw('CURRENT_TIMESTAMP')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
};
