<?php

namespace App\Http\Controllers;

use App\Models\Emisor;
use App\Models\Men;
use App\Models\mensaje;
use App\Models\carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;

class MensajeController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes=Mensaje::all();
        
        return view('mensaje.mensaje-list', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        return view('mensaje.mensaje-create', compact('carreras', 'semestres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();
        $mensaje = new mensaje();
        $mensaje -> titulo = $datos['titulo'];
        $mensaje -> descripcion = $datos['descripcion'];
        $mensaje -> estado = 0;
        $mensaje -> imagen="jhasdkhkd";
        $mensaje -> empleado_id=1;

        /*if(isset($_POST["servicio"]) and isset($_POST["residencia"])){
            $mensaje -> otros = 2;
        }elseif(isset($_POST["servicio"])){
            $mensaje -> otros = 0;
            $general=0;
        }elseif(isset($_POST["residencia"])){
            $mensaje -> otros = 1;
            $general=0;
        }elseif(isset($_POST["general"])){
            $mensaje -> otros = 3;
            $mensaje -> carrera = "GENERAL";
            $mensaje -> semestre = "TODOS";
            $general=1;
        }*/
        $mensaje -> save();
        $mensaje ->carreras()->attach([1]);
        $mensaje ->carreras()->attach([2]);

        

        
        // Servicio social (0), Residencia (1), ambos seleccionados (2), General (3)
        return redirect('/mensajes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mensaje = Mensaje::find($id);
        
        return view('mensaje.mensaje-show', compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carreras = [
            'Ingen. Mécanica',
            'Ingen. Sistemas Computacionales',
            'Ingen. Industrial',
            'Ingen. Electrónica',
            'Ingen. Eléctrica',
            'Ingen. Bioquímica',
            'Ingen. Química',
            'Ingen. Gestión Empresarial',
            'Maestria en Ciencias en Ingeniería Bioquímica',
            'Maestría en Ciencias en Ingeniería Mecatrónica',
            'Doctorado en Ciencias de los Alimentos y Biotecs de los Alimentos y Biotecnología',
            'Doctorado en Ciencias de la Ingeniería'
        ];
        $semestres = [1,2,3,4,5,6,7,8,9];
        $mensaje = Mensaje::find($id);
        return view('mensaje.mensaje-edit', compact('mensaje', 'carreras', 'semestres'));
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
        $mensaje = Mensaje::find($id);
        
        $mensaje -> titulo = $request->titulo;
        $mensaje -> descripcion = $request->descripcion;
        $mensaje -> carrera = $request->carrera;
        $mensaje -> semestre = $request->semestre;
        if(isset($_POST["servicio"]) and isset($_POST["residencia"])){
            $mensaje -> otros = 2;
        }elseif(isset($_POST["servicio"])){
            $mensaje -> otros = 0;
        }elseif(isset($_POST["residencia"])){
            $mensaje -> otros = 1;
        }elseif(isset($_POST["general"])){
            $mensaje -> otros = 3;
        }
        $mensaje -> save();
        return redirect('/mensajes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Mensaje::destroy($id)){
            return redirect()->back()->with('message','ok');
        }
    }
}
