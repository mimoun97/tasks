importScripts("/service-worker/precache-manifest.1bc356d49ce2736617bef20a082bf60a.js", "https://storage.googleapis.com/workbox-cdn/releases/4.1.0/workbox-sw.js");

workbox.setConfig({
    debug: true
});
// 4.0
workbox.core.skipWaiting()
workbox.core.clientsClaim()

workbox.precaching.cleanupOutdatedCaches()

//TODO notifications push

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


// TODO NOTIFICATIONS
self.addEventListener('push', (event) => {
    const title = 'TODO CANVIAR TITOL'
    const options = {
        body: event.data.text()
    }
    event.waitUntil(self.registration.showNotification(title, options))
})


const showNotification = () => {
    self.registration.showNotification('Post Sent', {
        body: 'You are back online and your post was successfully sent!'
        // icon: 'assets/icon/256.png',
        // badge: 'assets/icon/32png.png'
    })
}

const bgSyncPlugin = new workbox.backgroundSync.Plugin('newsletter', {
    maxRetentionTime: 24 * 60, // Retry for max of 24 Hours
    callbacks: {
        queueDidReplay: showNotification
    }
})

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
