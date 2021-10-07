@extends('dashboard')
@section('emisor.mensaje-create')
    <section class="mensaje-create">
        <form action="/mensajes-emisor" method="POST" class="mensaje-create__form" id="form">
            @csrf
            <div class="c1">
                <input placeholder="Título" class="mensaje-create__form_title" type="text" name="titulo">
                <textarea placeholder="Descripción..." class="mensaje-create__form_body" name="descripcion" id="" cols="30" rows="10"></textarea>
                <label class="mensaje-create__form_lbl_adjuntar" for="">Adjuntar archivo</label>
            
                <input class="mensaje-create__form_file" type="file" name="imagen" id="">
                <label class="mensaje-create__form-preview" >aqui la vista prevcia de la imagen</label>
            </div>
            <div class="c2">
                <label class="mensaje-create__form_lbl" >Dirigido a:</label>
            <select class="mensaje-create__form_select_carrera" name="carrera" id="">
                    <option value="">Seleccione una carrera</option>
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
                <option value="">Semestre</option>
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
            <input id="btn_enviar" class="btn" type="submit" value="Enviar">
        </form>


        <form>
            <div class="multiselect">
              <div class="selectBox" onclick="showCheckboxes()">
                <select>
                  <option>Select an option</option>
                </select>
                <div class="overSelect"></div>
              </div>
              <div id="checkboxes">
                <label for="one">
                  <input type="checkbox" id="one" />First checkbox</label>
                <label for="two">
                  <input type="checkbox" id="two" />Second checkbox</label>
                <label for="three">
                  <input type="checkbox" id="three" />Third checkbox</label>
              </div>
            </div>
          </form>

    </section>

    <script>
        var expanded = false;
        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            }else {
                checkboxes.style.display = "none";
                expanded = false;
            }
         }
    </script>    
@endsection


