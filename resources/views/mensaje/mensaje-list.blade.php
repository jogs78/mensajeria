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

    </style>


    <section class="new-messages">
        <style>
            .dashboard-EmisorRevisror,
            .dashboard-difusor {
                display: none;
            }

        </style>
        <a class="new-messages__link" href="/mensajes/create">Redactar mensaje</a>
        @if (sizeof($mensajes) == 0)
            <label class="image-title fas fa-exclamation-circle">Sin registros</label>
        @else
            @foreach ($mensajes as $mensaje)
                <div class="new-messages__container">
                    <div class="new-messages__information">
                        <label for="" class="new-messages__title">Título: {{ $mensaje->titulo }}</label>
                        <label for="" class="new-messages__title">Descripción: {{ $mensaje->descripcion }}</label>
                        @if ($mensaje->estado == 0)
                            <label for="" class="new-messages__status-menssage">Estado: Pendiente</label>
                        @elseif($mensaje->estado==1)
                            <label for="" class="new-messages__status-menssage">Estado: Aceptado</label>
                        @elseif($mensaje->estado==2)
                            <label for="" class="new-messages__status-menssage">Estado: Rechazado</label>
                        @else
                            <label for="" class="new-messages__status-menssage">Estado: Publicado</label>
                        @endif
                        <label for="" class="new-messages__fecha-publicacion">Fecha de publicación:</label>
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
                        @endcan
                        @can('difundirMensaje', $mensaje)
                        <div class="new-messages_delete" style="background: #e91e63 !important">
                            <form action="/mensajes/{{ $mensaje->id }}" method="POST" class="form_eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <span class="fas fa-share-square" title="Difundir"></span>
                                </button>
                            </form>
                        @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
    @if (session('message') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'Mensaje eliminado con éxito',
                'success'
            )
        </script>
    @endif
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
@endsection
