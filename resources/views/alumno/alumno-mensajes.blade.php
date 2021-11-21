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
                            <div class="menu-content" id="personalInformation">
                                <i class="fas fa-chevron-left" id="btnback" style="font-size:22px;"></i>
                                <center>
                                    <figure class="img1">
                                        <img class="imgP" src="{{ Auth::user()->foto_perfil }}" id="imgProfile"
                                            alt="">
                                    </figure>
                                </center>
                                <form id="actualizarInfo" style="display: flex; flex-direction:column;" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{ Auth::user()->id }}" id="idEmpleado">
                                    <div class="container-input">
                                        <input type="file" name="file-1" id="file-1" class="inputfile inputfile-1"
                                            accept="image/*">
                                        <label for="file-1">
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
                                        <img class="imgP" id="imgProfile1"
                                            src="{{ Auth::user()->foto_perfil }}" alt="">
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

        {{-- <section class="alumno-messages">

            <div class="alumno-messages__container">
                @foreach ($mensajes as $mensaje)
                    <div class="alumno-messages__content">
                        <div class="image_container">
                            <img src="{{ asset($mensaje->imagen) }}" alt="">
                            <i class="fas fa-chevron-circle-down message_btn_down"></i>
                        </div>
                        <div class="alumno-messages__body_container">
                            <label>Título: {{ $mensaje->titulo }}</label>
                            <small>Publicado el:<b> aqui va la fecha de publicacion</b></small>
                            <p>{{ $mensaje->descripcion }}
                            </p>
                        </div>
                    </div>
                @endforeach
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
        </section> --}}
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
                top: 0;
            }

            #btnClose {
                font-size: 30px;
                float: right;
                padding: 1px;
                margin: 5px;
                border-radius: 50%;
                border: 1px solid rgb(255, 255, 255);
                background: rgb(255, 255, 255);
            }

            .mensaje_body {
                background: rgb(255, 255, 255);
                padding: 5px;
                margin: 11px;
            }

        </style>
        <section class="lista-mensajes">
            <dl>
                <div class="contenedor">
                    <dt>
                        <p style="text-align: justify">Título: Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Ratione incidunt rerum eos illum repudiandae dolores quia molestiae dolorem totam tempore
                            reiciendis deleniti nobis similique aut quasi, voluptas pariatur iste omnis?</p>
                    </dt>
                    <dd><b>Fecha de publicacion:</b> este es el titulo del mensaje</dd>
                    <dd title="ver mas" class="ver-mas"><b>ver más </b><i class="fas fa-plus-circle"></i></dd>
                </div>
            </dl>
            <div class="mensaje-container" id="contenedor">
                <div class="mensaje_body">
                    <i class="fas fa-times-circle" id="btnClose"></i>
                    <figure id="mensaje-img">
                        <img src="" alt="">
                    </figure>
                    <div class="mensaje-informacion">
                        <p>Titulo:</p>
                        <p>Descipcion:</p>
                        <label for=""><small><b>Fecha de publicacion:</b></small></label>
                        <label for=""><small><b>Publicado por: aqui el dep al que pertenece el emisor</b></small></label>
                        <label for=""></label>
                        <label for="">Descargar pdf</label>
                    </div>
                </div>
            </div>
        </section>
        <script>
            let btnMenu = document.getElementById("navigation_btn");
            let menu = document.getElementById("menu");
            let personalInformation = document.getElementById('personalInformation')
            let btnShow = document.getElementById('btnShow');
            let btnBack = document.getElementById('btnback')
            let btnEdit = document.getElementsByClassName('edit');
            let inputInfo = document.getElementsByClassName('input')
            let actualizarInfo = document.getElementById('actualizarInfo')
            let inputFile = document.getElementById('file-1');
            let userName = document.getElementById('userName')
            let bandera = false;
            let img = null;
            let btnVerMas = document.getElementsByClassName('ver-mas');
            let btnClose = document.getElementById('btnClose');
            let contendor = document.getElementById('contenedor');

            for (let i = 0; i < btnVerMas.length; i++) {
                btnVerMas[i].addEventListener('click', function() {
                    contendor.style.display = 'block'
                });
            }
            btnClose.addEventListener('click', function() {
                contendor.style.display = 'none';

            })

            btnMenu.addEventListener('click', function() {
                menu.classList.toggle('navigation_show');
                btnMenu.classList.toggle('navigation_alternate_color')
            });
            btnShow.addEventListener('click', function() {
                personalInformation.style.left = 0
            });
            btnBack.addEventListener('click', function() {
                personalInformation.style.left = '-100%'
            });
            for (let i = 0; i < btnEdit.length; i++) {
                btnEdit[i].addEventListener('click', function() {
                    if (bandera == false) {
                        inputInfo[i].disabled = false;
                        bandera = true;
                    } else {
                        inputInfo[i].disabled = true;
                        bandera = false;
                    }

                })
            }
            inputFile.addEventListener('change', function(e) {
                let image = e.target.files[0];
                img = image;
                let file = new FileReader();
                let imgProfile = document.getElementById('imgProfile')
                let imgProfile1 = document.getElementById('imgProfile1')
                file.onload = (e) => {
                    imgProfile1.setAttribute('src', e.target.result)
                    imgProfile.setAttribute('src', e.target.result)

                }
                file.readAsDataURL(image);
            });
            actualizarInfo.addEventListener('submit', function(e) {
                let formData = new FormData(this);
                let id = document.getElementById('idEmpleado').value;
                var fullName = document.getElementById('nombre').value + " " + document.getElementById('a_paterno')
                    .value + " " + document.getElementById('a_materno').value
                formData.append("user_id", id);
                formData.append("nombre", document.getElementById('nombre').value);
                formData.append("a_paterno", document.getElementById('a_paterno').value);
                formData.append("a_materno", document.getElementById('a_materno').value);
                formData.append("correo", document.getElementById('correo').value);
                formData.append("newPass", document.getElementById('password').value);


                $.ajax({
                    url: '/empleado/' + id,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,

                }).done(function(res) {

                    userName.innerHTML = fullName;
                    Swal.fire({
                        toast: true,
                        position: 'top-left',
                        icon: 'info',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(res)
                });

                e.preventDefault();
            });
        </script>
    @endguest

</body>

</html>
