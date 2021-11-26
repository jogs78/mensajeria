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
    }

    #close:active {
        transform: scale(.9);
    }

    .estadisticas {
        opacity: 0;
        top: -200%;
        position: absolute;
        z-index: 4444;
        background: rgba(0, 0, 0, 0.425);
        width: 100%;
        height: 100vh;
        transition: all 1s ease;
    }

    .dashboard-EmisorRevisror,
    .dashboard-difusor {
        display: none;
    }

    .lbl-container {
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 2px;
        width: 80vw;
        margin: auto;
    }

    .lbls-inf {
        font-weight: 800;
        border-radius: 5px
    }

    .lbls-inf:nth-child(1) {
        width: 100%;
        text-align: center;
        padding: 3px;
        background: #1e88e5;
    }

    .lbls-inf:nth-child(2),
    .lbls-inf:nth-child(3) {
        background: #1e88e5;
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
    }

    #listSemestres::before {
        content: "Semestres seleccionados: ";
    }

</style>

<section class="estadisticas" id="graficaContainer">
    <i class="fas fa-times-circle" id="close"></i>
    <div
        style="position: relative; height:60vh; width:80vw; margin: auto;background: black;padding: 6px;margin: 10px auto;border-radius: 5px;">
        <canvas id="myChart"></canvas>
    </div>
    <div class="lbl-container">
        <div class="lbls-inf" id="lbls-container">
            <label for="" class="" style="display:block;">Alumnos que han visto esta publicación</label>

        </div>
        <label for="" class="lbls-inf" id='listCarreras'> </label>
        <label for="" class="lbls-inf" id="listSemestres"></label>
    </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<script src="{{ asset('static/js/mensajes.js') }}"></script>
