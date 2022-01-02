@extends('alumno.alumno-mensajes')
@section('mensajes-viejos')
<div class="user-select">
    <form action="/mensajes" style="flex-grow:1; height:40px">
        <button id="btn3" name="general" value="all">Ver todos los mensajes</button>
    </form>
    
    
    @if (Auth::user()->rol == "Revisor")
        <form action="/mensajes" style="flex-grow:1; height:40px">
            <button id="btn1" name="estado" value="1">Mensajes por revisar</button>
        </form>
    @else
       <form action="/mensajes" style="flex-grow:1; height:40px">
        <button id="btn1" name="estado" value="1">Mensajes pendientes</button>
    </form>  
    @endif
   
    
    <form action="/mensajes" style="flex-grow:1; height:40px">
        <button id="btn2" name="difundido" value="3">Mensajes difundidos</button>
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