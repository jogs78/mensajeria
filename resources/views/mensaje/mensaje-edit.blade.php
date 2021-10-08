@extends('dashboard')
@section('mensaje.mensaje-edit')
{{-- <style>
    .message_selected {
    border-radius: 5px 5px 0 0;
    box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.281);
    top: -10px;
    color: rgb(251, 255, 35);
}

.user_selected>.text {
    bottom: 10%;
} --}}
</style>
    <section class="messages-edit">
        <form class="messages-edit__form" action="/mensajes/{{$mensaje->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="container">
                <label for="">Título</label>
            <input class="messages-edit__form_input" type="text" value="{{$mensaje->titulo}}" name="titulo">
            </div>
            
            <div class="container">
                <label for="">Descripción</label>
                <input class="messages-edit__form_input" type="text" value="{{$mensaje->descripcion}}" name="descripcion">
            </div>
            <div class="container_image">
                <label for="" >Imagen</label>
                <input  name="imagen" type="file">
                <label for="">aqui la vista previa del archivo</label>
            </div>
            <div class="container_segmento">
                <label for="">Carrera</label>
                <select class="mensaje-edit__form_select" name="carrera" id="">
                    <option value="{{$mensaje->carrera}}">{{$mensaje->carrera}}</option>
                    <option value="Ingen. Mécanica" {{ old('carrera') == 'Ingen. Mécanica' ? 'selected' : '' }}>Ingen. Mécanica</option>
                    <option value="Ingen. Sistemas Computacionales" {{ old('carrera') == 'Ingen. Sistemas Computacionales' ? 'selected' : '' }}>Ingen. Sistemas Computacionales</option>
                    <option value="Ingen. Industrial" {{ old('carrera') == 'Ingen. Industrial' ? 'selected' : '' }}>Ingen. Industrial</option>
                    <option value="Ingen. Electrónica" {{ old('carrera') == 'Ingen. Electrónica' ? 'selected' : '' }}>Ingen. Electrónica</option>
                    <option value="Ingen. Eléctrica" {{ old('carrera') == 'Ingen. Eléctrica' ? 'selected' : '' }}>Ingen. Eléctrica</option>
                    <option value="Ingen. Bioquímica" {{ old('carrera') == 'Ingen. Bioquímica' ? 'selected' : '' }}>Ingen. Bioquímica</option>
                    <option value="Ingen. Química" {{ old('carrera') == 'Ingen. Química' ? 'selected' : '' }}>Ingen. Química</option>
                    <option value="Ingen. Gestión Empresarial" {{ old('carrera') == 'Ingen. Gestión Empresarial' ? 'selected' : '' }}>Ingen. Gestión Empresarial</option>
                    <option value="Maestria en Ciencias en Ingeniería Bioquímica" {{ old('carrera') == 'Maestria en Ciencias en Ingeniería Bioquímica' ? 'selected' : '' }}>Maestria en Ciencias en Ingeniería Bioquímica</option>
                    <option value="Maestría en Ciencias en Ingeniería Mecatrónica" {{ old('carrera') == 'Maestría en Ciencias en Ingeniería Mecatrónica' ? 'selected' : '' }}>Maestría en Ciencias en Ingeniería Mecatrónica</option>
                    <option value="Doctorado en Ciencias de los Alimentos y Biotecnología" {{ old('carrera') == 'Doctorado en Ciencias de los Alimentos y Biotecnología' ? 'selected' : '' }}>Doctorado en Ciencias de los Alimentos y Biotecnología</option>
                    <option value="Doctorado en Ciencias de la Ingeniería" {{ old('carrera') == 'Doctorado en Ciencias de la Ingeniería' ? 'selected' : '' }}>Doctorado en Ciencias de la Ingeniería</option>
            </select>
            <label for="">Semestre</label>
            <select class="mensaje-edit__form_select" name="semestre" id="" >
                <option value="{{$mensaje->semestre}}">{{$mensaje->semestre}}</option>
                <option value="1" {{ old('semestre') == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('semestre') == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('semestre') == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('semestre') == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('semestre') == 5 ? 'selected' : '' }}>5</option>
                <option value="6" {{ old('semestre') == 6 ? 'selected' : '' }}>6</option>
                <option value="7" {{ old('semestre') == 7 ? 'selected' : '' }}>7</option>
                <option value="8" {{ old('semestre') == 8 ? 'selected' : '' }}>8</option>
                <option value="9" {{ old('semestre') == 9 ? 'selected' : '' }}>9</option>
            </select>
            @if ($mensaje->otros==0)
                <span><input checked class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social" value="0"> Servicio social</span>
                <span><input class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia" value="1"> Residencia</span>
                <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3"> General</span>
            @elseif($mensaje->otros==1)
                <span><input  class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social" value="0"> Servicio social</span>
                <span><input checked class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia" value="1"> Residencia</span>
                <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3"> General</span>
            @elseif($mensaje->otros==2)
                <span><input checked class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia" value="1"> Residencia</span>
                <span><input checked class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social" value="0"> Servicio social</span>
                <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3"> General</span>
            @else
                <span><input class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social" value="0"> Servicio social</span>
                <span><input class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia" value="1"> Residencia</span>
                <span><input checked class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3"> General</span>
            @endif
            
            
            
            </div>

            <button type="submit" class="save">Guardar</button>
        </form>
    </section>
@endsection