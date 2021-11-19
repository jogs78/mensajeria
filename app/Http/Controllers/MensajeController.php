<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Mensaje;
use App\Models\Carrera;
use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MensajeController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        if(Auth::user()->rol=='Emisor'){
            $mensajes= Mensaje::where('empleado_id',Auth::user()->id)->get();
            
        }
        elseif(Auth::user()->rol=='Revisor'){
            $mensajesBD = Mensaje::with('empleado')->get();
            $mensajes=array();
            for($i=0; $i<sizeof($mensajesBD);$i++){
                if(Auth::user()->puesto==$mensajesBD[$i]->empleado->quien_revisa){
                    $mensajes[$i]=$mensajesBD[$i];
                }
                
            } 
        }
        elseif(Auth::user()->rol=='Difusor'){
            $mensajes = Mensaje::where('estado', 1)->get();
        }
        $this->authorize('viewMensajes', App\Models\Mensaje::class);
        return view('mensaje.mensaje-list', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', App\Models\Mensaje::class);

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
        
        if($request->hasFile('file-1')){
            $img = $datos['file-1']->store('public/imagenes_mensajes');
            $url = Storage::url($img);
            $mensaje -> imagen = $url;
        }
        if($request->hasFile('file-2')){
            $img = $datos['file-2']->store('public/documentos_mensajes');
            $urlDoc = Storage::url($img);
            $mensaje -> documento = $urlDoc;
        }
        
        $mensaje -> titulo = $datos['titulo'];
        $mensaje -> descripcion = $datos['descripcion'];
        //Estados... 0-Pendiente, 1-Aceptado, 2-Rechazado
        $mensaje -> estado = 0;
        $mensaje -> empleado_id= Auth::user()->id;
        $mensaje -> save();        
        for ($i=0; $i<sizeof($datos['car']); $i++){
            $mensaje ->carreras()->attach(($datos['car'])[$i]);
        }
        for ($i=0; $i<sizeof($datos['sem']); $i++){
            $mensaje ->semestres()->attach(($datos['sem'])[$i]);
        }
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
        $this->authorize('show', $mensaje);
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
        $carreras = Carrera::all();
        $semestres = Semestre::all();
        $mensaje = Mensaje::find($id);
        $this->authorize('edit', $mensaje);
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
        $datos = $request -> all();
        $mensaje = Mensaje::find($id);
        if(Auth::user()->rol=='Emisor'){
            $mensaje -> titulo = $request->titulo;
            $mensaje -> descripcion = $request->descripcion;
            
            if($request->hasFile('file-1')){
                $url = str_replace('storage', 'public', $mensaje->imagen);
                Storage::delete($url);
                $img = $request->file('file-1')->store('public/imagenes_mensajes');
                $url = Storage::url($img);
                $mensaje -> imagen = $url;
            }
            if($request->hasFile('file-2')){
                $url = str_replace('storage', 'public', $mensaje->imagen);
                Storage::delete($url);
                $img = $datos['file-2']->store('public/documentos_mensajes');
                $urlDoc = Storage::url($img);
                $mensaje -> documento = $urlDoc;
            }
            $mensaje ->carreras()->sync(($datos['car']));
            $mensaje ->semestres()->sync(($datos['sem']));
            // $mensaje -> carrera = $request->carrera;
            // $mensaje -> semestre = $request->semestre;
            // if(isset($_POST["servicio"]) and isset($_POST["residencia"])){
            //     $mensaje -> otros = 2;
            // }elseif(isset($_POST["servicio"])){
            //     $mensaje -> otros = 0;
            // }elseif(isset($_POST["residencia"])){
            //     $mensaje -> otros = 1;
            // }elseif(isset($_POST["general"])){
            //     $mensaje -> otros = 3;
            // }
            $mensaje -> save();
        }
        if(Auth::user()->rol=='Revisor'){
            //return $request->estado;
            if($request->estado=='Aceptar')
                $mensaje->estado=1;
            elseif($request->estado=='Rechazar')
                $mensaje->estado=2;
            $mensaje -> save();
        }
        if(Auth::user()->rol=='Difusor'){
            $mensaje->estado=$request->estado;
            $mensaje -> save();
            return 'Mensaje difundido';
        }
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
        $this->authorize('delete', Mensaje::find($id));
        if(Mensaje::destroy($id)){
            return redirect()->back()->with('message','ok');
        }
    }
    public function panelDifusor(){
        $carreras = Carrera::all();
        $totalMensajes = Mensaje::where('estado','=', 3)->count();
        $totalAlumnos = Alumno::all()->count();
        $mensajesByCarrera = array();
        $mensaje = Mensaje::with('carreras')->get();
        for($i = 0; $i<sizeof($carreras); $i++){
            $total = DB::select('SELECT * FROM carrera_mensaje WHERE carrera_id='.($i+1));
            $mensajesByCarrera[$i]=sizeof($total); 
        }
        $valores=['carreras'=> $carreras,'mensajesTotales'=> $totalMensajes,'alumnosTotales'=> $totalAlumnos,'MensajesByCarrera'=> $mensajesByCarrera];
        return response()->json($valores);
    }
}
