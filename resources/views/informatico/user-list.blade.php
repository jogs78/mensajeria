@extends('dashboard')
@section('informatico.user-list')
    <style>
        .dashboard-informatico {
            display: none;
        }
    </style>
    <div>
        <button id="btn_alumno" value="1">Alumnos</button>
        <button id="btn_empleado" value="0">Empleados</button>
    </div>
    
    <table id="tabla_alumnos">
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
                    <td>{{$alumno->id}}</td>
                    <td>{{$alumno->nombre." ".$alumno->apellido_paterno." ".$alumno->apellido_materno}}</td>
                    <td>{{$alumno->correo}}</td>
                    <td>{{$alumno->carrera->name}}</td>
                    <td>{{$alumno->semestre->semestre}}</td>
                    <td>Aciones</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table id="tabla_empleados">
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
                    <td>{{$empleado->id}}</td>
                    <td>{{$empleado->nombre." ".$empleado->apellido_paterno." ".$empleado->apellido_materno}}</td>
                    <td>{{$empleado->correo}}</td>
                    <td>{{$empleado->rol}}</td>
                    <td>{{$empleado->puesto}}</td>
                    <td>Aciones</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        let alumnos=document.getElementById("tabla_alumnos")
        let empleados=document.getElementById("tabla_empleados")
        let btn_alumno=document.getElementById("btn_alumno")
        let btn_empleado=document.getElementById("btn_empleado")
        empleados.style.display="none"
        //none ocultar
        //block mostrar
        btn_alumno.addEventListener('click',function(){
            empleados.style.display="none"
            alumnos.style.display="block"
        })

        btn_empleado.addEventListener('click',function(){
            alumnos.style.display="none"
            empleados.style.display="block"
        })

        
    </script>

@endsection
