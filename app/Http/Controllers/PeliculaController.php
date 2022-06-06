<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

session_start();

class PeliculaController extends Controller
{
    public function getMovieId($idCine, $idPeli) {
        //SELECT cp.id FROM cine_pelicula as cp, peliculas as p, cines as c WHERE cp.cine_id = c.id AND cp.pelicula_id = p.id AND c.id = 1 AND p.id = 9

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
                ->select('cines.id', 'empresas.nombre', 'cines.localidad', 'cines.direccion', 'cines.telefono', 'cines.email')
                ->get();

            return view('bookMovie.getMovie', ['movie' => $peli, 'cine' => $cine]);
        }
    }

    public function getMoviesById($idPeli) {
        $data = DB::table('peliculas')
            ->where('peliculas.api_id', $idPeli)
            ->select('*')
            ->get();

        return Response::json($data);
    }

    public function getAlreadyPlaying() {
        $movies = DB::table('peliculas')
            ->select('*')
            ->get();
        
        return Response::json($movies);
    }

    /* Proporciona todos los cines que emtian esta pelicula_id */

    public function getCinesByMovieId($id) {
        $peliculas = DB::table('peliculas')
            ->where('peliculas.id', $id)
            ->value('peliculas.id');

        if ($peliculas == null) {
            return Response::json(array('message' => 'La peli no esta en la DB'), 404);
        } else {
            $data = DB::table('cine_pelicula')
            ->join('cines', 'cines.id', '=', 'cine_pelicula.cine_id')
            ->join('empresas', 'empresas.id', '=', 'cines.empresa_id')
            ->where('cine_pelicula.pelicula_id', $peliculas)
            ->select('cine_pelicula.id', 'cine_pelicula.cine_id', 'cines.localidad', 'empresas.nombre')
            ->get();

            if (count($data) == 0) {
                return Response::json(array('HTTP code' => 200,'success' => false, 'Message' => 'No se ha encontrado la pelicula en ningún cine'), 200);
            } else if (count($data) > 0) {
                return Response::json($data, 200);
            } else {
                return Response::json(array('HTTP code' => 400,'success' => false, 'Message' => 'Ha habido un error con la solicitud'), 400);
            }
        }
    }
}
