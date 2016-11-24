const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

// var browserify = require('laravel-elixir-browserify'); 
// var elixir = require('laravel-elixir');
// var browserify = require('laravel-elixir-browserify-official');



/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */



elixir(function(mix) {

    mix.browserify('main.js');
    mix.version('js/main.js')

    // mix.webpack('main.js'); // mix.browserify(srcPath, outputPath, srcBaseDir, browserifyOptions)

    // browserify.init();
    // mix.browserify('main.js');

});



// elixir((mix) => {


//     // mix.webpack('main.js'); // resources/assets/js/app.js
//       // mix.sass('app.js');
//       // .webpack('app.js')

//     mix.browserify('main.js');  
//     // mix.version('js/main.js')

       

//     mix.styles([
//         "c1.css",
//         "c2.css"
//     ], 'public/css/all.css');

//    // mix.scripts([
//    //      "jquery.js",
//    //      "app.js"
//    //  ], 'public/js/app.js');


// });
