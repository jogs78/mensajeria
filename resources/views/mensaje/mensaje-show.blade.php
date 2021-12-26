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
                <p class="lbl"><b>Título:</b> {{ $mensaje->titulo }}</p>
                <p class="lbl"><b>Descripción:</b> {{ $mensaje->descripcion }}</p>
                <label for="" class="lbl"><b>Segmentación:</b> </label>
                
                <ul>
                    @if ($mensaje->otros==0)
                        <li style="list-style: none"><b>- Todos los alumnos</b></li>
                    @else
                        @if($mensaje->otros==1)
                            <li style="list-style: none"><b>- Alumnos en residencia</b></li>
                        @elseif($mensaje->otros==2)
                            <li style="list-style: none"><b>- Alumnos en servicio social</b></li>           
                        @elseif($mensaje->otros==3)
                            <li style="list-style: none"><b>-Alumnos en servicio social y residencia</b></li>    
                        @endif
                        
                        <ul>
                            <li style="list-style: none"><b>Carreras:</b></li>
                            @foreach ($mensaje->carreras as $carrera)
                                    <li style="list-style: none"><input type="checkbox" name="" id="" checked disabled> {{$carrera->name}}</li>
                            @endforeach
                        </ul>
                        <ul>
                            <li style="list-style: none"><b>Semestres:</b></li>
                            @foreach ($mensaje->semestres as $semestre)
                                    <li style="list-style: none"><input type="checkbox" name="" id="" checked disabled> {{$semestre->semestre}}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                </ul>
            <label for="" style="text-decoration: underline"><b><small>Publicado el: {{\Carbon\Carbon::parse($mensaje->fecha_publicacion)->format('d/m/Y')}}</small></b></label>
            </div>
            @can('aceptarRechazar', $mensaje)
                <div class="div" style="display: flex;
                margin: auto;">
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
