<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Mensaje;
use Illuminate\Support\Facades\DB;


class Alumno extends Authenticatable
{
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno','correo', 'contraseña', 'foto_perfil', 'carrera_id', 'semestre_id', 'confirmation_code']; 
    
//relacion 1:N inverso
    public function semestre(){
        return $this -> belongsTo('App\Models\Semestre');
    }
    public function carrera(){
        return $this -> belongsTo('App\Models\Carrera');
    }

    public function scopeBuscarpor($query, $tipo, $buscar){
        if(($tipo) && ($buscar)){
            return $query->where($tipo, 'like','%'.$buscar.'%');
        }  
    }

    public function scopeFiltroCarreraSemestre($query, $tipo_carrera,$tipo_semestre){

        if($tipo_carrera && $tipo_semestre){
            
            return $query->where(function($query) use ($tipo_semestre, $tipo_carrera){
                $query->where('carrera_id',$tipo_carrera)
                      ->where('semestre_id',$tipo_semestre);
            });    
        }
        if($tipo_carrera){
            return $query->where('carrera_id',$tipo_carrera);
        }
        if($tipo_semestre){
            return $query->where('semestre_id',$tipo_semestre);
        }
        
    }

    public static function getMensaje(Mensaje $mensaje){
        $users = array();
        $alumno = Alumno::all();
        for($i = 0; $i < sizeof($mensaje->carreras); $i++){
            for($j = 0; $j < sizeof($mensaje->semestres); $j++){
                $con = Alumno::where('carrera_id', $mensaje->carreras[$i]->id)->where('semestre_id', $mensaje->semestres[$j]->id)->orderBy('nombre')->get();
                if(sizeof($con) > 0 ){
                    for($k = 0; $k<sizeof($con); $k ++){
                    array_push($users, $con[$k]);
                    }
                }else unset($con);
            } 
        };
        return $u = (object) $users;
    }

    use Notifiable;
    use HasFactory;
    public $timestamps = false;

}
