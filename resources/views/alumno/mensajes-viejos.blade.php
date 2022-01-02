@extends('alumno.alumno-mensajes')
@section('mensajes-viejos')
<style>
        .image-title {
            margin: 20px auto;
            font-size: 25px;
            display: block;
            text-align: center;
            position: relative;
            padding: 4px;

        }

        .dashboard-EmisorRevisror,
        .dashboard-difusor {
            display: none;
        }

        #btn1,
        #btn2, #btn3 {
            cursor: pointer;
            width: 100%;
            height: 100%;
            border: none;
            padding: 4px;
            background: transparent;
        }

    </style>
<div class="user-select" style="margin-top:42px">
    <form action="/mensajes-alumnos" style="flex-grow:1; height:40px">
        <button id="btn1" name="all" value="0">Mensajes en general</button>
    </form>
    
    
    {{-- 0 n inguno 3 ambos 1 servicio 2 residencia --}}
        {{-- @if (Auth::user()->segmentacion == )
        <form action="/mensajes" style="flex-grow:1; height:40px">
            <button id="btn1" name="estado" value="1">Mensajes de residencia</button>
        </form>
        @endif --}}
        <form action="/mensajes-alumnos" style="flex-grow:1; height:40px">
            <button id="btn2" name="residencia" value="2">Mensajes de residencia</button>
        </form>
       <form action="/mensajes-alumnos" style="flex-grow:1; height:40px">
        <button id="btn3" name="sericioSocial" value="2">Mensajes de servicio social</button>
    </form>  
</div>
<section class="lista-mensajes">
    <dl>
        @forelse ($mensajes as $mensaje)
            <div class="contenedor">
                <dt>
                    <p style="text-align: justify">Título: {{ $mensaje->titulo }}</p>
                </dt>
                <dd><b>Fecha de publicacion:</b> {{ \Carbon\Carbon::parse($mensaje->fecha_publicacion)->format('d/m/Y') }}</dd>
                <dd title="ver mas" class="ver-mas" data-mensaje="{{ $mensaje->id }}" data-notificacion = ""><b>ver más </b><i
                        class="fas fa-plus-circle"></i></dd>
            </div>
        @empty
        <div class="warning-container">
            <p>Hola <b>{{Auth::user()->nombre." ".Auth::user()->apellido_paterno}}</b>, por el momento no hay mensajes nuevos para ti.</p>

        </div>
        @endforelse
    </dl>
    {{-- aqui se muestra la ventana emergente con la info del mensaje --}}

    <div class="mensaje-container" id="contenedor">
        <div class="mensaje_body">
            <i class="fas fa-times-circle" id="btnClose"></i>
            <figure class="figure image-container" id="imageContainer">
                <img id="image" class="image-zoom" src="" alt="">
            </figure>
            <div class="mensaje-informacion">
                <p id="title">Titulo:</p>
                <p id="description">Descipcion:</p>
                <label id="fechaPublicacion" for=""><small><b>Fecha de publicacion:</b></small></label>
                <label id="emisor" for=""><small><b>Publicado por: aqui el dep al que pertenece el
                            emisor</b></small></label>
                <label id="" for=""></label>
                <a href="" id="documento" target="__BLANK">Descargar PDF</a>
            </div>
        </div>
    </div>
</section>
@endsection