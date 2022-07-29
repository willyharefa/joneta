const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
*/

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .sass('resources/sass/homepage.scss', 'public/css/homepage.css')
    .sass('resources/sass/dashboard.scss', 'public/css/dashboard.css')
    .sass('resources/sass/login.scss', 'public/css/login.css');