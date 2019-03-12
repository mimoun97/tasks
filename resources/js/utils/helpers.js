export default {
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