const mix = require('laravel-mix');
const webpackNodeExternals = require('webpack-node-externals')

mix
    .js('resources/js/ssr.js', 'public/js')
    .vue(3)
    .alias({
        '@': 'resources/js',
        'ziggy': 'vendor/tightenco/ziggy/dist/index',
    })
    .postCss('resources/css/app.css', 'public/css')
    .disableNotifications()
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
    })
    .options({
        legacyNodePolyfills: false,
    });
