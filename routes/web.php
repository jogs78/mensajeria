<?php

use Illuminate\Support\Facades\Route;
use App\Models\Semestre;
use App\Models\Carrera;
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
/*rutas login */
Route::get('/log-in', function(){
    return view('login.login');
})->name('login');
Route::post('/log-in', 'AutenticarController@logIn');


/*rutas registro */
Route::get('/sign-up',function(){
    $semestres = Semestre::all();$carreras = Carrera::all();
    return view('sign-up.sing-up', compact('semestres', 'carreras'));
});
Route::post('/sign-up', 'AutenticarController@signUp');


/*ruta salir */
Route::get('/log-out','AutenticarController@logOut');






Route::resource('user', 'InformaticoController');
Route::resource('alumno', 'AlumnoController');
Route::resource('mensajes', 'MensajeController');




