<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

session_start();

class ErrorController extends Controller
{
    public function displayError() {
        return view('errorPage')->with("alert", [
            "message" => (isset($_SESSION['error']) ? $_SESSION['error'] : "El recurso que está siendo accedido está bloqueado."),
            "httpcode" => (isset($_SESSION['htCode']) ? $_SESSION['htCode'] : 423)
        ]);
    }
}

