<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AutenticarController extends Controller
{
    public function logIn(Request $request){
        $personalInformation = $request -> all();
        $alumno = Alumno::find($personalInformation['num_control'], ['numero_control', 'contraseña']);

        if(is_null($alumno)){
            return redirect() -> back() -> with('message', '¡Error! Usuario no registrado');
        }else{
            if($personalInformation['num_control'] != $alumno -> numero_control || $personalInformation['password'] !=  Hash::check($personalInformation['password'], $alumno -> contraseña)){
                return redirect() -> back() -> with('message', '¡Error! Datos ingresados erroneos');
            }
            if($personalInformation['num_control'] == $alumno -> numero_control && $personalInformation['password'] ==  Hash::check($personalInformation['password'], $alumno -> contraseña)){
                return view('alumno.example');
            }
        }
    }
    public function logOut(){

    }
    public function signUp(Request $request){
        //  return $request;
        $personalInformation = $request -> all();
        if($personalInformation['password'] != $personalInformation['confirmar_password']){
            return redirect() -> back() -> with('message', 'Las contraseñas no coinciden');
        }elseif ($personalInformation['num_control'] == "" || $personalInformation['name'] == "" || $personalInformation['a_paterno'] == "" || $personalInformation['a_materno'] == "" || $personalInformation['correo'] == "" || $personalInformation['password'] == "" || $personalInformation['confirmar_password'] == "" || $personalInformation['carrera'] == "" || $personalInformation['semestre'] == "") {
            return redirect() -> back() -> with('message', '¡Faltan campos por llenar!');
        }elseif ($personalInformation['password'] == $personalInformation['confirmar_password']) {
            unset($personalInformation['confirmar_password']);
            $alumno = new Alumno();
            $personalInformation['num_control']= intval($personalInformation['num_control']);
            
            // $alumno -> fill($personalInformation);
            // $pregunta->producto_id=$enviar['id_producto'];
            $alumno -> numero_control = $personalInformation['num_control'];
            $alumno -> nombre = $personalInformation['name'];
            $alumno -> apellido_paterno = $personalInformation['a_paterno'];
            $alumno -> apellido_materno = $personalInformation['a_materno'];
            $alumno -> carrera = $personalInformation['carrera'];
            $alumno -> semestre = $personalInformation['semestre'];
            $alumno -> correo = $personalInformation['correo'];
            $alumno -> contraseña = Hash::make($personalInformation['password']);
            $alumno -> save();
            return redirect() -> back() -> with('message', 'Registro exitoso');
            return $personalInformation;
            
        return redirect('/Usuarios');
            
        }else{
            return redirect() -> back() -> with('message', "¡Error de registro!");
        }   

    }
}
