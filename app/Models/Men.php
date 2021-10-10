<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Men extends Model
{
    public $timestamps = false;
    protected $fillable = ['estado', 'semestre', 'carrera', 'general'];
    use HasFactory;
}
