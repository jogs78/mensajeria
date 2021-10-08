@extends('dashboard')
@section('mensaje.mensaje-show')

    <section class="mensage-show">
        <label  for="">Título: </label>
        <label class="lbl" for="">{{$mensaje->titulo}}</label>
        <label for="">Descripción:</label>
        <label class="lbl" for="">{{$mensaje->descripcion}}</label>
        <label  for="">Segmento: </label>
        <label class="lbl" for="">Carrera: {{$mensaje->carrera}}</label>
        <label class="lbl" for="">Semestre: {{$mensaje->semestre}}</label>
    </section>
@endsection