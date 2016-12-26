@extends('back.layouts.admin')
@section('css.import')

<style>



.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active, .list-leave-active {
  transition: all 1s;
}
.list-enter, .list-leave-active {
  opacity: 0;
  transform: translateY(30px);
}
ul .media li{
   padding: 3px;
}
.media{
	margin-top: 0;
	padding: 10px;
}
.sidebar{
    color: white;
    background-color: #404f5f; 
    padding: 0%;
}
#sidebarChat{
	width: 100%;
	margin-top: 5px;
}

#sidebarChat  li:not(.active_user):hover {
  background: #435b75 none repeat scroll 0 0;
  color: #fff;
  cursor:pointer;
}

.active_user{
	background-color: white;
	color: #2f4358;
	padding: 6px;
	margin-left: 0px;	
}
.footer_message{
	width: 80%;
}
.message_pic {
    width: 10%;
    float: left;
}
.message_pic_right {
    width: 10%;
    float: right;
    text-align: right;
}
.pull-right {
     float: right; 
}
.pull-right {
     float: right!important; 
} 
.profile_pic_sidebar {
    width: 25%;
    float: left;
    margin-left: 20px;
}
.img-circlechat {
    width: 70%;
    background: #fff;
    z-index: 1000;
    position: inherit;
    border: 1px solid rgba(52,73,94,0.44);
    padding: 2px;
    border-radius: 50%;
}
.img-circlechat-left {
    width: 70%;
    background: #fff;
    z-index: 1000;
    position: inherit;
    border: 1px solid rgba(52,73,94,0.44);
    padding: 4px;
    border-radius: 50%;
}
.img-circlechat_right {
    width: 70%;
    background: #fff;
    z-index: 1000;
    position: inherit;
    text-align: right;
    border: 1px solid rgba(52,73,94,0.44);
    padding: 4px;
    float: right;
    border-radius: 50%;
}

.panel_toolbox {float: left;min-width: 0px;}
.panel-heading{
  	background-color: #2f4358;
  	color: white
}
.panel-primary>.panel-heading {
	background-color: #2f4358;
  color: white
  border-color: #2f4358;
}

.chat-body-left {
    margin-left: 60px;
}


.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 330px;
}

.panel-footer
{
    height: 70px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}


</style>
@stop


@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title">{{ $form }} <small>User and Messages list</small></h3>
		</span>
	
	</div>

<div id="appDirect" class="row">

<div class="col-md-12 col-sm-12 col-xs-12">

  <div class="x_panel">
	<div class="row">


    <div class="col-sm-4">
			<user></user>
		</div>

		<div class="col-sm-8">
			<chat :userid.sync="userSelectedId" :userauthid.sync=" {{ auth::user()->id }} "></chat>
		</div>
	</div>

	</div>
</div>

</div>	{{-- end of the vue instance --}}



<template id="template-user">
	<div class="panel panel-primary">


	  <div class="panel-heading">
	      <span class="glyphicon glyphicon-user"></span> Users
	      <div class="btn-group pull-right">
	      </div>
	  </div>

	  <div class="panel-body sidebar">
			<div  id="sidebarChat">


				<ul class="list-unstyled top_profiles1 scroll-view" style="overflow: hidden; outline: none; cursor: -webkit-grab;">


						<li v-for="user in users" class="media event" 
							v-on:click="cmdUserSelect(user)" 
							v-bind:class="{'active_user': userSelectedId == user.id  }"
							> 

							<div class="hvr-forward">

								<div class="profile_pic_sidebar ">
			            	<img v-bind:src="user.UserAvatar" class="img-circlechat hvr-grow-shadow ">
			            </div>

			            <div class="media-body"> 
			                <div class="title">@{{ user.fullname }}
			                <small><p>@{{ user.designation }}</p></small>
			                <small>Status:</small>
			                
			                <span class="label"  
				                v-bind:class="{
				                'label-success': user.chat_status == 0,
				                'label-warning': user.chat_status == 1,
				                'label-danger': user.chat_status == 2
				                }"  > @{{ user.ChatStat }}</span>

		                	</div>
			            </div>
							</div>
					        	
			     	</li>

				</ul>
			</div>
	  </div>
	  <div class="panel-footer">

			<small>Number of Users ( @{{ users.length }} )</small>
	  </div>

	</div>
</template>

<template id="template-chat">
	<div>
		<div class="col-md-12 ">


			  <div class="panel panel-primary">

	        <div class="panel-heading">
	            <span class="glyphicon glyphicon-comment"></span> Messages
	            <div class="btn-group pull-right">
	                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                    <span class="glyphicon glyphicon-chevron-down"></span>
	                </button>
	                <ul class="dropdown-menu slidedown">

	                          <li><a href=" {{ route('messages.index') }}"><span class="glyphicon glyphicon-refresh">
	                          	</span>Refresh</a></li>

	                          <li  
	                          v-bind:class="{'active' : stat == 0}"
	                          v-on:click="updateStatus('0')"><a><span class="glyphicon glyphicon-ok-sign">
	                          	</span>Available</a></li>

	                          <li 
	                          v-bind:class="{'active' : stat == 1}"
	                          v-on:click="updateStatus('1')"><a><span class="glyphicon glyphicon-remove">
	                          	</span>Busy</a></li>
									 
				                    <li 
				                    v-bind:class="{'active' : stat == 2}"
				                    v-on:click="updateStatus('2')"><a><span class="glyphicon glyphicon-time"></span>
				                        Away</a></li>
	                </ul>
	            </div>
	        </div>

	        <div class="panel-body">
		        <div id="chat-wrap">

		       	<ul id="chat" class="chat" > {{-- v-sticky-scroll:animate=500 --}}

		 					{{-- <transition-group name="list" tag="p"> --}}

								<li  v-for="row in rows" class="clearfix" scroll-bottom="rows"  v-bind:key="row" class="list-item">

										<div 
												v-bind:class="{'message_pic pull-left': row.sender_id == {{ auth::user()->id  }}, 
																			'message_pic_right pull-right': row.sender_id != {{ auth::user()->id  }} }"
												>
												<img v-bind:src="row.user_sender.UserAvatar" 
												class="img-circlechat-left" />	
										</div>

			              <div class="clearfix"
												v-bind:class="{'chat-body': row.sender_id == {{ auth::user()->id  }}, 
																			'chat-body-left': row.sender_id != {{ auth::user()->id  }} }"
			              >

			                  <div class="header">
			                      <strong class="primary-font"> @{{  row.user_sender.fullname  }}</strong> 
			                      <small class="pull-right text-muted">
			                          <span class="glyphicon glyphicon-time"></span>

			                          @{{ row.created_at  }}

			                      </small>
			                  </div>
			                  <div class="footer_message">
			                		@{{ row.messages }}
			                	</div>

			              </div>
							

			          </li>

		  				{{-- </transition-group> --}}
		        </ul>

		        </div>

	        </div>
	          <div class="panel-footer">
	          
							<div class="input-group {{ $errors->has('messages') ? 'has-error' :'' }}">	
		
								<input 
										v-on:keyup.enter="cmdAddMessage()" 
										v-model="message" id="messages" name="messages" type="text" class="form-control input-sm" placeholder="Type your message here..."  required autofocus />
							
								<span class="input-group-btn">
									<button v-on:click="cmdAddMessage()" class="btn btn-warning btn-sm">
						                Send</button>
						        </span>
							</div>		


						
	          </div>
	      </div>
		</div> 	

	</div>
</template>


@stop

@push('scripts')

<script>

// Vue.use(require('vue-moment'))
// import 'vue-sticky-scroll';
// vue loading

Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
Vue.component('user', {
	template: '#template-user',
	data(){
      return{
         users: {},
         userSelectedId:''
      }
    },
  created : function(){
		this.fetchUserList();		
  },

  methods: {

  	cmdUserSelect:function(users){
  		this.userSelectedId = users.id;
  		this.$parent.userSelectedId = users.id;
  	},

    fetchUserList: function(){
		this.$http.get('messages/userList').then((response) => {
	    this.users = response.data;
			}, (response) => {
				console.log('no data found - user.');
			}).bind(this);
    }
  }
})
Vue.component('chat', {
	
  props: ['userid','userauthid'],
  template: '#template-chat',

	data() {
    return{ 
  	  rows: {},
  	  message:'',
      stat: ''
    }
  },


  ready: function () {
  },

  created : function(){
		this.fetchUserStat();		//available,busy,away

  },
  mounted:function(){

  	var self = this;

  	Echo.channel('jaasaria_channel' )
      .listen('ChatMessageReceived', (e) => {

      	if(e.message.receiver_id == this.userauthid){
						var v = {params: {selectedMessageId: e.message.id }};
						this.$http.get('messages/dataReceivedMessage',v).then((response) => {
							if(response.status == 200){

									self.rows.push(response.data);

			  					// let element = document.getElementById('chat-wrap')
		        //       element.scrollIntoView(false)
							}
						}, (response) => {
							console.log('no data found.');
						}).bind(this);
      	}

    });	


  },

  watch:{
  		userid:function(){
  				this.fetchMessages();
  		}
  },

  methods: {    

  	updateStatus:function(stat){
  		var postData = {stat: stat};

  		this.$http.post('messages/updateStatus', postData).then((response) => {
  				if(response.status == 200){
  					toastr["success"]("User status was successfully saved.", "Success")
  					this.stat = stat
  				}
  		}, (response) => {
				console.log('update status error');
			});
  	},


    fetchMessages: function(){
	    if(this.userid != ""){

	    	var v = {params: {selectedUserId: this.userid}};
				this.$http.get('messages/dataMessage',v).then((response) => {
					if(response.status == 200){
						this.rows = response.data;
	  					// let element = document.getElementById('chat-wrap')
        //       element.scrollIntoView(0)
					}
				}, (response) => {
					console.log('no data found.');
				}).bind(this);
	    }    	
    },
    fetchUserStat: function(){
			this.$http.get('messages/userStat').then((response) => {
			this.stat = response.data.status;		 	
			}, (response) => {
				console.log('no data found.');
			}).bind(this);
    },

    cmdAddMessage:function(){

    	if(this.userid !="" &&  this.message !=""){

    		var postData = {receiver_id: this.userid,messages: this.message};
    		var self = this;
	  		this.$http.post('messages', postData).then((response) => {
	  				if(response.status == 200){
	  					
	  					self.rows.push(response.data);
							self.message = '';

	  					// let element = document.getElementById('chat-wrap')
        //       element.scrollIntoView(0);

	  				}
	  		}, (response) => {
					console.log('send message error');
				});

    	}
  	}


  }	//end of method
})

var vm =  new Vue({
    el: '#appDirect',
    data:{
    	userSelectedId: ''
    } 
});

</script>

@endpush 