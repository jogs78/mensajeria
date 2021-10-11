<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;
    //relacion 1:N 
    public function alumnos(){
        return $this -> hasMany('App\Models\Alumno');
    }
    public function mensajes(){
        return $this->belongsToMany('App\Models\Mensaje');
    }
}
