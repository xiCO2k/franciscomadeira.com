import path from 'path'
import vue from '@vitejs/plugin-vue'

export default ({ command }) => ({
    base: command === 'serve' ? '' : '/dist/',
    plugins: [vue()],
    build: {
        manifest: true,
        outDir: 'public/dist',
        emptyOutDir: true,
        target: 'es2018',
        rollupOptions: {
            input: [
                'resources/js/app.js',
                'resources/css/app.css',
            ],
        },
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            'ziggy': path.resolve('vendor/tightenco/ziggy/dist/vue.m.js')
        }
    },
});
