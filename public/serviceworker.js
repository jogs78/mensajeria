const cacheDynamicName = 'mensajeriaITTGDynamic-v1'
const cacheStaticName = 'mensajeriaITTGStatic-v1'
const cacheInmutableName = 'mensajeriaITTGInmutable-v1'
const cacheItems = 50;

function limpiarCache(cacheName, numeroItems) {
    caches.open(cacheName).then(cache => {
        cache.keys()
            .then(keys => {
                if (keys.length > numeroItems) {
                    cache.delete(keys[0])
                        .then(limpiarCache(cacheName, numeroItems))
                }
            })
    });
}
const filesToCache = [
    '/',
    '/log-in',
    '/sign-up',
    '/manifest.json',
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
]
const filesToCacheInmutable = [
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
    '/static/css/sweetalert/sweetalert2.all.min.js',
    '/static/glider/glider.min.css',
    '/static/glider/glider.min.js',
    '/static/js/dashboard.js',
    '/static/js/informatico.js',
    '/static/js/mensajes.js',
    '/static/js/difusor.js',
    '/static/jquery/jquery-3.6.0.min.js',
    '/static/jquery/jquery.zoom.min.js',
    '/static/jquery/jquery-ui.js',
    '/static/jquery/jquery-ui.css',
    '/static/js/offline.js',
    '/static/js/mdtoast.min.js',
    '/static/js/mdtoast.min.css',
]
self.addEventListener('install', event => {
    // se guarda el cache y cosas nuevas
    console.log('SW: Installing')
    const cacheProm = caches.open(cacheStaticName).then(cache => {
        return cache.addAll(filesToCache).then(
            console.log("Caching AppShell")
        )
    }).catch(err => { console.log('fallo appshell: ', err) })
    const cacheInmutable = caches.open(cacheInmutableName).then(cache => {
        return cache.addAll(filesToCacheInmutable).then(
            console.log("Caching imutable cache")
        )
    }).catch(err => { console.log('fallo imuntable: ', err) })
    event.waitUntil(Promise.all([cacheProm, cacheInmutable]));
});

self.addEventListener('activate', event => {
    //borar cache viejo
    console.log("SW: activated & ready")
});

self.addEventListener('fetch', event => {

    const respuesta = fetch(event.request).then(res => {
        console.log("respuesta del fetch", res)

        caches.open(cacheDynamicName)
            .then(cache => {
                cache.put(event.request, res);
                limpiarCache(cacheDynamicName, cacheItems)
            })
        return res.clone()
    }).catch(err => {
        return caches.match(event.request)
    })
    event.respondWith(respuesta)
});


self.addEventListener('push', event => {
    console.log("notificacion recibida")
})
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    clients.openWindow("/mensajes-alumnos?mensajes_nuevos=true");
}, false);