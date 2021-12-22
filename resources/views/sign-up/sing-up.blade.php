<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/signup_style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <title>BIENVENIDO</title>
</head>

<body>
    <style>
        small {
            position: absolute;
            bottom: -11px;
        }

        .span {
            position: absolute;
            z-index: 10;
            display: block;
            padding: 10px;
            font-size: 1.5rem;
            top: 0;
            width: max-content;
            font-weight: 800;
            text-shadow: -4px 0px 7px #00000050;
            width: 100%;
            border-left: 10px solid #0d47a1;
        }

        .span::after,
        .span::before {
            position: absolute;
            z-index: -1;
            top: 0;
            content: "";
            width: 25px;
            height: 25px;
            left: 5px;
            box-shadow: 0px 0px 7px #0000004f;
        }

        .span::after {
            transform: rotate(16deg);
            border: 2px solid red;
        }

        .span::before {
            transform: rotate(26deg);
            border: 2px solid royalblue;
            top: 18px;
        }

        .div1,
        .div2,
        .div3 {
            width: 11px;
            height: 100%;
            background: aqua;
            position: relative;
            z-index: 11;
        }

        .div1 {
            background: yellow;

        }

        .div2 {

            background: black;
        }

        .div3 {

            background: deeppink
        }

    </style>
    <section class="login">
        @if (session('message'))
            <div class="notification">
                {{ session('message') }}
            </div>

        @endif
        <div style="background: var(--main-bg-color); height:max-content" id="a">
            <a href="/log-in" class="fas fa-chevron-left" style="text-decoration: none;cursor: pointer;   width: 64px;display: block;color: rgb(255, 255, 255);height: 100%;z-index: 100;position: relative;padding: 5px 10px;font-size: 1.5rem;"></a>
        </div>
        <div class="login__container">
            <div class="c" style="height: 100%; position: absolute; z-index:11;right: 8%; width:30px; display:flex">
                <div class="div1"></div>
                <div class="div2"></div>
                <div class="div3"></div>
            </div>
            <span class="span">Crear cuenta</span>
            <div class="login__img">

                <div class="title_container">
                    <p>TecNM Campus Tuxtla Gutiérrez</p>
                    <ul>

                        <li>Ciencia</li>
                        <li>y</li>
                        <li>Tecnología</li>
                        <li>con</li>
                        <li>sentido humando</li>
                    </ul>
                </div>

                <img src="{{ asset('static/imagenes/mascota_ittg.png') }}" alt="">
            </div>
            <div class="login__form">
                <form action="/sign-up" method="POST" style="position: relative;  z-index: 100; background:white">
                    @csrf
                    <div class="login__personal_information">
                        {!! $errors->first('num_control', '<small>:message</small>') !!}
                        <input type="text"  name="num_control" class="input_personal_information"
                            value="{{ old('num_control') }}" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
                            <label for="" class="lbl_personal_information">Número de control</label>
                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('name', '<small>:message</small>') !!}
                        <input type="text" name="name" class="input_personal_information" value="{{ old('name') }}">
                        <label for="" class="lbl_personal_information">Nombre</label>

                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('a_paterno', '<small>:message</small>') !!}
                        <input type="text" name="a_paterno" class="input_personal_information"
                            value="{{ old('a_paterno') }}">
                        <label for="" class="lbl_personal_information">Apellido paterno</label>
                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('a_materno', '<small>:message</small>') !!}
                        <input type="text" name="a_materno" class="input_personal_information"
                            value="{{ old('a_materno') }}">
                        <label for="" class="lbl_personal_information">Apellido materno</label>
                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('correo', '<small>:message</small>') !!}
                        <input type="email" name="correo" class="input_personal_information"
                            value="{{ old('correo') }}">
                        <label for="" class="lbl_personal_information">Correo electrónico</label>
                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('password', '<small>:message</small>') !!}
                        <input type="password" name="password" class="input_personal_information" id="password"
                            value="{{ old('password') }}">
                        <label for="" class="lbl_personal_information">Contraseña</label>
                        <i style="position: absolute;right: 0;padding: 5px;font-size: 1.5rem;" id="vp" class="show-pass fas fa-eye"></i>
                    </div>
                    <div class="login__personal_information">
                        {!! $errors->first('confirmar_password', '<small>:message</small>') !!}
                        <input type="password" name="confirmar_password" class="input_personal_information" id="confirmar_password"
                            value="{{ old('confirmar_password') }}">
                        <label for="" class="lbl_personal_information">Confirmar contraseña</label>
                        <i style="position: absolute;right: 0;padding: 5px;font-size: 1.5rem;" id="vp" class="show-pass fas fa-eye"></i>
                    </div>
                    <div class="login__extra_information" style="position: relative; margin-bottom:10px">
                        <select name="carrera" id="carrera">
                            <option value="">Seleccione una opcion</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}"
                                    {{ old('carrera') == $carrera->id ? 'selected' : '' }} >{{ $carrera->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('carrera', '<small>:message</small>') !!}
                    </div>    
                    <div class="login__extra_information" style="position: relative; margin-bottom:10px">
                        <select name="semestre" id="semestre">
                            <option value="" >Semestre</option>
                            @foreach ($semestres as $semestre)
                                <option value="{{ $semestre->id }}"
                                    {{ old('semestre') == $semestre->id ? 'selected' : '' }} >{{ $semestre->semestre }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('semestre', '<small>:message</small>') !!}
                    </div>

                    <input class="login__form_btn" type="submit" value="Crear cuenta">
                </form>
            </div>
        </div>
    </section>
    <script>
        let label = document.getElementsByClassName("lbl_personal_information");
        let input = document.getElementsByClassName("input_personal_information");
        let vp = document.getElementById('vp')
        let bandera = false;
        window.addEventListener('load', function() {
            for (let i = 0; i < input.length; i++) {
                if (input[i].value != "") {
                    input[i].nextElementSibling.classList.add("fijar");
                    input[i].classList.add('bordes');
                }
            }
        });
        //Visualizar cotraseña.
        vp.addEventListener('click', function() {
            pass = document.getElementById('password')
            if (bandera == false) {
                pass.setAttribute('type', "text")
                vp.classList.remove('fa-eye')
                vp.classList.add('fa-eye-slash')
                bandera = true
            } else {
                pass.setAttribute('type', "password")
                vp.classList.add('fa-eye')
                vp.classList.remove('fa-eye-slash')
                bandera = false
            }
        })

        //Visualizar confirmar cotraseña.
        vp2.addEventListener('click', function() {
            pass = document.getElementById('confirmar_password')
            if (bandera == false) {
                pass.setAttribute('type', "text")
                vp.classList.remove('fa-eye')
                vp.classList.add('fa-eye-slash')
                bandera = true
            } else {
                pass.setAttribute('type', "confirmar_password")
                vp.classList.add('fa-eye')
                vp.classList.remove('fa-eye-slash')
                bandera = false
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
    </script>
</body>

</html>
