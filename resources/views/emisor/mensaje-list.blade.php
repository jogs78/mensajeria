@extends('dashboard')
@section('emisor.mensaje-list')



<section class="new-messages">
    <a href="/mensajes-emisor/create">Redactar mensaje</a>
    @foreach ($mensajes as $mensaje)
        <div class="new-messages__container">
            <div class="new-messages__information">
                <label for="" class="new-messages__title">Título: {{$mensaje->titulo}}</label>
                <label for="" class="new-messages__title">Descripción: {{$mensaje->descripcion}}</label>
                @if ($mensaje->estado==0)
                    <label for="" class="new-messages__status-menssage">Estado: Pendiente</label>         
                @elseif($mensaje->estado==1) 
                    <label for="" class="new-messages__status-menssage">Estado: Aceptado</label>
                @elseif($mensaje->estado==2)
                    <label for="" class="new-messages__status-menssage">Estado: Enviado</label>   
                @else
                    <label for="" class="new-messages__status-menssage">Estado: Rechazado</label>   
                @endif
                {{-- <label for="" class="new-messages__fecha-publicacion">Fecha de publicación</label> --}}
            </div>
            <div class="new-messages_actions">
                <div class="new-messages_edit">
                    <a href="/mensajes-emisor/{{$mensaje->id}}">
                        <span class="fas fa-edit update" title="Editar"></span>
                    </a>
                </div>
                <div class="new-messages_show">
                    <a href="/mensajes-emisor/{{$mensaje->id}}">
                        <span class="fab fa-readme" title="Leer"></span>
                    </a>
                </div>
                <div class="new-messages_delete">
                    <form action="/mensajes-emisor/{{$mensaje->id}}" method="POST" class="form_eliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            <span class="fas fa-trash-alt" title="Eliminar"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>    
    @endforeach
</section>
@if (session('message') == "ok")
        <script>
            Swal.fire(
                'Eliminado!',
                'Mensaje eliminado con éxito',
                'success'
                )
        </script>
 @endif
<script>
    let eliminar=document.getElementsByClassName('form_eliminar');
    for(let i = 0; i < eliminar.length; i++){
        eliminar[i].addEventListener('submit', function(e){
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