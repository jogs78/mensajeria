<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/dashboard_style.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/alumno_mensajes_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">

    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <title>Bienvenido</title>
</head>

<body>
    @guest
        Inicia session para continuar
    @else
        {{ Auth::user()->rol }}
        <header class="header">
            <div class="header_container">
                <div class="header_container">
                <div class="account_cotainer">
                    <div class="image-profile_container">
                        <img src="{{ Auth::user()->foto_perfil }}" alt="">
                        <span>{{ Auth::user()->nombre }}</span>
                    </div>
                    <i class="fas fa-caret-down" id="menu2"></i>
                    <div class="menu2-container" id="menu2-container">
                        <ul id="menu2-list">
                            <li>Actualizar datos</li>
                            @if (Auth::user()->rol != '')
                                <li class="fas fa-sign-out-alt"><a href="/admins/log-out">Salir</a></li>
                            @else
                                <li class="fas fa-sign-out-alt"><a href="/log-out">Salir</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <nav class="nav">
                    <i class="fas fa-bars" id="navigation_btn"></i>
                    <div class="menu-container" id="menu">
                        <div class="menu-content">
                            <ul class="menu-list">
                                <a id="home" class="menu-list__item fas fa-home home_selected" href="">
                                    <li class="text">Inicio</li>
                                </a>
                                <a id="alumnos" class="menu-list__item fas fa-globe" href="/mensajes-alumnos">
                                    <li class="text">Para mi</li>
                                </a>
                                <a id="alumnos_general" class="menu-list__item fas fa-globe" href="/mensajes-alumnos">
                                    <li class="text">General</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <section class="alumno-messages">
            <div class="alumno-messages__container">
                <div class="alumno-messages__content">
                    <div class="image_container">
                        <img src="https://www.ttandem.com/media/como-crear-un-calendario-de-publicaciones-en-redes-sociales.jpg"
                            alt="">
                        <i class="fas fa-chevron-circle-down message_btn_down"></i>
                    </div>
                    <div class="alumno-messages__body_container">
                        <label>Título: aqui el titulo de la publicacion</label>
                        <small>Publicado el:<b> aqui va la fecha de publicacion</b></small>
                        <p>Aqui la descripción del mensaje
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis iure nihil eligendi ipsa
                            architecto facilis voluptas quisquam modi atque. Expedita, minus excepturi amet blanditiis
                            quaerat
                            itaque aut quidem sunt laboriosam!
                        </p>
                    </div>
                </div>
            </div>

            <script>
                let message_btn_dow = document.getElementsByClassName('message_btn_down');
                let message_body = document.getElementsByClassName('alumno-messages__body_container')
                let toogle = 0;
                for (let i = 0; i < message_btn_dow.length; i++) {
                    message_btn_dow[i].addEventListener('click', function() {
                        console.log("h")
                        if (toogle == 0) {
                            message_btn_dow[i].classList.add("message_btn_down_rotate");
                            message_body[i].classList.add("alumno-messages__body_container_show");
                            toogle = 1;
                        } else {
                            message_btn_dow[i].classList.remove("message_btn_down_rotate");
                            message_body[i].classList.remove("alumno-messages__body_container_show");
                            toogle = 0;
                        }
                    });

                }
            </script>
        </section>
        <script>
            let btnMenu = document.getElementById("navigation_btn");
            let menu = document.getElementById("menu");
            let btnmenu2 = document.getElementById("menu2");
            let menu2 = document.getElementById("menu2-container")
            btnMenu.addEventListener('click', function() {
                menu.classList.toggle('navigation_show');
                btnMenu.classList.toggle('navigation_alternate_color')
            });
            btnmenu2.addEventListener('click', function() {
                console.log(1)
            
                menu2.classList.toggle('showMenu2');
            });
        </script>
    @endguest

</body>

</html>
