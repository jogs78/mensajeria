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
    <link rel="stylesheet" href="{{ asset('static/glider/glider.min.css') }}">
    <script src="{{ asset('static/glider/glider.min.js') }}"></script>

    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <title>Bienvenido</title>
</head>

<body>
    <header class="header">
        <div class="header_container">
            <div class="account_cotainer">
                <div class="image-profile_container">
                    <img src="{{ Auth::user()->foto_perfil }}" alt="">
                    <span>{{ Auth::user()->nombre }}</span>
                    <span>{{ Auth::user()->rol }}</span>
                </div>
                <i class="fas fa-caret-down" id="menu2"></i>
                <div class="menu2-container" id="menu2-container">
                    <ul id="menu2-list">
                        <li>Actualizar datos</li>
                        <li class="fas fa-sign-out-alt"><a href="/log-out">Salir</a></li>
                    </ul>
                </div>
            </div>
            <nav class="nav1">
                <i class="fas fa-bars" id="navigation_btn"></i>
                <div class="menu-container" id="menu">
                    <div class="menu-content">
                        <ul class="menu-list">
                            <a id="home" class="menu-list__item fas fa-home home_selected" href="/inicio">
                                <li class="text">Inicio</li>
                            </a>
                            @can('view', App\Models\Empleado::class)
                                <a id="users" class="menu-list__item fas fa-user user_selected" href="/user">
                                    <li class="text">Usuarios</li>
                                </a>
                            @endcan
                            @can('viewMensajes', App\Models\Mensaje::class)
                                <a id="mensajes" class="menu-list__item fas fa-envelope message_selected" href="/mensajes">
                                    <li class="text">Mensajes</li>
                                </a>
                            @endcan


                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    @if (Auth::user()->rol == 'Emisor'|| Auth::user()->rol == 'Revisor')
        @include('emisor-revisor.dashboard-emisor_revisor')
    @elseif (Auth::user()->rol == "Difusor")
        @include('difusor.dashboard-difusor')
        <script>
            window.addEventListener("load", function() {
                let mensajesTotal = document.getElementById('lblMensajesTotal');
                let alumnosTotal = document.getElementById('lbl1alumnosTotal');
                let mensajesByCarreras = document.getElementById('mensajesByCarreras');
                let newLi = []
                $.ajax({
                url: '/panel-difusor',
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                
            }).done(function(res){
                mensajesTotal.innerHTML = "Mensajes totales: "+res.mensajesTotales
                alumnosTotal.innerHTML = "Alumnos registrados: "+res.alumnosTotales
                console.log('Publicaciones por carrera:')
                for(let i= 0; i<res.carreras.length; i++){
                    newLi[i]= document.createElement('li');
                    newLi[i].innerHTML = res.carreras[i].name+": "+res.MensajesByCarrera[i]
                    mensajesByCarreras.appendChild(newLi[i])  
                    //console.log(res.carreras[i].name+": "+res.MensajesByCarrera[i])
                }
                
            });
                
         });
        </script>
    @elseif (Auth::user()->rol == "Informático")
        @include('informatico.dashboard-informatico')
        <script src="{{ asset('static/js/informatico.js') }}"></script>

    @endif
    @yield('mensaje.mensaje-list')
    @yield('mensaje.mensaje-create')
    @yield('mensaje.mensaje-edit')
    @yield('mensaje.mensaje-show')
    @yield('informatico.user-register')
    @yield('informatico.user-list')
    @yield('informatico.user-edit')

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
            menu2.classList.toggle('showMenu2');
        });
    </script>
</body>

</html>
