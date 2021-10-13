@extends('dashboard')

@section('alumno-mensajes')
    <style>
        #alumnos {
            border-radius: 5px 5px 0 0;
            box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.281);
            color: rgb(251, 255, 35);
        }

    </style>
    <section class="alumno-messages">
        <div class="alumno-messages__container">
            <div class="alumno-messages__content">
                <div class="image_container">
                    <img src="https://www.ttandem.com/media/como-crear-un-calendario-de-publicaciones-en-redes-sociales.jpg"
                        alt="">
                    <i class="fas fa-chevron-circle-down message_btn_down"></i>
                </div>
                <div class="alumno-messages__body_container">
                    <label>Título: aqui el titulo de la publicacion</label>
                    <small>Publicado el:<b> aqui va la fecha de publicacion</b></small>
                    <p>Aqui la descripción del mensaje
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis iure nihil eligendi ipsa
                        architecto facilis voluptas quisquam modi atque. Expedita, minus excepturi amet blanditiis quaerat
                        itaque aut quidem sunt laboriosam!
                    </p>
                </div>
            </div>
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
    </section>

@endsection
