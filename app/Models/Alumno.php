<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumno extends Authenticatable
{
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno','correo', 'contraseña', 'foto_perfil', 'carrera_id', 'semestre_id']; 
    
//relacion 1:N inverso
    public function semestre(){
        return $this -> belongsTo('App\Models\Semestre');
    }
    public function carrera(){
        return $this -> belongsTo('App\Models\Carrera');
    }
    use HasFactory;
}
