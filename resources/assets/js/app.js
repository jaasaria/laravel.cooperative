require('./bootstrap');

// var Vue = require('vue');

import VueMoment from 'vue-moment'
Vue.use(VueMoment)



Vue.component('example', require('./components/Example.vue'));
Vue.component('comments', require('./components/Comments.vue'));

const app = new Vue({
    el: '#app',
    created(){

		// this.pusher = new Pusher('ecce3514ecfa8d62617e',{
		// 	encrypted: true,
		// 	cluster:'ap1'
		// });

		// this.channel = this.pusher.subscribe('jaasaria_channel')
		// this.channel.bind('ChatMessageReceived',function(data){
		// 	console.log('receive message from pusher');
		// });

    }


  
});














// Vue.component('comments', require('./components/Comments.vue'));

// var vm =  new Vue({
//     el: '#app1',
//     data:{
//     }
// });




// var Vue = require('vue');
// Vue.use( require('vue-resource') );

// var Pusher = require('pusher-js');

// new Vue({
// 	 el: '#app',
//     data:{
//     	val:''
//     },
//     ready: function(){
//     	console.log('test');
//         // this.pusher = new Pusher('ecce3514ecfa8d62617e');

//          this.pusher = new Pusher('ecce3514ecfa8d62617e', {
// 	      cluster: 'ap1',
// 	      encrypted: true
//     	});
//         this.pusherChannel = this.pusher.subscribe('jaasaria_channel');
//         this.pusherChannel.bind('ChatMessageReceived', function(data) {
//             console.log(data);
//         });
//     }
// });
