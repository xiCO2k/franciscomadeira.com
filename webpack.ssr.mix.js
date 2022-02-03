const mix = require('laravel-mix');
const webpackNodeExternals = require('webpack-node-externals')

mix
    .js('resources/js/ssr.js', 'public/js')
    .vue({ version: 3, options: { optimizeSSR: true }})
    .alias({
        '@': 'resources/js',
        'ziggy': 'vendor/tightenco/ziggy/dist/index',
    })
    .disableNotifications()
    .webpackConfig({
        target: 'node',
        externals: [webpackNodeExternals()],
    })
    .options({
        manifest: false,
        legacyNodePolyfills: false,
    });
