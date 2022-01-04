@extends('dashboard')
@php
    $c_total=null;
    $c_alumnos =null;
    $c_empleados = null;
    $c_carreras= null;

@endphp
@section('informatico.user-register')
    <style>
        .dashboard-informatico {
            display: none;
        }

    </style>
    
    <section class="user-list">
        <div class="user-register__container">

            @if (session('message'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        
                        animation: true,
                        position: 'top-left',
                        showConfirmButton: false,
                        timer: 2000
                        
                    });
                    Toast.fire({
                        type: 'success',
                        title: '{{session('message')}}'
                    })
                </script>
            @endif  
            <div class="user-select">
                <button id="alumno" name="alumno" value="0">Alumno</button>
                <button id="empleado" name="empleado" value="0">Empleado</button>

            </div>
            <form action="" method="POST" class="user-register__form" id="form">
                @csrf
                <div class="div-item_container">
                    <input class="input" type="text" name="numero_control" value="{{ old('numero_control') }}">
                    <label class="lbls" for="">Número de control</label><br>
                    {!! $errors->first('numero_control', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="name" value="{{ old('name') }}">
                    <label class="lbls" for="">Nombre</label><br>
                    {!! $errors->first('name', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="a_paterno" value="{{ old('a_paterno') }}">
                    <label class="lbls" for="">Apellido paterno</label><br>
                    {!! $errors->first('a_paterno', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">

                    <input class="input" type="text" name="a_materno" value="{{ old('a_materno') }}">
                    <label class="lbls" for="">Apellido materno</label><br>
                    {!! $errors->first('a_materno', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <label for="" style="top: 0; color:rgb(0, 0, 0)" >Semestre*: <i class="fas fa-question-circle" title="Campo requerido" style="font-size: .9rem"></i></label>
                    <select name="carrera" id="carrera" class="">
                        <option value="">Seleccione una opción</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}"
                                {{ old('carrera') == $carrera->id ? 'selected' : '' }}>{{ $carrera->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('carrera', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <label for="" style="top: 0; color:rgb(0, 0, 0)" >Carrera*: <i class="fas fa-question-circle" title="Campo requerido" style="font-size: .9rem"></i></label>
                    <select name="semestre" id="semestre" class="">
                        <option value="">Semestre</option>
                        @foreach ($semestres as $semestre)
                            <option value="{{ $semestre->id }}"
                                {{ old('carrera') == $semestre->id ? 'selected' : '' }}>{{ $semestre->semestre }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('semestre', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="email" value="{{ old('email') }}">
                    <label class="lbls" for="">Correo</label><br>
                    {!! $errors->first('email', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    
                    <input class="input pw1" type="password" name="password"
                        value="{{ old('password') }}">
                    <label class="lbls" for="">Contraseña</label><br>
                    <i style="position: absolute;right: 0; top:0;padding: 5px;font-size: 1.5rem;"  class="show-pass fas fa-eye vp"></i>
                    {!! $errors->first('password', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input pw1" type="password" name="password_confirm"
                        value="{{ old('password_confirm') }}">
                    <label class="lbls " for="">Confirmar contraseña</label><br>
                    <i style="position: absolute;right: 0; top:0;padding: 5px;font-size: 1.5rem;"  class="show-pass fas fa-eye vp"></i>
                    {!! $errors->first('password_confirm', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <label for="" style="position: absolute;top: -20px; color:rgb(0, 0, 0)" >Rol*: <i class="fas fa-question-circle" title="Campo requerido" style="font-size: .9rem"></i></label>
                    <select name="rol" id="rol" class="">
                        <option value="">Elija una opción</option>
                        <option value="Informático">Informático</option>
                        <option value="Difusor">Difusor</option>
                        <option value="Revisor">Revisor</option>
                        <option value="Emisor">Emisor</option>
                    </select>
                    {!! $errors->first('rol', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <input id="departamento" class="input" type="text" name="puesto" value="{{ old('puesto') }}">
                    <label class="lbls" for="">Departamento</label><br>
                    {!! $errors->first('puesto', '<small>:message</small>') !!}
                </div>

                <div class="div-item_container">
                    <label for="" style="top: 0; color:rgb(0, 0, 0)" >Revisor*: <i class="fas fa-question-circle" title="Campo requerido" style="font-size: .9rem"></i></label>
                    <select name="quien_revisa" id="quien_revisa" class="">
                        <option>Elija una opción</option>
                        <option>Subdirección de Planeación y Vinculación</option>
                        <option>Subdirección Académica</option>
                        <option>Subdirección de Servicios Administrativos</option>
                    </select>
                    
                    {!! $errors->first('quien_revisa', '<small>:message</small>') !!}
                </div>

                <input id="btn_enviar" class="btn" type="submit" value="Enviar">


            </form>
        </div>
    </section>
    <script>
        let opcContainer = document.getElementsByClassName('div-item_container')
        let label = document.getElementsByClassName("lbls");
        let input = document.getElementsByClassName("input");
        let alumnos = document.getElementById("alumno");
        let empleados = document.getElementById("empleado");
        let form = document.getElementById("form");
        let bandera = 0;
        let alum = 0;
        let enviar_btn = document.getElementById("btn_enviar");

        let vp = document.getElementsByClassName('vp')
        let bandera1 = false;
        let subdirecciones = ['Subdirección de Planeación y Vinculación', 'Subdirección Académica', 'Subdirección de Servicios Administrativos']
        $(function(){
            $('#departamento').autocomplete({
                source: subdirecciones,
                minLength: 1
            })
        })
       for(let i = 0; i < vp.length; i++){
        vp[i].addEventListener('click', function() {
            pass = document.getElementsByClassName('pw1')
            if (bandera1 == false) {
                console.log(bandera1)
                pass[i].setAttribute('type', "text")
                vp[i].classList.remove('fa-eye')
                vp[i].classList.add('fa-eye-slash')
                bandera1 = true
            } else if(bandera1 == true) {
                pass[i].setAttribute('type', "password")
                vp[i].classList.add('fa-eye')
                vp[i].classList.remove('fa-eye-slash')
                bandera1 = false
            }
        })
       }
        window.addEventListener('load', function() {
            //alumnos.classList.add("btn__selected");
            //empleados.disabled=true;
            enviar_btn.disabled = true;
            for (let i = 0; i < input.length; i++) {
                if (input[i].value != "") {
                    input[i].nextElementSibling.classList.add("fijar");
                    console.log(input[i].value);
                }
            }
            /// if para mantener la opcion elegida de crear alumno por si hay una exepcion.
            if (sessionStorage.getItem("val") == "1") {
                ocualtar_label_alumnos();
                empleados.disabled = true;
                enviar_btn.disabled = false;
                alumnos.classList.toggle('btn__selected');
                bandera = 1;
                form.setAttribute("action", "/alumno")

            }
            /// if para mantener la opcion elegida de crear empleado por si hay una exepcion.
            if (sessionStorage.getItem("emple") == "1") {
                ocualtar_label_empleados();
                alumnos.disabled = true;
                enviar_btn.disabled = false;
                empleados.classList.toggle('btn__selected');
                bandera = 1;
                form.setAttribute("action", "/user")
            }
        })
        for (let i = 0; i < input.length; i++) {

            input[i].addEventListener("change", function() {
                if (this.value.length >= 1) {
                    this.nextElementSibling.classList.add("fijar");
                } else {
                    this.nextElementSibling.classList.remove("fijar");
                }
            });
        }
        //Accion boton alumnos.
        alumnos.addEventListener('click', function() {
            ocualtar_label_alumnos();
            alumnos.classList.toggle('btn__selected');
            if (bandera == 0) {
                bandera = 1; //siginifica alumno seleccionado
                empleados.disabled = true
                enviar_btn.disabled = false;
                alumnos.setAttribute("value", "1");
                sessionStorage.setItem("val", alumnos.value);
            } else {
                empleados.disabled = false
                bandera = 0
                enviar_btn.disabled = true
                alumnos.setAttribute("value", "0");
                sessionStorage.setItem("val", alumnos.value);
            }
        });
        //Accion boton empleado
        empleados.addEventListener('click', function() {
            empleados.classList.toggle('btn__selected');
            alumnos.disabled = true
            ocualtar_label_empleados();
            if (bandera == 0) {
                bandera = 1
                alumnos.disabled = true
                enviar_btn.disabled = false
                empleados.setAttribute("value", "1");
                sessionStorage.setItem("emple", empleados.value);
            } else {
                alumnos.disabled = false
                bandera = 0
                enviar_btn.disabled = true
                empleados.setAttribute("value", "0");
                sessionStorage.setItem("emple", empleados.value);
            }
            form.setAttribute("action", "/user")
            });
        function ocualtar_label_alumnos() {
            opcContainer[9].classList.toggle('ocultar');
            opcContainer[10].classList.toggle('ocultar');
            opcContainer[11].classList.toggle('ocultar');
            form.setAttribute("action", "/alumno")
        }
        function ocualtar_label_empleados() {
            opcContainer[0].classList.toggle('ocultar');
            opcContainer[4].classList.toggle('ocultar');
            opcContainer[5].classList.toggle('ocultar');
        }
    </script>


@endsection
