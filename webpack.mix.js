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

// Admin
mix.styles([
    'resources/assets/admin/plugins/fontawesome-free/css/all.css',
    'resources/assets/admin/css/custom.css',
    'resources/assets/admin/css/adminlte.css',
    'resources/assets/admin/css/adminlte.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
    'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
], 'public/assets/admin/css/admin.css');

mix.scripts([
    'resources/assets/admin/plugins/jquery/jquery.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
    'resources/assets/admin/js/bs-custom-file-input.min.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/plugins/ckeditor/build/ckeditor.js',
], 'public/assets/admin/js/admin.js');

mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img')
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts',
                  'public/assets/admin/webfonts')

mix.copy('resources/assets/admin/css/adminlte.min.css.map', 'public/assets/admin/css/adminlte.min.css.map')
mix.copy('resources/assets/admin/css/adminlte.css.map', 'public/assets/admin/css/adminlte.css.map')
mix.copy('resources/assets/admin/js/adminlte.min.js.map', 'public/assets/admin/js/adminlte.min.js.map')

// Front
mix.styles([
    'resources/assets/front/lib/owlcarousel/assets/owl.carousel.min.css',
    'resources/assets/front/css/style.css',
    'resources/assets/front/css/custom.css',
], 'public/assets/front/css/main.css');

mix.scripts([
    'resources/assets/front/lib/easing/easing.min.js',
    'resources/assets/front/lib/owlcarousel/owl.carousel.min.js',
    'resources/assets/front/js/main.js',
    'resources/assets/front/js/custom.js',
], 'public/assets/front/js/main.js');

mix.copyDirectory('resources/assets/front/img', 'public/assets/front/img')
