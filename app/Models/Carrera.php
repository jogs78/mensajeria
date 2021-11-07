<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'logo']; 
    use HasFactory;

    

    //relacion muchos a muchos
    public function mensajes(){
        return $this->belongsToMany('App\Models\Mensaje');
    }
    public function alumnos(){
        return $this->belongsToMany('App\Models\Alumno');
    }
}
