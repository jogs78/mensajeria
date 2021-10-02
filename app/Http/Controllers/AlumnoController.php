<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('informatico.user-register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $informacion = $request ->all();
        //
        request()->validate([
            'numero_control' => 'required',
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'carrera'=> 'required',
            'semestre' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirm' => 'required',
        ]);

        /*$request->validate([
            'numero_control' => 'required',
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required',

        ], [
            'numero_control.required' => 'El campo numero de control es requerido',
            'name.required' => 'El campo nombre es requerido',
            'a_paterno.required' => 'El campo apellido paterno es requerido',
            'a_materno.required' => 'El campo apellido materno es requerido',
            'email.required' => 'El campo email es requerido',
            'password.required' => 'El campo contraseña es requerido',
            'password_confirm.required' => 'El campo confirmar contraseña es requerido'
        ]);*/

        if($informacion['password'] != $informacion['password_confirm']){
            return back() -> with('message', 'Las contraseñas no coinciden')->withInput();
        }
        
        $empleado = new Alumno();
        unset($informacion['rol']);
        unset($informacion['puesto']);
        unset($informacion['quien_envia']);
        unset($informacion['password_confirm']);

        $empleado -> numero_control = $informacion['numero_control'];
        $empleado -> nombre = $informacion['name'];
        $empleado -> apellido_paterno = $informacion['a_paterno'];
        $empleado -> apellido_materno = $informacion['a_materno'];
        $empleado -> carrera = $informacion['carrera'];
        $empleado -> semestre = $informacion['semestre'];
        $empleado -> correo = $informacion['email'];
        $empleado -> contraseña = Hash::make($informacion['password']);
        $empleado -> save();
        return redirect() -> back() -> with('message', 'Registro exitoso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
