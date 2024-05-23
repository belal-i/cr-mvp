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
   .postCss('resources/css/app.css', 'public/css', [
	          //
   ]);

mix.sass('resources/sass/app.scss', 'public/css');
mix.copy('resources/images/*.svg', 'public/images');
mix.copy('resources/images/*.gif', 'public/images');
mix.copy('resources/images/*.png', 'public/images');
mix.copy('resources/images/*.jpg', 'public/images');
mix.copy('resources/images/favicon.ico', 'public/images');
mix.copy('resources/css/style.css', 'public/css');
mix.copy('resources/js/main.js', 'public/js');

mix.scripts([
    'node_modules/@splidejs/splide/dist/js/splide.min.js',
], 'public/js/splide.js')
.styles([
    'node_modules/@splidejs/splide/dist/css/splide.min.css',
    // Include this one if you want to fully customize the look.
    // 'node_modules/@splidejs/splide/dist/css/splide-core.min.css',
], 'public/css/splide.css');
