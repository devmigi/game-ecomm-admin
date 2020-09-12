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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss')
]);



/*
 |--------------------------------------------------------------------------
 | Admin App
 |--------------------------------------------------------------------------
 */

mix.js('resources/js/admin/app.js', 'public/js/admin').sourceMaps();

mix.sass('resources/sass/admin/app.scss', 'public/css/admin');