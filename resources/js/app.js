require('./bootstrap');
Echo.channel('mensajeriaITTG-home')
    .listen('MensajeEvent', (e) => {
        console.log(e);
    });