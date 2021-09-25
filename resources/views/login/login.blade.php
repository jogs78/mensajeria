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
        @if(session('message'))
            <div class="notification">
                {{session('message')}}
                </div>
                    
            @endif
        <div class="login__container">
            
            <div class="login__img">

                {{-- <ul>
                    <li>TecNM Campus Tuxtla Gutiérrez</li>
                    <li>Ciencia y Tecnologia con sentido humano</li>
                </ul> --}}

                <img src="{{ asset('static/imagenes/mascota_ittg.png') }}" alt="">
            </div>
            <div class="login__form">
                <form action="/log-in" method="POST">
                    @csrf
                    <div class="login__form_name">
                        <input class="name" type="text" name="num_control" id="num_control">
                        <label for="" class="lbl_name">Número de control</label>
                    </div>
                    <div class="login__form_password">
                        <input class="password" type="text" name="password" id="password">
                        <label for="" class="lbl_contraseña">Contraseña</label>
                    </div>
                    <input class="login__form_btn" type="submit" value="Iniciar">
                </form>
                <div class="login__links">
                    <a href="">Registrate aquí</a>
                    <a href="">¿Olvidó su contraseña?</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        let name = document.getElementById("num_control");
        let password = document.getElementById("password");
        name.addEventListener("keyup", function(){
            if(name.value.length >= 1){
                name.nextElementSibling.classList.add("fijar");
            }else{
                name.nextElementSibling.classList.remove("fijar");
            }
        });
        password.addEventListener("keyup", function(){
            if(password.value.length >= 1){
                password.nextElementSibling.classList.add("fijar");
            }else{
                password.nextElementSibling.classList.remove("fijar");
            }
        });
        
        
        
    </script>
</body>
</html>