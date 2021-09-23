@extends('dashboard')
@section('emisor.mensaje-create')
    <section class="mensaje">
        <div class="mensaje__container">
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
        </div>
    </section>
@endsection