@extends('dashboard')
@section('mensaje.mensaje-list')
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
            width: 100%;
            height: 100%;
            border: none;
            padding: 4px;
            background: transparent;
        }

    </style>
    <section class="filtro-mensaje">
        @include('mensaje.mensaje-filtro')
    </section>
    <section class="new-messages" id="new-messages">
        @if (session('message') == 'ok')
            <script>
                Swal.fire(
                    'Eliminado!',
                    'Mensaje eliminado con éxito',
                    'success'
                )
            </script>
        @endif
        <a class="new-messages__link" href="/mensajes/create">Redactar mensaje</a>
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
        @if (sizeof($mensajes) == 0)
            <label class="image-title fas fa-exclamation-circle">Sin registros</label>
        @else                
            @foreach ($mensajes as $mensaje)
                <div class="new-messages__container" id="{{ $mensaje->id }}">
                    <div class="new-messages__information">
                        <p style="text-align: justify" class="new-messages__title">Título: {{ $mensaje->titulo }}</p>
                        <p style="text-align: justify" class="new-messages__title">Descripción: {{ $mensaje->descripcion }}</p>
                        @if ($mensaje->estado == 0)
                            <label for="" class="new-messages__status-menssage" style="background: #2f8b8b">Estado: Pendiente</label>
                        @elseif($mensaje->estado==1)
                            <label for="" class="new-messages__status-menssage" style="background: #558B2F"><b>Estado:
                                    Aceptado</b></label>
                        @elseif($mensaje->estado==2)
                            <label for="" class="new-messages__status-menssage" style="background: #B71C1C"><b>Estado:
                                    Rechazado</b></label>
                        @else
                            <label for="" class="new-messages__status-menssage" style="background: #0277BD"><b>Estado:
                                    Publicado</b></label>
                        @endif
                        @if ($mensaje->fecha_publicacion)
                        <label for="" class="new-messages__fecha-publicacion" style="">Fecha de publicación: {{\Carbon\Carbon::parse($mensaje->fecha_publicacion)->format('d/m/Y')}}</label>
                        @endif
                    </div>
                    <div class="new-messages_actions">
                        @can('edit', $mensaje)
                            <div class="new-messages_edit">
                                <a href="/mensajes/{{ $mensaje->id }}/edit" style="color: rgb(255, 255, 255)">
                                    <span class="fas fa-edit update" title="Editar"></span>
                                </a>
                            </div>
                        @endcan
                        @can('show', $mensaje)
                            <div class="new-messages_show">
                                <a href="/mensajes/{{ $mensaje->id }}" style="color: rgb(255, 255, 255)">
                                    <span class="far fa-file-alt" title="Leer"></span>
                                </a>
                            </div>
                        @endcan
                        @can('delete', $mensaje)
                            <div class="new-messages_delete">
                                <form action="/mensajes/{{ $mensaje->id }}" method="POST" class="form_eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <span class="fas fa-trash-alt" title="Eliminar"></span>
                                    </button>
                                </form>
                            </div>
                        @endcan
                        @can('difundirMensaje', $mensaje)
                            <div class="new-messages_delete new-messages_difundir " style="background: #e91e63 !important">
                                <form action="/mensajes/{{ $mensaje->id }}" method="POST" class="form_difundir">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="estado" value="3" id="updateEstado">
                                    <button type="submit">
                                        <span class="fas fa-share" title="Difundir"></span>
                                    </button>
                                </form>
                            </div>
                        @endcan
                        @can('estadisticas', $mensaje)
                            <div class="new-messages_show">
                                <span style="color: rgb(255, 255, 255)" class="far fa-chart-bar estadistica"
                                    title="Estadisticas" data-id="{{ $mensaje->id }}"></span>
                            </div>
                        @endcan
                    </div>
                </div>
                </div>
            @endforeach
            <label for="" class="new-messages__status-menssage" style="background: #B71C1C"><b>Mis mensajes</b></label>
            @foreach ($mensaje1 as $mensaje)
            <div class="new-messages__container" id="{{ $mensaje->id }}">
                <div class="new-messages__information">
                    <p style="text-align: justify" class="new-messages__title">Título: {{ $mensaje->titulo }}</p>
                    <p style="text-align: justify" class="new-messages__title">Descripción: {{ $mensaje->descripcion }}</p>
                    @if ($mensaje->estado == 0)
                        <label for="" class="new-messages__status-menssage" style="background: #2f8b8b">Estado: Pendiente</label>
                    @elseif($mensaje->estado==1)
                        <label for="" class="new-messages__status-menssage" style="background: #558B2F"><b>Estado:
                                Aceptado</b></label>
                    @elseif($mensaje->estado==2)
                        <label for="" class="new-messages__status-menssage" style="background: #B71C1C"><b>Estado:
                                Rechazado</b></label>
                    @else
                        <label for="" class="new-messages__status-menssage" style="background: #0277BD"><b>Estado:
                                Publicado</b></label>
                    @endif
                    @if ($mensaje->fecha_publicacion)
                    <label for="" class="new-messages__fecha-publicacion" style="">Fecha de publicación: {{\Carbon\Carbon::parse($mensaje->fecha_publicacion)->format('d/m/Y')}}</label>
                    @endif
                </div>
                <div class="new-messages_actions">
                    @can('edit', $mensaje)
                        <div class="new-messages_edit">
                            <a href="/mensajes/{{ $mensaje->id }}/edit" style="color: rgb(255, 255, 255)">
                                <span class="fas fa-edit update" title="Editar"></span>
                            </a>
                        </div>
                    @endcan
                    @can('show', $mensaje)
                        <div class="new-messages_show">
                            <a href="/mensajes/{{ $mensaje->id }}" style="color: rgb(255, 255, 255)">
                                <span class="far fa-file-alt" title="Leer"></span>
                            </a>
                        </div>
                    @endcan
                    @can('delete', $mensaje)
                        <div class="new-messages_delete">
                            <form action="/mensajes/{{ $mensaje->id }}" method="POST" class="form_eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <span class="fas fa-trash-alt" title="Eliminar"></span>
                                </button>
                            </form>
                        </div>
                    @endcan
                    @can('difundirMensaje', $mensaje)
                        <div class="new-messages_delete new-messages_difundir " style="background: #e91e63 !important">
                            <form action="/mensajes/{{ $mensaje->id }}" method="POST" class="form_difundir">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="estado" value="3" id="updateEstado">
                                <button type="submit">
                                    <span class="fas fa-share" title="Difundir"></span>
                                </button>
                            </form>
                        </div>
                    @endcan
                    @can('estadisticas', $mensaje)
                        <div class="new-messages_show">
                            <span style="color: rgb(255, 255, 255)" class="far fa-chart-bar estadistica"
                                title="Estadisticas" data-id="{{ $mensaje->id }}"></span>
                        </div>
                    @endcan
                </div>
            </div>
            </div>
            @endforeach
            {{ $mensajes->links() }}

        @endif
    </section>
    @include('difusor.ver-estadisticas')
    <script>
        let eliminar = document.getElementsByClassName('form_eliminar');
        for (let i = 0; i < eliminar.length; i++) {
            eliminar[i].addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Esta seguro de querer eliminar este mensaje?',
                    text: "No será posible revertir este cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    </script>

    <script>
        let btn1 = document.getElementById("btn1");
        let btn2 = document.getElementById("btn2");
        let btn3 = document.getElementById("btn3");
        let b = 0;
        let alum = 0;
        window.addEventListener('load', function() {
            
            if(sessionStorage.getItem("val") == "1" || sessionStorage.getItem("val") == "0") {
                btn1.classList.add('btn__selected');
            }else if (sessionStorage.getItem("val") == "3") {
                btn2.classList.add('btn__selected');
            }else if (sessionStorage.getItem("val") == "4") {
                btn3.classList.add('btn__selected');
            }else{
                btn3.classList.add('btn__selected');

            }
            btn1.addEventListener('click', function() {
                sessionStorage.setItem("val", btn1.value);
                btn1.classList.add('btn__selected');
                btn2.classList.remove('btn__selected');
                
            });
            btn2.addEventListener('click', function() {
                sessionStorage.setItem("val", btn2.value);
                btn2.classList.add('btn__selected');
                btn1.classList.remove('btn__selected');
                
            });
            btn3.addEventListener('click', function() {
                sessionStorage.setItem("val", btn3.value);
                btn3.classList.add('btn__selected');
                btn2.classList.remove('btn__selected');
                btn1.classList.remove('btn__selected');
            });

            function realizarSolicitud(estado) {
                $.ajax({
                    url: '/mensajes?estado='+estado,
                    method: 'GET',
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done(function(res) {
                    let respuesta = JSON.parse(res)
                    let section = document.getElementById('new-messages');
                    let contenedor = ""
                    console.log(section[section.length])

                });
            }
        })
    </script>
@endsection
