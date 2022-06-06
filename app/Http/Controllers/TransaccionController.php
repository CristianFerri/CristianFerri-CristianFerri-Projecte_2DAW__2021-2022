<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

session_start();

class TransaccionController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function getMovieCinemaAndCookies(Request $request, $idCine, $idPeli) {
        $redirectCine = DB::table('cine_pelicula')
            ->join('peliculas', 'peliculas.id', '=', 'cine_pelicula.pelicula_id')
            ->join('cines', 'cines.id', '=', 'cine_pelicula.cine_id')
            ->where('cines.id', $idCine)
            ->where('peliculas.api_id', $idPeli)
            ->value('cine_pelicula.id');

        if ($redirectCine == null) {
            $_SESSION['error'] = "La pelicula con la id $idPeli no existe en el cine $idCine";
            $_SESSION['htCode'] = 404;
            return redirect()->route('noExistsPage');
        } else {
            $peli = DB::table('peliculas')
                ->where('peliculas.api_id', $idPeli)
                ->select('*')
                ->get();

            $cine = DB::table('cines')
                ->join('empresas', 'empresas.id', '=', 'cines.empresa_id')
                ->where('cines.id', $idCine)
                ->select('cines.id', 'empresas.nombre', 'cines.localidad', 'cines.direccion', 'cines.telefono', 'cines.email', 'cines.latitude', 'cines.longitude')
                ->get();

            $salas = DB::table('salas')
                ->where('salas.cine_id', $idCine)
                ->select('*')
                ->get();
            
            if (count($salas) == 0) {
                $_SESSION['error'] = "No hay ninguna sala para el cine con la id $idCine";
                $_SESSION['htCode'] = 404;
                return redirect()->route('noExistsPage');
            } else {
                $sala = rand(0, count($salas)-1);

                $date = date('Y-m-d H:i:s');
                $currentDate = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($date)));
                DB::table('asientos')
                    ->where('asientos.expira', '<=', $currentDate)
                    ->update(['reservado' => 0]);
                    
                $reservadas = DB::table('asientos')
                    ->where('asientos.sala_id', $salas[$sala]->id)
                    ->where('asientos.reservado', 1)
                    ->select('*')
                    ->get();

                $asientos = DB::table('asientos')
                    ->where('asientos.sala_id', $salas[$sala]->id)
                    ->select('*')
                    ->get();

                return view('transactions.butaques', ['cine' => $cine, 'peli' => $peli, 'salas' => json_encode($salas[$sala]), 'reservas' => $reservadas, 'asientos' => $asientos]);
            }
        }
    }

    public function carrito(Request $request) {
        if ($request->hasCookie('butacasSelected') && $request->hasCookie('cineSelected') && $request->hasCookie('movieSelected') &&
            $request->hasCookie('diaSelected') && $request->hasCookie('horaSelected') && $request->hasCookie('salaSelected') && 
            $request->hasCookie('numeroButacasSelected') && $request->hasCookie('dayFormattedSelected')) {
                $cine = json_decode($request->cookie('cineSelected'));
                $butaques = json_decode($request->cookie('butacasSelected'));
                $sala = json_decode($request->cookie('salaSelected'));
                $infoSillones = array();
                
                foreach ($butaques as $b) {
                    //SELECT * FROM asientos as a, salas as s, cines as c WHERE a.sala_id = s.id AND s.cine_id = c.id AND a.sillon = 4 AND s.cine_id = 2 ORDER BY a.id ASC LIMIT 1;
                    $query = DB::table('asientos')
                        ->join('salas', 'salas.id', '=', 'asientos.sala_id')
                        ->join('cines', 'cines.id', '=', 'salas.cine_id')
                        ->join('empresas', 'empresas.id', '=', 'cines.empresa_id')
                        ->where('asientos.sillon', $b->butaca)
                        ->where('salas.cine_id', $cine->id)
                        ->where('salas.id', $sala->id)
                        ->select('asientos.*')
                        ->get();


                    if (count($query) == 0) {
                        $_SESSION['error'] = "No hay ninguna sillon con la información proporcionada";
                        $_SESSION['htCode'] = 404;
                        return redirect()->route('noExistsPage');
                    } else {
                        $date = date('Y-m-d H:i:s');
                        $currentDate = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($date)));
                        $added10min = date('Y-m-d H:i:s', strtotime('+15 minutes', strtotime($currentDate)));
                        DB::table('asientos')
                            ->where('asientos.id', $query[0]->id)
                            ->update(['reservado' => 1, 'expira' => $added10min]);

                        array_push($infoSillones, $query);
                    }
                }

                $salas = DB::table('salas')
                        ->where('salas.cine_id', $sala->cine_id)
                        ->select('*')
                        ->get();

                $numeroSala = 0;

                for ($i = 0; $i < count($salas); $i++) {
                    if ($salas[$i]->id == $sala->id) {
                        break;
                    } else {
                        $numeroSala++;
                        continue;
                    }
                }
                
                $cupones = DB::table('cupons')
                    ->select('*')
                    ->get();

                return view('transactions.resumen', ['infoSillones' => json_encode($infoSillones), 'cupones'=> $cupones, 'salaNumero' => $numeroSala, 'sala' => json_encode($salas[$numeroSala])]);
        } else {
                $_SESSION['error'] = "La sesión ha expirado, vuelve a intentarlo";
                $_SESSION['htCode'] = 440;
                return redirect()->route('noExistsPage');
        }
    }

    public function setSessionVariables(Request $request) {
        if (!session()->has($request['key']))
            session()->put($request['key'], $request['value']);
        else {
            session()->forget($request['key']);
            session()->put($request['key'], $request['value']);
        }

        return Response::json(array('message' => 'Done'));
    }

}
