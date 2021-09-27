@extends('dashboard')
@section('informatico.user-register')

<section class="user-list">
    <div class="user-register__container">
        @if(session('message'))
            <div class="notification">
                {{session('message')}}
                </div>

            @endif
            {{-- <div class="notification">
                {{session('message')}}
                </div> --}}
               
            <div class="user-select">
                Registrar a:
                <button id="alumno">Alumno</button>
                <button id="empleado">Empleado</button>
                
            </div>
        <form action="" class="user-register__form" id="form">
            
            <input class="input"  type="text" name="numero_control">
            <label class="lbl" for="">Número de control</label>

            <input class="input" type="text" name="name">
            <label class="lbl" for="">Nombre</label>

            <input class="input" type="text" name="a_paterno">
            <label class="lbl" for="">Apellido paterno</label>

            <input class="input" type="text" name="a_materno">
            <label class="lbl" for="">Apellido materno</label>

            <input class="input" type="text" name="carrera">
            <label class="lbl" for="">Carrera</label>

            <input class="input" type="text" name="semestre">
            <label class="lbl" for="">Semestre</label>

            <input class="input" type="text" name="email">
            <label class="lbl" for="">Correo</label>

            <input class="input" type="text" name="password">
            <label class="lbl" for="">Contraseña</label>
            <input class="input" type="text" name="password_confirm">
            <label class="lbl" for="">Contraseña</label>

            <input class="input" type="text" name="rol">
            <label class="lbl" for="">Rol</label>

            <input class="input" type="text" name="puestp">
            <label class="lbl" for="">Puesto</label>

            <input class="input" type="text" name="quien_revisa">
            <label class="lbl" for="">¿Quien revisa?</label>

            <input class="btn" type="submit" value="Enviar">


        </form>
    </div>
</section>
<script>
    let label = document.getElementsByClassName("lbl");
    let input = document.getElementsByClassName("input");
    let alumnos = document.getElementById("alumno");
    let empleados = document.getElementById("empleado");
    let form = document.getElementById("form");
        for (let i = 0; i < input.length; i++) {

            input[i].addEventListener("keyup", function () {
                if(this.value.length >= 1){
                    this.nextElementSibling.classList.add("fijar");
                }else{
                    this.nextElementSibling.classList.remove("fijar");
                }
            });
        }
        alumnos.addEventListener('click', function(){
            // form.removeChild(input[10])

            // form.removeChild(input[11])
            // form.removeChild(input[12])
            alumnos.classList.toggle('btn__selected');
            input[9].classList.toggle('ocultar');
            label[9].classList.toggle('ocultar');

            input[10].classList.toggle('ocultar');
            label[10].classList.toggle('ocultar');

            input[11].classList.toggle('ocultar');
            label[11].classList.toggle('ocultar');
            form.setAttribute("action", "/h")
            //classList.toggle('navigation_alternate_color')
        });
        empleados.addEventListener('click', function(){
            empleados.classList.toggle('btn__selected');
            input[0].classList.toggle('ocultar');
            label[0].classList.toggle('ocultar');
            input[4].classList.toggle('ocultar');
            label[4].classList.toggle('ocultar');
            input[5].classList.toggle('ocultar');
            label[5].classList.toggle('ocultar');
            form.setAttribute("action", "/h1")
            //


            // form.removeChild(input[0])
            // form.removeChild( input[4])
            // form.removeChild( input[5])

        });
</script>
@endsection