<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SesionesController extends Controller
{
    public function getSesionesByMovie($idPeli) {
        $data = DB::table('sesions')
            ->where('sesions.pelicula_id', $idPeli)
            ->select('*')
            ->orderBy('sesions.hora_sesion', 'asc')
            ->get();

        if (count($data) == 0) {
            return Response::json(array('success' => 'false', 'message' => 'No hay sesiones para esta pelicula todavía, vuelve más tarde'));
        } else {
            return Response::json($data);
        }
    }
}
