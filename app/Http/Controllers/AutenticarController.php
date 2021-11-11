<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Mai;
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
        $alumno = Alumno::where('correo', $email)->first();
        $rememberMe = false;
        if (isset($request->rememberMe))
            $rememberMe = true;
        if (is_null($alumno)) {
            $credentials = ['correo' => $email, 'password' => $password];
            if (Auth::guard('admin')->attempt($credentials)) {
                $empleado = Empleado::where('correo', $email)->first();
                Auth::login($empleado, $rememberMe);
                return redirect('/inicio');
            }
            return back()->withErrors('¡Error! El usuario no existe')->withInput();
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
        $codigo = Str::random(25);
        $personalInformation = $request->all();
        if ($personalInformation['password'] != $personalInformation['confirmar_password']) {
            return back()->with('message', 'Las contraseñas no coinciden')->withInput();
        } elseif ($personalInformation['num_control'] == "" || $personalInformation['name'] == "" || $personalInformation['a_paterno'] == "" || $personalInformation['a_materno'] == "" || $personalInformation['correo'] == "" || $personalInformation['password'] == "" || $personalInformation['confirmar_password'] == "" || $personalInformation['carrera'] == "" || $personalInformation['semestre'] == "") {
            return back()->with('message', '¡Faltan campos por llenar!')->withInput();
        } elseif ($personalInformation['password'] == $personalInformation['confirmar_password']) {
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
            ///////
            $data = [
                'name' => $personalInformation['name'],
                'confirmation_code' => $codigo
            ];
            Mail::to($personalInformation['correo'])->send(new TestMail($data));

            $alumno->save();
            return redirect()->back()->with('message', 'Registro exitoso');
            return $personalInformation;
            return redirect('/Usuarios');
        } else {
            return redirect()->back()->with('message', "¡Error de registro!");
        }
    }

    public function verify($code)
    {
        $alumno = Alumno::where('confirmation_code', $code)->first();
        if (!$alumno) {
            return redirect('/Usuarios');
        }

        $alumno->confirmed = true;
        $alumno->confirmation_code = null;
        $alumno->save();
        return redirect('/log-in');
    }

    public function restPassword(Request $request)
    {
        $alumno = Alumno::where('correo', $request->email)->first();
        $empleado = Empleado::where('correo', $request->email)->first();
        if ($alumno) {
            $alumno->contraseña = Hash::make($request->newPassword);
            $alumno->save();
        } elseif ($empleado) {
            $empleado->password = Hash::make($request->newPassword);
            $empleado->save();
        } else {
            return "El correo ingresado no existe o es erroneo";
        }
        return "Contraseña cambiada exitosamente";
    }
}
