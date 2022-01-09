
@foreach ($mensajes as $mensaje)
          
          @if ($mensaje-> empleado_id != Auth::user()->id)
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
          @endif      
@endforeach
@if (Auth::user()->rol == "Revisor"  || Auth::user()->rol == "Difusor")
<label for="" style="border-bottom: 1px solid;
font-weight: 800;
background: #dad9d9;
padding: 5px; text-align:center; font-size: 1.2rem;">Mis mensajes</label>
@endif
@foreach ($mensajes as $mensaje)
          
          @if ($mensaje-> empleado_id == Auth::user()->id)
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
          @endif      
@endforeach