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

Route::get('/log-in', function(){
    return view('login.login');
});
Route::post('/log-in', 'AutenticarController@logIn')->name('login');

Route::get('/sign-up',function(){
    $semestres = Semestre::all();
    $carreras = Carrera::all();
    return view('sign-up.sing-up', compact('semestres', 'carreras'));
});
Route::post('/sign-up', 'AutenticarController@signUp');
Route::get('/', function () {
    return view('emisor.mensaje-create');
});
//Route::get('/show', function () {
  //  return view('emisor.mensaje-list');
//});




Route::resource('user', 'InformaticoController');
Route::resource('alumno', 'AlumnoController');
Route::resource('mensajes', 'MensajeController');




