@extends('alumno.alumno-mensajes')
@section('mensajes-nuevos')
    <section class="lista-mensajes">
        <dl>
            @forelse ($mensajes as $mensaje)
                <div class="contenedor">
                    <dt>
                        <p style="text-align: justify">Título: {{ $mensaje->data['titulo'] }}</p>
                    </dt>
                    <dd><b>Fecha de publicacion:</b> {{ \Carbon\Carbon::parse($mensaje->created_at)->format('d/m/Y') }}
                    </dd>
                    <dd title="ver mas" class="ver-mas" data-mensaje="{{ $mensaje->data['mensaje_id'] }}"
                        data-notificacion="{{ $mensaje->id }}"><b>ver más </b><i class="fas fa-plus-circle"></i></dd>
                </div>
            @empty
                <style>
  

}
                </style>
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
                    <label id="documento" for="">Descargar pdf</label>
                </div>
            </div>
        </div>
    </section>
@endsection
