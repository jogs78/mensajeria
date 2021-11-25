window.addEventListener("load", function() {
    let mensajesTotal = document.getElementById('lblMensajesTotal');
    let alumnosTotal = document.getElementById('lbl1alumnosTotal');
    let mensajesByCarreras = document.getElementById('mensajesByCarreras');
    let newLi = []
    let difundir = document.getElementsByClassName('form_difundir');
    let btnEstadisticas = document.getElementsByClassName('estadistica')
    $.ajax({
        url: '/panel-difusor',
        method: 'GET',
        cache: false,
        contentType: false,
        processData: false,

    }).done(function(res) {
        mensajesTotal.innerHTML = "Mensajes totales: " + res.mensajesTotales
        alumnosTotal.innerHTML = "Alumnos registrados: " + res.alumnosTotales
        for (let i = 0; i < res.carreras.length; i++) {
            newLi[i] = document.createElement('li');
            newLi[i].innerHTML = res.carreras[i].name + ": " + res.MensajesByCarrera[i]
            mensajesByCarreras.appendChild(newLi[i])
        }

    });
    if (difundir) {
        let lblEstado = document.getElementsByClassName('new-messages__status-menssage');
        let divDifundir = document.getElementsByClassName('new-messages_difundir');
        for (let j = 0; j < difundir.length; j++) {
            difundir[j].addEventListener('submit', function(event) {
                let url = difundir[j].getAttribute('action')
                let estado = document.getElementById('updateEstado').value;
                let id = document.getElementsByClassName('idMensaje');
                let mensajeContainer = document.getElementsByClassName('new-messages__container');
                let messageSection = document.getElementById('new-messages')
                console.log("anterior actual" + mensajeContainer.length)
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: {
                        estado: estado,
                        _token: $("input[name='_token']").val()
                    },
                    dataType: 'html',
                }).done(function(res) {
                    let d = difundir[j].getAttribute('action')
                    let l = d.split('/')

                    if (res) {
                        Swal.fire({
                            toast: true,
                            position: 'top',
                            icon: 'info',
                            title: res,
                            showConfirmButton: false,
                            timer: 1500
                        });



                        if (mensajeContainer[j].id == l[2]) {
                            setTimeout(function() {
                                divDifundir[j].style.opacity = 0
                                divDifundir[j].style.display = "none"
                                lblEstado[j].innerHTML = "<b>Estado: Publicado</b>"
                                lblEstado[j].style.background = "#0277BD";
                            }, 800)
                        }
                    } else {
                        Swal.fire({
                            toast: true,
                            position: 'center',
                            icon: 'error',
                            title: 'Error',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    }
                });
                event.preventDefault();
            });
        }
    }
    if (btnEstadisticas) {
        let graficaContainer = document.getElementById('graficaContainer')
        let btnClose = document.getElementById('close')
        let myChart = null;
        let listCarreras = document.getElementById('listCarreras'),
            listSemestres = document.getElementById('listSemestres');
        for (let i = 0; i < btnEstadisticas.length; i++) {
            btnEstadisticas[i].addEventListener('click', function() {
                graficaContainer.style.opacity = 1;
                graficaContainer.style.top = "42px";
                let id = btnEstadisticas[i].getAttribute("data-id")
                solicitud(id)

                // console.log(btnEstadisticas[i].getAttribute("data-id"))
            })
        }
        btnClose.addEventListener('click', function() {
            graficaContainer.style.opacity = 0;
            graficaContainer.style.top = "-200%";
            listCarreras.innerHTML = "";
            listSemestres.innerHTML = "";
            if (myChart) {
                myChart.destroy();
            }
        })

        function solicitud(id) {
            $.ajax({
                url: '/ver-estadisticas/' + id,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(res) {
                let carreras = [];
                let valores = [];
                let datos = res
                let tituloGrafica = datos.mensaje.titulo;
                let mensaje = []
                mensaje = datos.mensaje
                for (let i = 0; i < datos.alumnosCarreras.length; i++) {
                    listCarreras.innerHTML = "<ul><li>" + mensaje.carreras[i].name + "</li></ul>" + listCarreras
                        .innerHTML;
                }
                for (let i = 0; i < datos.alumnosCarreras.length; i++) {
                    listSemestres.innerHTML = "<ul><li>Semestre:" + mensaje.semestres[i].semestre + "</li></ul>" +
                        listSemestres.innerHTML;
                }
                generarGrafica(carreras, valores, tituloGrafica);
                console.log(datos)
            });

        }


        function generarGrafica(carreras, valores, titulo) {
            const ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: carreras,
                    datasets: [{
                        data: valores,
                        backgroundColor: [
                            'rgb(103, 58, 183)',
                            'rgb(76, 175, 80)',
                            'rgb(205, 220, 57)',
                            'rgb(24, 220, 179)',
                            'rgb(213, 165, 151)',

                            'rgb(33, 150, 243)',
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4,
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: titulo,
                            color: '#FAF8ED',

                            font: {
                                size: 25,
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: 10
                    }
                }
            });
        }
    }
});