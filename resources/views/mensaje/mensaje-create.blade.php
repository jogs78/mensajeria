@extends('dashboard')
@section('mensaje.mensaje-create')

    <section class="mensaje-create">
        <form action="/mensajes" method="POST" class="mensaje-create__form" id="form" enctype="multipart/form-data">
            @csrf
            <div class="c1">
                <input placeholder="Título" class="mensaje-create__form_title" type="text" name="titulo">
                <textarea placeholder="Descripción..." class="mensaje-create__form_body" name="descripcion" id="" cols="30"
                    rows="10"></textarea>
                <label class="mensaje-create__form_lbl_adjuntar" for="">Adjuntar archivo</label>

               

                <div class="container-input">
                    <input type="file" name="file-1" id="file-1" class="inputfile inputfile-1"/>
                    <label for="file-1">
                        <span class="iborrainputfile fas fa-upload"> Seleccionar archivo</span>
                    </label>
                </div>
                <img class="mensaje-create__form-preview" id="previewImage">
            </div>
            <div class="c2">
                <label class="mensaje-create__form_lbl">Dirigido a:</label>
                <div class="multiselect">
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_carrera" name="carrera" id="">
                            <option value="">Seleccione una carrera</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes">
                        @foreach ($carreras as $carrera)
                            <label><input type="checkbox" name="car[]" value="{{ $carrera->id }}"
                                    {{ old('carrera') == $carrera->id ? 'selected' : '' }}>{{ $carrera->name }}</label>
                        @endforeach
                    </div>
                </div>
                <div class="multiselect select2">
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_semestre" name="semestre[]" id="">
                            <option value="">Semestre</option>

                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes">
                        @foreach ($semestres as $semestre)
                            <label><input type="checkbox" name="sem[]" value="{{ $semestre->id }}"
                                    {{ old('semestres') == $semestre->id ? 'selected' : '' }}>{{ $semestre->semestre }}</label>
                        @endforeach
                    </div>
                </div>

                <span><input class="mensaje-create__form_check" type="checkbox" name="servicio" id="servicio_social"
                        value="0"> Servicio social</span>
                <span><input class="mensaje-create__form_check" type="checkbox" name="residencia" id="residencia" value="1">
                    Residencia</span>
                <span><input class="mensaje-create__form_check" type="checkbox" name="general" id="general" value="3">
                    General</span>
            </div>
            <input id="btn_enviar" class="btn_en" type="submit" value="Enviar">
        </form>
        <script>
            let expanded = false;
            let checkboxes = document.getElementsByClassName("checkboxes");
            let selectBox = document.getElementsByClassName("selectBox");
            let previewImage = document.getElementById('previewImage');
            let inputFile = document.getElementById('file-1');
            for (let i = 0; i < 2; i++) {
                selectBox[i].addEventListener("click", function() {
                    if (!expanded) {
                        checkboxes[i].style.display = "block";
                        expanded = true;
                    } else {
                        checkboxes[i].style.display = "none";
                        expanded = false;
                    }
                });
            }
            inputFile.addEventListener('change', function(e) {
                let image = e.target.files[0];
                let file = new FileReader();
                file.onload = (e) => {
                    previewImage.setAttribute('src', e.target.result)
                }
                file.readAsDataURL(image);
            });
        </script>




    @endsection
