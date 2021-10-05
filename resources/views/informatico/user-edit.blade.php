@extends('dashboard')
@section('user-edit')
@if (session('message'))
{{session('message')}}

    
@endif
    @if ($alumno != "")
        <form action="/user/{{$alumno->numero_control}}" class="form-edit" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-edit__item">
                <label for="">Numero de control</label>
                <input type="text" name="numero_control" id="" value="{{$alumno->numero_control}}">
            </div>
            <div class="form-edit__item">
                <label for="">Nombre</label>
                <input type="text" name="name" id="" value="{{$alumno->nombre}}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido paterno</label>
                <input type="text" name="a_paterno" id="" value="{{$alumno->apellido_paterno}}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido materno</label>
                <input type="text" name="a_materno" id="" value="{{$alumno->apellido_materno}}">
            </div>
            <div class="form-edit__item">
                <label for="">Carrera</label>
                <input type="text" name="carrera" id="" value="{{$alumno->carrera}}">
            </div>
            <div class="form-edit__item">
                <label for="">Semestre</label>
                <input type="text" name="semestre" id="" value="{{$alumno->semestre}}">
            </div>
            <div class="form-edit__item">
                <label for="">Correo</label>
                <input type="text" name="correo" id="" value="{{$alumno->correo}}">
            </div>
            <div class="form-edit__item">
                <label for="">Contraseña</label>
                <input type="text" name="contraseña" id="">
            </div>
            <div class="form-edit__item">
                <label for="">Confirmar contraseña</label>
                <input type="text" name="contraseña_confirm" id="">
            </div>
            <div class="form-edit__item">
                <input type="submit" name="enviar" id="" value="Guardar" class="enviar">
            </div>
        </form>
    @elseif ($empleado != "")
    <form action="/user/{{$empleado->id}}" class="form-edit" method="POST">
        @csrf
        @method('PUT')
        <div class="form-edit__item">
            <label for="">Nombre</label>
            <input type="text" name="name" id="" value="{{$empleado->nombre}}">
        </div>
        <div class="form-edit__item">
            <label for="">Apellido paterno</label>
            <input type="text" name="a_paterno" id="" value="{{$empleado->apellido_paterno}}">
        </div>
        <div class="form-edit__item">
            <label for="">Apellido materno</label>
            <input type="text" name="a_materno" id="" value="{{$empleado->apellido_materno}}">
        </div>
        <div class="form-edit__item">
            <label for="">Correo</label>
            <input type="text" name="correo" id="" value="{{$empleado->correo}}">
        </div>
        <div class="form-edit__item">
            <label for="">Contraseña</label>
            <input type="password" name="contraseña" id="">
        </div>
        <div class="form-edit__item">
            <label for="">Confirmar contraseña</label>
            <input type="password" name="contraseña_confirm" id="">
        </div>
        <div class="form-edit__item">
            <label for="">Rol</label>
            <input type="text" name="rol" id="" value="{{$empleado->rol}}">
        </div>
        <div class="form-edit__item">
            <label for="">Puesto</label>
            <input type="text" name="puesto" id="" value="{{$empleado->puesto}}">
        </div>
        <div class="form-edit__item">
            <label for="">Revisor</label>
            <input type="text" name="quien_revisa" id="" value="{{$empleado->quien_revisa}}">
        </div>
        <div class="form-edit__item">
            <input type="submit" name="enviar" id="" value="Guardar" class="enviar">
        </div>
        </form>
    @endif




@endsection