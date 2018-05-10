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

mix.disableNotifications();
mix.version([
  'public/dist/css/app.css',
  'public/dist/js/manifest.js',
  'public/dist/js/vendor.js',
  'public/dist/js/dashboard.js',
]);
