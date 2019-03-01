<template>
  <span></span>
</template>
<script>
export default {
  name: "ServiceWorker",
  methods: {
    registerServiceWorker() {
      if ("serviceWorker" in navigator) {
        if (!("serviceWorker" in navigator)) {
          console.log("Service workers aren't supported in this browser.");
          return;
        }
        if (document.readyState === "complete") {
          window.addEventListener("load", () => {
            this.register();
          });
        } else {
          this.register();
        }
      } else {
        console.log("Navegador obsolet");
      }
    },
    register() {
      navigator.serviceWorker
        .register("/service-worker.js")
        .then(function(registration) {
          console.log("Registration successful, scope is.", registration.scope);
        })
        .catch(function(error) {
          console.log("Service worker registration failed, error", error);
        });
    }
  },
  // VULL EXECUTAR EL REGISTRE DEL SERVICE WORKER
  mounted() {
    this.registerServiceWorker();
  }
};
</script>

