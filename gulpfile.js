var elixir = require('laravel-elixir');
// var vueify = require('laravel-elixir-browserify').init("vueify");
require('laravel-elixir-vue-2');



elixir(function(mix) {

    mix.browserify('main.js');
    // mix.webpack('main.js');


	// mix.scripts([
	// 	'vendor/vue.js',
	// 	'vendor/vue-resource.min.js'
	// ],'public/js/vendor.js')


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
