<template></template>
<script>
  export default {
    name: 'ServiceWorker',
    mounted () {
      if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js');
      } else {
        console.log('Navegador no soporta workers')
      }
    }
  }
</script>
