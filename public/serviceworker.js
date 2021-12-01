var cacheName = "pwa-v0";
var filesToCache = [
    '/inicio',
    '/log-in',
    '/static/css/css/all.css',
    '/static/css/sweetalert/sweetalert2.all.min.js',
    '/static/jquery/jquery-3.6.0.min.js',
    '/static/css/login_style.css',
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

self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request, { ignoreSearch: true }).then(response => {
            return response || fetch(event.request);
        })
    );
});