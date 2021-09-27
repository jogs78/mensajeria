@extends('dashboard')
@section('emisor.mensaje-create')
    <section class="mensaje-create">
        {{-- <div class="mensaje__container">
            <form action="" class="mensaje__form">
                <div class="container__1">
                    <input type="text">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <label for="">Adjuntas archivo (s):</label> <input type="file">
                    <label for="">Vista previa</label>
                    <input class="mensaje__btn_enviar" type="submit" value="Enviar">
                </div>
                <div class="container__2">
                    Dirigido a:
                <select name="" id="">
                    <option value="">Seleccione una carrera</option>
                </select>
                <select name="" id="">
                    <option value="">Seleccione semestre</option>
                </select>
                <span><input type="checkbox" name="" id="servicio_social"> Servicio social</span>
                <span><input type="checkbox" name="Residencia" id="residencia"> Residencia</span>
                <span><input type="checkbox" name="general" id="general"> General</span>
                </div>
                
            </form>
        </div> --}}
        <form action="" class="mensaje-create__form">
            <div class="c1">
                <input class="mensaje-create__form_title" type="text">
                <textarea class="mensaje-create__form_body" name="" id="" cols="30" rows="10"></textarea>
                <label class="mensaje-create__form_lbl_adjuntar" for="">Adjuntar archivo</label>
            
                <input class="mensaje-create__form_file" type="file" name="" id="">
                <label class="mensaje-create__form-preview" >aqui la vista prevcia de la imagen</label>
            </div>
            <div class="c2">
                <label class="mensaje-create__form_lbl" >Dirigido a:</label>
            <select class="mensaje-create__form_select_carrera" name="" id="">
                <option value="">Seleccione una carrera</option>
            </select>
            <select class="mensaje-create__form_select_semestre" name="" id="">
                <option value="">Seleccione semestre</option>
            </select>
            <span><input class="mensaje-create__form_check" type="checkbox" name="" id="servicio_social"> Servicio social</span>
            <span><input class="mensaje-create__form_check" type="checkbox" name="Residencia" id="residencia"> Residencia</span>
            <span><input class="mensaje-create__form_check" type="checkbox" name="general" id="general"> General</span>
            </div>
        </form>
    </section>
@endsection