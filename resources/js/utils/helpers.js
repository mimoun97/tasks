export default {
    /**
   * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
   *
   * @param  {String} base64String
   * @return {Uint8Array}
   */
    urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4)
        const base64 = (base64String + padding)
            .replace(/\-/g, '+')
            .replace(/_/g, '/')

        const rawData = window.atob(base64)
        const outputArray = new Uint8Array(rawData.length)

        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i)
        }

        return outputArray
    },
    changeExtension(path, ext) {
        var pos = path.lastIndexOf('.')
        return path.substr(0, pos < 0 ? path.length : pos) + '.' + ext
    },
    async supportsWebp() {
        if (!self.createImageBitmap) return false

        const webpData = 'data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA='
        const blob = await fetch(webpData).then(r => r.blob())
        return createImageBitmap(blob).then(() => true, () => false)
    }
}