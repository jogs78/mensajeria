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
                <div class="div">
                    <form method="POST" action="/mensajes/{{ $mensaje->id }}" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <div class="show__form_btn">
                        <i class="fas fa-check"></i>
                        <input type="submit" class="show__form_btn" name="estado"  value="Aceptar" style="border:0 !important"> 

                    </div>
                </form>
                <form method="POST" action="/mensajes/{{ $mensaje->id }}" style="text-align: center">
                    @csrf
                    @method('PUT')
                    <div class="show__form_btn">
                        <i class="fas fa-times"></i>
                        <input type="submit" name="estado" class="show__form_btn" value="Rechazar" style="border:0 !important"> 
                    </div>
                </form>
            </div>
            @endcan
        </div>
    </section>
@endsection
