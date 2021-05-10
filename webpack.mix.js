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

mix.js('resources/js/app.js', 'public/js').version();
mix.js('resources/js/request/request.js', 'public/js').version();
mix.js('resources/js/home/feedback.js', 'public/js').version();

mix.sass('resources/sass/app.scss', 'public/css').version();
mix.sass('resources/sass/home.scss', 'public/css').version();
mix.sass('resources/sass/request.scss', 'public/css').version();
mix.sass('resources/sass/rating.scss', 'public/css').version();
