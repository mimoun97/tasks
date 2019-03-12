importScripts("/service-worker/precache-manifest.6a7ced9797a8f2f14b358835240d5bcb.js", "https://storage.googleapis.com/workbox-cdn/releases/3.6.3/workbox-sw.js");

workbox.core.skipWaiting()
workbox.core.clientsClaim()
workbox.core.setConfig({
    debug: false
});

// workbox.routing.registerRoute(
//   new RegExp('https://hacker-news.firebaseio.com'),
//   workbox.strategies.staleWhileRevalidate()
// );

// // TODO cal utilitzar PushManager al registrar el service worker
// self.addEventListener('push', (event) => {
//     const title = 'TODO CANVIAR TITOL'
//     const options = {
//         body: event.data.text()
//     }
//     event.waitUntil(self.registration.showNotification(title, options))
// })
//pre-cache
workbox.precaching.precacheAndRoute(self.__precacheManifest)
// workbox.precaching.precacheAndRoute([]) També funciona i workbox substitueix pel que pertoca -> placeholder

/**Fin de archivo */

// static
workbox.routing.registerRoute(
    new RegExp('.(?:ico)$'),
    new workbox.strategies.NetworkFirst({
        cacheName: 'icons'
    })
)

// images
workbox.routing.registerRoute(
    new RegExp('.(?:jpg|jpeg|png|gif|svg|webp)$'),
    new workbox.strategies.CacheFirst({
        cacheName: 'images',
        plugins: [
            new workbox.expiration.Plugin({
                maxEntries: 20,
                purgeOnQuotaError: true
            })
        ]
    })
)

workbox.routing.registerRoute(
    '/',
    new workbox.strategies.StaleWhileRevalidate({ cacheName: 'landing' })
)

workbox.routing.registerRoute(
    '/tasques',
    new workbox.strategies.StaleWhileRevalidate({ cacheName: 'tasqques' })
)

workbox.routing.registerRoute(
    new RegExp('/api/'),
    new workbox.strategies.NetworkFirst({ cacheName: 'api' })
)


workbox.routing.registerRoute(
    '/api/v1/newsletter',
    new workbox.strategies.NetworkOnly({
        cacheName: 'api',
        plugins: [bgSyncPlugin]
    }),
    'POST'
)

// NO ENS CAL PQ LES TENIM INTEGRADES EN LOCAL VIA WEBPACK i NMP IMPORTS
// // fonts
// workbox.routing.registerRoute(
//   new RegExp('https://fonts.*'),
//   workbox.strategies.cacheFirst({
//     cacheName: 'fonts',
//     plugins: [
//       new workbox.cacheableResponse.Plugin({
//         statuses: [0, 200]
//       })
//     ]
//   })
// )
//
// // google stuff
// workbox.routing.registerRoute(
//   new RegExp('.*(?:googleapis|gstatic).com.*$'),
//   workbox.strategies.networkFirst({
//     cacheName: 'google'
//   })
// )
//
// // static
// workbox.routing.registerRoute(
//   new RegExp('.(?:js|css|ico)$'),
//   workbox.strategies.networkFirst({
//     cacheName: 'static'
//   }),
// )
//
// // images
// workbox.routing.registerRoute(
//   new RegExp('.(?:jpg|png|gif|svg)$'),
//   workbox.strategies.cacheFirst({
//     cacheName: 'images',
//     plugins: [
//       new workbox.expiration.Plugin({
//         maxEntries: 20,
//         purgeOnQuotaError: true,
//       })
//     ]
//   })
