window.addEventListener('load', function() {
    let expanded = false;
    let checkboxes = document.getElementsByClassName("checkboxes");
    let selectBox = document.getElementsByClassName("selectBox");
    let previewImage = document.getElementById('previewImage');
    let image = document.getElementById('file-1');
    let doc = document.getElementById('file-2');
    let verDocumento = this.document.getElementById('verDocumento')
    for (let i = 0; i < 2; i++) {
        selectBox[i].addEventListener("click", function() {
            if (!expanded) {
                checkboxes[i].style.display = "block";
                expanded = true;
            } else {
                checkboxes[i].style.display = "none";
                expanded = false;
            }
        });

    }
    image.addEventListener('change', function(e) {
        let image = e.target.files[0];
        let file = new FileReader();
        file.onload = (e) => {
            previewImage.setAttribute('src', e.target.result)
        }
        file.readAsDataURL(image);
    });
    doc.addEventListener('change', function(e) {
        let doc = e.target.files[0];
        let file = new FileReader();
        let docName = document.getElementById('fileName')
        docName.className = "mensaje-create__form_lbl_adjuntar"
        docName.innerHTML = "Archivo seleccionado: " + doc.name;

    });
    if (verDocumento) {
        verDocumento.addEventListener('click', function() {
            let MostrarDocumento = document.getElementById('MostrarDocumento');
            MostrarDocumento.style.display = "block"
        });
    }

})