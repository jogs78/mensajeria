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

    public function viewMensajes(?Empleado $empleado){
        if($empleado->rol == "Emisor"){
            return true;
        }elseif($empleado->rol == "Difusor" || $empleado->rol == "Revisor"){
            return true;
        }elseif($empleado->rol == "Informatico"){
            return false;
        }
    }
    
    public function create(Empleado $empleado){
        if($empleado->rol == "Emisor" || $empleado->rol == "Difusor" || $empleado->rol == "Revisor"){
            return true;
        }elseif($empleado->rol == "Informatico"){
            return false;
        }
    }
    public function aceptarRechazar(Empleado $empleado, Mensaje $mensaje){
        if($empleado->rol == "Revisor")
            return true;
    }

    
}
