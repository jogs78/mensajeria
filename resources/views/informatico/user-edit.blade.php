@extends('dashboard')
@php
$c_total = null;
$c_alumnos = null;
$c_empleados = null;
$c_carreras = null;
@endphp
@section('informatico.user-edit')
    <style>
        .dashboard-informatico {
            display: none;
        }

    </style>
    @if (session('message'))
        <script>
            const Toast = Swal.mixin({
                toast: true,

                animation: true,
                position: 'top-left',
                showConfirmButton: false,
                timer: 2000

            });
            Toast.fire({
                type: 'success',
                title: '{{ session('message') }}'
            })
        </script>
    @endif

    @if ($alumno != '')
        <form action="/user/{{ $alumno->id }}" class="form-edit" method="POST">
            @csrf
            @method('PUT')

            <div class="form-edit__item">
                <label for="">Numero de control</label>
                <input type="text" name="numero_control" id="" value="{{ $alumno->id }}">
            </div>
            <div class="form-edit__item">
                <label for="">Nombre</label>
                <input type="text" name="name" id="" value="{{ $alumno->nombre }}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido paterno</label>
                <input type="text" name="a_paterno" id="" value="{{ $alumno->apellido_paterno }}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido materno</label>
                <input type="text" name="a_materno" id="" value="{{ $alumno->apellido_materno }}">
            </div>
            <div class="form-edit__item">
                <label for="">Carrera</label>
                <select name="carrera" id="carrera1" class="input">
                    <option value="{{ $alumno->carrera->id }}">{{ $alumno->carrera->name }}</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-edit__item">
                <label for="">Semestre</label>
                <select name="semestre" id="semestre1" class="input">
                    <option value="{{ $alumno->semestre_id }}">Semestre {{ $alumno->semestre_id }}</option>
                    @foreach ($semestres as $semestre)
                        <option value="{{ $semestre->id }}">Semestre {{ $semestre->semestre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-edit__item">
                <label for="">Correo</label>
                <input type="text" name="correo" id="" value="{{ $alumno->correo }}">
            </div>
            <div class="form-edit__item">
                <label for="">Contraseña nueva</label>
                <div style="display: flex">
                    <input type="password" name="contraseña" id="" class="pw1">
                    <i style="position: relative;right: 0;border-bottom: 1px solid; bottom:0;padding: 5px;font-size: 1.5rem;"
                        class="show-pass fas fa-eye vp"></i>
                </div>
            </div>
            <div class="  form-edit__item">
                <label for="">Confirmar contraseña</label>
               
                <div style="display: flex">
                    <input type="password" name="contraseña_confirm" id="" class="pw1">
                    <i style="position: relative;right: 0;border-bottom: 1px solid; bottom:0;padding: 5px;font-size: 1.5rem;"
                        class="show-pass fas fa-eye vp"></i>
                </div>
            </div>
            <div class="form-edit__item">

                <input type="submit" name="enviar" id="" value="Guardar" class="enviar">
            </div>
        </form>
    @elseif ($empleado != "")
        <form action="/user/{{ $empleado->id }}" class="form-edit" method="POST">
            @csrf
            @method('PUT')
            <div class="form-edit__item">
                <label for="">Nombre</label>
                <input type="text" name="name" id="" value="{{ $empleado->nombre }}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido paterno</label>
                <input type="text" name="a_paterno" id="" value="{{ $empleado->apellido_paterno }}">
            </div>
            <div class="form-edit__item">
                <label for="">Apellido materno</label>
                <input type="text" name="a_materno" id="" value="{{ $empleado->apellido_materno }}">
            </div>
            <div class="form-edit__item">
                <label for="">Correo</label>
                <input type="text" name="correo" id="" value="{{ $empleado->correo }}">
            </div>
            <div class="form-edit__item">
                <label for="">Contraseña</label>
                <div style="display: flex">
                    <input type="password" name="contraseña" id="" class="pw1">
                    <i style="position: relative;right: 0;border-bottom: 1px solid; bottom:0;padding: 5px;font-size: 1.5rem;"
                        class="show-pass fas fa-eye vp"></i>
                </div>
            </div>
            <div class="form-edit__item">
                <label for="">Confirmar contraseña</label>
                <div style="display: flex">
                    <input type="password" name="contraseña_confirm" id="" class="pw1">
                    <i style="position: relative;right: 0;border-bottom: 1px solid; bottom:0;padding: 5px;font-size: 1.5rem;"
                        class="show-pass fas fa-eye vp"></i>
                </div>

            </div>
            <div class="form-edit__item">
               
                <label for="" style="position: relative;top: -20px; color:rgb(0, 0, 0)" >Rol:</label>
                    <select name="rol" id="rol" class="">
                        <option value="{{ $empleado->rol }}">{{ $empleado->rol }}</option>
                        <option value="Informático">Informático</option>
                        <option value="Difusor">Difusor</option>
                        <option value="Revisor">Revisor</option>
                        <option value="Emisor">Emisor</option>
                    </select>
            </div>
            <div class="form-edit__item">
                <label for="">Puesto</label>
                <input type="text" name="puesto" id="" value="{{ $empleado->puesto }}">
            </div>
            <div class="form-edit__item">
                

                <label for="" style="top: 0; color:rgb(0, 0, 0)" >Revisor: </label>
                    <select name="quien_revisa" id="quien_revisa" class="">
                        <option value="{{ $empleado->quien_revisa }}">{{ $empleado->quien_revisa }}</option>
                        <option>Subdirección de Planeación y Vinculación</option>
                        <option>Subdirección Académica</option>
                        <option>Subdirección de Servicios Administrativos</option>
                    </select>
            </div>
            <div class="form-edit__item">
                <input type="submit" name="enviar" id="" value="Guardar" class="enviar btn">
            </div>
        </form>
    @endif
    <script>
        let vp = document.getElementsByClassName('vp')
        let bandera1 = false;
        for (let i = 0; i < vp.length; i++) {
            vp[i].addEventListener('click', function() {
                pass = document.getElementsByClassName('pw1')
                if (bandera1 == false) {
                    console.log(bandera1)
                    pass[i].setAttribute('type', "text")
                    vp[i].classList.remove('fa-eye')
                    vp[i].classList.add('fa-eye-slash')
                    bandera1 = true
                } else if (bandera1 == true) {
                    pass[i].setAttribute('type', "password")
                    vp[i].classList.add('fa-eye')
                    vp[i].classList.remove('fa-eye-slash')
                    bandera1 = false
                }
            })
        }
    </script>



@endsection
