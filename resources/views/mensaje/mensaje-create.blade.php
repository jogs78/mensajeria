@extends('dashboard')
@section('mensaje.mensaje-create')

    <section class="mensaje-create">
        <style>
            .dashboard-EmisorRevisror,
            .dashboard-difusor {
                display: none;
            }

        </style>
        <form action="/mensajes" method="POST" class="mensaje-create__form" id="form" enctype="multipart/form-data">
            @csrf
            <div class="c1">
                <span><b>Título:</b></span>
                <input value="{{old('titulo')}}" placeholder="Título" class="mensaje-create__form_title" type="text" name="titulo" >
                {!! $errors->first('titulo', '<small>:message</small><br>') !!}
                <span><b>Descripción:</b></span>
                <textarea placeholder="Descripción..." class="mensaje-create__form_body" name="descripcion" id="" cols="30"
                    rows="10">{{old('titulo')}}</textarea>
                {!! $errors->first('descripcion', '<small>:message</small><br>') !!}
                <label class="mensaje-create__form_lbl_adjuntar" for="">Adjuntar archivo</label>
                <span><b><small>** Nota: la dimension maxima de la imagen debe de ser: 700x1280 px ó 1500x500 px **</small></b></span>
                <div class="container-input">
                    <input type="file" name="file-1" id="file-1" class="inputfile inputfile-1" accept="image/*">
                    <label for="file-1">
                        <span class="iborrainputfile fas fa-upload"> Seleccionar imagen</span>
                    </label>
                    {!! $errors->first('file-1', '<small>:message</small><br>') !!}
                </div>
                <img class="mensaje-create__form-preview" id="previewImage">
                <div class="container-input">
                    <input type="file" name="file-2" id="file-2" class="inputfile inputfile-1" accept="application/pdf">
                    <label for="file-2">
                        <span class="iborrainputfile fas fa-upload"> Seleccionar documento</span>
                    </label>
                    {!! $errors->first('file-2', '<small>:message</small><br>') !!}
                </div>
                <label id="fileName"></label>
            </div>
            <div class="c2">
                <label class="mensaje-create__form_lbl">Dirigido a:</label>
                <div class="multiselect">
                    Carreras seleccionadas:
                    <p id="carrerasSelected" style="text-align: justify; border-bottom: 1px solid;
                    padding: 4px; "></p>
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_carrera" name="carrera" id="">
                            <option value="">Seleccione Carrera</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes" tabindex="100">
                        @foreach ($carreras as $carrera)
                            <label><input class="c" type="checkbox" name="car[]" value="{{ $carrera->id }}"
                                {{ (is_array(old('car')) and in_array($carrera->id, old('car'))) ? ' checked' : '' }}>{{ $carrera->name }}</label>
                        @endforeach
                    </div>
                    {!! $errors->first('car', '<small>:message</small><br>') !!}
                </div>
                <div class="multiselect select2">
                    Semestres seleccionados:
                    <p id="semestresSelected" style="text-align: justify; border-bottom: 1px solid;
                    padding: 4px; width:50%"></p>
                    <div class="selectBox" >
                        <select class="mensaje-create__form_select_semestre" name="semestre[]" id="">
                            <option value="">Seleccione Semestre</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    
                    <div class="checkboxes" style="width: max-content">
                        
                        @foreach ($semestres as $semestre)
                            <label><input class="s" type="checkbox" name="sem[]" value="{{ $semestre->id }}"
                                {{ (is_array(old('sem')) and in_array($semestre->id, old('sem'))) ? ' checked' : '' }}> {{ $semestre->semestre }}
                            </label>
                        @endforeach
                    </div>
                    {!! $errors->first('sem', '<small>:message</small><br>') !!}
                </div>

                <div>
                    <span><input class="mensaje-create__form_check" type="checkbox" name="servicio" id="servicio_social"
                        value="0"> Servicio social</span>
                <span><input class="mensaje-create__form_check" type="checkbox" name="residencia" id="residencia" value="1">
                    Residencia</span>
                <span><input class="mensaje-create__form_check" type="checkbox" name="general" id="general" value="3">
                    General</span>
                </div>
            </div>
            <input  class="btn_en" type="submit" value="Enviar">
        </form>

    </section>
    <script src="{{ asset('static/js/mensajes.js') }}"></script>
    <script>
        let car = document.getElementsByClassName('c')
        let sem = document.getElementsByClassName('s')
        let semSelected = [];
        let carSelected = [];
        let seleccion = document.getElementById('semestresSelected')
        let seleccionC = document.getElementById('carrerasSelected')
        for(let i = 0; i < sem.length; i++){
            sem[i].addEventListener('change', function(e){
                if(sem[i].checked){
                    semSelected.push(e.target.parentNode.innerText)
                    seleccion.innerHTML = seleccion.innerHTML +"- "+ e.target.parentNode.innerText
                }else{
                    seleccion.innerHTML = ""
                    semSelected.forEach((element, index) => {
                        if(element == e.target.parentNode.innerText){semSelected.splice(index, 1)
                        }
                    });
                    semSelected.forEach(element => {
                        seleccion.innerHTML = seleccion.innerHTML +"- "+ element
                    });
                }
            })
        }
        for(let i = 0; i < car.length; i++){
            car[i].addEventListener('change', function(e){
                if(car[i].checked){
                    carSelected.push(e.target.parentNode.innerText)
                    seleccionC.innerHTML = seleccionC.innerHTML +"- "+ e.target.parentNode.innerText
                }else{
                    seleccionC.innerHTML = ""
                    
                    carSelected.forEach((element, index) => {
                        if(element == e.target.parentNode.innerText){carSelected.splice(index, 1)
                        }
                    });
                    carSelected.forEach(element => {
                        seleccionC.innerHTML = seleccionC.innerHTML +"- "+ element
                    });
                }
            })
        }
    </script>
@endsection
