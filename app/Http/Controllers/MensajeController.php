<?php

namespace App\Http\Controllers;

use App\Events\MensajeEvent;
use App\Models\Alumno;
use App\Models\Mensaje;
use App\Models\Carrera;
use App\Models\Semestre;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function index(Request $request)
    {
        //$this->authorize('viewMensajes', App\Models\Mensaje::class);
        $titulo = $request->titulo;
        $fechaPublicacion = $request->fechaPub;
        $carrera = $request->carrera;
        $carreras = Carrera::all();

        if (Auth::user()->rol == 'Emisor') {
            $mensajes = Mensaje::where('empleado_id', Auth::user()->id)->paginate(50);
            if ($request->general) {
                $mensajes = Mensaje::where('empleado_id', Auth::user()->id)->paginate(50);
            } elseif ($request->estado) {
                $mensajes = Mensaje::where('empleado_id', Auth::user()->id)->where('estado', 0)->paginate(50);
            } elseif ($request->difundido) {
                $mensajes = Mensaje::where('empleado_id', Auth::user()->id)->where('estado', 3)->paginate(50);
            } elseif ($request->titulo || $request->carrera) {
                $mensajes = Mensaje::filtro($titulo, $carrera)->with('carreras')->where('empleado_id', Auth::user()->id)->paginate(50);
            }
        } elseif (Auth::user()->rol == 'Revisor') {
            $mensajes = Mensaje::whereHas('empleado', function (Builder $query) {
                $query->where('quien_revisa', Auth::user()->puesto)->orwhere('empleado_id', Auth::user()->id);
            })->paginate(50);
            if ($request->general) {
                $mensajes = Mensaje::whereHas('empleado', function (Builder $query) {
                    $query->where('quien_revisa', Auth::user()->puesto)->orwhere('empleado_id', Auth::user()->id);
                })->paginate(50);
            } elseif ($request->estado) {
                $mensajes = Mensaje::whereHas('empleado', function (Builder $query) {
                    $query->where('quien_revisa', Auth::user()->puesto);
                })->where('estado', 0)->orwhere('empleado_id', Auth::user()->id)->paginate(50);
            } elseif ($request->difundido) {
                $mensajes = Mensaje::whereHas('empleado', function (Builder $query) {
                    $query->where('quien_revisa', Auth::user()->puesto);
                })->where('estado', 3)->paginate(50);
            } elseif ($request->titulo  || $request->carrera) {
                $mensajes = Mensaje::filtro($titulo, $carrera)->whereHas('empleado', function (Builder $query) {
                    $query->where('quien_revisa', Auth::user()->puesto);
                })->paginate(50);
            }
        } elseif (Auth::user()->rol == 'Difusor') {
            $mensajes = Mensaje::where('estado', 1)->orwhere('estado', 3)->orwhere('empleado_id', Auth::user()->id)->paginate(50);

            if ($request->general) {
                $mensajes = Mensaje::where('estado', 1)->orwhere('estado', 3)->orwhere('empleado_id', Auth::user()->id)->paginate(50);
            } elseif ($request->estado) {
                $mensajes = Mensaje::where('estado', 1)->orwhere('empleado_id', Auth::user()->id)->paginate(50);
            } elseif ($request->difundido) {
                $mensajes = Mensaje::where('estado', 3)->paginate(50);
            } elseif ($request->titulo || $request->carrera) {
                $mensajes = Mensaje::filtro($titulo, $carrera)->with('carreras')->paginate(50);
            }
        }
        return view('mensaje.mensaje-list', compact('mensajes', 'carreras'));
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
        //Si el mensaje es para general.
        if (isset($_POST["general"])) {
            request()->validate([
                'titulo' => 'required',
                'descripcion' => 'required',
                'file-1' => 'required| dimensions:max_width=1500,max_height=1280',
                'file-2' => 'required| mimetypes:application/pdf',
            ]);
        } elseif (isset($_POST["servicio"]) or isset($_POST["residencia"])) { //Si es para residencia o servicio
            request()->validate([
                'titulo' => 'required',
                'descripcion' => 'required',
                'file-1' => 'required| dimensions:max_width=1500,max_height=1280',
                'file-2' => 'required| mimetypes:application/pdf',
                'car' => 'required',
            ]);
        } else { //si no se selecciona general
            request()->validate([
                'titulo' => 'required',
                'descripcion' => 'required',
                'file-1' => 'required| dimensions:max_width=1500,max_height=1280',
                'file-2' => 'required| mimetypes:application/pdf',
                'car' => 'required',
                'sem' => 'required',
            ]);
        }

        $datos = $request->all();
        $mensaje = new mensaje();

        if ($request->hasFile('file-1')) {
            $img = $datos['file-1']->store('public/imagenes_mensajes');
            $url = Storage::url($img);
            $mensaje->imagen = $url;
        }
        if ($request->hasFile('file-2')) {
            $img = $datos['file-2']->store('public/documentos_mensajes');
            $urlDoc = Storage::url($img);
            $mensaje->documento = $urlDoc;
        }

        $mensaje->titulo = $datos['titulo'];
        $mensaje->descripcion = $datos['descripcion'];
        //Estados... 0-Pendiente, 1-Aceptado, 2-Rechazado
        $mensaje->estado = 0;
        $mensaje->empleado_id = Auth::user()->id;

        //0 - Mensaje genreal./ 2- Mensaje para residencia de x carrera 
        //1 - Mensaje para servicio x carrera/3- Mensaje para resi y serv x carrera
        //4 - mensaje una carrera un semestre
        $segmentacion = 5;
        $mensaje->otros = 4;
        //0 - Todos / 1 - Residencia / 2 - Servicio_social / 3 Servicio y Residencia
        if (isset($_POST["servicio"]) and isset($_POST["residencia"])) {
            //return 'servicio y residencia';
            $mensaje->otros = 3;
            $segmentacion = 3;
        } elseif (isset($_POST["servicio"])) {
            //return 'solo servicio';
            $mensaje->otros = 1;
            $segmentacion = 2;
        } elseif (isset($_POST["residencia"])) {
            //return 'solo residencia';
            $mensaje->otros = 2;
            $segmentacion = 1;
        } elseif (isset($_POST["general"])) {
            //return 'todos';
            $mensaje->otros = 0;
            $segmentacion = 0;
        }

        $mensaje->save();

        $semestres = Semestre::all();
        $carreras = Carrera::all();
        if ($segmentacion == 0) {

            for ($i = 0; $i < sizeof($carreras); $i++) {

                $mensaje->carreras()->attach($carreras[$i]->id);
            }

            for ($i = 0; $i < sizeof($semestres); $i++) {

                $mensaje->semestres()->attach($semestres[$i]->id);
            }
        } elseif ($segmentacion == 5) {
            if ($request->sem[0] == 'on') {
                for ($i = 0; $i < sizeof($datos['car']); $i++) {

                    $mensaje->carreras()->attach(($datos['car'])[$i]);
                }
                for ($i = 0; $i < sizeof($semestres); $i++) {

                    $mensaje->semestres()->attach($semestres[$i]->id);
                }
            } else {
                for ($i = 0; $i < sizeof($datos['car']); $i++) {

                    $mensaje->carreras()->attach(($datos['car'])[$i]);
                }
                for ($i = 0; $i < sizeof($datos['sem']); $i++) {

                    $mensaje->semestres()->attach($datos['sem'][$i]);
                }
            }
        } elseif ($segmentacion == 2 || $segmentacion == 3) {


            for ($i = 0; $i < sizeof($datos['car']); $i++) {
                $mensaje->carreras()->attach(($datos['car'])[$i]);
            }
            $mensaje->semestres()->attach([7, 8, 9]);
        } elseif ($segmentacion == 1) {

            for ($i = 0; $i < sizeof($datos['car']); $i++) {
                $mensaje->carreras()->attach(($datos['car'])[$i]);
            }
            $mensaje->semestres()->attach(9);
        }
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
        $mensaje = Mensaje::with('carreras', 'semestres')->get()->find($id);
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
        $datos = $request->all();
        $mensaje = Mensaje::with('carreras', 'semestres', 'empleado')->get()->find($id);
        //return  $mensaje;
        if ($mensaje->empleado->id == Auth::user()->id || Auth::user()->rol == "Difusor") {
            //Funcion Editar mi mensaje Emisor, Editar mi Mensaje Revisor
            if($request->estadoD){
                if (event(new MensajeEvent($mensaje))) {
                    $mensaje->estado = $request->estadoD;
                    $mensaje->fecha_publicacion = Carbon::now();
                    $mensaje->save();
                    return 'Mensaje difundido';
                }
            }
            $this->actMensaje($request, $id);
            
        } elseif (Auth::user()->rol == 'Revisor') {
            if ($request->estado == 'Aceptar')
                $mensaje->estado = 1;
            elseif ($request->estado == 'Rechazar')
                $mensaje->estado = 2;
            $mensaje->save();
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
        if (Mensaje::destroy($id)) {
            return redirect()->back()->with('message', 'ok');
        }
    }
    public function panelDifusor()
    {
        Mensaje::whereHas('empleado', function (Builder $query) {
            $query->where('quien_revisa', Auth::user()->puesto);
        })->paginate(50);
        $carreras = Carrera::all();
        $totalMensajes = Mensaje::where('estado', '=', 3)->count();
        $totalAlumnos = Alumno::all()->count();
        $mensajesByCarrera = array();
        $mensaje = Mensaje::with('carreras')->where('estado', 3)->get();
        // return $mensaje;

        // for($i = 0; $i<sizeof($carreras); $i++){
        //     $total = DB::select('SELECT * FROM carrera_mensaje WHERE carrera_id='.($i+1));
        //     $mensajesByCarrera[$i]=sizeof($total);
        // }
        for ($i = 0; $i < sizeof($carreras); $i++) {
            $total = Mensaje::whereHas('carreras', function (Builder $query) use ($carreras, $i) {
                $query->where('carrera_id', $carreras[$i]->id);
            })->where('estado', 3)->count();
            if ($total > 0) {
                array_push($mensajesByCarrera, [
                    'carrera' => $carreras[$i]->name,
                    'total' => $total
                ]);
            } else {
                array_push($mensajesByCarrera, [
                    'carrera' => $carreras[$i]->name,
                    'total' => 0
                ]);
            }
        }
        // return $mensajesByCarrera;
        $valores = ['carreras' => $carreras, 'mensajesTotales' => $totalMensajes, 'alumnosTotales' => $totalAlumnos, 'MensajesByCarrera' => $mensajesByCarrera];
        return response()->json($valores);
    }

    function actMensaje($request, $id)
    {
        $datos = $request->all();
        $mensaje = Mensaje::with('carreras', 'semestres', 'empleado')->get()->find($id);
        if ($request->estado) { //Verificamos si existe la variable estado. If para aceptar el mensaje como Revisor
            if ($request->estado == 'Aceptar') {
                $mensaje->estado = 1;
            } elseif ($request->estado == 'Rechazar') {
                $mensaje->estado = 2;
            }
            $mensaje->save();
            return redirect('/mensajes');
        }else { //Caso contrario solo hacemos modificaciones a los datos(titulo, etc)
            //For para eliminar datos de la tabla intermedia
            for ($i = 0; $i < sizeof($mensaje->carreras); $i++) {
                $mensaje->carreras()->detach($mensaje->carreras[$i]->id);
            }
            for ($i = 0; $i < sizeof($mensaje->semestres); $i++) {
                $mensaje->semestres()->detach($mensaje->semestres[$i]->id);
            }
            $segmentacion = 5;
            $mensaje->titulo = $request->titulo;
            $mensaje->descripcion = $request->descripcion;
            if ($request->hasFile('file-1')) {
                $url = str_replace('storage', 'public', $mensaje->imagen);
                Storage::delete($url);
                $img = $request->file('file-1')->store('public/imagenes_mensajes');
                $url = Storage::url($img);
                $mensaje->imagen = $url;
            }
            if ($request->hasFile('file-2')) {
                $url = str_replace('storage', 'public', $mensaje->imagen);
                Storage::delete($url);
                $img = $datos['file-2']->store('public/documentos_mensajes');
                $urlDoc = Storage::url($img);
                $mensaje->documento = $urlDoc;
            }
            $mensaje->otros = 4;
            if (isset($_POST["servicio"]) and isset($_POST["residencia"])) {

                $mensaje->otros = 3;
                $segmentacion = 3;
            } elseif (isset($_POST["servicio"])) {
                //return 'solo servicio';

                $mensaje->otros = 1;
                $segmentacion = 2;
            } elseif (isset($_POST["residencia"])) {
                //return 'solo residencia';

                $mensaje->otros = 2;
                $segmentacion = 1;
            } elseif (isset($_POST["general"])) {
                //return 'todos';

                $mensaje->otros = 0;
                $segmentacion = 0;
            }

            $mensaje->save();

            $semestres = Semestre::all();
            $carreras = Carrera::all();
            if ($segmentacion == 0) {

                for ($i = 0; $i < sizeof($carreras); $i++) {

                    $mensaje->carreras()->attach($carreras[$i]->id);
                }

                for ($i = 0; $i < sizeof($semestres); $i++) {

                    $mensaje->semestres()->attach($semestres[$i]->id);
                }
            } elseif ($segmentacion == 5) {
                if ($request->sem[0] == 'on') {
                    for ($i = 0; $i < sizeof($datos['car']); $i++) {

                        $mensaje->carreras()->attach(($datos['car'])[$i]);
                    }
                    for ($i = 0; $i < sizeof($semestres); $i++) {

                        $mensaje->semestres()->attach($semestres[$i]->id);
                    }
                } else {
                    for ($i = 0; $i < sizeof($datos['car']); $i++) {

                        $mensaje->carreras()->attach(($datos['car'])[$i]);
                    }
                    for ($i = 0; $i < sizeof($datos['sem']); $i++) {

                        $mensaje->semestres()->attach($datos['sem'][$i]);
                    }
                }
            } elseif ($segmentacion == 2 || $segmentacion == 3) {


                for ($i = 0; $i < sizeof($datos['car']); $i++) {
                    $mensaje->carreras()->attach(($datos['car'])[$i]);
                }
                $mensaje->semestres()->attach([7, 8, 9]);
            } elseif ($segmentacion == 1) {

                for ($i = 0; $i < sizeof($datos['car']); $i++) {
                    $mensaje->carreras()->attach(($datos['car'])[$i]);
                }
                $mensaje->semestres()->attach(9);
            }
        }
    }

    public function panelEmisor()
    {

        $Totalmensaje = null;
        $mensajesAceptados = null;
        $mensajesPendientes = null;
        $carreras = Carrera::all();
        $mensajesByCarrera = array();
        if (Auth::user()->rol == "Emisor") {
            $Totalmensaje = Mensaje::where('empleado_id', Auth::user()->id)->count();
            $mensajesAceptados = Mensaje::where('empleado_id', Auth::user()->id)->where('estado', 1)->count();
            $mensajesPendientes = Mensaje::where('empleado_id', Auth::user()->id)->where('estado', 0)->count();
            for ($i = 0; $i < sizeof($carreras); $i++) {
                $sql = Mensaje::whereHas('carreras', function (Builder $query) use ($carreras, $i) {
                    $query->where('carrera_id', $carreras[$i]->id);
                })->where('empleado_id', Auth::user()->id)->count();
                if ($sql >= 1) {
                    array_push($mensajesByCarrera, [
                        'carrera' => $carreras[$i]->name,
                        'total' => $sql
                    ]);
                }
            }
        } elseif (Auth::user()->rol == "Revisor") {

            $Totalmensaje = Mensaje::wherehas('empleado', function (Builder $query) {
                $query->where('quien_revisa', Auth::user()->puesto);
            })->count();

            $mensajesAceptados = Mensaje::wherehas('empleado', function (Builder $query) {
                $query->where('quien_revisa', Auth::user()->puesto);
            })->where('estado', 1)->count();
            $mensajesPendientes = Mensaje::wherehas('empleado', function (Builder $query) {
                $query->where('quien_revisa', Auth::user()->puesto);
            })->where('estado', 0)->count();
            for ($i = 0; $i < sizeof($carreras); $i++) {
                $sql = Mensaje::whereHas('carreras', function (Builder $query) use ($carreras, $i) {
                    $query->where('carrera_id', $carreras[$i]->id);
                })->wherehas('empleado', function (Builder $query) {
                    $query->where('quien_revisa', Auth::user()->puesto);
                })->count();
                if ($sql >= 1) {
                    array_push($mensajesByCarrera, [
                        'carrera' => $carreras[$i]->name,
                        'total' => $sql
                    ]);
                }
            }
        }
        $valores = [
            'Totalmensaje' => $Totalmensaje,
            'mensajesAceptados' => $mensajesAceptados,
            'mensajesPendientes' => $mensajesPendientes,
            'mensajesCarreras' => $mensajesByCarrera,
        ];
        return $valores;
    }
}
