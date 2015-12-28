
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

elixir(function(mix) {
    mix.sass('app.scss')
       .browserify('app.js');


    mix.styles([
        '../../../node_modules/medium-editor/dist/css/themes/default.css',
        '../../../node_modules/medium-editor/dist/css/medium-editor.css',
        '../../../public/css/app.css'
    ]);

    mix.version([
        'css/all.css',
        'js/app.js'
    ]);
});