<?php

namespace App\Http\Controllers;

use App\Models\Emisor;
use App\Models\mensaje;
use Illuminate\Http\Request;

class EmisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes=Mensaje::all();
        
        return view('emisor.mensaje-list', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emisor.mensaje-create');
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
        $mensaje -> carrera = $datos['carrera'];
        $mensaje -> semestre = $datos['semestre'];
        $mensaje -> estado = 0;
        if(isset($_POST["servicio"]) and isset($_POST["residencia"])){
            $mensaje -> otros = 2;
        }elseif(isset($_POST["servicio"])){
            $mensaje -> otros = 0;
        }elseif(isset($_POST["residencia"])){
            $mensaje -> otros = 1;
        }elseif(isset($_POST["general"])){
            $mensaje -> otros = 3;
            $mensaje -> carrera = "GENERAL";
            $mensaje -> semestre = "TODOS";
        }
        
        $mensaje -> save();
        // Servicio social (0), Residencia (1), ambos seleccionados (2), General (3)
        return redirect('/mensajes-emisor');
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
        
        return view('emisor.mensaje-show', compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mensaje = Mensaje::find($id);
        return view('emisor.mensaje-edit', compact('mensaje'));
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
        return redirect('/mensajes-emisor');

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
