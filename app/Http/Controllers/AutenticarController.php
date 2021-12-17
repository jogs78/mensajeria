<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\TestMail;
use App\Mail\restPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AutenticarController extends Controller
{
    //alumno
    public function logIn(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'El campo correo electrónico es requerido',
            'password.required' => 'El campo password es requerido',
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        $alumno = Alumno::where('correo', $email)->first();//buscamos el correo en la tabla alumnos
        $rememberMe = false;
        if (isset($request->rememberMe))
            $rememberMe = true;
        if (is_null($alumno)) {//validamos si encontramos correo en la tabla alumnos
            $empleado = Empleado::where('correo', $email)->first();
            if(is_null($empleado)){
                return back()->withErrors('¡Error! El usuario no existe')->withInput();
            }else{
                if($empleado->confirmed==1){
                    $credentials = ['correo' => $email, 'password' => $password];
                    if (Auth::guard('admin')->attempt($credentials)) {
                        Auth::login($empleado, $rememberMe);
                        return redirect('/inicio');
                    }
               }else{
                    return redirect()->back()->with('message', "¡El correo no ha sio confirmado!");
               }
            }
        } elseif ($alumno->confirmed == 1) {
            if (Hash::check($password, $alumno->contraseña)) {
                Auth::login($alumno, $rememberMe);
                return redirect('/mensajes-alumnos');
            } else {
                return back()->withErrors('¡Error! Datos incorrectos (alumno)')->withInput();
            }
        } else {
            return redirect()->back()->with('message', "¡El correo no ha sio confirmado!");
        }
    }
    public function logOut()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/log-in');
    }
    public function signUp(Request $request)
    {
        //Metodo para registrate como alumno.
        $codigo = Str::random(25);//generamos un codigo de confirmacion aleatorio
        $personalInformation = $request->all();//obtenemos todos los datos puestos en el formulario
        request()->validate([//validamos que los campos no esten vacios
            'num_control' => 'required',
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'correo' => 'required | email',
            'password' => 'required',
            'confirmar_password' => 'required',
            'carrera' => 'required',
            'semestre' => 'required'
        ]);
        // checamos si el número de control ya existe en la base
        $users = Alumno::where('id', $personalInformation['num_control'])->get();
        // checamos si el correol ya existe en la base
        $correo = Alumno::where('correo', $personalInformation['correo'])->get();
        $correo2 = Empleado::where('correo', $personalInformation['correo'])->get();
        // validamos si encontramos un registro
        if(sizeof($users) > 0){
            return redirect()->back()->with('message', "¡El número de control ya se encuentra registrado!");
        }else{
            //validamos si encontramos un correo existente
            if(sizeof($correo) > 0 or sizeof($correo2)>0){
                return redirect()->back()->with('message', "¡Este correo ya esta en uso, por favor utilice otro!");
            }else{
                //validamos que las contraseñas coincidan
                if ($personalInformation['password'] != $personalInformation['confirmar_password']) {
                    return back()->with('message', 'Las contraseñas no coinciden')->withInput();
                }
                //si son iguales, procedemos a guardar el registro en la base
                elseif ($personalInformation['password'] == $personalInformation['confirmar_password']) {
                    unset($personalInformation['confirmar_password']);
                    $alumno = new Alumno();
                    $personalInformation['num_control'] = intval($personalInformation['num_control']);
                    $alumno->id = $personalInformation['num_control'];
                    $alumno->nombre = $personalInformation['name'];
                    $alumno->apellido_paterno = $personalInformation['a_paterno'];
                    $alumno->apellido_materno = $personalInformation['a_materno'];
                    $alumno->correo = $personalInformation['correo'];
                    $alumno->contraseña = Hash::make($personalInformation['password']);
                    $alumno->carrera_id = $personalInformation['carrera'];
                    $alumno->semestre_id = $personalInformation['semestre'];
                    $alumno->foto_perfil = Storage::url('user-profile-icon.jpg');
                    $alumno->confirmation_code = $codigo;
                    //guardamos el nombre y el codigo para usarlos en la confirmacion de correo.
                    $data = [
                        'name' => $personalInformation['name'],
                        'confirmation_code' => $codigo
                    ];
                    //pasamos los datos al archivo TestMail
                    Mail::to($personalInformation['correo'])->send(new TestMail($data));
                    $alumno->save();
                    return redirect()->back()->with('message', 'Revise su correo para terminar el registro.');
                    return redirect('/Usuarios');
                }
                //error de conexion
                else {
                    return redirect()->back()->with('message', "¡Error de registro!");
                }
            }
        }
    }
    // //Metodo para confirmar el correo.
    // public function verify($code)
    // {
    //     return $code;
    //     $alumno = Alumno::where('confirmation_code', $code)->first();
    //     if (!$alumno) {
    //         return redirect('/log-in');
    //     }

    //     $alumno->confirmed = true;
    //     $alumno->confirmation_code = null;
    //     $alumno->save();
    //     return redirect('/log-in');
        
       
    // }

    public function sendMailReset(Request $request)
    {
        $email = $request->email;
        $alumno = Alumno::where('correo', $request->email)->first();
        $empleado = Empleado::where('correo', $request->email)->first();

        if ($alumno) {
            $data = ['name' => $alumno->nombre,
            'email' => $alumno->correo];
            Mail::to($email)->send(new restPasswordMail($data));
            return "Se a enviado un email al correo proporcionado";
        } elseif ($empleado) {
            $data = ['name' => $empleado->nombre,
            'email' => $empleado->correo];
            Mail::to($email)->send(new restPasswordMail($data));
            return "Se a enviado un email al correo proporcionado xd";
        } 
    }
    public function resetPasswordView($email)
    {
        $alumno = Alumno::where('correo', $email)->first();
        $empleado = Empleado::where('correo', $email)->first();
        $user = null;
        if ($alumno) {
            $user = $alumno;
            return view('reset-password.reset-password', compact('user'));
        } elseif ($empleado) {
            $user = $empleado;
            return view('reset-password.reset-password', compact('user'));
        } 
    }
    public function resetPassword(Request $request)
    {
        $alumno = Alumno::where('correo', $request->correo)->first();
        $empleado = Empleado::where('correo', $request->correo)->first();

        if ($alumno) {
          
           $alumno->contraseña = Hash::make($request->p1);
           $alumno->save(); 
           return redirect('/log-in')->withErrors('Contraseña actualizada');
        } elseif ($empleado) {
           $empleado->password = Hash::make($request->p1);
           $empleado->save(); 
           return redirect('/log-in')->withErrors('Contraseña actualizada');
        } 
    }
}
