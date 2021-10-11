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
}
