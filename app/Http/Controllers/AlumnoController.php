<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Mail\TestMail;
use App\Models\Empleado;
use App\Models\Semestre;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        ///
        $semestres = Semestre::all();
        $mensajes = "";
        if ($request->mensajes_nuevos == true) {
            $mensajes = Auth::user()->unreadNotifications;
            return view('alumno.mensajes-nuevos', compact('mensajes', 'semestres'));
        } else {
            if ($request->all) {
                $mensajes = DB::select('SELECT mensajes.id,titulo,fecha_publicacion FROM mensajes INNER JOIN carrera_mensaje INNER JOIN mensaje_semestre WHERE carrera_mensaje.mensaje_id=mensajes.id AND carrera_mensaje.carrera_id=' . Auth::user()->carrera_id . ' AND mensaje_semestre.mensaje_id=mensajes.id AND mensaje_semestre.semestre_id=' . Auth::user()->semestre_id . ' AND mensajes.estado=3');
            } elseif ($request->residencia) {
                $mensajes = DB::select('SELECT mensajes.id,titulo,fecha_publicacion FROM mensajes INNER JOIN carrera_mensaje INNER JOIN mensaje_semestre INNER JOIN alumnos WHERE carrera_mensaje.mensaje_id=mensajes.id AND carrera_mensaje.carrera_id= ' . Auth::user()->carrera_id . ' AND mensaje_semestre.mensaje_id=mensajes.id AND mensaje_semestre.semestre_id=' . Auth::user()->semestre_id . ' AND mensajes.estado=3 AND (mensajes.otros=1 or mensajes.otros=3) AND (alumnos.segmentacion=2 or alumnos.segmentacion=3)');
            } elseif ($request->servicioSocial) {
                $mensajes = DB::select('SELECT mensajes.id,titulo,fecha_publicacion FROM mensajes INNER JOIN carrera_mensaje INNER JOIN mensaje_semestre INNER JOIN alumnos WHERE carrera_mensaje.mensaje_id=mensajes.id AND carrera_mensaje.carrera_id= ' . Auth::user()->carrera_id . ' AND mensaje_semestre.mensaje_id=mensajes.id AND mensaje_semestre.semestre_id=' . Auth::user()->semestre_id . ' AND mensajes.estado=3 AND (mensajes.otros=2 or mensajes.otros=3) AND (alumnos.segmentacion=3 or alumnos.segmentacion=1)');
            } else {
                $mensajes = DB::select('SELECT mensajes.id,titulo,fecha_publicacion FROM mensajes INNER JOIN carrera_mensaje INNER JOIN mensaje_semestre WHERE carrera_mensaje.mensaje_id=mensajes.id AND carrera_mensaje.carrera_id=' . Auth::user()->carrera_id . ' AND mensaje_semestre.mensaje_id=mensajes.id AND mensaje_semestre.semestre_id=' . Auth::user()->semestre_id . ' AND mensajes.estado=3 AND (mensajes.otros = 0 or mensajes.otros=4)');
            }
            return view('alumno.mensajes-viejos', compact('mensajes', 'semestres'));
        }
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
        //Crear usuario alumno, desde la vista del informatico.

        $codigo = Str::random(25); //generamos un codigo de confirmacion aleatorio.
        $informacion = $request->all();
        request()->validate([
            'numero_control' => 'required',
            'name' => 'required',
            'a_paterno' => 'required',
            'a_materno' => 'required',
            'carrera' => 'required',
            'semestre' => 'required',
            'email' => 'required|email',
            'password' => ['required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
            'password_confirm' => 'required',
        ]);
        // checamos si el número de control ya existe en la base
        $users = Alumno::where('id', $informacion['numero_control'])->get();

        // checamos si el correol ya existe en la base
        $correo = Alumno::where('correo', $informacion['email'])->get();
        $correo2 = Empleado::where('correo', $informacion['email'])->get();
        // validamos si encontramos un registro
        if (sizeof($users) > 0) {
            return redirect()->back()->with('message', "¡El número de control ya se encuentra registrado!")->withInput();
        } else {
            //validamos si encontramos un correo existente
            if (sizeof($correo) > 0 or sizeof($correo2) > 0) {
                return redirect()->back()->with('message', "¡Este correo ya esta en uso, por favor utilice otro!")->withInput();
            } else {
                //validamos que las contraseñas coincidan
                if ($informacion['password'] != $informacion['password_confirm']) {
                    return redirect()->back()->with('message', 'Las contraseñas no coinciden')->withInput();
                }
                //si son iguales, procedemos a guardar el registro en la base
                elseif ($informacion['password'] == $informacion['password_confirm']) {
                    $alumno = new Alumno();
                    // unset($informacion['rol']);
                    // unset($informacion['puesto']);
                    // unset($informacion['quien_envia']);
                    // unset($informacion['password_confirm']);
                    //$contents = Storage::get('file.jpg');
                    $alumno->id = $informacion['numero_control'];
                    $alumno->nombre = $informacion['name'];
                    $alumno->foto_perfil = "static/imagenes/ittg_escudo.png";
                    $alumno->apellido_paterno = $informacion['a_paterno'];
                    $alumno->apellido_materno = $informacion['a_materno'];
                    $alumno->carrera_id = $informacion['carrera'];
                    $alumno->semestre_id = $informacion['semestre'];
                    $alumno->correo = $informacion['email'];
                    $alumno->contraseña = Hash::make($informacion['password']);
                    $alumno->confirmation_code = $codigo;
                    //guardamos el nombre y el codigo para usarlos en la confirmacion de correo.
                    $data = [
                        'name' => $informacion['name'],
                        'confirmation_code' => $codigo
                    ];
                    //pasamos los datos al archivo TestMail
                    Mail::to($informacion['email'])->send(new TestMail($data));
                    $alumno->save();
                    return redirect()->back()->with('message', 'Revise su correo para terminar el registro');
                }
            }
        }
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

        $alumno = Alumno::find($id);

        if ($request->hasFile('file-1')) {
            $url = str_replace('storage', 'public', $alumno->foto_perfil);
            Storage::delete($url);
            $img = $request->file('file-1')->store('public/usuarios_foto_perfil');
            $url = Storage::url($img);
            $alumno->foto_perfil = $url;
        }
        if($request->newPass){
            if ($request->newPass != null &&  Hash::check($request->PassActual, Auth::user()->contraseña)) {
                $alumno->contraseña =  Hash::make($request->newPass);
            } else {
                return "¡Contraseña actual erronea!";
            }
        }

        $alumno->nombre = $request->nombre;
        $alumno->apellido_paterno = $request->a_paterno;
        $alumno->apellido_materno = $request->a_materno;
        $alumno->semestre_id = $request->semestre;
        // return $request;
        $alumno->save();
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
    }

    public function segmentacion(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        $alumno->segmentacion = $request->estado;
        $alumno->save();
    }

    public function verMensaje(Request $request, $id)
    {
        $mensaje = Mensaje::with('empleado')->get()->find($id);
        if ($request->id_notification) {
            Auth::user()->unreadNotifications
                ->when(
                    $request->id_notification,
                    function ($query) use ($request) {
                        return $query->where('id', $request->id_notification);
                    }
                )->markAsRead();
        }
        return $mensaje;
    }
}
