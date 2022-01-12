<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="user-id" content="{{ Auth::user()->id }}">

    <link rel="stylesheet" href="{{ asset('static/css/dashboard_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/mensaje_list_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/user_register_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/alumno_mensajes_style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/css/all.css') }}">
    <script src="{{ asset('static/js/offline.js') }}"></script>
    <script src="{{ asset('static/css/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('static/jquery/jquery.zoom.min.js') }}"></script>

    @laravelPWA

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@300&display=swap" rel="stylesheet">
    <title>Bienvenido</title>
</head>



<body>
    <style>
        .loader_container {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-color: var(--main-bg-color);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 700ms ease-in-out;
        }

        .loader {
            height: 250px;
            display: flex;
            align-items: center;
        }

        .line {
            width: 6px;
            height: 95px;
            background-color: white;
            margin: 0 7px;
            border-radius: 4px;
            animation: line_loader 800ms infinite normal forwards;
        }

        .line:nth-child(1) {
            background-color: rgb(255, 251, 0);
            box-shadow: 0px 0.5px 5px rgb(255 251 0);
        }

        .line:nth-child(2) {
            animation-delay: 100ms;
            background-color: rgb(17, 0, 250);
            box-shadow: 0px 0.5px 5px rgb(17, 0, 250);
        }

        .line:nth-child(3) {
            animation-delay: 200ms;
            background-color: rgb(255, 255, 255);
            box-shadow: 0px 0.5px 5px rgb(255, 255, 255);
        }

        .line:nth-child(4) {
            animation-delay: 300ms;
            background-color: rgb(255, 0, 255);
            box-shadow: 0px 0.5px 5px rgb(255, 0, 255);
        }

        .line:nth-child(5) {
            animation-delay: 400ms;
            background-color: rgb(250, 0, 62);
            box-shadow: 0px 0.5px 5px rgb(250, 0, 62);
        }

        .line:nth-child(6) {
            animation-delay: 500ms;
            background-color: rgb(247, 70, 0);
            box-shadow: 0px 0.5px 5px rgb(247, 70, 0);
        }

        .line:nth-child(7) {
            animation-delay: 600ms;
            background-color: rgb(0, 149, 248);
            box-shadow: 0px 0.5px 5px rgb(0, 149, 248);
        }

        .line:nth-child(8) {
            animation-delay: 700ms;
            background-color: rgb(0, 140, 255);
            box-shadow: 0px 0.5px 5px rgb(0, 140, 255);
        }


        @keyframes line_loader {
            0% {
                height: 0;
            }

            50% {
                height: 95%;
            }

            100% {
                height: 0%;
            }
        }

    </style>
    <div class="loader_container">
        <div class="loader">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function() {
            const loader_container = this.document.querySelector('.loader_container')
            setTimeout(() => {
                loader_container.style.opacity = 0
                loader_container.style.visibility = 'hidden'
            }, 500);

        })
    </script>
    <header class="header">
        <div class="header_container">
            <nav class="nav1">
                <i class="fas fa-bars" id="navigation_btn"></i>
                <div class="menu-container" id="menu">

                    <div class="menu-content" id="menuContainer">
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
                                <label style="color: white;font-weight: bold;padding: 0 5px;" for="">Semestre
                                    actual:</label>
                                <select name="semestre" id="" style="width: 80%;
                                margin: auto;">
                                    <option value="{{ Auth::user()->semestre_id }}">
                                        {{ Auth::user()->semestre->semestre }}</option>
                                    @foreach ($semestres as $semestre)
                                        <option value="{{ $semestre->id }}">{{ $semestre->semestre }}</option>
                                    @endforeach
                                </select>

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

                            <li class="menu-list__item fas fa-envelope-open"> <a id="home" class="text"
                                    href="/mensajes-alumnos">Mis mensajes </a></li>
                            <li class="menu-list__item fas fa-envelope"> <a id="home" class="text"
                                    href="/mensajes-alumnos?mensajes_nuevos=true">Mensajes nuevos
                                    @if (count(Auth::user()->unreadNotifications) > 0)
                                        <span id="notificationMarker"></span>
                                    @endif
                                </a></li>

                            @if (Auth::user()->semestre_id == 7 || Auth::user()->semestre_id == 8)
                                <li class="menu-list__item fas fa-exclamation-circle " id="" style="cursor: pointer"
                                    title="Marca alguna de las casillas si deseas recibir mensajes relacionados con algunas las siguientes opciones">
                                    Desea recibir mensajes de:
                                    <div style="margin-left: 10%;">
                                        @if (Auth::user()->segmentacion == 1)
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="0" checked> Servicio
                                                social</span>
                                            </label>
                                        @else
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="1"> Servicio
                                                social</span>
                                            </label>

                                        @endif

                                    </div>
                                </li>
                            @elseif (Auth::user()->semestre_id == 9)
                                <li class="menu-list__item fas fa-exclamation-circle " id="" style="cursor: pointer"
                                    title="Marca alguna de las casillas si deseas recibir mensajes relacionados con algunas las siguientes opciones">
                                    Desea recibir mensajes de:
                                    <div style="margin-left: 10%;">
                                        @if (Auth::user()->segmentacion == 1)
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="1" checked> Servicio
                                                social</span>

                                            </label>
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="residencia"
                                                    id="residencia" value="0">
                                                Residencia
                                            </label>

                                        @elseif (Auth::user()->segmentacion == 2)
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="0"> Servicio
                                                social</span>

                                            </label>
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="residencia"
                                                    id="residencia" value="1" checked>
                                                Residencia
                                            </label>
                                        @elseif (Auth::user()->segmentacion == 3)
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="0" checked> Servicio
                                                social</span>
                                            </label>
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="residencia"
                                                    id="residencia" value="1" checked>
                                                Residencia
                                            </label>
                                        @else
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="servicio"
                                                    id="servicio_social" value="0"> Servicio
                                                social</span>
                                            </label>
                                            <label style="cursor: pointer">
                                                <input class="servicioResidencia" type="checkbox" name="residencia"
                                                    id="residencia" value="1">
                                                Residencia
                                            </label>
                                        @endif

                                    </div>
                                </li>
                            @endif

                            <li class="menu-list__item fas fa-bell " id="notificaciones" style="cursor: pointer">
                                <span class="text">Activar notificaciones</span>
                            </li>
                            <li class="menu-list__item fas fa-sign-out-alt"> <a id="home" class="text"
                                    href="/log-out">Salir </a></li>

                        </ul>

                        <div>

                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @yield('mensajes-viejos')
    @yield('mensajes-nuevos')
    @yield('content')

    <script src="{{ asset('static/js/dashboard.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('static/js/offline.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript">
        var id = document.querySelector("meta[name='user-id']").getAttribute('content');
        let servicioResidencia = document.getElementsByClassName('servicioResidencia')

        //estadoServicioResidencia recibe un parametro que corresponde a: 1 para servicio, 2 for residencia, 3 para ambos y 0 para ninguno
        //estadoServicioResidencia(1);

        if (servicioResidencia.length === 1) {
            servicioResidencia[0].addEventListener('change', function() {
                if (servicioResidencia[0].checked) {
                    console.log('ha seleccionado solo servicio')
                    estadoServicioResidencia(1)
                } else {
                    console.log('sin segmento')
                    estadoServicioResidencia(0)
                }
            })
        } else if (servicioResidencia.length === 2) {
            for (let i = 0; i < 2; i++) {
                servicioResidencia[i].addEventListener('change', function() {
                    if (servicioResidencia[0].checked & servicioResidencia[1].checked) {
                        console.log('Servicio social y residencia seleccionado')
                        estadoServicioResidencia(3)
                    } else {
                        //console.log('no seleccionado Servicio social y residencia')
                        if (servicioResidencia[0].checked) {
                            console.log('ha seleccionado solo servicio')
                            estadoServicioResidencia(1)
                        } else {
                            //console.log('servicio social no seleccionado')
                            if (servicioResidencia[1].checked) {
                                console.log('ha seleccionado solo residencia')
                                estadoServicioResidencia(2)
                            } else {
                                console.log('residencia y servicio no seleccionada')
                                estadoServicioResidencia(4)
                            }
                        }

                    }
                })
            }
        }



        function estadoServicioResidencia(estado) {
            $.ajax({
                url: '/segmentacion/' + id,
                method: 'GET',
                data: {
                    estado: estado,
                }
            }).done(function(res) {
                // alert(res);
            })
        }
        let notificacionBtn = document.getElementById('notificaciones')
        notificacionBtn.addEventListener('click', function() {
            if (!window.Notification) {
                console.log('este navegador no soporta');
                return;
            }
            if (Notification.permission == 'granted') {


            } else if (Notification.permission != 'denied' || Notification.permission == 'default') {

                Notification.requestPermission(function(permission) {
                    
                    console.log(permission);
                    if (permission == 'granted') {

                        let mensajeTitle = "";
                    Echo.private('App.Models.Alumno.' + id)
                        .notification((notification) => {
                            mensajeTitle = notification.title
                            notifica(mensajeTitle)
                        });
                    Echo.channelprivate('App.Models.Alumno.' + id)
                        .listen('MensajeEvent', (e) => {
                            console.log(e);
                        });
                    }
                });

            }



            
        })

        function notifica(mensajeTitle) {
            const options = {
                body: mensajeTitle,
                icon: './static/imagenes/ittg_escudo.png',
            };
            swRegistration.showNotification('Mensajería ITTG', options);
        }
    </script>
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
                contendor.style.opacity = 1
                contendor.style.left = "0";
                consultarMensaje(btnVerMas[i].dataset.mensaje, btnVerMas[i].dataset.notificacion)
            });
        }
        btnClose.addEventListener('click', function() {
            $('#imageContainer').trigger('zoom.destroy');
            imageContainer.classList.remove('cambiarMedida')
            imageContainer.classList.remove('cambiarMedida1')
            image.removeAttribute('src')
            contendor.style.opacity = 0;
            contendor.style.left = "-200%";

        })


        function consultarMensaje(id, id_notification) {
            $.ajax({
                url: '/ver-mensaje/' + id + "?id_notification=" + id_notification,
                method: 'GET',

                contentType: false,
                cache: false,
                processData: false,
            }).done(function(res) {
                image.setAttribute('src', res.imagen)
                title.innerHTML = "<b>Título: </b>" + res.titulo
                description.innerHTML = "<b>Descripción: </b>" + res.descripcion
                fechaPublicacion.innerHTML = "<b>Fecha de publicacion: </b>" + res.fecha_publicacion
                emisor.innerHTML = "<b>Publicado por: </b>" + res.empleado.puesto
                documento.setAttribute('href', res.documento)
                $('#imageContainer').zoom({
                    url: image.getAttribute('src')
                });
            });
        }
    </script>


</body>

</html>
