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
                        <input type="text" name="num_control"  class="input_personal_information" value="{{old('num_control')}}">
                        <label for="" class="lbl_personal_information">Número de control</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="name" class="input_personal_information" value="{{old('name')}}">
                        <label for="" class="lbl_personal_information">Nombre</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_paterno" class="input_personal_information" value="{{old('a_paterno')}}">
                        <label for="" class="lbl_personal_information">Apellido paterno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="a_materno" class="input_personal_information" value="{{old('a_materno')}}">
                        <label for="" class="lbl_personal_information">Apellido materno</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="text" name="correo" class="input_personal_information" value="{{old('correo')}}">
                        <label for="" class="lbl_personal_information">Correo electrónico</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="password" name="password" class="input_personal_information" value="{{old('password')}}">
                        <label for="" class="lbl_personal_information">Contraseña</label>
                    </div>
                    <div class="login__personal_information">
                        <input type="password" name="confirmar_password" class="input_personal_information" value="{{old('confirmar_password')}}">
                        <label for="" class="lbl_personal_information">Confirmar contraseña</label>
                    </div>
                    <div class="login__extra_information">
                        <select name="carrera" id="carrera" >
                            <option value="">Seleccione una opción</option>
                            <option value="Ingen. Mécanica" {{ old('carrera') == 'Ingen. Mécanica' ? 'selected' : '' }}>Ingen. Mécanica</option>
                            <option value="Ingen. Sistemas Computacionales" {{ old('carrera') == 'Ingen. Sistemas Computacionales' ? 'selected' : '' }}>Ingen. Sistemas Computacionales</option>
                            <option value="Ingen. Industrial" {{ old('carrera') == 'Ingen. Industrial' ? 'selected' : '' }}>Ingen. Industrial</option>
                            <option value="Ingen. Electrónica" {{ old('carrera') == 'Ingen. Electrónica' ? 'selected' : '' }}>Ingen. Electrónica</option>
                            <option value="Ingen. Eléctrica" {{ old('carrera') == 'Ingen. Eléctrica' ? 'selected' : '' }}>Ingen. Eléctrica</option>
                            <option value="Ingen. Bioquímica" {{ old('carrera') == 'Ingen. Bioquímica' ? 'selected' : '' }}>Ingen. Bioquímica</option>
                            <option value="Ingen. Química" {{ old('carrera') == 'Ingen. Química' ? 'selected' : '' }}>Ingen. Química</option>
                            <option value="Ingen. Gestión Empresarial" {{ old('carrera') == 'Ingen. Gestión Empresarial' ? 'selected' : '' }}>Ingen. Gestión Empresarial</option>
                            <option value="Maestria en Ciencias en Ingeniería Bioquímica" {{ old('carrera') == 'Maestria en Ciencias en Ingeniería Bioquímica' ? 'selected' : '' }}>Maestria en Ciencias en Ingeniería Bioquímica</option>
                            <option value="Maestría en Ciencias en Ingeniería Mecatrónica" {{ old('carrera') == 'Maestría en Ciencias en Ingeniería Mecatrónica' ? 'selected' : '' }}>Maestría en Ciencias en Ingeniería Mecatrónica</option>
                            <option value="Doctorado en Ciencias de los Alimentos y Biotecnología" {{ old('carrera') == 'Doctorado en Ciencias de los Alimentos y Biotecnología' ? 'selected' : '' }}>Doctorado en Ciencias de los Alimentos y Biotecnología</option>
                            <option value="Doctorado en Ciencias de la Ingeniería" {{ old('carrera') == 'Doctorado en Ciencias de la Ingeniería' ? 'selected' : '' }}>Doctorado en Ciencias de la Ingeniería</option>
                        </select>
                        <select name="semestre" id="semestre">
                            <option value="">Semestre</option>
                            <option value="1" {{ old('semestre') == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('semestre') == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('semestre') == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('semestre') == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('semestre') == 5 ? 'selected' : '' }}>5</option>
                            <option value="6" {{ old('semestre') == 6 ? 'selected' : '' }}>6</option>
                            <option value="7" {{ old('semestre') == 7 ? 'selected' : '' }}>7</option>
                            <option value="8" {{ old('semestre') == 8 ? 'selected' : '' }}>8</option>
                            <option value="9" {{ old('semestre') == 9 ? 'selected' : '' }}>9</option>
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
        window.addEventListener('load', function() {
            for(let i = 0; i < input.length; i++){
                if(input[i].value != ""){
                    input[i].nextElementSibling.classList.add("fijar");
                    input[i].classList.add('bordes');
                }
            }
        });
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