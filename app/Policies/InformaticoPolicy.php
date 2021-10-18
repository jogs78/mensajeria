<?php

namespace App\Policies;

use App\Models\Empleado;
use App\Models\Alumno;
use Illuminate\Auth\Access\HandlesAuthorization;

class InformaticoPolicy
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
    public function view(Empleado $empleado){
        if($empleado -> rol == "Informático"){
            return true;
        }
    }
    public function create(Empleado $empleado){
        return $empleado -> rol == "Informático";
    }
    public function edit(Empleado $empleado){
        return $empleado -> rol == "Informático";
    }
    public function update(Empleado $empleado, ?Empleado $newEmpleado, ?Alumno $newAlumno){
        return $empleado -> rol == "Informático";
    }

}
