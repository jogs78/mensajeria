window.addEventListener('load', function() {
    let btnMenu = document.getElementById("navigation_btn");
    let menu = document.getElementById("menu");
    let personalInformation = document.getElementById('personalInformation')
    let btnShow = document.getElementById('btnShow');
    let btnBack = document.getElementById('btnback')
    let btnEdit = document.getElementsByClassName('edit');
    let inputInfo = document.getElementsByClassName('input')
    let actualizarInfo = document.getElementById('actualizarInfo')
    let userP = document.getElementById('userP');
    let userName = document.getElementById('userName')
    let bandera = false;
    let bandera1 = false;
    let img = null;
    btnMenu.addEventListener('click', function() {
        menu.classList.toggle('navigation_show');
        btnMenu.classList.toggle('navigation_alternate_color')
        personalInformation.focus();

    });

    personalInformation.addEventListener('blur', function() {
        personalInformation.focus();
        if (bandera1) {
            menu.classList.toggle('navigation_show');
            btnMenu.classList.toggle('navigation_alternate_color')
            bandera1 = false
        }
        bandera = false
    });

    btnShow.addEventListener('click', function() {
        personalInformation.style.left = 0
        personalInformation.focus();
        bandera1 = true
    });
    btnBack.addEventListener('click', function() {
        personalInformation.style.left = '-100%'
        personalInformation.focus();
        bandera1 = true
    });
    for (let i = 0; i < btnEdit.length; i++) {
        btnEdit[i].addEventListener('click', function() {
            if (bandera == false) {
                inputInfo[i].disabled = false;
                bandera = true;
            } else {
                inputInfo[i].disabled = true;
                bandera = false;
            }
        })
    }
    userP.addEventListener('click', function() {
        bandera1 = false
    });
    userP.addEventListener('change', function(e) {
        bandera1 = true
        let image = e.target.files[0];
        img = image;
        let file = new FileReader();
        let imgProfile = document.getElementById('imgProfileNew')
        let imgProfile1 = document.getElementById('imgProfile')
        file.onload = (e) => {
            imgProfile1.setAttribute('src', e.target.result)
            imgProfile.setAttribute('src', e.target.result)
        }
        file.readAsDataURL(image);
    });
    actualizarInfo.addEventListener('submit', function(e) {
        let formData = new FormData(this);
        var fullName = document.getElementById('nombre').value + " " + document.getElementById('a_paterno').value + " " + document.getElementById('a_materno').value
        formData.append("nombre", document.getElementById('nombre').value);
        formData.append("a_paterno", document.getElementById('a_paterno').value);
        formData.append("a_materno", document.getElementById('a_materno').value);
        formData.append("correo", document.getElementById('correo').value);
        formData.append("newPass", document.getElementById('password').value);
        $.ajax({
            url: actualizarInfo.action,
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(res) {
            userName.innerHTML = fullName;
            Swal.fire({
                toast: true,
                position: 'top-left',
                icon: 'info',
                title: res,
                showConfirmButton: false,
                timer: 1500
            })

        });
        e.preventDefault();
    });
})