<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoporteController extends Controller
{
    public function getView() {
        return view('soporte.soporte');
    }

    public function postForm(Request $request) {
        return view('soporte.soporte')->with('successMsg', 'Se ha enviado tu problema al equipo de soporte pronto tendrás una respuesta en tu correo');
    }
}
