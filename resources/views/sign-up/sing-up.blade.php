<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/signup_style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <title>BIENVENIDO</title>
</head>

<body>
    <section class="login">
        @if (session('message'))
            <div class="notification">
                {{ session('message') }}
            </div>

        @endif
        <div class="login__container">


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
                <form action="/sign-up" method="POST">
                    @csrf
                    <div class="login__personal_information">
                        <input type="text" name="num_control" class="input_personal_information"
                            value="{{ old('num_control') }}">
                        <label for="" class="lbl_personal_information">Número de control</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="name" class="input_personal_information" value="{{ old('name') }}">
                        <label for="" class="lbl_personal_information">Nombre</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_paterno" class="input_personal_information"
                            value="{{ old('a_paterno') }}">
                        <label for="" class="lbl_personal_information">Apellido paterno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_materno" class="input_personal_information"
                            value="{{ old('a_materno') }}">
                        <label for="" class="lbl_personal_information">Apellido materno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="correo" class="input_personal_information" value="{{ old('correo') }}">
                        <label for="" class="lbl_personal_information">Correo electrónico</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="password" name="password" class="input_personal_information"
                            value="{{ old('password') }}">
                        <label for="" class="lbl_personal_information">Contraseña</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="password" name="confirmar_password" class="input_personal_information"
                            value="{{ old('confirmar_password') }}">
                        <label for="" class="lbl_personal_information">Confirmar contraseña</label>
                    </div>
                    <div class="login__extra_information">
                        <select name="carrera" id="carrera">
                            <option>Seleccione una opcion</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
                            @endforeach
                        </select>
                        <select name="semestre" id="semestre">
                            <option value="">Semestre</option>
                            @foreach ($semestres as $semestre)
                                <option value="{{ $semestre->id }}">{{ $semestre->semestre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input class="login__form_btn" type="submit" value="Crear cuenta">
                </form>
            </div>
        </div>
    </section>
    <script>
        let label = document.getElementsByClassName("lbl_personal_information");
        let input = document.getElementsByClassName("input_personal_information");
        window.addEventListener('load', function() {
            for (let i = 0; i < input.length; i++) {
                if (input[i].value != "") {
                    input[i].nextElementSibling.classList.add("fijar");
                    input[i].classList.add('bordes');
                }
            }
        });
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
