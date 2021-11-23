<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use App\Models\mensaje;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);

        if($empleado){
            return $empleado;
        }else{
            return "Hubo un error al cargar sus datos";
        }
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
        $empleado = Empleado::find($id);
        if ($request->hasFile('imagProfile')) {
            $url = str_replace('storage', 'public', $empleado->foto_perfil);
            Storage::delete($url);
            $img = $request->file('imagProfile')->store('public/usuarios_foto_perfil');
            $url = Storage::url($img);
            $empleado -> foto_perfil = $url;
        }
        if($request->newPass != null){
            $empleado->password =  Hash::make($request->newPass); 
        }
        $empleado->nombre = $request->nombre;
        $empleado->apellido_paterno = $request->a_paterno;
        $empleado->apellido_materno = $request->a_materno;
        $empleado->correo = $request->correo;
        $empleado->save();
        return "¡Datos actualizado!";
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
    public function verEstadisticas($id){
        // $mensaje = mensaje::where('id', $id)::with('carreras', 'semestres')->get();
        $mensaje = mensaje::with('carreras', 'semestres')->where('id', $id)->first();
        // Alumno::with('carrera', 'semestre')->get();
        $alumnosMensajes = array();
        // return sizeof($mensaje->carreras);
        for($i = 0; $i<sizeof($mensaje->carreras); $i++){
            // Alumno::where('carrera_id', $mensaje->carreras[$i]->id )->count()
            // $alumnosMensajes[$i]= array($mensaje->carreras[$i]->name => Alumno::where('carrera_id', $mensaje->carreras[$i]->id )->count(),);
            $alumnosMensajes[$i]= array(
                'carrera' => $mensaje->carreras[$i]->name,
                'cantidadAlumnos' => Alumno::where('carrera_id', $mensaje->carreras[$i]->id )->count(),
                 
            );
            ;
        }
        // return $alumnosMensajes;
        return json_encode($respuesta = array($mensaje, $alumnosMensajes) );
        
    }
    
}
