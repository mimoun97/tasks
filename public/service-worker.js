"use strict";
console.log('HOLA');
self.addEventListener('fetch', function (event) {
    console.log('WORKER: fetch event progress: ', event);
})