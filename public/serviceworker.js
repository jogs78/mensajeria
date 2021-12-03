const cacheName = "mensajeriaITTGv0";
const filesToCache = [
    '/',
    '/log-in',
    '/sign-up',
    '/inicio',
    '/panel-difusor',
    '/user',
    '/empleado',
    '/alumno',
    '/mensajes',
    '/carreras',
    '/mensajes-alumnos',
    '/serviceworker.js',
    '/manifest.json',
    '/static/css/webfonts/fa-brands-400.eot',
    '/static/css/webfonts/fa-brands-400.svg',
    '/static/css/webfonts/fa-brands-400.ttf',
    '/static/css/webfonts/fa-brands-400.woff',
    '/static/css/webfonts/fa-brands-400.woff2',
    '/static/css/webfonts/fa-regular-400.eot',
    '/static/css/webfonts/fa-regular-400.svg',
    '/static/css/webfonts/fa-regular-400.ttf',
    '/static/css/webfonts/fa-regular-400.woff',
    '/static/css/webfonts/fa-regular-400.woff2',
    '/static/css/webfonts/fa-solid-900.eot',
    '/static/css/webfonts/fa-solid-900.svg',
    '/static/css/webfonts/fa-solid-900.ttf',
    '/static/css/webfonts/fa-solid-900.woff',
    '/static/css/webfonts/fa-solid-900.woff2',
    '/static/css/css/all.css',
    '/static/css/login_style.css',
    '/static/css/signup_style.css',
    '/static/css/alumno_mensajes_style.css',
    '/static/css/dashboard_style.css',
    '/static/css/mensaje_create_style.css',
    '/static/css/mensaje_edit_style.css',
    '/static/css/mensaje_list_style.css',
    '/static/css/mensaje_show_style.css',
    '/static/css/user_edit_style.css',
    '/static/css/user_list_style.css',
    '/static/css/user_register_style.css',
    '/static/css/sweetalert/sweetalert2.all.min.js',
    '/static/glider/glider.min.css',
    '/static/glider/glider.min.js',
    '/static/js/dashboard.js',
    '/static/js/informatico.js',
    '/static/js/mensajes.js',
    '/static/js/difusor.js',
    '/static/jquery/jquery-3.6.0.min.js',
    '/static/jquery/jquery.zoom.min.js',
    '/static/imagenes/ittg_escudo.svg',
    '/static/imagenes/mascota_ittg.png',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
];

self.addEventListener("install", e => {
    console.log("[ServiceWorker**] - Install");
    e.waitUntil(
        caches.open(cacheName).then(cache => {
            console.log("[ServiceWorker**] - Caching app shell");
            return cache.addAll(filesToCache);
        }).then(() => {
            return self.skipWaiting();
        })

    );
});

self.addEventListener("activate", event => {
    caches.keys().then(keyList => {
        return Promise.all(
            keyList.map(key => {
                if (key !== cacheName) {
                    console.log("[ServiceWorker] - Removing old cache", key);
                    return caches.delete(key);
                }
            })
        );
    });
    event.waitUntil(self.clients.claim());
});


self.addEventListener('fetch', function(event) {
    event.respondWith(

        fetch(event.request).catch(function() {
            console.log(event.request)
            return caches.match(event.request);
        })
    );
});

// self.addEventListener("fetch", event => {
//     event.respondWith(
//         caches.match(event.request, { ignoreSearch: true }).then(response => {
//             if (response) {
//                 console.log('Found ', event.request.url, ' in cache');
//                 console.log('Network request for ', event.request.url);
//                 return response;
//             }
//             return response || fetch(event.request);

//         }).catch(error => {

//             // TODO 6 - Respond with custom offline page
//             console.log(error);


//         })
//     );
// });