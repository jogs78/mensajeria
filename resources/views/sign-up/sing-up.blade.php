<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('static/css/signup_style.css') }}">
    <title>BIENVENIDO</title>
</head>
<body>
    <section class="login">
        @if(session('message'))
            <div class="notification">
                {{session('message')}}
                </div>
                    
            @endif
        <div class="login__container">
            
            
            <div class="login__img">

                <ul class="title">
                    <li>TecNM Campus Tuxtla Gutiérrez</li>
                    <li>Ciencia y Tecnologia con sentido humano</li>
                </ul>

                <img src="{{ asset('static/imagenes/mascota_ittg.png') }}" alt="">
            </div>
            <div class="login__form">
                <form action="/sign-up"  method="POST">
                    @csrf
                    <div class="login__personal_information">
                        <input type="text" name="num_control" id="name" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Número de control</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="name" id="name" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Nombre</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_paterno" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Apellido paterno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_materno" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Apellido materno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="correo" class="input_personal_information" >
                        <label for="" class="lbl_personal_information">Correo electrónico</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="password" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Contraseña</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="confirmar_password" class="input_personal_information">
                        <label for="" class="lbl_personal_information">Confirmar contraseña</label>
                    </div>
                    <div class="login__extra_information">
                        <select name="carrera" id="carrera">
                            <option value="">Seleccione una opción</option>
                            <option value="Ingen. Mécanica">Ingen. Mécanica</option>
                            <option value="Ingen. Sistemas Computacionales">Ingen. Sistemas Computacionales</option>
                            <option value="Ingen. Industrial">Ingen. Industrial</option>
                            <option value="Ingen. Electrónica">Ingen. Electrónica</option>
                            <option value="Ingen. Eléctrica">Ingen. Eléctrica</option>
                            <option value="Ingen. Bioquímica">Ingen. Bioquímica</option>
                            <option value="Ingen. Química">Ingen. Química</option>
                            <option value="Ingen. Gestión Empresarial">Ingen. Gestión Empresarial</option>
                            <option value="Maestria en Ciencias en Ingeniería Bioquímica">Maestria en Ciencias en Ingeniería Bioquímica</option>
                            <option value="Maestría en Ciencias en Ingeniería Mecatrónica">Maestría en Ciencias en Ingeniería Mecatrónica</option>
                            <option value="Doctorado en Ciencias de los Alimentos y Biotecnología">Doctorado en Ciencias de los Alimentos y Biotecnología</option>
                            <option value="Doctorado en Ciencias de la Ingeniería">Doctorado en Ciencias de la Ingeniería</option>
                        </select>
                        <select name="semestre" id="semestre">
                            <option value="">Semestre</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
                    
                    <input class="login__form_btn" type="submit" value="Crear cuenta">
                </form>
                
            </div>
        </div>
    </section>
    <script>
        let label = document.getElementsByClassName("lbl_personal_information");
        let input = document.getElementsByClassName("input_personal_information");
        console.log(label);
        for (let i = 0; i < input.length; i++) {

            input[i].addEventListener("keyup", function () {
                if(this.value.length >= 1){
                    this.nextElementSibling.classList.add("fijar");
                }else{
                    this.nextElementSibling.classList.remove("fijar");
                } 
});
}
        
    </script>
</body>
</html>