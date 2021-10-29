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

    public function scopeBuscarpor($query, $tipo, $buscar){
        if(($tipo) && ($buscar)){
            // if($tipo=='apellido_paterno'){
            //     $tipo1='apellido_paterno';
            //     $tipo2='apellido_materno';
            //     return $query->where($tipo2, 'like','%'.$buscar.'%')->orWhere($tipo1, 'like','%'.$buscar.'%');
            // }
            return $query->where($tipo, 'like','%'.$buscar.'%');
        }  
    }

    public function scopeFiltro($query, $car){
        $tipo_car='carera_id';
        if(($car) ){
            return $query->where('carrera_id', '==' .$car);
        }
    }

    use HasFactory;
}
