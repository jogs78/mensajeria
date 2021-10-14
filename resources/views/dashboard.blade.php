<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/dashboard_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_list_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_create_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_show_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_edit_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/alumno_mensajes_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_register_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_list_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_edit_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">

    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <title>Bienvenido</title>
</head>

<body>
    {{Auth::user()->nombre}}
        <header class="header">
            <div class="header_container">
                <nav class="nav">
                    <i class="fas fa-bars" id="navigation_btn"></i>
                    <div class="menu-container" id="menu">
                        <div class="menu-content">
                            <ul class="menu-list">
                                <a id="home" class="menu-list__item fas fa-home home_selected" href="">
                                    <li class="text">Inicio</li>
                                </a>
                                <a id="users" class="menu-list__item fas fa-user user_selected" href="/user">
                                    <li class="text">Usuarios</li>
                                </a>
                                <a id="mensajes" class="menu-list__item fas fa-envelope message_selected" href="/mensajes">
                                    <li class="text">Mensajes</li>
                                </a>
                                <a id="alumnos" class="menu-list__item fas fa-globe" href="/alumno">
                                    <li class="text">Para mi</li>
                                </a>
                                <a id="alumnos_general" class="menu-list__item fas fa-globe" href="/alumno">
                                    <li class="text">General</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>


        </header>
        @yield('mensaje.mensaje-list')
        @yield('mensaje.mensaje-create')
        @yield('mensaje.mensaje-edit')
        @yield('mensaje.mensaje-show')
        @yield('informatico.user-register')
        @yield('user-list')
        @yield('informatico.user-edit')
        @yield('alumno-mensajes')
        <script>
            let btnMenu = document.getElementById("navigation_btn");
            let menu = document.getElementById("menu");
            btnMenu.addEventListener('click', function() {
                menu.classList.toggle('navigation_show');
                btnMenu.classList.toggle('navigation_alternate_color')
            });
        </script>

</body>

</html>
