<?php

namespace App\Policies;

use App\Models\Empleado;
use App\Models\Mensaje;

use Illuminate\Auth\Access\HandlesAuthorization;

class MensajePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewMensajes(?Empleado $empleado)
    {
        if ($empleado->rol == "Emisor") {
            return true;
        } elseif ($empleado->rol == "Difusor" || $empleado->rol == "Revisor") {
            return true;
        } elseif ($empleado->rol == "Informatico") {
            return false;
        }
    }

    public function create(Empleado $empleado)
    {
        if ($empleado->rol == "Emisor" || $empleado->rol == "Difusor" || $empleado->rol == "Revisor") {
            return true;
        } elseif ($empleado->rol == "Informatico") {
            return false;
        }
    }
    public function edit(Empleado $empleado, Mensaje $mensaje)
    {
        if ($mensaje->empleado_id == $empleado->id & $mensaje->estado == 1 || $empleado->rol == "Difusor") {
            return true;
        }
    }
    public function show(Empleado $empleado, Mensaje $mensaje)
    {
        if ($mensaje->empleado_id == $empleado->id) {
            return true;
        } elseif ($empleado->rol == "Revisor" || $empleado->rol == "Difusor") {
            return true;
        }
    }
    public function delete(Empleado $empleado, Mensaje $mensaje)
    {
        if ($mensaje->empleado_id == $empleado->id & $mensaje->estado === 0) {
            return true;
        }
    }
    public function aceptarRechazar(Empleado $empleado, Mensaje $mensaje)
    {
        if ($empleado->rol == "Revisor" & $mensaje->estado == 0)
            return true;
    }
    public function difundirMensaje(Empleado $empleado, Mensaje $mensaje)
    {
        if ($empleado->rol == "Difusor" && $mensaje->estado == 1)
            return true;
    }
    public function estadisticas(Empleado $empleado, Mensaje $mensaje){
        if ($empleado->rol == "Difusor" && $mensaje->estado == 3)
        return true;
    }
}
