<style>
    .filtro-mensaje {
        position: relative;
        top: 42px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 5px;
    }

    .btn-sub {
        background: transparent;
        font-size: 20px;
        border: 0;
        padding: 2px;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        border-radius: 5px;
        cursor: pointer;
        transition: transform .4s ease;
    }
    .btn-sub:active{
        transform: scale(.9);
        background: #29B6F6;
        color: rgb(255, 255, 255);
    }
    #f1 {
        width: max-content;
    }

    #f2 {
        flex-grow: 1;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        justify-content: flex-end;
    }

    .select {
        width: 150px;
background: transparent;
border: 1px solid;
border-radius: 5px;
color: rgb(0, 0, 0);
    }

</style>
<form action="/mensajes" id="f1">
    <input type="text" placeholder="Buscar una publicacion" name="titulo">
    <button type="submit" class="btn-sub fas fa-search"></button>
</form>
<form action="/mensajes" id="f2">
    <label for="fechaPub">Fecha de publicación <input type="date" name="fechaPub"></label>
    <select name="carrera" id="" name="carreras" class="select">
        <option >Filtrar por carreras</option>
        @foreach ($carreras as $carrera)
            <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-sub fas ">Filtrar</button>

</form>
