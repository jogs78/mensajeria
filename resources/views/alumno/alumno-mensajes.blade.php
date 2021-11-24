<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('static/css/dashboard_style.css') }}">

    <link rel="stylesheet" href="{{ asset('static/css/alumno_mensajes_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">
    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery.zoom.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@300&display=swap" rel="stylesheet">
    <title>Bienvenido</title>
</head>

<body>
    
        <header class="header">
            <div class="header_container">

                <nav class="nav1">
                    <i class="fas fa-bars" id="navigation_btn"></i>
                    <div class="menu-container" id="menu">

                        <div class="menu-content">
                            <div class="menu-content" id="personalInformation" tabindex="100">
                                <i class="fas fa-chevron-left" id="btnback" style="font-size:22px;"></i>
                                <center>
                                    <figure class="img1">
                                        <img class="imgP" src="{{ Auth::user()->foto_perfil }}"
                                            id="imgProfileNew" alt="">
                                    </figure>
                                </center>
                                <form id="actualizarInfo" action="/alumno/{{ Auth::user()->id }}"
                                    style="display: flex; flex-direction:column;" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="container-input">
                                        <input type="file" name="file-1" id="userP" class="inputfile inputfile-1"
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
                                    <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Correo
                                        electrónico:</label>
                                    <div style="text-align: center;">
                                        <input class="input" id="correo" type="text" name="correo"
                                            value="{{ Auth::user()->correo }}" disabled><i class="edit fas fa-edit"
                                            style="font-size: 20px;"></i>
                                    </div>
                                    <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Nueva
                                        contraseña:</label>
                                    <div style="text-align: center;">
                                        <input class="input" id="password" type="password" name="password"
                                            disabled><i class="edit fas fa-edit" style="font-size: 20px;"></i>
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
                                
                                <li class="menu-list__item fas fa-envelope-open"> <a id="home" class="text"
                                        href="/mensajes-alumnos">Mis mensajes </a></li>
                                <li class="menu-list__item fas fa-envelope"> <a id="home" class="text"
                                            href="/mensajes-alumnos?mensajes_nuevos=true">Mensajes nuevos
                                            @if (count(Auth::user()->unreadNotifications) >0)
                                            <span id="notificationMarker"></span>
                                            @endif</a></li>
                                <li class="menu-list__item fas fa-sign-out-alt"> <a id="home" class="text"
                                        href="/log-out">Salir </a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @yield('mensajes-viejos')
        @yield('mensajes-nuevos')
        <script src="{{ asset('static/js/dashboard.js') }}"></script>
        <script>
            let btnVerMas = document.getElementsByClassName('ver-mas');
            let btnClose = document.getElementById('btnClose');
            let contendor = document.getElementById('contenedor');

            let imageContainer = document.getElementById('imageContainer');
            let image = document.getElementById('image')
            let title = document.getElementById('title')
            let description = document.getElementById('description')
            let fechaPublicacion = document.getElementById('fechaPublicacion')
            let emisor = document.getElementById('emisor')
            let documento = document.getElementById('documento')

            for (let i = 0; i < btnVerMas.length; i++) {
                btnVerMas[i].addEventListener('click', function() {
                    contendor.style.display = 'block'
                    consultarMensaje(btnVerMas[i].dataset.mensaje, btnVerMas[i].dataset.notificacion)
                });
            }
            btnClose.addEventListener('click', function() {
                contendor.style.display = 'none';
                $('#imageContainer').trigger('zoom.destroy');
                imageContainer.classList.remove('cambiarMedida')
                imageContainer.classList.remove('cambiarMedida1')
                image.setAttribute('src', "")

            })

            function consultarMensaje(id, id_notification) {
                $.ajax({
                    url: '/ver-mensaje/' + id+"?id_notification="+id_notification,
                    method: 'GET',
                    
                    contentType: false,
                    cache: false,
                    processData: false,
                }).done(function(res) {
                    image.setAttribute('src', res.imagen)
                    title.innerHTML = "<b>Título: <b>" + res.titulo
                    description.innerHTML = "<b>Descripción: <b>" + res.descripcion
                    fechaPublicacion.innerHTML = "<b>Fecha de publicacion: </b>"
                    emisor.innerHTML = "<b>Publicado por: <b>" + res.empleado.puesto
                    if (image.naturalHeight == 1280 & image.naturalWidth == 720) {
                        imageContainer.classList.add('cambiarMedida')
                        imageContainer.classList.remove('cambiarMedida1')
                        image.style.width = "50%"
                    } else if (image.naturalHeight == 500 & image.naturalWidth == 1500) {
                        imageContainer.classList.remove('cambiarMedida')
                        imageContainer.classList.add('cambiarMedida1')
                        image.style.width = "80%"
                    }
                    $('#imageContainer').zoom({
                        url: image.getAttribute('src')
                    });
                });
            }
        </script>
    

</body>

</html>
