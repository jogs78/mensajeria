@extends('dashboard')
@section('informatico.user-list')
    <style>
        .dashboard-informatico {
            display: none;
        }

    </style>
    <section class="users-list">
        <div class="form-filtro__container" id="filtroAlumno">
            <form action="" class="form-filtro" method="GET">
                <select name="carreras"  class="form-filtro__carrera">
                    <option value="">Carreras</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
                    @endforeach
                </select>
                <select name="semestres" id="" class="form-filtro__semestre">
                    <option value="">Semestres</option>
                    @foreach ($semestres as $semestre)
                            <option value="{{ $semestre->id }}">{{ $semestre->semestre }}</option>
                    @endforeach
                </select>
                <button class="btn btn-dark" >Filtrar</button>
            </form>
            <form class="form-search__numControl" method="GET">
                <select name="tipo">
                    <option value="">Buscar por tipo</option>
                    <option value="id">Número de Control</option>
                    <option value="nombre">Nombre</option>
                    <option value="apellido_paterno">Apellido Paterno</option>
                    <option value="apellido_materno">Apellido Materno</option>
                    <option value="correo">Correo</option>
                </select>
                <input name="buscarpor" class="form-search__numControl" type="search" placeholder="Buscar Por">
                <button class="btn-form__search fas fa-search btn-outline-primary" type="submit"></button>
            </form>
        </div>
        <div class="form-filtro__container" style="display: none; justify-content: end;" id="filtroEmpleado">
            <form class="form-search__numControl" method="GET">
                <select name="tipoEmpleado" >
                    <option value="">Buscar por tipo</option>
                    <option value="nombre">Nombre</option>
                    <option value="apellido_paterno">Apellido Paterno</option>
                    <option value="apellido_materno">Apellido Materno</option>
                    <option value="correo">Correo</option>
                    <option value="quien_revisa">Departamento</option>
                </select>
                <input name="buscarPor" class="form-search__numControl" type="search" placeholder="Buscar Por">
                <button class="btn-form__search fas fa-search btn-outline-primary" type="submit"></button>
            </form>
        </div>
        <div class="btn-select__container">
            <button class="btn-select" id="btn_alumno" value="1">Alumnos</button>
            <button class="btn-select" id="btn_empleado" value="0">Empleados</button>
        </div>
        <div class="user-list__table_header"><a class="user-list__create" href="/user/create">Agregar usuario</a></div>
        <table id="tabla_alumnos" class="table">
            <thead>
                <th>Número de Control</th>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Carrera</th>
                <th>Semestre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td data-label="Número de Control">{{ $alumno->id }}</td>
                        <td data-label="Nombre Completo" class="full-name">
                            {{ $alumno->nombre . ' ' . $alumno->apellido_paterno . ' ' . $alumno->apellido_materno }}</td>
                        <td data-label="Correo">{{ $alumno->correo }}</td>
                        <td data-label="Carrera">{{ $alumno->carrera->name }}</td>
                        <td data-label="Semestre">{{ $alumno->semestre->semestre }}</td>
                        <td data-label="Acciones">
                            <span class="user-list__table_item">
                                <a href="/user/{{ $alumno->id }}/edit" style="color: black"><i class="fas fa-edit"
                                        title="editar"></i></a>
                                <form action="/user/{{ $alumno->id }}" style="display: inline" class="form-eliminar" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="fas fa-trash-alt eliminar" title="eliminar"></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach



            </tbody>

        </table>
        <div id="pag1">
            {{ $alumnos->links() }}
        </div>
        <table id="tabla_empleados" class="table">
            <thead>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td data-label="ID">{{ $empleado->id }}</td>
                        <td data-label="Nombre Completo" class="full-name">
                            {{ $empleado->nombre . ' ' . $empleado->apellido_paterno . ' ' . $empleado->apellido_materno }}</td>
                        <td data-label="Correo">{{ $empleado->correo }}</td>
                        <td data-label="Rol">{{ $empleado->rol }}</td>
                        <td data-label="Departamento">{{ $empleado->puesto }}</td>
                        <td data-label="Accciones"><span class="user-list__table_item">
                            <a href="/user/{{ $empleado->id }}/edit" style="color: black"><i class="fas fa-edit"
                                    title="editar"></i></a>
                            <form action="/user/{{ $empleado->id }}" style="display: inline" class="form-eliminar" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-trash-alt eliminar" title="eliminar"></button>
                            </form>
                        </span></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div id="pag2">
            {{ $empleados->links() }}
        </div>
    </section>
    @if (session('message') == 'ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'Usuario eliminado con éxito',
            'success'
        )
    </script>
@endif
    <script>
        let alumnos = document.getElementById("tabla_alumnos")
        let empleados = document.getElementById("tabla_empleados")
        let btn_alumno = document.getElementById("btn_alumno")
        let btn_empleado = document.getElementById("btn_empleado")
        let filtroEmpleado = document.getElementById("filtroEmpleado")
        let filtroAlumno = document.getElementById("filtroAlumno")
        let eliminar = document.getElementsByClassName('form-eliminar');
        let fullName = document.getElementsByClassName('full-name')
        empleados.style.display = "none"
        document.getElementById("pag2").style.display = "none"
        window.addEventListener('load', function(){
            if(sessionStorage.getItem("v1") == "1"){
                document.getElementById("pag1").style.display = "block"
                btn_alumno.style.borderBottom = "5px solid #0d47a1"
                alumnos.style.display = "table"
                document.getElementById("pag2").style.display = "none"
                empleados.style.display = "none"
                filtroEmpleado.style.display = "none"
                
            }else if(sessionStorage.getItem("v1") == "0"){
                btn_empleado.style.borderBottom = "5px solid #0d47a1"
                empleados.style.display = "table"
                document.getElementById("pag2").style.display = "block"
                document.getElementById("pag1").style.display = "none"
                alumnos.style.display = "none"
                filtroEmpleado.style.display = "flex"
                filtroAlumno.style.display = "none"

            }
        });
        btn_alumno.addEventListener('click', function() {
            empleados.style.display = "none"
            alumnos.style.display = "table"
            this.style.borderBottom = "5px solid #0d47a1"
            btn_empleado.style.borderBottom = "0"
            btn_alumno.setAttribute("value", "1");
            sessionStorage.setItem("v1", btn_alumno.value);
            document.getElementById("pag2").style.display = "none"
            document.getElementById("pag1").style.display = "block"
            filtroEmpleado.style.display = "none"
            filtroAlumno.style.display = "flex"

        })
        btn_empleado.addEventListener('click', function() {
            alumnos.style.display = "none"
            empleados.style.display = "table"
            document.getElementById("pag2").style.display = "block"
            document.getElementById("pag1").style.display = "none"
            this.style.borderBottom = "5px solid #0d47a1"
            btn_alumno.style.borderBottom = "0"
            btn_empleado.setAttribute("value", "0");
            sessionStorage.setItem("v1", btn_empleado.value);
            filtroEmpleado.style.display = "flex"
            filtroAlumno.style.display = "none"

        })
        for (let i = 0; i < eliminar.length; i++) {
            eliminar[i].addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Esta seguro de querer eliminar al usuario '+fullName[i].textContent+'?',
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

@endsection
