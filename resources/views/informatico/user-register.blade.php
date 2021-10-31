@extends('dashboard')
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
                        title: 'Registro exitoso!'
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
                    {!! $errors->first('numero_control', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="name" value="{{ old('name') }}">
                    <label class="lbls" for="">Nombre</label><br>
                    {!! $errors->first('name', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="a_paterno" value="{{ old('a_paterno') }}">
                    <label class="lbls" for="">Apellido paterno</label><br>
                    {!! $errors->first('a_paterno', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="a_materno" value="{{ old('a_materno') }}">
                    <label class="lbls" for="">Apellido materno</label><br>
                    {!! $errors->first('a_materno', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <select name="carrera" id="carrera" class="input">
                        <option value="">Seleccione una opción</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('carrera', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <select name="semestre" id="semestre" class="input">
                        <option value="">Semestre</option>
                        @foreach ($semestres as $semestre)
                            <option value="{{ $semestre->id }}">{{ $semestre->semestre }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('semestre', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="email" value="{{ old('email') }}">
                    <label class="lbls" for="">Correo</label><br>
                    {!! $errors->first('email', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="password" name="password" value="{{ old('password') }}">
                    <label class="lbls" for="">Contraseña</label><br>
                    {!! $errors->first('password', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="password" name="password_confirm"
                        value="{{ old('password_confirm') }}">
                    <label class="lbls" for="">Contraseña</label><br>
                    {!! $errors->first('password_confirm', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="rol" value="{{ old('rol') }}">
                    <label class="lbls" for="">Rol</label><br>
                    {!! $errors->first('rol', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="puesto" value="{{ old('puesto') }}">
                    <label class="lbls" for="">Puesto</label><br>
                    {!! $errors->first('puesto', '<small>:message</small><br>') !!}
                </div>

                <div class="div-item_container">
                    <input class="input" type="text" name="quien_revisa" value="{{ old('quien_revisa') }}">
                    <label class="lbls" for="">¿Quien revisa?</label><br>
                    {!! $errors->first('quien_revisa', '<small>:message</small><br>') !!}
                </div>

                <input id="btn_enviar" class="btn" type="submit" value="Enviar">


            </form>
        </div>






    </section>
    <script>
        let label = document.getElementsByClassName("lbls");
        let input = document.getElementsByClassName("input");
        let alumnos = document.getElementById("alumno");
        let empleados = document.getElementById("empleado");
        let form = document.getElementById("form");
        let bandera = 0;
        let alum = 0;
        let enviar_btn = document.getElementById("btn_enviar");

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

            input[i].addEventListener("keyup", function() {
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
            // form.setAttribute("action", "/h1")
            //


            // form.removeChild(input[0])
            // form.removeChild( input[4])
            // form.removeChild( input[5])

        });


        function ocualtar_label_alumnos() {
            input[9].classList.toggle('ocultar');
            label[7].classList.toggle('ocultar');

            input[10].classList.toggle('ocultar');
            label[8].classList.toggle('ocultar');

            input[11].classList.toggle('ocultar');
            label[9].classList.toggle('ocultar');
            form.setAttribute("action", "/alumno")
        }

        function ocualtar_label_empleados() {
            input[0].classList.toggle('ocultar');
            label[0].classList.toggle('ocultar');

            input[4].classList.toggle('ocultar');
            input[5].classList.toggle('ocultar');

        }
    </script>


@endsection
