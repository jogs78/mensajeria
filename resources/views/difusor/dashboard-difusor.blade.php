<section class="dashboard-difusor">
    <div class="dashboard-difusor__contianer">
        <div class="dashboard-difusor__mensajes">
            <img class="img-dashboard"
                src="https://iconarchive.com/download/i84522/designbolts/seo/Review-Post.ico" alt="">
            <label for="" id="lblMensajesTotal">Mensajes totales: 00000</label>
            <a href="/mensajes" class="btn__verMensajes">Ver mensajes</a>
        </div>
        <div class="dashboard-difusor__alumnos">
            <img src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="">
            <label id="lbl1alumnosTotal">Alumnos registrados: 0000</label>
        </div>
        <div class="dashboard-difusor__carrerasMensajes">
            <label class="lbl__info">Publicaciones por carreras</label>
            <ol class="list__carreras" id="mensajesByCarreras">
            </ol>
        </div>
    </div>
    <style>
        .preloader_container {
    position: absolute;
    display: flex;
    margin: auto;
    width: 100%;
    height: 100vh;
    top: 0;
    flex-direction: column;
    background: #ffffff;
    transition: all 1s;
    z-index: 100;

}
        .preloader{

    margin: auto;
    width: 50px;
    height: 50px;
    border: 10px solid #00000087;
    border-radius: 50%;
    animation: spin 2000ms linear 100ms infinite normal forwards;
}
@keyframes spin {
    0%{
        transform: rotate(0deg);
        border-top: 10px solid #666;
    }
    50%{
        transform: rotate(180deg);
        border-top: 10px solid rgba(102, 102, 102, 0.514);
    }
    100%{
        transform: rotate(360deg);
        border-top: 10px solid rgba(102, 102, 102, 0);
    }
}
.span{
    position: absolute;
margin: auto;
top: 59%;
bottom: 50%;
font-size: 20px;
text-align: center;
width: 100%;
color: rgb(0, 0, 0);
font-weight: 800;
}
    </style>
    
</section>
<div class="preloader_container">
        <div class="preloader"></div>
        <span class="span">Cargando...</span>

    </div>