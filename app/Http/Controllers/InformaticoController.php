<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformaticoController extends Controller
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

        $validator=$request->validate([
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required',
            'rol' => 'required',
            'puesto' => 'required',
            'quien_revisa' => 'required'

        ], [
            'name.required' => 'El campo nombre es requerido',
            'a_paterno.required' => 'El campo apellido paterno es requerido',
            'a_materno.required' => 'El campo apellido materno es requerido',
            'email.required' => 'El campo email es requerido',
            'password.required' => 'El campo contraseña es requerido',
            'password_confirm.required' => 'El campo confirmar contraseña es requerido',
            'rol.required' => 'El campo rol es requerido',
            'puesto.required' => 'El campo puesto es requerido',
            'quien_revisa.required' => 'El campo quien revisa es requerido',
        ]);

        if($informacion['password'] != $informacion['password_confirm']){
            return back() -> with('message', 'Las contraseñas no coinciden')->withInput();
        }
        
        $empleado = new Empleado();
        unset($informacion['numer_control']);
        unset($informacion['carrera']);
        unset($informacion['semestre']);
        unset($informacion['password_confirm']);

        $empleado -> nombre = $informacion['name'];
        $empleado -> apellido_paterno = $informacion['a_paterno'];
        $empleado -> apellido_materno = $informacion['a_materno'];
        $empleado -> correo = $informacion['email'];
        $empleado -> pass = Hash::make($informacion['password']);
        $empleado -> rol = $informacion['rol'];
        $empleado -> puesto = $informacion['puesto'];
        $empleado -> quien_revisa = $informacion['quien_revisa'];
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
