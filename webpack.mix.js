const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/bootstrap.js', 'public/js')
.scripts([
    'public/js/bootstrap.js',
    'node_modules/sweetalert2/dist/sweetalert2.all.min.js',
    'node_modules/bootstrap-select/js/bootstrap-select.js',
    'resources/js/main.js',
    'resources/js/custom.js'
], 'public/js/main.js')
    .sass('resources/sass/main.scss', 'public/css')
    .options({processCssUrls: false})
    .sourceMaps(true, 'source-map')
