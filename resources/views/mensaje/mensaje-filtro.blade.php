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
        font-size: 14px;
        border: 0;
        padding: 4px;
        box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        border-radius: 5px;
        cursor: pointer;
        transition: transform .4s ease;
    }

    .btn-sub:active {
        transform: scale(.9);
        background: #29B6F6;
        color: rgb(255, 255, 255);
    }

    #f1 {
        width: max-content;
        flex-grow: 1;
        display: flex;
        gap: 5px
    }

    #f2 {
        width: 100%;
        flex-grow: 1;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        justify-content: flex-end;
    }

    .ass {
        display: block;
        width: 100%;
    }

    .select {
        background: transparent;
        border: 1px solid;
        border-radius: 5px;
        color: rgb(0, 0, 0);
        padding: 4px;
        width: 100%;
    }

    .btn-sub__grow {
        width: 50%;
        margin: auto;
    }

    @media screen and (min-width:650px) {
        .ass {
            flex-grow: 1;
            width: max-content !important;
        }

        .select {
            width: min-content;

        }
        .btn-sub__grow {
        width: min-content;
        margin: auto;
    }
    #f2{
        width: max-content;
    }
    }

</style>
<form action="/mensajes" id="f1">
    <input type="text" placeholder="Buscar una publicacion" name="titulo" style="flex-grow: 1;border: 0;border-bottom: 1px solid;">
    <button type="submit" class="btn-sub fas fa-search"></button>
</form>
<form action="/mensajes" id="f2">
    
    <select name="carrera" id="" name="carreras" class="select">
        <option>Filtrar por carreras</option>
        @foreach ($carreras as $carrera)
            <option value="{{ $carrera->id }}">{{ $carrera->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-sub fas btn-sub__grow">Filtrar</button>

</form>
