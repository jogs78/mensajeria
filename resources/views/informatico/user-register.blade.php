@extends('dashboard')
@section('informatico.user-register')

<section class="user-list">
    <div class="user-register__container">
        {{--@if($errors->any())

            <div class="notification">
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
            </div>

        @endif--}}
        @if(session('message'))
        <div class="notification">
            {{session('message')}}
            </div>
                
        @endif
            {{-- <div class="notification">
                {{session('message')}}
                </div> --}}
               
                <div class="user-select">
                    <button id="alumno" name="alumno" >Alumno</button>
                    <button id="empleado">Empleado</button>
                    
                </div>    
        <form action="" method="POST" class="user-register__form" id="form">
            @csrf
            <div class="div-item_container">
                <input class="input"  type="text" name="numero_control" value="{{old ('numero_control')}}">
                <label class="lbl" for="">Número de control</label><br>
                {!! $errors->first('numero_control','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="name" value="{{old ('name')}}">
                <label class="lbl" for="">Nombre</label><br>
                {!! $errors->first('name','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="a_paterno" value="{{old ('a_paterno')}}">
                <label class="lbl" for="">Apellido paterno</label><br>
                {!! $errors->first('a_paterno','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="a_materno" value="{{old ('a_materno')}}">
                <label class="lbl" for="">Apellido materno</label><br>
                {!! $errors->first('a_materno','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="carrera" value="{{old ('carrera')}}">
                <label class="lbl" for="">Carrera</label><br>
                {!! $errors->first('carrera','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="semestre" value="{{old ('semestre')}}">
                <label class="lbl" for="">Semestre</label><br>
                {!! $errors->first('semestre','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="email" value="{{old ('email')}}">
                <label class="lbl" for="">Correo</label><br>
                {!! $errors->first('email','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="password" name="password" value="{{old ('password')}}">
                <label class="lbl" for="">Contraseña</label><br>
                {!! $errors->first('password','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="password" name="password_confirm" value="{{old ('password_confirm')}}">
                <label class="lbl" for="">Contraseña</label><br>
                {!! $errors->first('password_confirm','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="rol" value="{{old ('rol')}}">
                <label class="lbl" for="">Rol</label><br>
                {!! $errors->first('rol','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="puesto" value="{{old ('puesto')}}">
                <label class="lbl" for="">Puesto</label><br>
                {!! $errors->first('puesto','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <input class="input" type="text" name="quien_revisa" value="{{old ('quien_revisa')}}">
                <label class="lbl" for="">¿Quien revisa?</label><br>
                {!! $errors->first('quien_revisa','<small>:message</small><br>') !!}
            </div>

            <input id="btn_enviar" class="btn" type="submit" value="Enviar">


        </form>
    </div>
</section>
<script>
    let label = document.getElementsByClassName("lbl");
    let input = document.getElementsByClassName("input");
    let alumnos = document.getElementById("alumno");
    let empleados = document.getElementById("empleado");
    let form = document.getElementById("form");
    let bandera =0;
    let enviar_btn= document.getElementById("btn_enviar");

    

    window.addEventListener('load', function(){
        //alumnos.classList.add("btn__selected");
        //empleados.disabled=true;
        enviar_btn.disabled=true;
        for(let i=0; i<input.length;i++){
            if(input[i].value != ""){
                input[i].nextElementSibling.classList.add("fijar");
                console.log(input[i].value);
            }
        }

        
        /// if para mantener la opcion elegida de crear alumno por si hay una exepcion.
        if(sessionStorage.getItem("val") == "1"){
            ocualtar_label_alumnos();
            empleados.disabled=true;
            enviar_btn.disabled=false;
            alumnos.classList.toggle('btn__selected');
            if(bandera==0){
                empleados.disabled= true
                
                //enviar_btn.disabled=true
                alert(bandera);
            }else{
                empleados.disabled= true
                //
                
                //alert(bandera + "else");
            }
            alumnos.setAttribute("value","0");
            if(sessionStorage.getItem("val") == "0"){
                enviar_btn.disabled=true
            }
        }
        

    })
        for (let i = 0; i < input.length; i++) {

            input[i].addEventListener("keyup", function () {
                if(this.value.length >= 1){
                    this.nextElementSibling.classList.add("fijar");
                }else{
                    this.nextElementSibling.classList.remove("fijar");
                }
            });
        }

        alert(bandera);
        ////alumnsssssss
        alumnos.addEventListener('click', function(){
            ocualtar_label_alumnos();
            alumnos.classList.toggle('btn__selected');
            //classList.toggle('navigation_alternate_color')
            if(bandera==0){
                empleados.disabled= true
                bandera =1
                //enviar_btn.disabled=true
                alert(bandera);
            }else{
                empleados.disabled= false
                bandera = 0
                enviar_btn.disabled=true
                alert(bandera + "else");
            }
            alumnos.setAttribute("value","1");
            sessionStorage.setItem("val", alumnos.value);
            enviar_btn.disabled=false;
        });

        /////////////////////////////////////
        empleados.addEventListener('click', function(){
            empleados.classList.toggle('btn__selected');
            alumnos.disabled= true
            input[0].classList.toggle('ocultar');
            label[0].classList.toggle('ocultar');
            input[4].classList.toggle('ocultar');
            label[4].classList.toggle('ocultar');
            input[5].classList.toggle('ocultar');
            label[5].classList.toggle('ocultar');
            if(bandera==0){
                alumnos.disabled= true
                bandera =1
            }else{
                alumnos.disabled= false
                bandera = 0
            }
            form.setAttribute("action", "/user")
            // form.setAttribute("action", "/h1")
            //


            // form.removeChild(input[0])
            // form.removeChild( input[4])
            // form.removeChild( input[5])

        });


        function ocualtar_label_alumnos(){
                input[9].classList.toggle('ocultar');
                label[9].classList.toggle('ocultar');

                input[10].classList.toggle('ocultar');
                label[10].classList.toggle('ocultar');

                input[11].classList.toggle('ocultar');
                label[11].classList.toggle('ocultar');
                form.setAttribute("action", "/alumno")
            }
</script>


@endsection