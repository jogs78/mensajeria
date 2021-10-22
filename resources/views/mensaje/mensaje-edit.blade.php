@extends('dashboard')
@section('mensaje.mensaje-edit')
    <style>
        #mensajes {
            border-radius: 5px 5px 0 0;
            box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.281);
            color: rgb(251, 255, 35);
        }

    </style>
    <section class="messages-edit">
        <form class="messages-edit__form" action="/mensajes/{{ $mensaje->id }}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container">
                <label for="">Título</label>
                <input class="messages-edit__form_input" type="text" value="{{ $mensaje->titulo }}" name="titulo">
            </div>

            <div class="container">
                <label for="">Descripción</label>
                <input class="messages-edit__form_input" type="text" value="{{ $mensaje->descripcion }}" name="descripcion">
            </div>
            <div class="container_image">
                <label for="">Imagen</label>
                <div class="container-input">
                    <input type="file" name="file-1" id="file-1" class="inputfile inputfile-1"/>
                    <label for="file-1">
                        <span class="iborrainputfile fas fa-upload"> Seleccionar archivo</span>
                    </label>
                </div>
                
            </div>
                <img class="" id="previewImage" class="mensaje-create__form-preview" src="{{asset($mensaje->imagen)}}">
            </div>
            <div class="container_segmento">
                <label for="">Carrera</label>
                <div class="multiselect">
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_carrera" name="carrera" id="">
                            <option value="{{ $mensaje->carrera }}">{{ $mensaje->carrera }}</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes">
                        @for ($i = 0; $i < sizeof($carreras); $i++)
                            <label><input type="checkbox" value="{{ $carreras[$i] }}"
                                    {{ old('carrera') == $carreras[$i] ? 'selected' : '' }}>{{ $carreras[$i] }}</label>
                        @endfor
                    </div>
                </div>
                <label for="">Semestre</label>
                <div class="multiselect select2">
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_semestre" name="semestre" id="">
                            <option value="{{ $mensaje->semestre }}">{{ $mensaje->semestre }}</option>

                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes">
                        @for ($i = 0; $i < sizeof($semestres); $i++)
                            <label><input type="checkbox" value="{{ $semestres[$i] }}"
                                    {{ old('semestres') == $semestres[$i] ? 'selected' : '' }}>{{ $semestres[$i] }}</label>
                        @endfor
                    </div>
                    @if ($mensaje->otros == 0)
                        <span><input checked class="mensaje-edit__form_check" type="checkbox" name="servicio"
                                id="servicio_social" value="0"> Servicio social</span>
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia"
                                value="1"> Residencia</span>
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3">
                            General</span>
                    @elseif($mensaje->otros==1)
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social"
                                value="0"> Servicio social</span>
                        <span><input checked class="mensaje-edit__form_check" type="checkbox" name="residencia"
                                id="residencia" value="1"> Residencia</span>
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3">
                            General</span>
                    @elseif($mensaje->otros==2)
                        <span><input checked class="mensaje-edit__form_check" type="checkbox" name="residencia"
                                id="residencia" value="1"> Residencia</span>
                        <span><input checked class="mensaje-edit__form_check" type="checkbox" name="servicio"
                                id="servicio_social" value="0"> Servicio social</span>
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="general" id="general" value="3">
                            General</span>
                    @else
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="servicio" id="servicio_social"
                                value="0"> Servicio social</span>
                        <span><input class="mensaje-edit__form_check" type="checkbox" name="residencia" id="residencia"
                                value="1"> Residencia</span>
                        <span><input checked class="mensaje-edit__form_check" type="checkbox" name="general" id="general"
                                value="3"> General</span>
                    @endif



                </div>

                <button type="submit" class="save">Guardar</button>
        </form>
    </section>
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
