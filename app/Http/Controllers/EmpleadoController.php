<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Empleado;
use App\Models\mensaje;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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
        $mensaje = mensaje::with('carreras', 'semestres')->get()->where('id', $id)->first();
        $alumnosMensajes = array();
        
        $a1 = array(); $visitas = array(); $visitas2 = array(); $visitasContador = array(); $contador = 0;
        for($i = 0; $i < sizeof($mensaje->carreras); $i++){
            for($j = 0; $j < sizeof($mensaje->semestres); $j++){
                $sql = Alumno::where('carrera_id', $mensaje->carreras[$i]->id)->where('semestre_id', $mensaje->semestres[$j]->id)->count();
                array_push($a1, [
                    'carrera' => $mensaje->carreras[$i]->name,
                    'cantidadAlumnos' => $sql,
                ]);
            } 
            
        }
        for($i = 0; $i < sizeof($a1); $i++){
            if($a1[$i]['cantidadAlumnos'] > 0) array_push($alumnosMensajes,$a1[$i]);
        }

        for($i = 0; $i < sizeof($mensaje->carreras); $i++){
            for($j = 0; $j < sizeof($mensaje->semestres); $j++){
                $con = Alumno::whereHas('notifications', function(Builder $query){
                    $query->where('read_at','!=', null);
                })
                ->where('carrera_id', $mensaje->carreras[$i]->id)
                ->where('semestre_id', $mensaje->semestres[$j]->id)
                ->orderBy('nombre')->get();
                if(sizeof($con) > 0){
                    for($k = 0; $k<sizeof($con); $k ++){
                    array_push($visitas, $con[$k]);
                    }
                }else unset($con);
            } 
        };
        for($i = 0; $i < sizeof($mensaje->carreras); $i++){
            for($j = 0; $j < sizeof($visitas); $j++){
                if($mensaje->carreras[$i]->id == $visitas[$j]->carrera_id){
                    $contador +=1;
                    if(sizeof($visitas2) == 0){
                        array_push($visitas2, ['carrera' => $mensaje->carreras[$i]->name,
                        'visitas' => $contador,]);
                    }else{
                        if($mensaje->carreras[$i]->name == $visitas2[$j-1]['carrera']){
                            $visitas2[$j-1]['visitas'] = $visitas2[$j-1]['visitas'] + $contador;
                            unset($visitas2[$j-1]['carrera']);
                        }  
                        array_push($visitas2, ['carrera' => $mensaje->carreras[$i]->name,
                        'visitas' => $contador,]);                
                    }   
                    $contador =0;                   
                }
            }           
        }
        
    //    for($i = 0; $i < sizeof($visitas2); $i++){
    //        if(is_null($visitas2[$i]['carrera'])){
    //         unset($visitas2[$i]);
    //        }else{
    //            array_push($visitasContador, $visitas2[$i]);
    //        }
    //    }
    //    return $visitas2;
        return (object) $respuesta = array(
            'mensaje' => $mensaje, 
            'alumnosCarreras' => $alumnosMensajes, 
            'visitas' => $visitasContador);
        
    }
}


