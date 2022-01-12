function isOnline() {
    if (navigator.onLine) {
        Swal.fire({
            toast: true,
            position: 'bottom-left',
            icon: 'success',
            title: "Estas en línea :)",
            showConfirmButton: false,
            timer: 3000
        })
    } else {

        Swal.fire({
            toast: true,
            position: 'bottom-left',
            icon: 'warning',
            title: "Ha perdido la conexión :(",
            showConfirmButton: false,
            timer: 3000
        })

    }
}

window.addEventListener('online', isOnline);
window.addEventListener('offline', isOnline);
isOnline();