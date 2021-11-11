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
    @elseif (Auth::user()->rol == "Informático")
        @include('informatico.dashboard-informatico')
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
        let items = document.getElementsByClassName('carousel__elemento')
        let carreraId = document.getElementsByClassName('carreraId')
            
        btnMenu.addEventListener('click', function() {
            menu.classList.toggle('navigation_show');
            btnMenu.classList.toggle('navigation_alternate_color')
        });
        btnmenu2.addEventListener('click', function() {
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
            let logo = document.getElementById('logo')
            let formData = new FormData(this);
            let newItem = document.createElement('div')
            let newFormDel = document.createElement('form'), newBtnDel = document.createElement('button'), newLblCarrera = document.createElement('label'),
            newImgCarrera = document.createElement('img'), newLblAlumnos = document.createElement('label'), newInId = document.createElement('input');
            $.ajax({
                url: '/carreras',
                method: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
            }).done(function(res) {
                Swal.fire({
                    toast: true,
                    position: 'top',
                    icon: 'info',
                    title: res,
                    showConfirmButton: false,
                    timer: 1500
                })
                const newImg = logo.files[0];
                const objURL = URL.createObjectURL(newImg)
                newImgCarrera.setAttribute('src', objURL)
                newImgCarrera.className = 'img-logoCarrera'
                newLblAlumnos.innerHTML = "Alumnos registrados: 0"
                newLblCarrera.innerHTML = carrera
                newFormDel.className='deleteCareer'
                newBtnDel.className='fas fa-minus-circle delete-career'
                newFormDel.appendChild(newBtnDel)
                newItem.className='carousel__elemento'
                items[items.length - 1].insertAdjacentElement('afterend', newItem)
                console.log(items[items.length - 1])
                items[items.length - 1].insertAdjacentElement('afterbegin', newFormDel)
                items[items.length - 1].insertAdjacentElement('beforeend', newLblCarrera)
                items[items.length - 1].insertAdjacentElement('beforeend', newImgCarrera)
                items[items.length - 1].insertAdjacentElement('beforeend', newLblAlumnos)
                
                
            });
            event.preventDefault();
        });
        

        for (let i = 0; i < deleteCareer.length; i++) {
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
                            url: '/carreras/'+carreraId[i].value,
                            method: 'DELETE',
                            data: {
                                ID: carreraId[i].value,
                                _token: _token,
                            }
                        }).done(function(res) {
                            Swal.fire({
                                toast: true,
                                position: 'top',
                                icon: 'info',
                                title: res,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            items[i].remove();
                        });
                    }
                })
                event.preventDefault();
            });
        }
    </script>
</body>

</html>
