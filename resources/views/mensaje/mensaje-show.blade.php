@extends('dashboard')
@section('mensaje.mensaje-show')
    <style>
        #mensajes {
            border-radius: 5px 5px 0 0;
            box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.281);
            color: rgb(251, 255, 35);
        }

    </style>
    <section class="mensage-show">
        <label for="">Título: </label>
        <label class="lbl" for="">{{ $mensaje->titulo }}</label>
        <label for="">Descripción:</label>
        <label class="lbl" for="">{{ $mensaje->descripcion }}</label>
        <label for="">Segmento: </label>
        <label class="lbl" for="">Carrera: {{ $mensaje->carrera }}</label>
        <label class="lbl" for="">Semestre: {{ $mensaje->semestre }}</label>
    </section>
@endsection
