<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Semestre;
use App\Models\Carrera;
use Illuminate\Support\Facades\Auth;

class InformaticoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $c_total = null;
        $this->authorize('view', Auth::user());
        $buscar=$request->get('buscarpor');
        $tipo=$request->get('tipo');
        $buscarEmpleado=$request->get('buscarPor');
        $tipoEmpleado=$request->get('tipoEmpleado');
        $tipo_carrera=$request->get('carreras');
        
        $tipo_semestre=$request->get('semestres');
        $alumnos = Alumno::FiltroCarreraSemestre($tipo_carrera,$tipo_semestre)->buscarpor($tipo, $buscar)->with('carrera', 'semestre')->paginate(100);
        $empleados = Empleado::FiltroEmpleado($tipoEmpleado, $buscarEmpleado)->where('id', '!=', Auth::user()->id)->paginate(10);
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        return view('informatico.user-list', compact('alumnos', 'empleados','carreras','semestres'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Auth::user());
        $semestres = Semestre::all();
        $carreras = Carrera::all();
        //$empleados = DB::select('SELECT * FROM empleados WHERE rol="Revisor"');
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
        $informacion = $request->all();
        //return $informacion;
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
        if ($informacion['password'] != $informacion['password_confirm']) {
            return back()->with('message', 'Las contraseñas no coinciden')->withInput();
        }
        $empleado = new Empleado();
        // unset($informacion['numer_control']);
        // unset($informacion['carrera']);
        // unset($informacion['semestre']);
        // unset($informacion['password_confirm']);
        $empleado->nombre = $informacion['name'];
        $empleado->apellido_paterno = $informacion['a_paterno'];
        $empleado->apellido_materno = $informacion['a_materno'];
        $empleado->correo = $informacion['email'];
        $empleado->password = Hash::make($informacion['password']);
        $empleado->rol = $informacion['rol'];
        $empleado->puesto = $informacion['puesto'];
        $empleado->quien_revisa = $informacion['quien_revisa'];
        $empleado->save();
        return redirect()->back()->with('message', 'Registro existoso');
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
        $this->authorize('edit', Auth::user());
        $alumno = "";
        $empleado = "";
        if (Alumno::find($id)) {
            $semestres = Semestre::all();
            $carreras = Carrera::all();
            $alumno = Alumno::find($id);
            return view('informatico.user-edit', compact('alumno', 'empleado', 'semestres', 'carreras'));
        } elseif (Empleado::find($id)) {
            $empleado = Empleado::find($id);
            return view('informatico.user-edit', compact('alumno', 'empleado'));
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
        
        if ($alumno) {
            
            if ($request->contraseña != $request->contraseña_confirm) {
                return back()->with('message', 'Las contraseñas no coinciden');
            } elseif ($request->contraseña == "" || $request->contraseña_confirm == "") {
                $alumno->id = $request->numero_control;
                $alumno->nombre = $request->name;
                $alumno->apellido_paterno = $request->a_paterno;
                $alumno->apellido_materno = $request->a_materno;
                $alumno->carrera = $request->carrera;
                $alumno->semestre = $request->semestre;
                $alumno->correo = $request->correo;
                
                $alumno->save();
                return redirect('user')->with('message', 'registro');
            } elseif ($request->contraseña = !"") {
                
                $alumno->contraseña = Hash::make($request->contraseña);
                $alumno->save();
                return redirect('user')->with('message', 'registro');
            }
        } elseif ($empleado) {
            $datosEmpleado =  $request->all();
            if ($request->contraseña != $request->contraseña_confirm) {
                return back()->with('message', 'Las contraseñas no coinciden');
            } elseif ($request->contraseña == "" && $request->contraseña_confirm == "") {
                $empleado->nombre = $request->name;
                $empleado->apellido_paterno = $request->a_paterno;
                $empleado->apellido_materno = $request->a_materno;
                $empleado->correo = $request->correo;
                $empleado->rol = $request->rol;
                $empleado->puesto = $request->puesto;
                $empleado->quien_revisa = $request->quien_revisa;
                $empleado->save();
                return redirect('user')->with('message', 'registro');
            } elseif ($request->contraseña = !"") {
                    $empleado -> password = Hash::make($datosEmpleado['contraseña']);
                    $empleado->save();
                return redirect('user')->with('message', 'registro');
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
        if (Alumno::destroy($id) || Empleado::destroy($id)) {
            return redirect()->back()->with('message', 'ok');
        }
    }


    
}
