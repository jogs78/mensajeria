function isOnline() {
    if (navigator.onLine) {

        $.mdtoast('En linea :)', {
            interaction: true,
            interactionTimeout: 2000,
            actionText: 'ok'
        });
    } else {

        $.mdtoast('Sin acceso a internet :(', {
            interaction: true,
            actionText: 'ok',
            type: 'warning'
        });
    }
}

window.addEventListener('online', isOnline);
window.addEventListener('offline', isOnline);
isOnline();