@extends('dashboard')
@section('emisor.mensaje-list')



<section class="new-messages">
    <a href="/mensajes-emisor/create">Redactar mensaje</a>
    <div class="new-messages__container">
        <div class="new-messages__information">
            <label for="" class="new-messages__title">Aqui el titulo de la publicación</label>
            <label for="" class="new-messages__status-menssage">Aceptado/Rechazado</label>
            <label for="" class="new-messages__fecha-publicacion">Fecha de publicación</label>
        </div>
        <div class="new-messages_actions">
            <div class="new-messages_edit"><span class="fas fa-edit update" title="Editar"></span></div>
            <div class="new-messages_show"><span class="fab fa-readme"></span></div>
            <div class="new-messages_delete"><span class="fas fa-trash-alt"></span></div>
        </div>
    </div>
</section>
@endsection