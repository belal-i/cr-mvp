const mix = require('laravel-mix');

const version = 'd4547';
const publicCssPath    = 'public/css'    + version;
const publicJsPath     = 'public/js'     + version;
const publicImagesPath = 'public/images' + version;

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

mix.js('resources/js/app.js', publicJsPath)
   .postCss('resources/css/app.css', publicCssPath, [
	          //
   ]);

mix.sass('resources/sass/app.scss', publicCssPath);
mix.copy('resources/images/*.svg', publicImagesPath);
mix.copy('resources/images/*.gif', publicImagesPath);
mix.copy('resources/images/*.png', publicImagesPath);
mix.copy('resources/images/*.jpg', publicImagesPath);
mix.copy('resources/images/favicon.ico', publicImagesPath);
mix.copy('resources/css/style.css', publicCssPath);
mix.copy('resources/js/main.js', publicJsPath);

mix.scripts([
    'node_modules/@splidejs/splide/dist/js/splide.min.js',
], publicJsPath + '/splide.js')
.styles([
    'node_modules/@splidejs/splide/dist/css/splide.min.css',
    // Include this one if you want to fully customize the look.
    // 'node_modules/@splidejs/splide/dist/css/splide-core.min.css',
], publicCssPath + '/splide.css');
