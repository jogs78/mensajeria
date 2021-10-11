<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
  
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno','correo', 'contraseña', 'foto_perfil', 'carrera_id', 'semestre_id']; 
    use HasFactory;
//relacion 1:N inverso
    public function semestre(){
        return $this -> belongsTo('App\Models\Semestre');
    }
    public function carrera(){
        return $this -> belongsTo('App\Models\Carrera');
    }
}
