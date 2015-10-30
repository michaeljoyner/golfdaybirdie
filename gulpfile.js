var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('fapp.scss', './public/css/fapp.css')
        .sass('app.scss', './public/css/app.css')
        .scripts([
            'sweetalert.min.js',
            'cart.js',
            'lodash.min.js',
            'dropzone.js',
            'dropzonemanager.js',
            'cartmanager.js',
            'contactform.js',
            'vue.js',
            'vue-resource.js',
            'vueconstructors.js'
        ], './public/js/all.js')
        .scripts([
            'sweetalert.min.js',
            'dropzone.js',
            'jquery.js',
            'webflow.js',
            'contactform.js',
            'vue.js',
            'vue-resource.js',
            'vueconstructors.js'
        ], './public/js/fall.js')
        .version(['css/app.css', 'css/fapp.css', 'js/all.js', 'js/fall.js']);
});
