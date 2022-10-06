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
    .js("./node_modules/sweetalert2/dist/SweetAlert2.all.js", "public/js")
    .css("./node_modules/sweetalert2/dist/sweetalert2.css", "public/css")
    .js("./node_modules/flowbite/dist/flowbite.js", "public/js")
    .css("./node_modules/flowbite/dist/flowbite.css", "public/css")
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
