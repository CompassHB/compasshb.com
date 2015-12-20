
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */


/**
  * Bootstrap / Less styles (old)
  **/
elixir(function(mix) {
    mix.sass('app.scss')
       .browserify('app.js')
       .version(['css/app.css', 'js/app.js']);

    mix.copy(
       'node_modules/bootstrap/dist/fonts',
       'public/build/fonts'
   )

});
