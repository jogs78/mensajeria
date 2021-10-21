@extends('dashboard')
@section('informatico.user-list')
    <style>
        #users {
            border-radius: 5px 5px 0 0;
            box-shadow: -1px -1px 4px rgba(0, 0, 0, 0.281);
            color: rgb(251, 255, 35);
        }

    </style>
    <section class="user-list">
        <div class="user-list__table_container">
            <div class="user-list__table_header"><a class="user-list__create" href="/user/create">Agregar usuario</a></div>
            <div class="user-list__table_header">ID</div>
            <div class="user-list__table_header">Nombre completo</div>
            <div class="user-list__table_header">Correo</div>
            <div class="user-list__table_header">Carrera</div>
            <div class="user-list__table_header">Semestre</div>
            <div class="user-list__table_header">Rol</div>
            <div class="user-list__table_header">Puesto</div>
            <div class="user-list__table_header">Acciones</div>


            @foreach ($alumnos as $alumno)
                <div class="user-list__table_row">
                    <span class="user-list__table_item">{{ $alumno->id }}</span>
                    <span class="user-list__table_item">{{ $alumno->nombre." ".$alumno->apellido_paterno ." ". $alumno->apellido_materno }}</span>
                    <span class="user-list__table_item ">{{ $alumno->correo }}
                        <i class="user-list__viewmore fas fa-sort-down show"></i>
                        <div class="more_information">
                            <span>Carrera: {{ $alumno->carrera_id }} </span>
                            <span>Semestres: {{ $alumno->semestre_id }}</span>
                            <span>Rol: Estudiante</span>
                            <ul>
                                <a href="/user/{{ $alumno->id }}/edit" style="color: black">
                                    <li class="fas fa-edit update" title="editar">Editar</li>
                                </a>
                                <form action="/user/{{ $alumno->id }}" style="display: inline" class="form-eliminar"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="fas fa-trash-alt eliminar"
                                        title="eliminar">Eliminar</button>
                                </form>
                            </ul>
                    </span>
                </div>
                </span>
                <span class="user-list__table_item">{{ $alumno->carrera->name }}</span>
                <span class="user-list__table_item">{{ $alumno->semestre->semestre }}</span>
                <span class="user-list__table_item">Estudiante</span>
                <span class="user-list__table_item">----------</span>
                <span class="user-list__table_item">
                    <a href="/user/{{ $alumno->id }}/edit" style="color: black"><i class="fas fa-edit"
                            title="editar"></i></a>
                    <form action="/user/{{ $alumno->id }}" style="display: inline" class="form-eliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="fas fa-trash-alt eliminar" title="eliminar"></button>
                    </form>
                </span>
        </div>
        @endforeach

        @foreach ($empleados as $empleado)
            <div class="user-list__table_row">
                <span class="user-list__table_item">{{ $empleado->id }}</span>
                <span
                    class="user-list__table_item">{{ $empleado->nombre ." ". $empleado->apellido_paterno ." ". $empleado->apellido_materno }}
                </span>
                <span class="user-list__table_item ">{{ $empleado->correo }}
                    <i class="user-list__viewmore fas fa-sort-down show"></i>
                    <div class="more_information">
                        <span>Rol: {{ $empleado->rol }}</span>
                        <span>Puesto: {{ $empleado->puesto }}</span>
                        <ul>
                            <a href="/user/{{ $empleado->id }}/edit" style="color: black">
                                <li class="fas fa-edit update" title="editar"> Editar</li>
                            </a>
                            <form action="/user/{{ $empleado->id }}" style="display: inline" class="form-eliminar"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-trash-alt eliminar" title="eliminar">Eliminar</button>
                            </form>
                        </ul>
                </span>
            </div>
            </span>
            <span class="user-list__table_item">-------</span>
            <span class="user-list__table_item">-------</span>
            <span class="user-list__table_item">{{ $empleado->rol }}</span>
            <span class="user-list__table_item">{{ $empleado->puesto }}</span>
            <span class="user-list__table_item">
                <a href="/user/{{ $empleado->id }}/edit" style="color: black"><i class="fas fa-edit"
                        title="editar"></i></a>
                <form action="/user/{{ $empleado->id }}" style="display: inline" class="form-eliminar" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="fas fa-trash-alt eliminar" title="eliminar"></button>
                </form>
            </span>
            </div>
        @endforeach

        </div>
        @if (session('message') == 'ok')
            <script>
                Swal.fire(
                    'Eliminado!',
                    'Registro eliminado con éxito',
                    'success'
                )
            </script>
        @endif
    </section>
    <script>
        let btn = document.getElementsByClassName("user-list__viewmore");
        let info = document.getElementsByClassName("more_information");
        let btn_delete = document.getElementsByClassName("form-eliminar");
        let bandera = 0;

        for (let i = 0; i < btn.length; i++) {
            btn[i].addEventListener('click', function() {
                if (bandera == 0) {
                    info[i].classList.add("mostrar");
                    bandera = 1
                } else {
                    info[i].classList.remove("mostrar");
                    bandera = 0
                }

            });

        }

        for (let i = 0; i < btn_delete.length; i++) {
            btn_delete[i].addEventListener('submit', function(e) {
                console.log(btn_delete[i])
                e.preventDefault();
                Swal.fire({
                    title: '¿Esta seguro de querer eliminar a este usuario?',
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
