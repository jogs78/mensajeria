<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mensaje extends Model
{
    public $timestamps = false;
    protected $fillable = ['titulo', 'descripcion', 'estado', 'imagen', 'empleado_id']; 
    use HasFactory;


    //Relacion muchos a muchos
    public function carreras(){
        return $this->belongsToMany('App\Models\Carrera');
    }
    public function semestres(){
        return $this->belongsToMany('App\Models\Semestre');
    }
    //relacion 1:N indirecta
    public function empleado(){
        return $this -> belongsTo('App\Models\Empleado');
    }
}
