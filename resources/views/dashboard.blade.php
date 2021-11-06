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
    @if (Auth::user()->rol == 'Emisor')
        <section class="dashboard-EmisorRevisror">
            <div class="dashboard-EmisorRevisor__container">
                <div class="dashboard-EmusorRevisor__infMensajes">
                    <img src="https://iconarchive.com/download/i84522/designbolts/seo/Review-Post.ico" alt=""
                        class="img-dashboard">
                    <label class="lbl__info">Publicaciones totales: 0000</label>
                    <label class="lbl__info">Publicaciones aceptadas: 0000</label>
                    <label class="lbl__info">Publicaciones pendientes: 0000</label>
                    <a href="/mensajes" class="btn__verMensajes">Ver mensajes</a>
                </div>
                <div class="dashboard-EmisorRevisor__carrerasMensajes">
                    <label class="lbl__info">Publicaciones por carreras</label>
                    <ol class="list__carreras">
                        <li>Ingen. 1: 0000</li>
                        <li>Ingen. 2: 0000</li>
                        <li>Ingen. 3: 0000</li>
                        <li>Ingen. 4: 0000</li>
                    </ol>
                </div>
            </div>
        </section>
    @elseif (Auth::user()->rol == 'Revisor')
        <section class="dashboard-EmisorRevisror">
            <div class="dashboard-EmisorRevisor__container">
                <div class="dashboard-EmusorRevisor__infMensajes">
                    <img src="https://iconarchive.com/download/i84522/designbolts/seo/Review-Post.ico" alt=""
                        class="img-dashboard">
                    <label class="lbl__info">Publicaciones totales: 0000</label>
                    <label class="lbl__info">Publicaciones aceptadas: 0000</label>
                    <label class="lbl__info">Publicaciones pendientes: 0000</label>
                    <a href="/mensajes" class="btn__verMensajes">Ver mensajes</a>
                </div>
                <div class="dashboard-EmisorRevisor__carrerasMensajes">
                    <label class="lbl__info">Publicaciones por carreras</label>
                    <ol class="list__carreras">
                        <li>Ingen. 1: 0000</li>
                        <li>Ingen. 2: 0000</li>
                        <li>Ingen. 3: 0000</li>
                        <li>Ingen. 4: 0000</li>
                    </ol>
                </div>
            </div>
        </section>
    @elseif (Auth::user()->rol == "Difusor")
        <section class="dashboard-difusor">
            <div class="dashboard-difusor__contianer">
                <div class="dashboard-difusor__mensajes">
                    <img class="img-dashboard"
                        src="https://iconarchive.com/download/i84522/designbolts/seo/Review-Post.ico" alt="">
                    <label for="">Mensajes totales: 00000</label>
                    <a href="/mensajes" class="btn__verMensajes">Ver mensajes</a>
                </div>
                <div class="dashboard-difusor__alumnos">
                    <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="">
                    <label>Alumnos registrados: 0000</label>
                </div>
                <div class="dashboard-difusor__carrerasMensajes">
                    <label class="lbl__info">Publicaciones por carreras</label>
                    <ol class="list__carreras">
                        <li>Ingen. 1: 0000</li>
                        <li>Ingen. 2: 0000</li>
                        <li>Ingen. 3: 0000</li>
                        <li>Ingen. 4: 0000</li>
                    </ol>
                </div>
            </div>
        </section>
    @elseif (Auth::user()->rol == "Informático")
        <section class="dashboard-informatico">
            <div class="dashboard-informatico__container">
                <div class="alumnos-carreras__container">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($carreras as $carrera)
                        <div class="alumnos-carreras__ingenierias">
                            <form class="deleteCareer" style="position: relative;z-index: 1000;" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-minus-circle delete-career" style="cursor: pointer"></button>
                            </form>
                            <label>{{ $carrera->name }}</label>
                            <img class="img-logoCarrera" src="{{ $carrera->logo }}">
                            <label>Alumnos Registrados: {{ $c_total[$i] }}</label>
                            @php
                                $i++;
                            @endphp
                        </div>
                    @endforeach
                    <div style="display: flex" title="Añadir carrera">
                        <label class="fas fa-plus-circle add-career" id="addCareer"></label>
                    </div>
                    <div class="total-usuarios">
                        @php
                            $total = $alumnos + $empleados;
                        @endphp
                        <label class="total-usuarios__lbl_total">Usuarios registrados: {{ $total }}</label>
                        <div class="total-usuarios__container">
                            <div>
                                <img class="total-usuarios__img"
                                    src="https://icons-for-free.com/iconfiles/png/512/student-131964785014431620.png"
                                    alt="">
                                <label class="total-usuarios__lbl">Alumnos: {{ $alumnos }}</label>
                            </div>
                            <div>

                                <img class="total-usuarios__img"
                                    src="https://usefulicons.com/uploads/icons/202105/3714/84d810328ade.png" alt="">
                                <label class="total-usuarios__lbl">Empleados: {{ $empleados }}</label>
                            </div>
                        </div>

                        <a href="/user" class="btn__verUsuarios"> Ver usuarios</a>
                    </div>
                </div>
        </section>
        <section class="addCareer">
            <div class="addCareer-container" id="addCareer-container">
                <form class="form-addCareer" id="form-addCareer" method="POST" enctype="multipart/form-data">
                    @csrf
                    <i class="fas fa-times-circle closeWindow" id="close"></i>
                    <h2>Agregar Carrera</h2>

                    <input type="text" name="carrera" id="addcarrera" class="form-addCareer__input">
                    <input type="file" name="logo" id="logo" class="form-addCareer__input" accept="image/*">
                    <button type="submit" class="btn__verUsuarios">Agregar</button>
                </form>
            </div>
        </section>
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
        let addCareer = document.getElementById('addCareer')
        let close = document.getElementById('close')
        let addCareerContainer = document.getElementById('addCareer-container')
        let addCareerForm = document.getElementById('form-addCareer')
        let deleteCareer = document.getElementsByClassName('deleteCareer')
        let _token = document.querySelector('input[name="_token"]').value
        console.log(deleteCareer)
        btnMenu.addEventListener('click', function() {
            menu.classList.toggle('navigation_show');
            btnMenu.classList.toggle('navigation_alternate_color')
        });
        btnmenu2.addEventListener('click', function() {
            console.log(1)

            menu2.classList.toggle('showMenu2');
        });
        addCareer.addEventListener('click', function() {
            addCareerContainer.style.opacity = '1'
            addCareerContainer.classList.add('addCareer__show');
        })
        close.addEventListener('click', function() {
            addCareerContainer.style.opacity = '0'
            addCareerContainer.classList.remove('addCareer__show');
        })
        addCareerForm.addEventListener('submit', function(event) {
            let carrera = document.getElementById('addcarrera').value
            let logo = document.getElementById('logo').value
            let _token = document.querySelector('input[name="_token"]').value
            $.ajax({
                url: '/carreras',
                method: 'POST',

                data: {
                    logo: logo,
                    carrera: carrera,
                    _token: _token
                }
            }).done(function(res) {
                // Swal.fire({
                //     toast: true,
                //     position: 'top',
                //     icon: 'info',
                //     title: res,
                //     showConfirmButton: false,
                //     timer: 1500
                // })
                alert(res);
            });
            event.preventDefault();
        });
        addCareerForm.addEventListener('submit', function(event) {
            let carrera = document.getElementById('addcarrera').value
            let logo = document.getElementById('logo').value
            
            $.ajax({
                url: '/carreras',
                method: 'POST',

                data: {
                    logo: logo,
                    carrera: carrera,
                    _token: _token
                }
            }).done(function(res) {
                // Swal.fire({
                //     toast: true,
                //     position: 'top',
                //     icon: 'info',
                //     title: res,
                //     showConfirmButton: false,
                //     timer: 1500
                // })
                alert(res);
            });
            event.preventDefault();
        });
        
        for(let i = 0; i<deleteCareer.length; i++){
            deleteCareer[i].addEventListener('submit', function(event) {
            Swal.fire({
                title: '¿Seguro de eliminar?',
                text: "No se podra revertir el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                url: '/carreras/aquiElIdDeLaCarrera',
                method: 'DELETE',
                data: {
                    ID: 1,
                    _token: _token,
                }
            }).done(function(res) {
                // Swal.fire({
                //     toast: true,
                //     position: 'top',
                //     icon: 'info',
                //     title: res,
                //     showConfirmButton: false,
                //     timer: 1500
                // })
                alert(res);
            });
                }
            })
            event.preventDefault();
        });
        }
    </script>
</body>

</html>
