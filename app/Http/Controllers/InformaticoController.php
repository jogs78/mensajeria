<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Semestre;
use App\Models\Carrera;
class InformaticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $alumnos = DB::table('alumnos')
        //         ->select('id','nombre', 'apellido_paterno as a_paterno', 'apellido_materno as a_materno', 'carrera_id', 'semestre_id', 'correo')
        //         ->get();
        $alumnos = Alumno::with('carrera','semestre')->get();
        $empleados = DB::table('empleados')
                ->select('id','nombre', 'apellido_paterno as a_paterno', 'apellido_materno as a_materno', 'correo', 'rol', 'puesto')
                ->get();
        return view('informatico.user-list', compact('alumnos', 'empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semestres = Semestre::all();
        $carreras = Carrera::all();
        return view('informatico.user-register', compact('semestres', 'carreras'));
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

        request()->validate([
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'email' => 'required | email',
            'password' => 'required',
            'password_confirm' => 'required',
            'rol' => 'required',
            'puesto' => 'required',
            'quien_revisa' => 'required'
        ]);

        /*$validator=$request->validate([
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
        ]);*/

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
        $alumno = "";
        $empleado = "";
        if(Alumno::find($id)){
            $alumno = Alumno::find($id);
            return view('informatico.user-edit', compact('alumno','empleado'));
        }elseif(Empleado::find($id)){
            $empleado = Empleado::find($id);
            return view('informatico.user-edit', compact('alumno','empleado'));
        }
        
        //return view('informatico.user-edit', compact('alumno','empleado'));
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
        $alumno = Alumno::find($id);
        $empleado = Empleado::find($id);
        if($alumno){
            if($request->contraseña != $request->contraseña_confirm){
                return back()->with('message','Las contraseñas no coinciden');
            }elseif($request->contraseña=="" || $request->contraseña_confirm== ""){
                unset($request->contraseña);
                unset($request->contraseña_confirm);
                $alumno ->id = $request->numero_control;
                $alumno -> nombre = $request -> name;
                $alumno -> apellido_paterno = $request -> a_paterno;
                $alumno -> apellido_materno = $request -> a_materno;
                $alumno -> carrera = $request -> carrera;
                $alumno -> semestre = $request -> semestre;
                $alumno -> correo = $request -> correo;
                $alumno -> contraseña = $alumno -> contraseña;
                $alumno -> save();
                return redirect('user')-> with('message','registro');
            }elseif($request->contraseña =! ""){
                $alumno -> contraseña = Hash::make($request -> contraseña);
                $alumno -> save();
                return redirect('user')-> with('message','registro');
            }
        }elseif($empleado){
            if($request->contraseña != $request->contraseña_confirm){
                return back()->with('message','Las contraseñas no coinciden');
            }elseif($request->contraseña=="" || $request->contraseña_confirm== ""){
                unset($request->contraseña);
                unset($request->contraseña_confirm);
                
                $empleado -> nombre = $request -> name;
                $empleado -> apellido_paterno = $request -> a_paterno;
                $empleado -> apellido_materno = $request -> a_materno;
                $empleado -> correo = $request -> correo;
                $empleado -> pass = $empleado -> pass;
                $empleado ->rol = $request->rol;
                $empleado ->puesto = $request->puesto;
                $empleado ->quien_revisa = $request->quien_revisa;
                $empleado -> save();
                return redirect('user')-> with('message','registro');
            }elseif($request->contraseña =! ""){
                $empleado -> contraseña = Hash::make($request -> contraseña);
                $empleado -> save();
                return redirect('user')-> with('message','registro');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //solo elimina alumnos
        if(Alumno::destroy($id) || Empleado::destroy($id)){
            return redirect()->back()->with('message','ok');
        }
        
    }
}
