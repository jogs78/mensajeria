<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'numero_control';
    protected $fillable = ['numero_control', 'nombre', 'apellido_paterno', 'apellido_materno', 'carrera', 'semestre', 'correo', 'contraseña', 'foto_perfil']; 
    use HasFactory;
}
