@extends('dashboard')
@section('informatico.user-list')
    <style>
        .dashboard-informatico {
            display: none;
        }

    </style>
    <section class="users-list">
        <div class="form-filtro__container">
            <form action="" class="form-filtro">
                <select name="" id="" class="form-filtro__carrera">
                    <option value="">Seleccione una opcion</option>
                </select>
                <select name="" id="" class="form-filtro__semestre">
                    <option value="">Seleccione una opcion</option>
                </select>
                <button class="btn btn-dark">Filtrar</button>
            </form>
            <form class="form-search" action=""><input class="form-search__numControl" type="text" placeholder="Número de control"><button
                    class="btn-form__search fas fa-search btn-outline-primary" type="submit"></button></form>
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
                        <td data-label="Nombre Completo">
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
                        <td data-label="Nombre Completo">
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

    <script>
        let alumnos = document.getElementById("tabla_alumnos")
        let empleados = document.getElementById("tabla_empleados")
        let btn_alumno = document.getElementById("btn_alumno")
        let btn_empleado = document.getElementById("btn_empleado")
        empleados.style.display = "none"
        document.getElementById("pag2").style.display = "none"
        window.addEventListener('load', function(){
            if(sessionStorage.getItem("v1") == "1"){
                document.getElementById("pag1").style.display = "block"
                btn_alumno.style.borderBottom = "5px solid #0d47a1"
                alumnos.style.display = "table"
                document.getElementById("pag2").style.display = "none"
                empleados.style.display = "none"
            }else if(sessionStorage.getItem("v1") == "0"){
                btn_empleado.style.borderBottom = "5px solid #0d47a1"
                empleados.style.display = "table"
                document.getElementById("pag2").style.display = "block"
                document.getElementById("pag1").style.display = "none"
                alumnos.style.display = "none"
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
        })
    </script>

@endsection
