<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AutenticarController extends Controller
{
    //
    public function logIn(Request $request){
        $validator=$request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'El campo numero de control es requerido',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $alumno = Alumno::where('correo', $email)->first();
        $empleado = Empleado::where('correo', $email)->first();
        if(is_null($alumno)){
            if(is_null($empleado)){
            return back()->withErrors('¡Error! Datos incorrectoss')->withInput();
            }else{
            if($email == $empleado -> correo && $password ==  Hash::check($password, $empleado -> pass)){
                Auth::login($empleado);
                return "user em logged";
                }
            }
            return back()->withErrors('¡Error! Datos incorrectos')->withInput();
        }else{
            if(Hash::check($password, $alumno -> contraseña)){
                $usr = $alumno;
                Auth::login($usr);
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
            return back() -> with('message', 'Las contraseñas no coinciden')->withInput();
        }elseif ($personalInformation['num_control'] == "" || $personalInformation['name'] == "" || $personalInformation['a_paterno'] == "" || $personalInformation['a_materno'] == "" || $personalInformation['correo'] == "" || $personalInformation['password'] == "" || $personalInformation['confirmar_password'] == "" || $personalInformation['carrera'] == "" || $personalInformation['semestre'] == "") {
            return back() -> with('message', '¡Faltan campos por llenar!')->withInput();
        }elseif ($personalInformation['password'] == $personalInformation['confirmar_password']) {
            unset($personalInformation['confirmar_password']);
            $alumno = new Alumno();
            $personalInformation['num_control']= intval($personalInformation['num_control']);
            
            // $alumno -> fill($personalInformation);
            // $pregunta->producto_id=$enviar['id_producto'];
            $alumno -> id = $personalInformation['num_control'];
            $alumno -> nombre = $personalInformation['name'];
            $alumno -> apellido_paterno = $personalInformation['a_paterno'];
            $alumno -> apellido_materno = $personalInformation['a_materno'];
            $alumno -> correo = $personalInformation['correo'];
            $alumno -> contraseña = Hash::make($personalInformation['password']);
            $alumno -> carrera_id = $personalInformation['carrera'];
            $alumno -> semestre_id = $personalInformation['semestre'];
            $alumno -> save();
            return redirect() -> back() -> with('message', 'Registro exitoso');
            return $personalInformation;
            
        return redirect('/Usuarios');
            
        }else{
            return redirect() -> back() -> with('message', "¡Error de registro!");
        }   

    }
}
