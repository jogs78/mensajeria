<?php

use Illuminate\Support\Facades\Route;
use App\Models\Semestre;
use App\Models\Carrera;
use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
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

Route::get('/log-in', function () {
    return view('login.login');
})->name('login')->middleware('guest');
Route::post('/log-in', 'AutenticarController@logIn');

/*rutas registro*/
Route::get('/sign-up', function () {
    $semestres = Semestre::all();
    $carreras = Carrera::all();
    return view('sign-up.sing-up', compact('semestres', 'carreras'));
});
Route::post('/sign-up', 'AutenticarController@signUp');


/*ruta salir */
Route::get('/log-out', 'AutenticarController@logOut');

/*Reset contraseña*/
Route::get('/sendMailReset', 'AutenticarController@sendMailReset');
Route::get('//resetPassword/{email}', 'AutenticarController@resetPasswordView');
Route::post('/resetPassword', 'AutenticarController@resetPassword');

Route::get('/inicio', function () {
    $c_carreras = Carrera::all();
    $c_alumnos = sizeof(Alumno::all());
    $c_empleados = sizeof(Empleado::all());
    $c_total = array();
    for ($i = 0; $i < sizeof($c_carreras); $i++) {
        $total = DB::select('SELECT * FROM alumnos WHERE carrera_id=' . ($i + 1));
        $c_total[$i] = sizeof($total);
    }
    return view('dashboard', compact('c_carreras', 'c_total', 'c_alumnos', 'c_empleados'));
})->middleware('auth:admin');
Route::get('/', function () {
    if (Auth::user()) {
        $a = Alumno::find(Auth::user()->id);
        $e = Empleado::find(Auth::user()->id);
        if ($a) {
            return redirect('/mensajes-alumnos');
        } elseif ($e) {
            return redirect('/inicio');
        }
    }
    return redirect('/log-in');

});
Route::get('/ver-mensaje/{id}', 'AlumnoController@verMensaje')->middleware('auth');
Route::get('/panel-difusor', 'MensajeController@panelDifusor')->middleware('auth:admin');
Route::get('/panel-emisor', 'MensajeController@panelEmisor')->middleware('auth:admin');
Route::get('/ver-estadisticas/{id}', 'EmpleadoController@verEstadisticas')->middleware('auth:admin');
Route::get('/consultarEstadistica', 'EmpleadoController@consultarEstadistica')->middleware('auth:admin');
Route::get('/mensajes-alumnos', 'AlumnoController@index')->middleware('auth');
Route::resource('/user', 'InformaticoController')->middleware('auth:admin');
Route::resource('/empleado', 'EmpleadoController')->middleware('auth:admin');
Route::resource('/alumno', 'AlumnoController')->middleware('auth');
Route::resource('/mensajes', 'MensajeController')->middleware('auth:admin');
Route::resource('/carreras', 'CarrerasController')->middleware('auth:admin');


//E-mail verification
Route::get('register/verify{code}', 'InformaticoController@verifyEmpleado');

//Segmentacion
Route::get('segmentacion/{id}', 'AlumnoController@segmentacion');

