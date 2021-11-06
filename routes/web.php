<?php

use Illuminate\Support\Facades\Route;
use App\Models\Semestre;
use App\Models\Carrera;
use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
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
/*rutas login alumnos*/
Route::get('/log-in', function(){return view('login.login');})->name('login')->middleware('guest');
Route::post('/log-in', 'AutenticarController@logIn');

/*rutas registro*/
Route::get('/sign-up',function(){
    $semestres = Semestre::all();$carreras = Carrera::all();
    return view('sign-up.sing-up', compact('semestres', 'carreras'));
});
Route::post('/sign-up', 'AutenticarController@signUp');


/*ruta salir */
Route::get('/log-out','AutenticarController@logOut');
Route::get('/admins/log-out','AutenticarController@adminLogOut');

/*Reset contraseña*/
Route::post('resetPassword','AutenticarController@restPassword');

Route::get('/inicio', function(){
    $carreras = Carrera::all();
    $alumnos = sizeof(Alumno::all());
    $empleados = sizeof(Empleado::all());
    $c_total=array();
    for($i=0;$i<sizeof($carreras);$i++){
        $total = DB::select('SELECT * FROM alumnos WHERE carrera_id='.($i+1));
        $c_total[$i]=sizeof($total); 
    }
    return view('dashboard', compact('carreras','c_total','alumnos','empleados'));})->middleware('auth:admin');
Route::get('mensajes-alumnos', 'AlumnoController@index')->middleware('auth');
Route::resource('user', 'InformaticoController')->middleware('auth:admin');
Route::resource('alumno', 'AlumnoController')->middleware('auth:admin');
Route::resource('mensajes', 'MensajeController')->middleware('auth:admin');
Route::resource('carreras', 'CarrerasController')->middleware('auth:admin');





