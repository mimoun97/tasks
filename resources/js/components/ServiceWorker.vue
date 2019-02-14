<template>
    <span></span>
</template>
<script>
export default {
  name: 'ServiceWorker',
  methods: {
    registerServiceWorker() {
      if ('serviceWorker' in navigator) {

      navigator.serviceWorker.register('/service-worker.js')
        .then(function (registration) {
          console.log('Registration successful, scope is.', registration.scope);
        })
        .catch(function (error) {
          console.log('Service worker registration failed, error', error)
        })
      
    } else {
      console.log('Navegador obsolet')
    }
    }
  },
  // VULL EXECUTAR EL REGISTRE DEL SERVICE WORKER
  mounted () {
    this.registerServiceWorker()
  }
}
</script>

