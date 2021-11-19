window.addEventListener("load", function() {
    let mensajesTotal = document.getElementById('lblMensajesTotal');
    let alumnosTotal = document.getElementById('lbl1alumnosTotal');
    let mensajesByCarreras = document.getElementById('mensajesByCarreras');
    let newLi = []
    let difundir = document.getElementById('formDifundir');
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
        difundir.addEventListener('submit', function(event) {
            let estado = document.getElementById('updateEstado').value;
            let id = document.getElementById('idMensaje').value;
            let mensajeContainer = document.getElementsByClassName('new-messages__container');
            let messageSection = document.getElementById('new-messages')
            $.ajax({
                url: '/mensajes/' + id,
                method: 'PUT',
                data: {
                    estado: estado,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'html',
            }).done(function(res) {
                if (res) {
                    Swal.fire({
                        toast: true,
                        position: 'top',
                        icon: 'info',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    for (let i = 0; i < mensajeContainer.length; i++) {
                        if (mensajeContainer[i].id == id) {
                            mensajeContainer[i].style.opacity = 0
                            setTimeout(function() {
                                messageSection.removeChild(mensajeContainer[i])
                                const lbl = document.createElement("label")
                                lbl.className = "image-title fas fa-exclamation-circle"
                                lbl.innerHTML = "Sin registros"
                                messageSection.appendChild(lbl);
                            }, 800)
                        }
                    }
                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top',
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
});