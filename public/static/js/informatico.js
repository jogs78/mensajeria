window.addEventListener('load', function() {

    let addCareer = document.getElementById('addCareer')
    let close = document.getElementById('close')
    let addCareerContainer = document.getElementById('addCareer-container')
    let addCareerForm = document.getElementById('form-addCareer')
    let deleteCareer = document.getElementsByClassName('deleteCareer')
    let _token = document.querySelector('input[name="_token"]').value
    let items = document.getElementsByClassName('carousel__elemento')
    let carreraId = document.getElementsByClassName('carreraId')
    addCareer.addEventListener('click', function() {
        addCareerContainer.style.opacity = '1'
        addCareerContainer.classList.add('addCareer__show');
    })
    close.addEventListener('click', function() {
        addCareerContainer.style.opacity = '0'
        addCareerContainer.classList.remove('addCareer__show');
    })

    addCareerForm.addEventListener('submit', function(event) {
        let carrera = document.getElementById('addcarrera').value
        let logo = document.getElementById('logo')
        let formData = new FormData(this);
        let newItem = document.createElement('div')
        let newFormDel = document.createElement('form'),
            newBtnDel = document.createElement('button'),
            newLblCarrera = document.createElement('label'),
            newImgCarrera = document.createElement('img'),
            newLblAlumnos = document.createElement('label'),
            newInId = document.createElement('input');
        $.ajax({
            url: '/carreras',
            method: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
        }).done(function(res) {
            Swal.fire({
                toast: true,
                position: 'top',
                icon: 'info',
                title: res,
                showConfirmButton: false,
                timer: 1500
            })
            const newImg = logo.files[0];
            const objURL = URL.createObjectURL(newImg)
            newImgCarrera.setAttribute('src', objURL)
            newImgCarrera.className = 'img-logoCarrera'
            newLblAlumnos.innerHTML = "Alumnos registrados: 0"
            newLblCarrera.innerHTML = carrera
            newFormDel.className = 'deleteCareer'
            newBtnDel.className = 'fas fa-minus-circle delete-career'
            newFormDel.appendChild(newBtnDel)
            newItem.className = 'carousel__elemento'
            items[items.length - 1].insertAdjacentElement('afterend', newItem)
            console.log(items[items.length - 1])
            items[items.length - 1].insertAdjacentElement('afterbegin', newFormDel)
            items[items.length - 1].insertAdjacentElement('beforeend', newLblCarrera)
            items[items.length - 1].insertAdjacentElement('beforeend', newImgCarrera)
            items[items.length - 1].insertAdjacentElement('beforeend', newLblAlumnos)


        });
        event.preventDefault();
    });


    for (let i = 0; i < deleteCareer.length; i++) {
        deleteCareer[i].addEventListener('submit', function(event) {
            Swal.fire({
                title: '¿Seguro de eliminar?',
                text: "No se podra revertir el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/carreras/' + carreraId[i].value,
                        method: 'DELETE',
                        data: {
                            ID: carreraId[i].value,
                            _token: _token,
                        }
                    }).done(function(res) {
                        Swal.fire({
                            toast: true,
                            position: 'top',
                            icon: 'info',
                            title: res,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        items[i].remove();
                    });
                }
            })
            event.preventDefault();
        });
    }
    new Glider(document.querySelector('.carousel__lista'), {
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: true,

        arrows: {
            prev: '.carousel__anterior',
            next: '.carousel__siguiente'
        },
        responsive: [{
            // screens greater than >= 775px
            breakpoint: 450,
            settings: {
                // Set to `auto` and provide item width to adjust to viewport
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }, {
            // screens greater than >= 1024px
            breakpoint: 800,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }
        }]
    });




});