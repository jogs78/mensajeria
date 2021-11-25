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
                <input placeholder="Título" class="mensaje-create__form_title" type="text" name="titulo">
                {!! $errors->first('titulo', '<small>:message</small><br>') !!}
                <textarea placeholder="Descripción..." class="mensaje-create__form_body" name="descripcion" id="" cols="30"
                    rows="10"></textarea>
                {!! $errors->first('descripcion', '<small>:message</small><br>') !!}
                <label class="mensaje-create__form_lbl_adjuntar" for="">Adjuntar archivo</label>
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
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_carrera" name="carrera" id="">
                            <option value="">Seleccione Carrera</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes" tabindex="100">
                        @foreach ($carreras as $carrera)
                            <label><input type="checkbox" name="car[]" value="{{ $carrera->id }}"
                                    {{ old('carrera') == $carrera->id ? 'selected' : '' }}>{{ $carrera->name }}</label>
                        @endforeach
                    </div>
                    {!! $errors->first('car', '<small>:message</small><br>') !!}
                </div>
                <div class="multiselect select2">
                    <div class="selectBox">
                        <select class="mensaje-create__form_select_semestre" name="semestre[]" id="">
                            <option value="">Seleccione Semestre</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div class="checkboxes">
                        @foreach ($semestres as $semestre)
                            <label><input type="checkbox" name="sem[]" value="{{ $semestre->id }}"
                                    {{ old('semestres') == $semestre->id ? 'selected' : '' }}> {{ $semestre->semestre }}
                            </label>
                        @endforeach
                    </div>
                    {!! $errors->first('sem', '<small>:message</small><br>') !!}
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

    </section>
    <script src="{{ asset('static/js/mensajes.js') }}"></script>
@endsection
