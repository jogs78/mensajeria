<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">
    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>BIENVENIDO</title>
</head>

<body>
    <section class="login">
        @if ($errors->any())

            <div class="notification">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>

        @endif

        @if (session('message'))

            <div class="notification">
                {{ session('message') }}
            </div>

        @endif
        <div class="login__container">
            <div class="login__container">

                <div class="login__img">
                    <img src="{{ asset('static/imagenes/mascota_ittg.png') }}" alt="" id="img1">
                    <div id="img2">
                        <img src="{{ asset('static/imagenes/ittg_escudo.svg') }}" alt="" id="">
                    </div>
                </div>
                <div class="login__form">

                    <form action="/log-in" method="POST">
                        @csrf
                        <div class="login__form_name">
                            <input class="name" type="text" name="email" id="num_control"
                                value="{{ old('email') }}">
                            <label for="" class="lbl_name">Correo electrónico</label>
                        </div>
                        <div class="login__form_password">
                            <input class="password" type="password" name="password" id="password"
                                value="{{ old('password') }}">
                            <label for="" class="lbl_contraseña">Contraseña</label>
                        </div>
                        <input class="login__form_btn" type="submit" value="Iniciar">
                    </form>
                    <div class="login__links">
                        <a href="/sign-up">Registrate aquí</a>
                        <label></label>
                        <a style="text-decoration: underline; cursor: pointer;" id="resetPassword">¿Olvidó su
                            contraseña?</a>
                    </div>
                </div>
            </div>
    </section>
    <style>
        .resetPassword {
            width: 100vw;
            height: 100vh;
            transform: scale(0);
            opacity: 0;
            display: flex;
            transition-property: all;
            transition-duration: 700ms;
            transition-delay: 100ms;
        }

        .resetPasswordShow {
            position: relative;
            backdrop-filter: blur(1.5px);
            display: flex;
            transform: scale(1);
            opacity: 1;
            background: rgba(0, 0, 0, 0.301);

        }

        .resetPassword-container {
            margin: auto;
            width: 300px;
            min-width: 200px;
            background: rgb(255, 255, 255);
            padding: 10px;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
        }

        .resetPassword-form {
            display: flex;
            flex-direction: column;
            position: relative;

        }

        #email,
        #newPassword {
            padding: 4px;
            margin: 5px 2px;
            border: 0;
            border-bottom: 1px solid;
        }

        .closeWindow {
            font-size: 25px;
            cursor: pointer;
            width: min-content;
            align-self: end;
        }

    </style>
    <section>
        <div class="resetPassword" id="resetPassword-container">
            <div class="resetPassword-container" id="con">
                <i class="fas fa-times-circle closeWindow" id="close"></i>
                <i class="fas fa-lock" style="font-size:50px; text-align:center "></i>
                <h2>Recuperar contraseña</h2>
                <form class="resetPassword-form" id="updatePassword" method="POST">
                    @csrf
                    <label for="email">Correo electronico</label>
                    <input type="email" name="email" id="email" placeholder="ejemplo@email.com">
                    <label for="" id="vericaCorreo"></label>
                    <label for="resetPassword">Contraseña nueva</label>
                    <input type="password" name="resetPassword" id="newPassword" placeholder="************">
                    <button type="submit" class="login__form_btn" style="height: 30px">Enviar</button>
                </form>
            </div>
        </div>

    </section>
    <script>
        let name = document.getElementById("num_control");
        let password = document.getElementById("password");
        let resetPassword = document.getElementById('resetPassword');
        let rpContainer = document.getElementById('resetPassword-container');
        let btnClose = document.getElementById('close')
        let btnSave = document.getElementById('updatePassword')
        window.addEventListener('load', function() {
            if (name.value != "") {
                name.nextElementSibling.classList.add("fijar");
                name.classList.add('bordes');
            }
            if (password.value != "") {
                password.classList.add('bordes');
                password.nextElementSibling.classList.add("fijar");
            }
        });
        name.addEventListener("keyup", function() {
            if (name.value.length >= 1) {
                console.log
                name.classList.add('bordes');
                name.nextElementSibling.classList.add("fijar");
            } else {
                name.classList.remove('bordes');
                name.nextElementSibling.classList.remove("fijar");
            }
        });
        password.addEventListener("keyup", function() {
            if (password.value.length >= 1) {
                password.classList.add('bordes');
                password.nextElementSibling.classList.add("fijar");
            } else {
                password.classList.remove('bordes');
                password.nextElementSibling.classList.remove("fijar");
            }
        });

        resetPassword.addEventListener('click', function() {
            rpContainer.style.opacity = '1'
            rpContainer.classList.add('resetPasswordShow');

        });
        btnClose.addEventListener('click', function() {
            rpContainer.classList.remove('resetPasswordShow');

        });
        btnSave.addEventListener('submit', function(event) {
            console.log(1)
            let email = document.getElementById('email').value
            let newPassword = document.getElementById('newPassword').value
            let _token = document.querySelector('input[name="_token"]').value
            $.ajax({
                url: '/resetPassword',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    email: email,
                    newPassword: newPassword,
                }
            }).done(function(res) {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'info',
                    title: res,
                    showConfirmButton: false,
                    timer: 1500
                })
                email.value = ""
                newPassword.value = ""
            });
            event.preventDefault();
        });
    </script>
</body>

</html>
