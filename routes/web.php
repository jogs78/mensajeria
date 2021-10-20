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

/*admin login */
Route::get('/admins/log-in', function(){
    return view('login-empleado');
})->name('login');
Route::post('/admins/log-in', 'AutenticarController@logInAdmin');

/*rutas registro */
Route::get('/sign-up',function(){
    $semestres = Semestre::all();$carreras = Carrera::all();
    return view('sign-up.sing-up', compact('semestres', 'carreras'));
});
Route::post('/sign-up', 'AutenticarController@signUp');


/*ruta salir */
Route::get('/log-out','AutenticarController@logOut');
Route::get('/admins/log-out','AutenticarController@adminLogOut');


Route::get('/', function(){
    return view('dashboard');
})->middleware('auth:admin');


Route::get('mensajes-alumnos', 'AlumnoController@index')->middleware('auth');
Route::resource('user', 'InformaticoController')->middleware('auth:admin');
Route::resource('alumno', 'AlumnoController')->middleware('auth:admin');
Route::resource('mensajes', 'MensajeController')->middleware('auth:admin');




