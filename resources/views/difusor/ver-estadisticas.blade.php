<style>
    #close {
        font-size: 30px;
        background: white;
        border-radius: 50%;
        padding: 1px;
        float: right;
        margin: 5px;
        cursor: pointer;
        transition: transform .5s ease;
        position: relative;
        z-index: 2;
    }

    #close:active {
        transform: scale(.9);
    }

    .estadisticas {
        opacity: 0;
        top: -200%;
        position: fixed;
        z-index: 4444;
        background: rgba(0, 0, 0, 0.425);
        width: 100%;
        height: 100vh;
        transition: all 1s ease;
        backdrop-filter: blur(1px);
        overflow: auto;
    }

    .dashboard-EmisorRevisror,
    .dashboard-difusor {
        display: none;
    }

    .lbl-container {
        background: rgb(255, 255, 255);
        display: flex;
        flex-wrap: wrap;
        width: 80vw;
        margin: auto;
    }

    .lbls-inf {
        font-weight: 800;
    }

    .lbls-inf:nth-child(1) {
        width: 100%;
        text-align: center;
        padding: 3px;
    }

    .lbls-inf:nth-child(2),
    .lbls-inf:nth-child(3) {
        flex-grow: 1;
        text-align: center;
        padding: 5px;
        width: min-content;
    }

    #listCarreras,
    #listSemestres {
        position: relative;
    }

    #listCarreras::before {
        content: "Carreras seleccionadas: ";
        display: block;
    }

    #listSemestres::before {
        display: block;
        content: "Semestres seleccionados: ";
    }

</style>

<section class="estadisticas" id="graficaContainer">
    <i class="fas fa-times-circle" id="close"></i>
    <div
        style="position: relative; height:60vh; width:80vw; margin: auto;background: black;padding: 6px;margin: 10px auto;border-radius: 5px;z-index:1">
        <canvas id="myChart"></canvas>
    </div>
    <div class="lbl-container">
        <div class="lbls-inf" id="lbls-container">
            <label for="" class="" style="display:block;">Alumnos que han visto esta publicación</label>
            <p id="visitas"></p>
        </div>
        <label for="" class="lbls-inf" id='listCarreras'> </label>
        <label for="" class="lbls-inf" id="listSemestres"></label>
    </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<script src="{{ asset('static/js/mensajes.js') }}"></script>
