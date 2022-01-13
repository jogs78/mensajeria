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

    
    

    <link rel="manifest" href="{{ route('laravelpwa.manifest') }}">
    <script src="{{ asset('static/glider/glider.min.js') }}"></script>
    
    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/jquery/jquery-ui.css') }}">
    <title>Bienvenido</title>
</head>

<body>
    <header class="header">
        <div class="header_container">
            <nav class="nav1">
                <i class="fas fa-bars" id="navigation_btn"></i>
                <div class="menu-container" id="menu">

                    <div class="menu-content" id="menuContainer">
                        <div class="menu-content" id="personalInformation">
                            <i class="fas fa-chevron-left" id="btnback" style="font-size:22px;"></i>
                            <center>
                                <figure class="img1">
                                    <img class="imgP" src="{{ Auth::user()->foto_perfil }}"
                                        id="imgProfileNew" title="foto">
                                </figure>
                            </center>
                            <form id="actualizarInfo" action="/empleado/{{ Auth::user()->id }}"
                                style="display: flex; flex-direction:column;" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="container-input">
                                    <input type="file" name="imagProfile" id="userP" class="inputfile inputfile-1"
                                        accept="image/*">
                                    <label for="userP">
                                        <span class="iborrainputfile fas fa-upload"> Actualizar foto</span>
                                    </label>

                                </div>

                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Nombre:</label>
                                <div style="text-align: center;">
                                    <input class="input" id="nombre" type="text" name="nombre"
                                        value="{{ Auth::user()->nombre }}" disabled><i class="edit fas fa-edit"
                                        style="font-size: 20px;"></i>
                                </div>
                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Apellido
                                    paterno:</label>
                                <div style="text-align: center;">
                                    <input class="input" id="a_paterno" type="text" name="a_paterno"
                                        value="{{ Auth::user()->apellido_paterno }}" disabled><i
                                        class="edit fas fa-edit" style="font-size: 20px;"></i>
                                </div>
                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Apellido
                                    materno:</label>
                                <div style="text-align: center;">
                                    <input class="input" id="a_materno" type="text" name="a_materno"
                                        value="{{ Auth::user()->apellido_materno }}" disabled><i
                                        class="edit fas fa-edit" style="font-size: 20px;"></i>
                                </div>
                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Contraseña
                                    actual:</label>
                                <div style="text-align: center;position: relative">
                                    <input class="input" id="passwordActual" type="password"
                                        name="passwordActual" disabled><i class="edit fas fa-edit"
                                        style="font-size: 20px;"></i>
                                    <i style="position: absolute;top:0;right: 48px;padding: 5px;font-size: 1.5rem;color:black"
                                        id="vp" class="show-pass fas fa-eye"></i>

                                </div>
                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Nueva
                                    contraseña:</label>
                                <div style="text-align: center; position: relative">
                                    <input class="input" id="password" type="password" name="password"
                                        disabled><i class="edit fas fa-edit" style="font-size: 20px;"></i>
                                    <i style="position: absolute;top:0;right: 48px;padding: 5px;font-size: 1.5rem;color:black"
                                        id="vp2" class="show-pass fas fa-eye"></i>

                                </div>
                                <button id="btnA">Guardar</button>
                            </form>
                        </div>
                        <div class="image-profile_container">
                            <center>
                                <figure class="img1">
                                    <img class="imgP" id="imgProfile" src="{{ Auth::user()->foto_perfil }}"
                                        alt="">
                                </figure>
                            </center>
                            <label
                                id="userName">{{ Auth::user()->nombre . ' ' . Auth::user()->apellido_paterno . ' ' . Auth::user()->apellido_materno }}</label>
                            <label>{{ Auth::user()->rol }}</label>
                            <label class="btnF" id="btnShow">Actualizar mis datos</label>
                        </div>

                        <ul class="menu-list">
                            <li class="menu-list__item fas fa-home"> <a id="home" class="text"
                                    href="/inicio">Inicio </a></li>
                            @can('view', App\Models\Empleado::class)
                                <li class="menu-list__item fas fa-user"><a id="users" class="text"
                                        href="/user">Usuarios</a></li>
                            @endcan
                            @can('viewMensajes', App\Models\Mensaje::class)
                                <li class="menu-list__item fas fa-envelope"><a id="mensajes" class="text"
                                        href="/mensajes">Mensajes</a></li>

                            @endcan
                            @if (Auth::user()->rol == 'Informático')
                            @if (session('message'))
                            <script>
                                setTimeout(() => {
                                    Swal.fire({
                toast: true,
                position: 'top-left',
                icon: 'info',
                title: "Tarea realizada",
                showConfirmButton: false,
                timer: 3000
            })
                                }, 1000);
                            </script>
                            @endif
                                <li class="menu-list__item fas fa-server"> <a id="home" class="text"
                                        href="/sockets/serve/activated">Iniciar servidor </a></li>
                                <li class="menu-list__item fas fa-server"> <a id="home" class="text"
                                            href="/sockets/serve/restart">Reiniciar servidor </a></li>
                                <li class="menu-list__item fas fa-hdd"> <a id="home" class="text"
                                        href="/Storage-link">Activar almacenamiento </a></li>
                            @endif
                            <li class="menu-list__item fas fa-sign-out-alt"> <a id="home" class="text"
                                    href="/log-out">Salir </a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    @if (Auth::user()->rol == 'Emisor' || Auth::user()->rol == 'Revisor')
        @include('emisor-revisor.dashboard-emisor_revisor')
    @elseif (Auth::user()->rol == 'Difusor')
        @include('difusor.dashboard-difusor')
        <script src="{{ asset('static/js/difusor.js') }}"></script>
    @elseif (Auth::user()->rol == 'Informático')
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
    @yield('difusor.ver-estadisticas')
    <script src="{{ asset('static/js/offline.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   

    <script src="{{ asset('static/js/dashboard.js') }}"></script>
</body>

</html>
