<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class CinesController extends Controller {

    public function showCines() {
        return view('main.cines');
    }

    public function getClickedCinema($id) {
        $cine = DB::table('cines')
        ->join('empresas', 'cines.empresa_id', '=', 'empresas.id')
        ->select('cines.id', 'empresas.nombre', 'cines.localidad', 'cines.direccion', 'cines.telefono', 'cines.email', 'cines.latitude', 'cines.longitude','cines.img')
        ->where('cines.id', $id)
        ->get();


        if (count($cine) > 0) {
            return view('main.cineSesiones')->with('cine', json_encode($cine));
        } else {
            $_SESSION['error'] = "No existe el cine solicitado";
            $_SESSION['htCode'] = 404;
            return redirect()->route('noExistsPage');
        }

    }

    public function getCines() {
        //SELECT emp.nombre, cin.localidad, cin.direccion ,emp.director FROM cines as cin join empresas as emp ON cin.empresa_id = emp.id
        $cines = DB::table('cines')
            ->join('empresas', 'cines.empresa_id', '=',  'empresas.id')
            ->select('cines.id', 'empresas.nombre', 'cines.localidad', 'cines.direccion', 'cines.telefono', 'cines.img','empresas.director')
            ->get();

        if (count($cines) > 0) {
            return Response::json($cines);
        } else {
            return Response::json(Array('response' => 'Ha habido un error'));
        }
    }

    public function getPelisByCine($id) {
        //SELECT p.api_id FROM peliculas as p, cine_pelicula as cp WHERE p.id = cp.pelicula_id AND cp.cine_id = 1;
        $data = DB::table('cine_pelicula')
            ->join('peliculas', 'peliculas.id', '=', 'cine_pelicula.pelicula_id')
            ->where('cine_pelicula.cine_id', $id)
            ->select('peliculas.api_id')
            ->get();

        return Response::json($data);
    }
}
