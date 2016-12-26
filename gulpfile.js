var elixir = require('laravel-elixir');
require('laravel-elixir-vue-2')
// require('laravel-elixir-vueify');





elixir(function(mix) {

    // mix.browserify('main.js');
	mix.webpack('app.js');		

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
