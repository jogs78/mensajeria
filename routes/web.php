<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('emisor.mensaje-create');
});
Route::get('/show', function () {
    return view('emisor.mensaje-list');
});
Route::get('/log-in', function(){
    return view('login.login');
});
Route::get('/users-list', function(){
    return view('informatico.user-list');
});
Route::get('/users-register', function(){
    return view('informatico.user-register');
});
Route::post('/log-in', 'AutenticarController@logIn');

Route::get('/sign-up',function(){
    return view('sign-up.sing-up');
});
Route::post('/sign-up', 'AutenticarController@signUp');
