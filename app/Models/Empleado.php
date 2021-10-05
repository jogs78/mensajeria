<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'pass', 'rol', 'puesto', 'quien_revisa', 'mensaje_id']; 
    use HasFactory;
}
//