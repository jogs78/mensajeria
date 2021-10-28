@extends('dashboard')
@section('mensaje.mensaje-show')

    <section class="mensage-show">
        <style>
            .dashboard-EmisorRevisror, .dashboard-difusor{
                display: none;
            }
        </style>
        <div class="mensage-show__container">
            <div class="img"><img src="{{ $mensaje->imagen }}" alt=""></div>
            <div class="message-show__body">
                <label for="">Título: </label>
                <label class="lbl" for="">{{ $mensaje->titulo }}</label>
                <label for="">Descripción:</label>
                <label class="lbl" for="">{{ $mensaje->descripcion }}</label>
                <label for="">Segmento: </label>
                <label class="lbl" for="">Carrera: {{ $mensaje->carrera }}</label>
                <label class="lbl" for="">Semestre: {{ $mensaje->semestre }}</label>
            </div>
            @can('aceptarRechazar', $mensaje)
                <form method="POST" action="/mensajes/{{ $mensaje->id }}" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <input type="submit" name="estado" class="show__form_btn fas fa-check" value="Aceptar"> 
                </form>
                <form method="POST" action="/mensajes/{{ $mensaje->id }}" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <input type="submit" name="estado" class="show__form_btn fas fa-times" value="Rechazar"> 
                </form>
            @endcan
        </div>
    </section>
@endsection
