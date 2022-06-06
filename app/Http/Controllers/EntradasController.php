<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

session_start();

class EntradasController extends Controller {
    public function crearEntrada(Request $request) {
        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));      
            $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
            $customer = \Stripe\Customer::retrieve($session->customer);
            $order = Hash::make($customer->id);
            $user_id = Auth()->user()->id;
            $numero_asientos = session()->get('numeroButacasSelected');
            $cine_id = session()->get('cineSelected')['id'];
            $sala_id = session()->get('salaSelectedObj')['id'];
            $movie_id = session()->get('movieSelected')['id'];
            $myDay = session()->get('dayFormattedSelected');
            $myTime = session()->get('horaSelected');
            $day = str_replace('/', '-', $myDay);
            $dia_expiracion = new DateTime($day.' '. $myTime.':00');
            $precio_total = session()->get('precioTotal');

            $entrada = array(
                'user_id' => $user_id,
                'numero_asientos' => $numero_asientos,
                'cine_id' => $cine_id,
                'movie_id' => $movie_id,
                'sala_id' => $sala_id,
                'dia_expiracion' => $dia_expiracion,
                'precio_total' => $precio_total,
                'pedido' => $order,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            );

            $exists = DB::table('entradas')
                ->where('entradas.pedido', $order)
                ->value('*');

            if ($exists == null) {
                DB::table('entradas')->insert($entrada);
                $asientos = session()->get('butacasSelected');
                foreach ($asientos as $a) {
                    DB::table('asientos')
                        ->where('asientos.id', $a['id'])
                        ->update(['reservado' => 1, 'expira' => $dia_expiracion]);
                }
                return view('success');
            } else {
                $_SESSION['error'] = "Ha habido un problema al guardar la información de la entrada, ponte en contacto con el soporte i proporcionales este número de pedido '$order'";
                $_SESSION['htCode'] = 417;
                return redirect()->route('noExistsPage');
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "No tienes permisos para acceder aqui";
            $_SESSION['htCode'] = 403;
            return redirect()->route('noExistsPage');
        }
    }

    public function cancelarEntrada($id) {
        $exists = DB::table('entradas')
            ->where('entradas.id', $id)
            ->select('*')
            ->get();

        if (count($exists) !== 0) {
            $_SESSION['messageCE'] = "La entrada con el código de pedido ".$exists[0]->pedido." se ha canelado con éxito!";
            DB::table('entradas')->where('entradas.id', $exists[0]->id)->delete();
            return redirect()->route('myOrders');
        } else {
            $_SESSION['messageCE'] = "Ha habido un error con la cancelación de la entrada solicitada, intentelo de nuevo más tarde";
            return redirect()->back();
        }
    }
}
