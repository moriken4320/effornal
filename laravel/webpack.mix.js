let mix = require('laravel-mix');

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

mix.js([
      'resources/assets/js/app.js',
      'resources/assets/js/user_image_preview.js',
      'resources/assets/js/fixed.js',
      'resources/assets/js/subject_complement.js',
      'resources/assets/js/like.js',
      'resources/assets/js/flash.js',
   ], 'public/js/app.js');

   mix.sass('public/scss/application.scss', 'public/css/application.css'); // assets/sass配下のapplication.scssを、public/css配下にapplication.cssとしてコンパイル