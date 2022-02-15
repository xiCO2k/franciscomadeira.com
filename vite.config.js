import path from 'path'
import vue from '@vitejs/plugin-vue'

const ssr = process.argv.includes("--ssr");

export default ({ command }) => ({
    base: command === 'serve' ? '' : '/dist/',
    publicDir: false,
    server: {
        origin: 'http://localhost:3000',
    },
    plugins: [vue()],
    build: {
        ssrManifest: ssr,
        manifest: ! ssr,
        outDir: 'public/dist',
        emptyOutDir: false,
        ssr,
        rollupOptions: {
            input: ssr ? ['resources/js/ssr.js'] : [
                'resources/js/app.js',
                'resources/css/app.css',
            ],
        },
    },
    resolve: {
        alias: {
            '@': path.resolve('resources'),
            'ziggy': path.resolve(ssr ? 'vendor/tightenco/ziggy/dist/index.m.js' : 'vendor/tightenco/ziggy/dist/vue.m.js')
        }
    },
});
