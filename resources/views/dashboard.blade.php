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
    <script src="https://kit.fontawesome.com/d0d3bb1623.js" crossorigin="anonymous"></script>
    <title>Bienvenido</title>
</head>

<body>
    <header class="header">
        <div class="header_container">
            <nav class="navigation">
                <div class="navigation_icon" id="navigation_btn">
                    <i class="fas fa-ellipsis-v"></i>
                </div>
                <div class="navigation_container" id="menu">
                    <ul>
                        <li><a href="">opc1</a></li>
                        <li><a href="">opc1</a></li>
                        <li><a href="">opc1</a></li>
                        <li><a href="">opc1</a></li>
                        <li><a href="">opc1</a></li>
                    </ul>
                </div>
            </nav>
        </div>

    </header>
    @yield('emisor.mensaje-list')
    @yield('emisor.mensaje-create')
    @yield('informatico.user-register')
    @yield('user-list')
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
