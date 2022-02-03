const mix = require('laravel-mix');
const isHot = process.argv.includes('--hot');

mix
    .js('resources/js/app.js', 'public/js')
    .extract()
    .vue(3)
    .alias({
        '@': 'resources/js',
        'ziggy': 'vendor/tightenco/ziggy/dist/vue',
    })
    .postCss('resources/css/app.css', 'public/css')
    .version()
    .disableNotifications()
    .sourceMaps()
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]',
        },
        stats: {
            children: true,
        },
    });

if (isHot) {
    mix.setResourceRoot('//localhost:8080');
}
