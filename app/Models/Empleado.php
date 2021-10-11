<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class Empleado extends Model implements AuthenticatableContract
{
    use Authenticatable;
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'pass', 'rol', 'puesto', 'quien_revisa', 'mensaje_id']; 
    use HasFactory;

    //relacion 1:N directa
    public function mensajes(){
        return $this -> hasMany('App\Models\Mensaje');
    }
}
