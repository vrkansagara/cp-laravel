require('laravel-mix-polyfill');
const config = require('./webpack.config');
const mix = require('laravel-mix');
const productionSourceMaps = false;

mix.webpackConfig(config);
mix
    .js('resources/js/app.js', 'public/dist/js')
    .extract(
        [
            'bootstrap',
            'vue',
            'jquery',
            'datatables.net-bs4',
            'datatables.net-buttons-bs4',
            'fabric',
        ]
    )
    .version()
    .options({
        processCssUrls: false,
    })
    .sass('resources/sass/app.scss', 'public/dist/css', {
        implementation: require('node-sass'),
    })
    .sourceMaps(productionSourceMaps, 'source-map')
    .polyfill({
        enabled: true,
        useBuiltIns: "usage",
        targets: {"firefox": "50", "ie": 11}
    })
;

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync('http://127.0.0.1:8000');
    // Development settings
    mix.version()
        .webpackConfig({
            devtool: 'cheap-eval-source-map', // Fastest for development
        });
}
