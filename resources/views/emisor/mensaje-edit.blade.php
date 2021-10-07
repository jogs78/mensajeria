@extends('dashboard')
@section('emisor.mensaje-edit')
    <form action="/mensaje-emisor/{{$mensaje->id}}">
        <div>
            <label for="">Título</label>
        <input type="text" value="{{$mensaje->titulo}}">
        </div>
        
        <div>
            <label for="">Descripción</label>
            <input type="text" value="{{$mensaje->descripcion}}">
        </div>
        <div>
            <label for="">Imagen</label>
            <input type="text">
        </div>
        <div>
            <select class="mensaje-create__form_select_carrera" name="carrera" id="">
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
        <select class="mensaje-create__form_select_semestre" name="semestre" id="" >
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
        <span><input class="mensaje-create__form_check" type="checkbox" name="servicio" id="servicio_social" value="0"> Servicio social</span>
        <span><input class="mensaje-create__form_check" type="checkbox" name="residencia" id="residencia" value="1"> Residencia</span>
        <span><input class="mensaje-create__form_check" type="checkbox" name="general" id="general" value="3"> General</span>
        </div>
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection