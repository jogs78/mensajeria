@extends('dashboard')
@section('mensaje.mensaje-list')
    <style>
        .image-title {
            margin: 20px auto;
            font-size: 25px;
            display: block;
            text-align: center;
            position: relative;
            padding: 4px;

        }

        .dashboard-EmisorRevisror,
        .dashboard-difusor {
            display: none;
        }

        #btn1,
        #btn2, #btn3 {
            width: 100%;
            height: 100%;
            border: none;
            padding: 4px;
            background: transparent;
        }

    </style>
    <section class="filtro-mensaje">
        @include('mensaje.mensaje-filtro')
    </section>
    <section class="new-messages" id="new-messages">
        @if (session('message') == 'ok')
            <script>
                setTimeout(() => {
                    Swal.fire(
                    'Eliminado!',
                    'Mensaje eliminado con éxito',
                    'success'
                )
                }, 500);
            </script>
        @endif
        <a class="new-messages__link" href="/mensajes/create">Redactar mensaje</a>
        <div class="user-select">
            <form action="/mensajes" style="flex-grow:1; height:40px">
                <button id="btn3" name="general" value="all">Ver todos los mensajes</button>
            </form>
            
            
            @if (Auth::user()->rol == "Revisor")
                <form action="/mensajes" style="flex-grow:1; height:40px">
                    <button id="btn1" name="estado" value="1">Mensajes por revisar</button>
                </form>
            @else
               <form action="/mensajes" style="flex-grow:1; height:40px">
                <button id="btn1" name="estado" value="1">Mensajes pendientes</button>
            </form>  
            @endif
           
            
            <form action="/mensajes" style="flex-grow:1; height:40px">
                <button id="btn2" name="difundido" value="3">Mensajes difundidos</button>
            </form>
        </div>
        @if (sizeof($mensajes) == 0)
            <label class="image-title fas fa-exclamation-circle">Sin registros</label>
        @else
        @include('mensaje.mensajes')
            {{ $mensajes->links() }}

        @endif
    </section>
    @include('difusor.ver-estadisticas')
    <script>
        let eliminar = document.getElementsByClassName('form_eliminar');
        for (let i = 0; i < eliminar.length; i++) {
            eliminar[i].addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Esta seguro de querer eliminar este mensaje?',
                    text: "No será posible revertir este cambio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        }
    </script>

    <script>
        let btn1 = document.getElementById("btn1");
        let btn2 = document.getElementById("btn2");
        let btn3 = document.getElementById("btn3");
        let b = 0;
        let alum = 0;
        window.addEventListener('load', function() {
            
            if(sessionStorage.getItem("val") == "1" || sessionStorage.getItem("val") == "0") {
                btn1.classList.add('btn__selected');
            }else if (sessionStorage.getItem("val") == "3") {
                btn2.classList.add('btn__selected');
            }else if (sessionStorage.getItem("val") == "4") {
                btn3.classList.add('btn__selected');
            }else{
                btn3.classList.add('btn__selected');

            }
            btn1.addEventListener('click', function() {
                sessionStorage.setItem("val", btn1.value);
                btn1.classList.add('btn__selected');
                btn2.classList.remove('btn__selected');
                
            });
            btn2.addEventListener('click', function() {
                sessionStorage.setItem("val", btn2.value);
                btn2.classList.add('btn__selected');
                btn1.classList.remove('btn__selected');
                
            });
            btn3.addEventListener('click', function() {
                sessionStorage.setItem("val", btn3.value);
                btn3.classList.add('btn__selected');
                btn2.classList.remove('btn__selected');
                btn1.classList.remove('btn__selected');
            });

            function realizarSolicitud(estado) {
                $.ajax({
                    url: '/mensajes?estado='+estado,
                    method: 'GET',
                    cache: false,
                    contentType: false,
                    processData: false,
                }).done(function(res) {
                    let respuesta = JSON.parse(res)
                    let section = document.getElementById('new-messages');
                    let contenedor = ""
                    console.log(section[section.length])

                });
            }
        })
    </script>
@endsection
