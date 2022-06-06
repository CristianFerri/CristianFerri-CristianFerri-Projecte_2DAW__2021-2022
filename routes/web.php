<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\CinesController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\AccountConfigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\SesionesController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\EntradasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas por defecto

    Route::get('/', function () {
        return view('welcome');
    })->name('Inicio');

//Acceso solo a admin

    Route::get('/admin', [AdminController::class, 'adminMenu'])->name('adminMenu');

    Route::get('/admin/addCinema', [AdminController::class, 'addCinemasForm'])->name('admin_addCinemasForm');
    Route::post('/admin/addCinema', [AdminController::class, 'addCinemas'])->name('admin_addCinemas');
    Route::get('/admin/addEmpresa', [AdminController::class, 'addEmpresasForm'])->name('admin_addEmpresaForm');
    Route::post('/admin/addEmpresa', [AdminController::class, 'addEmpresa'])->name('admin_addEmpresa');
    Route::get('/admin/addPelicula', [AdminController::class, 'addPeliculasForm'])->name('admin_addPeliculasForm');
    Route::post('/admin/addPelicula/m', [AdminController::class, 'addPeliculasManual'])->name('admin_addPeliculasManual');
    Route::get('/admin/addPelicula/a', [AdminController::class, 'addPeliculasAuto'])->name('admin_addPeliculasAuto');
    Route::get('/admin/addPeliculaToCine', [AdminController::class, 'addPeliculasToCineForm'])->name('admin_addPeliculasToCineForm');
    Route::post('/admin/addPeliculaToCine', [AdminController::class, 'addPeliculasToCine'])->name('admin_addPeliculasToCine');
    Route::get('/admin/addSessions', [AdminController::class, 'addSessionsForm'])->name('admin_addSessionsForm');
    Route::post('/admin/addSessions', [AdminController::class, 'addSessions'])->name('admin_addSessions');
    Route::get('/asientos/insert', [AdminController::class, 'insertarSillonesDBForm'])->name('admin_insertarSillonesDBForm');
    Route::post('/asientos/insert', [AdminController::class, 'insertarSillonesDB'])->name('admin_insertarSillonesDB');
    
//Página de soporte

    Route::get('/support', [SoporteController::class, 'getView'])->name('soporte');
    Route::post('/support', [SoporteController::class, 'postForm'])->name('soportePost');

//Página de reserva

    //Cines
    Route::get('/cinemas', [CinesController::class, 'showCines'])->name('cinema_showCines');
    ROute::get('/cinemas/{id}', [CinesController::class, 'getClickedCinema'])->name('cinema_getClickedCinema');
    Route::get('/cinemasJSON', [CinesController::class, 'getCines'])->name('cinema_getCines');

    //Cine_pelicula
    Route::get('/cine/x/pelicula/{idCine}', [CinesController::class, 'getPelisByCine'])->name('cinema_getPelisByCine');

    //Peliculas 
    Route::get('/cinemas/{idCine}/movie/{idPeli}', [PeliculaController::class, 'getMovieId'])->name('peliculas_getMovieId');
    Route::get('/pelicula/x/cine/{idPeli}', [PeliculaController::class, 'getCinesByMovieId'])->name('peliculas_getCinesByMovieId');
    Route::get('/peliculas/get', [PeliculaController::class, 'getAlreadyPlaying'])->name('peliculas_getAlreadyPlaying');
    Route::get('/peliculas/get/{movieId}', [PeliculaController::class, 'getMoviesById'])->name('peliculas_getMoviesById');

    //Sesiones
    Route::get('/sesiones/get/{idPeli}', [SesionesController::class, 'getSesionesByMovie'])->name('sesiones_getSesionesByMovie');

    //Compra
    Route::post('/setSessions', [TransaccionController::class, 'setSessionVariables'])->name('transaccion_setSessionVariables');
    Route::get('/cinemas/{idCine}/movie/{idPeli}/transaccion', [TransaccionController::class, 'getMovieCinemaAndCookies'])->name('transaccion_getMovieCinemaAndCookies');
    Route::get('/cart', [TransaccionController::class, 'carrito'])->name('transaccion_carrito');

//Pagos

    Route::get('/cart/getSession', [StripeController::class, 'getSession'])->name('stripe_getSession');
    Route::get('/cart/payment/success', [EntradasController::class, 'crearEntrada'])->name('payment_success');

//Acceso a configuración de cuenta

    //Mi cuenta
    Route::get('/myAccount', [AccountConfigController::class, 'myAccount'])->name('myAccount');
    Route::get('/myAccount/edit', [AccountConfigController::class, 'editMyAccount'])->name('myAccount.edit');
    Route::put('/myAccount', [AccountConfigController::class, 'updateAccount'])->name('myAccountPost');

    //Privacidad
    Route::get('/myAccount/privacidad', [AccountConfigController::class, 'accountPrivacy'])->name('myPrivacy');
    Route::get('/myAccount/privacidad/edit', [AccountConfigController::class, 'editAccountPrivacy'])->name('myAccountPrivacy.edit');
    Route::put('/myAccount/privacidad', [AccountConfigController::class, 'updateAccountPrivacy'])->name('myPrivacyPost');

    //Mis pedidos
    Route::get('/myAccount/myOrders', [AccountConfigController::class, 'accountOrders'])->name('myOrders');
    Route::delete('/myAccount/myOrders/cancel/{idEntrada}', [EntradasController::class, 'cancelarEntrada'])->name('cancelarEntrada');


Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/error', [ErrorController::class, 'displayError'])->name('noExistsPage');
    Route::post('/home', [HomeController::class, 'update']);
