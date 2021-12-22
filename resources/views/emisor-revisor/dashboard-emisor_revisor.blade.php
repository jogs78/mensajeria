<section class="dashboard-EmisorRevisror">
    <div class="dashboard-EmisorRevisor__container">
        <div class="dashboard-EmusorRevisor__infMensajes">
            <img src="https://iconarchive.com/download/i84522/designbolts/seo/Review-Post.ico" alt=""
                class="img-dashboard">
            <label class="lbl__info" id="mT"></label>
            <label class="lbl__info" id="mA"> </label>
            <label class="lbl__info" id="mP"></label>
            <a href="/mensajes" class="btn__verMensajes">Ver mensajes</a>
        </div>
        <div class="dashboard-EmisorRevisor__carrerasMensajes">
            <label class="lbl__info">Publicaciones por carreras</label>
            <ol class="list__carreras" id="listM">
                
            </ol>
        </div>
    </div>
    <script>
        let mT = document.getElementById('mT')
        let mA = document.getElementById('mA')
        let mP = document.getElementById('mP')
        let listM = document.getElementById('listM')
        let newLi = document.createElement('li');
        window.addEventListener('load', function(){
            $.ajax({
                url: '/panel-emisor',
                method: 'GET',
            }).done(function(res){
                console.log(res.Totalmensaje)
                if(res){
                    mT.innerHTML = "Publicaciones totales: "+ res.Totalmensaje
                    mA.innerHTML = "Publicaciones aceptadas: "+ res.mensajesAceptados
                    mP.innerHTML = "Publicaciones pendientes: "+ res.mensajesPendientes
                    for(let i = 0; i < res.mensajesCarreras.length; i++){
                        newLi.innerHTML = res.mensajesCarreras[i].carrera +": " + res.mensajesCarreras[i].total
                        console.log( newLi)
                        listM.innerHTML=listM.innerHTML+ `<li>${res.mensajesCarreras[i].carrera}: ${res.mensajesCarreras[i].total}</li>`
                    }
                }
            })
        })
    </script>
</section>
