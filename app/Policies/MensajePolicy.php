<?php

namespace App\Policies;

use App\Models\Alumno;
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

    public function viewMensajes(Empleado $empleado){
        if($empleado->rol == "Emisor" || $empleado->rol == "Difusor" & $mensaje->empleado_id == $empleado-id){
            return true;
        }elseif($empleado->rol == "Difusor"){
            return true;
        }elseif($empleado->rol == "Informatico"){
            return false;
        }
    }
}
