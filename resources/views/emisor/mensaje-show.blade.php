@extends('dashboard')
@section('emisor.mensaje-show')

    <label for="">Titulo: {{$mensaje->titulo}}</label><br>
    <label for="">Descripción: {{$mensaje->descripcion}}</label><br>
    <label for="">Dirigido a: </label><br>
    <label for="">Carrera: {{$mensaje->carrera}}</label><br>
    <label for="">Semestre: {{$mensaje->semestre}}</label>
@endsection