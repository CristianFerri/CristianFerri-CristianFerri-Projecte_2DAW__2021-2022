<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
  public function getSession() {
    $cine = session()->get('cineSelected');
    $movie = session()->get('movieSelected');
    
    $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

    $allCoupons = $stripe->coupons->all();

    foreach ($allCoupons['data'] as $ac) {
      if ($ac['id'] == 'ask4urticket') {
        $stripe->coupons->delete('ask4urticket', []);
      }
    }

    if (session()->get('cuponSelected') != null) {
      $cupon = session()->get('cuponSelected');
      $stripe->coupons->create(['id' => "ask4urticket", 'percent_off' => $cupon['descuento']]);
    } else {
      $stripe->coupons->create(['id' => "ask4urticket", 'percent_off' => 0.01]);
    }
    $checkout = $stripe->checkout->sessions->create([
      'success_url' => 'http://localhost:8000/cart/payment/success?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => "http://localhost:8000/cinemas/".$cine['id']."/movie/".$movie['api_id'],
      'line_items' => $this->createProducts(),
      'mode' => 'payment',
      'discounts' => [[ 'coupon' => 'ask4urticket']],
    ]);



    return $checkout;
  }

  public function createProducts() {
    $arrayMain = array();
    $movie = session()->get('movieSelected');
    $sala = session()->get('salaSelected');
    $hora = session()->get('horaSelected');
    $cine = session()->get('cineSelected');
    $cantidad = session()->get('numeroButacasSelected');
    $dia = session()->get('dayFormattedSelected');
    $butacas = session()->get('butacasSelected');
    

    for ($i = 0; $i < count($butacas); $i++) {
      $array = 
      [
        'price_data' => [
          'currency' => 'eur',
          'unit_amount' => $butacas[$i]['precio']*100,
          'product_data' => [
            'name' => 'Sillón '.$butacas[$i]['butaca']. ': Fila '.$butacas[$i]['row']. ' - Asiento '.$butacas[$i]['col'],
            'description' => $movie['title'] .' - '. $cine['nombre'] .' '. $cine['localidad'] .' '. $sala. ', a las '. $hora .' de '. $dia,
            'images' => ['https://i.imgur.com/Gfu6rzY.png']
          ]
        ],
        'quantity' => 1,
      ];

      array_push($arrayMain, $array);
    }

    return $arrayMain;
  }
}
