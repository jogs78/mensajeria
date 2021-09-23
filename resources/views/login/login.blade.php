<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/login_style.css') }}">
    <title>BIENVENIDO</title>
</head>
<body>
    <section class="login">
        <div class="login__container">
            <div class="login__img">

                {{-- <ul>
                    <li>TecNM Campus Tuxtla Gutiérrez</li>
                    <li>Ciencia y Tecnologia con sentido humano</li>
                </ul> --}}

                <img src="{{ asset('static/imagenes/mascota_ittg.png') }}" alt="">
            </div>
            <div class="login__form">
                <form action="">
                    <input type="text" name="name" id="name">
                    <input type="text" name="password" id="password">
                    <input class="login__form_btn" type="submit" value="Iniciar">
                </form>
                <div class="login__links">
                    <a href="">Registrate aquí</a>
                    <a href="">¿Olvidó su contraseña?</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>