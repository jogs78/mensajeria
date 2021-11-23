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
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery.zoom.min.js') }}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@300&display=swap" rel="stylesheet">
    <title>Bienvenido</title>
</head>

<body>
    @guest
        Inicia session para continuar
    @else
        <style>
            .container-input {
                background: var(--main-bg-color);
                width: max-content;
                padding: 3px;
                margin-top: 10px;
            }

            .inputfile {
                display: none;
                overflow: hidden;
                position: absolute;
                z-index: -1;
            }

            .inputfile+label {
                max-width: 100%;
                font-size: 1.25rem;
                font-weight: 700;
                white-space: nowrap;
                cursor: pointer;
                display: inline-block;
                padding: 6px;
                border-radius: 6px;
            }

            .inputfile+label svg {
                width: 1em;
                height: 1em;
                vertical-align: middle;
                fill: currentColor;
                margin-top: -0.25em;
                margin-right: 0.25em;
            }

            .iborrainputfile {
                font-size: 16px;

            }

            .inputfile-1+label {
                color: #fff;
                width: 100%;
            }

            .inputfile-1:focus+label,
            .inputfile-1.has-focus+label,
            .inputfile-1+label:hover {
                background-color: #006efd;
            }

        </style>
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
                                <li class="menu-list__item fas fa-home"> <a id="home" class="text" href="">Inicio
                                    </a></li>
                                <li class="menu-list__item fas fa-sign-out-alt"> <a id="home" class="text"
                                        href="/log-out">Salir </a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <style>
            section {
                position: relative;
                top: 42px;
            }

            dl {
                margin: 5px 15px;
                font-size: 20px;
            }

            dt {
                font-family: 'Zilla Slab', serif;
                font-weight: 800;
                padding: 2px;
                margin-left: 31px;

            }

            .contenedor::before {
                margin: 2px 0 0 2px;
                position: absolute;
                content: counter(my-awesome-counter);
                color: red;
                font-weight: 800;
                font-size: 30px;
                top: 0;
                left: 0;
                border-radius: 50%;
                width: 35px;
                height: 35px;
                text-align: center;
                box-shadow: rgba(50, 50, 105, 0.15) 0px 2px 5px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1px 0px;
            }

            dd {
                font-family: 'Zilla Slab', serif;
                margin-top: 3px;

            }

            .ver-mas {
                width: max-content;
                padding: 5px;
                background: #0d47a1;
                color: white;
                border-radius: 15px;
                font-size: 18px;
                font-weight: 100;
                cursor: pointer;
                box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
            }

            .contenedor {
                position: relative;
                counter-increment: my-awesome-counter;
                padding: 5px;
                border-radius: 10px;
                margin-bottom: 15px;
                box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            }

            .mensaje-container {
                display: none;
                background: #00000052;
                width: 100%;
                height: 100vh;
                position: absolute;
                z-index: 100;
                top: -5px;
                overflow: auto;
            }

            #btnClose {
                font-size: 23px;
                float: right;
                padding: 1px;
                margin: 5px;
                border-radius: 50%;
                border: 1px solid rgb(255, 255, 255);
                background: rgb(255, 255, 255);
                height: min-content;
                position: absolute;
                right: 0;
                top: 0;
                z-index: 10;
            }

            .mensaje-informacion {
                width: min-content;
                flex-grow: 1;
                display: flex;
                flex-wrap: wrap;
                gap: 5px
            }

            .mensaje-informacion p,
            .mensaje-informacion label {
                flex-grow: 1;
                padding: 3px;
            }

            .mensaje_body {
                background: rgb(255, 255, 255);
                padding: 5px;
                margin: 11px;
                display: flex;
                flex-wrap: wrap;
                width: 98%;
                margin: auto;
                margin-top: 10px;
                text-align: justify;
                font-family: 'Zilla Slab', serif;
            }

            .figure {
                height: max-content;
                border-radius: 15px;
                overflow: hidden;
                text-align: center;
            }

            #image {
                object-fit: scale-down;
                object-position: center;
                position: relative;
                margin: auto
            }



            .cambiarMedida {
                width: 100%;
            }

            .cambiarMedida1 {
                width: 100%;
            }

            #title,
            #descripcion,
            #fechaPublicacion {
                width: 100%;
            }

            @media screen and (min-width:650px) {

                .cambiarMedida {
                    width: 50%;
                }

                #btnClose {
                    font-size: 30px;

                }
            }

        </style>
        <section class="lista-mensajes">
            <dl>
                @foreach ($mensajes as $mensaje)
                    <div class="contenedor">
                        <dt>
                            <p style="text-align: justify">Título: {{ $mensaje->titulo }}</p>
                        </dt>
                        <dd><b>Fecha de publicacion:</b> este es el titulo del mensaje</dd>
                        <dd title="ver mas" class="ver-mas" data-mensaje="{{ $mensaje->id }}"><b>ver más </b><i
                                class="fas fa-plus-circle"></i></dd>
                    </div>
                @endforeach
            </dl>
            {{-- aqui se muestra la ventana emergente con la info del mensaje --}}

            <div class="mensaje-container" id="contenedor">
                <div class="mensaje_body">
                    <i class="fas fa-times-circle" id="btnClose"></i>
                    <figure class="figure image-container" id="imageContainer">
                        <img id="image" class="image-zoom" src="" alt="">
                    </figure>
                    <div class="mensaje-informacion">
                        <p id="title">Titulo:</p>
                        <p id="description">Descipcion:</p>
                        <label id="fechaPublicacion" for=""><small><b>Fecha de publicacion:</b></small></label>
                        <label id="emisor" for=""><small><b>Publicado por: aqui el dep al que pertenece el
                                    emisor</b></small></label>
                        <label id="" for=""></label>
                        <label id="documento" for="">Descargar pdf</label>
                    </div>
                </div>
            </div>
        </section>
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
                    consultarMensaje(btnVerMas[i].dataset.mensaje)
                });
            }
            btnClose.addEventListener('click', function() {
                contendor.style.display = 'none';
                $('#imageContainer').trigger('zoom.destroy');
                imageContainer.classList.remove('cambiarMedida')
                imageContainer.classList.remove('cambiarMedida1')
                image.setAttribute('src', "")

            })

            function consultarMensaje(id) {
                $.ajax({
                    url: '/ver-mensaje/' + id,
                    method: 'GET',
                    // data: formData,
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
    @endguest

</body>

</html>
