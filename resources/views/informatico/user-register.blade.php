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
                    <button id="alumno" name="alumno" value="0">Alumno</button>
                    <button id="empleado" name="empleado" value="0">Empleado</button>
                    
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
                <select name="carrera" id="carrera" class="input">
                    <option value="">Seleccione una opción</option>
                    <option value="Ingen. Mécanica" {{ old('carrera') == 'Ingen. Mécanica' ? 'selected' : '' }}>Ingen. Mécanica</option>
                    <option value="Ingen. Sistemas Computacionales" {{ old('carrera') == 'Ingen. Sistemas Computacionales' ? 'selected' : '' }}>Ingen. Sistemas Computacionales</option>
                    <option value="Ingen. Industrial" {{ old('carrera') == 'Ingen. Industrial' ? 'selected' : '' }}>Ingen. Industrial</option>
                    <option value="Ingen. Electrónica" {{ old('carrera') == 'Ingen. Electrónica' ? 'selected' : '' }}>Ingen. Electrónica</option>
                    <option value="Ingen. Eléctrica" {{ old('carrera') == 'Ingen. Eléctrica' ? 'selected' : '' }}>Ingen. Eléctrica</option>
                    <option value="Ingen. Bioquímica" {{ old('carrera') == 'Ingen. Bioquímica' ? 'selected' : '' }}>Ingen. Bioquímica</option>
                    <option value="Ingen. Química" {{ old('carrera') == 'Ingen. Química' ? 'selected' : '' }}>Ingen. Química</option>
                    <option value="Ingen. Gestión Empresarial" {{ old('carrera') == 'Ingen. Gestión Empresarial' ? 'selected' : '' }}>Ingen. Gestión Empresarial</option>
                    <option value="Maestria en Ciencias en Ingeniería Bioquímica" {{ old('carrera') == 'Maestria en Ciencias en Ingeniería Bioquímica' ? 'selected' : '' }}>Maestria en Ciencias en Ingeniería Bioquímica</option>
                    <option value="Maestría en Ciencias en Ingeniería Mecatrónica" {{ old('carrera') == 'Maestría en Ciencias en Ingeniería Mecatrónica' ? 'selected' : '' }}>Maestría en Ciencias en Ingeniería Mecatrónica</option>
                    <option value="Doctorado en Ciencias de los Alimentos y Biotecnología" {{ old('carrera') == 'Doctorado en Ciencias de los Alimentos y Biotecnología' ? 'selected' : '' }}>Doctorado en Ciencias de los Alimentos y Biotecnología</option>
                    <option value="Doctorado en Ciencias de la Ingeniería" {{ old('carrera') == 'Doctorado en Ciencias de la Ingeniería' ? 'selected' : '' }}>Doctorado en Ciencias de la Ingeniería</option>
                </select>
                {!! $errors->first('carrera','<small>:message</small><br>') !!}
            </div>

            <div class="div-item_container">
                <select name="semestre" id="semestre" class="input">
                    <option value="">Semestre</option>
                    <option value="1" {{ old('semestre') == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('semestre') == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('semestre') == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('semestre') == 4 ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('semestre') == 5 ? 'selected' : '' }}>5</option>
                    <option value="6" {{ old('semestre') == 6 ? 'selected' : '' }}>6</option>
                    <option value="7" {{ old('semestre') == 7 ? 'selected' : '' }}>7</option>
                    <option value="8" {{ old('semestre') == 8 ? 'selected' : '' }}>8</option>
                    <option value="9" {{ old('semestre') == 9 ? 'selected' : '' }}>9</option>
                </select>
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
    let alum=0;
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
            bandera=1; 

        }

        if(sessionStorage.getItem("emple") == "1"){
            ocualtar_label_empleados();
            alumnos.disabled=true;
            enviar_btn.disabled=false;
            empleados.classList.toggle('btn__selected');
            bandera=1; 
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
        //Accion boton alumnos.
        alumnos.addEventListener('click', function(){
            ocualtar_label_alumnos();
            alumnos.classList.toggle('btn__selected');  
            if(bandera==0){
                bandera=1;//siginifica alumno seleccionado
                empleados.disabled= true
                enviar_btn.disabled=false;
                alumnos.setAttribute("value","1");
                sessionStorage.setItem("val", alumnos.value);
                
            }else{
                empleados.disabled= false
                bandera = 0
                enviar_btn.disabled=true
                alumnos.setAttribute("value","0");
                sessionStorage.setItem("val", alumnos.value);
                
            }
               
        });

        //Accion boton empleado
        empleados.addEventListener('click', function(){
            empleados.classList.toggle('btn__selected');
            alumnos.disabled= true
            ocualtar_label_empleados();
            if(bandera==0){
                bandera =1
                alumnos.disabled= true
                enviar_btn.disabled=false
                empleados.setAttribute("value","1");
                sessionStorage.setItem("emple", empleados.value);
            }else{
                alumnos.disabled= false
                bandera = 0
                enviar_btn.disabled=true
                empleados.setAttribute("value","0");
                sessionStorage.setItem("emple", empleados.value);
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
                label[7].classList.toggle('ocultar');

                input[10].classList.toggle('ocultar');
                label[8].classList.toggle('ocultar');

                input[11].classList.toggle('ocultar');
                label[9].classList.toggle('ocultar');
                form.setAttribute("action", "/alumno")
        }

        function ocualtar_label_empleados(){
            input[0].classList.toggle('ocultar');
            label[0].classList.toggle('ocultar');

            input[4].classList.toggle('ocultar');
            input[5].classList.toggle('ocultar');

        }
</script>


@endsection