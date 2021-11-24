<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Empleado extends Authenticatable
{
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token', 'correo'];
    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'password', 'rol', 'puesto', 'quien_revisa', 'mensaje_id']; 
    use HasFactory;

    //relacion 1:N directa
    public function mensajes(){
        return $this -> hasMany('App\Models\Mensaje');
    }
    public function scopeFiltroEmpleado($query, $tipoEmpleado, $buscarEmpleado){
        
        if($tipoEmpleado != "quien_revisa" && $buscarEmpleado){
            
            return $query->where($tipoEmpleado, 'like','%'.$buscarEmpleado.'%');
        }  
        if(($tipoEmpleado) == "quien_revisa" && ($buscarEmpleado)){
            return $query->where($tipoEmpleado,$buscarEmpleado);
        }
    }
}
