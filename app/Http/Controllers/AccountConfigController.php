<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AccountConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myAccount() {
        return view('configCuenta.myAccount');
    }

    public function editMyAccount() {
        return view('configCuenta.edit.editMyAccount');
    }

    public function accountPrivacy() {
        return view('configCuenta.myPrivacy');
    }

    public function editAccountPrivacy(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($request['email'] !== Auth()->user()->email || !Hash::check($request['password'], Auth()->user()->password)) {
            return back();
        } else {
            return view('configCuenta.edit.editMyPrivacy');
        }
    }

    public function accountOrders() {
        $date = date('Y-m-d H:i:s');
        $currentDate = date('Y-m-d H:i:s', strtotime('+2 hour', strtotime($date)));
        DB::table('entradas')
            ->where('entradas.dia_expiracion', '<=', $currentDate)
            ->delete();
            
        $data = DB::table('entradas')
            ->join('peliculas', 'peliculas.id', '=', 'entradas.movie_id')
            ->join('cines', 'cines.id', '=', 'entradas.cine_id')
            ->join('empresas', 'empresas.id', '=', 'cines.empresa_id')
            ->where('entradas.user_id', Auth()->user()->id)
            ->select('entradas.id', 'empresas.nombre', 'cines.localidad', 'peliculas.title', 'entradas.dia_expiracion', 'entradas.precio_total', 'entradas.numero_asientos')
            ->orderBy('entradas.dia_expiracion', 'desc')
            ->get();

        return view('configCuenta.myOrders', ['entradas' => $data]);
    }

    public function updateAccount(Request $request) {
        $data = $request->validate([
            'username' => ["required", "string", Rule::unique('users')->ignore(Auth()->user())],
            'name' => 'nullable|string',
            'surname' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if (array_key_exists('image', $data)) {
            $image = $data['image']->store('images', 'public');
            Image::make(public_path("storage/$image"))->fit(800, 800)->save();
            $data['image'] = $image;
        }

        Auth()->user()->update($data);

        return redirect()->route('myAccount');
    }

    public function updateAccountPrivacy(Request $request) {

        $data = $request->validate([
            'email' => ["required", "email", Rule::unique('users')->ignore(Auth()->user())],
            'phone' => ["nullable", "regex:/[0-9]{9}/", Rule::unique('users')->ignore(Auth()->user())],
            'password' => 'nullable|string',
            'confirm-password' => 'nullable|string',
        ]);

        if(array_key_exists('password', $data)) {
            if (!array_key_exists('confirm-password', $data)) {
                return redirect()->back()->withErrors('alert', [
                    'type' => 'danger',
                    'message' => 'Debes de introducir una contraseña de confirmación'
                ]);
            } else {
                $password = $data['password'];
                $confPassword = $data['confirm-password'];
                if ($password !== $confPassword) {
                    return redirect()->back()->withErrors('alert', [
                        'type' => 'warning',
                        'message' => 'Las contraseñas no coinciden'
                    ]);
                } else {
                    $password = Hash::make($password);
                    $data['password'] = $password;
                }
            }
        }

        Auth()->user()->update($data);

        return redirect()->route('myPrivacy')->with('alert', [
            'type' => 'success',
            'message' => 'Se ha actualizado la información correctamente'
        ]);
    }
}
