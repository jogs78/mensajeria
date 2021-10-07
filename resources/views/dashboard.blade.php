<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/dashboard_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_list.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_create.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_register_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_list_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_edit_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css')}}">
    <script src="{{asset('static/css/sweetalert/sweetalert2.all.min.js')}}"></script>
    <title>Bienvenido</title>
</head>

<body>
    <header class="header">
        <div class="header_container">
            <nav class="nav">
                <i class="fas fa-bars" id="navigation_btn"></i>
                <div class="menu-container" id="menu">
                    <div class="menu-content">
                        <ul class="menu-list">
                            <li class="fas fa-home menu-list__item"><a class="text" href="">Inicio</a></li>
                            <li class="fas fa-user menu-list__item"><a class="text" href="/user">Usuarios</a></li>
                            <li class="fas fa-envelope menu-list__item"><a class="text" href="/mensajes-emisor">Mensajes</a></li>
                            <li class="fas fa-home menu-list__item"><a class="text">Inicio</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    

    </header>
    @yield('emisor.mensaje-list')
    @yield('emisor.mensaje-create')
    @yield('emisor.mensaje-edit')
    @yield('informatico.user-register')
    @yield('user-list')
    @yield('user-edit')
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
