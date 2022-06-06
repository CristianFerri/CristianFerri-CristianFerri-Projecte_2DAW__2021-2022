<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function adminMenu() {
        return view('adminMenu');
    }

    public function addEmpresasForm () {
        return view('admin.addEmpresa');
    }

    public function addCinemasForm () {
        $empresas = DB::table('empresas')
        ->select('*')
        ->get();
        return view('admin.addCine', ['emp' => $empresas]);
    }

    public function addPeliculasForm () {
        return view('admin.addPelicula');
    }

    public function addPeliculasToCineForm () {
        $cine = DB::table('cines')
            ->join('empresas', 'empresas.id', '=', 'cines.empresa_id')
            ->select('cines.id', 'cines.localidad', 'empresas.nombre')
            ->get();

        $peliculas = DB::table('peliculas')
            ->select('*')
            ->get();

        return view('admin.addPeliculaToCine', ['cines' => $cine, 'pelis' => $peliculas]);
    }

    public function addSessionsForm () {
        $peliculas = DB::table('peliculas')
            ->select('peliculas.id', 'peliculas.title')
            ->get();

        return view('admin.addSessionsForm', ['peliculas' => $peliculas]);
    }

    public function insertarSillonesDBForm() {
        return view('admin.addAsientos');
    }

    public function addEmpresa (Request $request) {
        $data = $request->validate([
            'nombre' => 'required|string',
            'director' => 'nullable|string',
        ]);

        DB::table('empresas')->insert($data);

        return redirect()->route('adminMenu');
    }

    public function addCinemas (Request $request) {
        $data = $request->validate([
            'empresa_id' => 'required|not_in:0',
            'localidad' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'nullable|unique:cines,telefono|regex:/[0-9]{9}/',
            'email' => 'nullable|email',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);

        if (array_key_exists('img', $data)) {
            $image = $data['img']->store('images', 'public');
            Image::make(public_path("storage/$image"))->fit(800, 800)->save();
            $data['img'] = $image;
        }

        DB::table('cines')->insert($data);

        return redirect()->route('adminMenu');
    }

    public function addPeliculasManual (Request $request) {
        $data = $request->validate([
            'api_id' => 'required|numeric',
            'title' => 'required|string'
        ]);

        $peliculaExists = DB::table('peliculas')
            ->where('peliculas.api_id', $data['api_id'])
            ->value('peliculas.id');
        if ($peliculaExists == null) {
            DB::table('peliculas')->insert($data);
            return redirect()->route('adminMenu')->withErrors(['Se ha añadido correctamente!']);
        } else {
            return redirect()->back()->withErrors(['Esta pelicula ya existe!']);
        }
    }

    public function addPeliculasAuto() {
        $apiUrl = 'https://api.themoviedb.org/3/movie/now_playing?api_key=4475c14c3e095c6c8e3ca8d00f5070d5&language=es&page=1';
        $response = file_get_contents($apiUrl);
        $response = json_decode($response);
        $updated = 0;
        $added = 0;
        foreach ($response->results as $key => $value) {
            $object = [
                'api_id' => $value->id,
                'title' => $value->title,
                'poster' => 'https://image.tmdb.org/t/p/w500'.$value->poster_path,
                'backdrop' => 'https://image.tmdb.org/t/p/original'.$value->backdrop_path,
                'votes' => $value->vote_average,
                'overview' => $value->overview,
                'releases' => $value->release_date,
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ];
            $exists = DB::table('peliculas')
                ->where('peliculas.api_id', $object['api_id'])
                ->value('peliculas.id');
            if ($exists === null) {
                $object = array_merge($object, array('created_at' => DB::raw('CURRENT_TIMESTAMP')));
                DB::table('peliculas')->insert($object);
                $added++;
            } else {
                DB::table('peliculas')->where('peliculas.api_id', $object['api_id'])->update($object);
                $updated++;
            }
        }

        $mensaje = "Se han añadido ".$added." peliculas y se han actualizado ".$updated;
        return redirect()->route('adminMenu')->withErrors([$mensaje]);
    }

    public function addPeliculasToCine (Request $request) {
        $data = $request->validate([
            'cine_id' => 'required|not_in:0',
            'pelicula_id' => 'required|not_in:0',
        ], [
            'cine_id.required' => 'Debes seleccionar un cine para poder añadir una pelicula!',
            'pelicula_id.required' => 'Debes seleccionar una pelicula!'
        ]);

        $cine_pelicula_exists = DB::table('cine_pelicula')
            ->where('cine_pelicula.cine_id', $data['cine_id'])
            ->where('cine_pelicula.pelicula_id', $data['pelicula_id'])
            ->value('cine_pelicula.id');

        if ($cine_pelicula_exists == null) {
            DB::table('cine_pelicula')->insert($data);
            return redirect()->route('adminMenu')->withErrors(['Se ha añadido correctamente!']);
        } else {
            return redirect()->back()->withErrors(['Esta relacion ya existe!']);
        }
    }

    public function addSessions (Request $request) {
        $data = $request->validate([
            'pelicula_id' => 'required|not_in:0',
            'hora_sesion' => 'required|date_format:H:i'
        ],
        [
            'hora_sesion.required' => 'Debes introducir un formato de hora entre 09:00 hasta 23:45!'
        ]);

        $sesion_exists = DB::table('sesions')
            ->where('sesions.pelicula_id', $data['pelicula_id'])
            ->where('sesions.hora_sesion', $data['hora_sesion'])
            ->value('sesions.id');

        if ($sesion_exists == null) {
            DB::table('sesions')->insert($data);
            return redirect()->route('adminMenu')->withErrors(['Se ha añadido correctamente!']);
        } else {
            return redirect()->back()->withErrors(['Esta hora ya existe para esta pelicula!']);
        }
    }

    public function insertarSillonesDB() {
        $salas = DB::table('salas')
            ->select('*')
            ->get();

        $added = 0;
        $omitido = 0;
        foreach ($salas as $s) {

            $asientos_totales = $s->rows * $s->cols;
            for ($i = 1; $i <= $asientos_totales; $i++) {
                $comprobar = DB::table('asientos')
                    ->where('asientos.sala_id', $s->id)
                    ->where('asientos.sillon', $i)
                    ->value('asientos.id');
                if ($comprobar == null) {
                    $added++;
                    DB::table('asientos')->insert(array('sala_id' => $s->id, 'sillon' => $i, 'precio' => 5.45, 'reservado' => false));
                } else {
                    $omitido++;
                }
            }
        }

        return redirect()->route('adminMenu')->with('alert', [
            'type' => 'success',
            'message' => "Se han añadido $added asientos y se han omitido $omitido por que ya existen",
        ]);
    }
}
