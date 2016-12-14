@extends('back.layouts.admin')

@section('css.import')
	<style>


.message_pic {
    width: 10%;
    float: left;
}
.message_pic_right {
    width: 10%;
    float: right;
}

.pull-right {
     float: right; 
}
.pull-right {
     float: right!important; 
} 

.img-circlechat {
    width: 70%;
    background: #fff;
    z-index: 1000;
    position: inherit;
    border: 1px solid rgba(52,73,94,0.44);
    padding: 4px;
    border-radius: 50%;
}
.img-circlechat-left {
    width: 70%;
    background: #b9e7f5;
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


.sidebar{
    float: left;
    width: 200px;
    color: #f4f4f4;
     background-color: #2e3238; 
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

.chat-body-left
{
    margin-left: 60px;
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
		
	</style>
@stop



@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title">{{ $form }} <small>User and Messages list</small></h3>
		</span>
	
	</div>


<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">

	    <div class="x_panel">
			<div class="row">
		        <div class="col-sm-4">


	        	<div class="container">
				    <div class="row">
				        <div class="col-md-12">
				            <div class="panel panel-primary">
				                <div class="panel-heading">
				                    <span class="glyphicon glyphicon-user"></span> Users
				                    <div class="btn-group pull-right">
				                    </div>
				                </div>
				                <div class="panel-body">


				<div id="sidebarChat">
					<ul class="list-unstyled top_profiles scroll-view"  style="overflow: hidden; outline: none; cursor: -webkit-grab;">
						@foreach ($user as $u)

							<li class="media event">
					        <div class="profile_pic">
				            	<img src="{{ asset('upload/avatars/' . $u->avatar)  }}" class="img-circlechat">
				            </div>

				            <div class="media-body">
				                <a class="title" href="#">{{ $u->fullname }}</a>
				                <p>{{ $u->designation }}</p>
				                @if (!empty($u->last_login))
				                	<p> <small>Last Online: {{ $u->last_login->diffForHumans() }}</small>
				                </p>	
				                @endif
				                
				            </div>

				            </li>
						@endforeach
				   	</ul>
				</div>
			
				                </div>
				                <div class="panel-footer">
									<small>Number of Users ({{$user->count()}})</small>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

		
		        </div>

		         <div class="col-sm-8">

					<div class="container">
					    <div class="row">


					        <div class="col-md-12">
					            <div class="panel panel-primary">

					                <div class="panel-heading">
					                    <span class="glyphicon glyphicon-comment"></span> Messages
					                    <div class="btn-group pull-right">
					                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
					                            <span class="glyphicon glyphicon-chevron-down"></span>
					                        </button>
					                        <ul class="dropdown-menu slidedown">
					                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-refresh">
					                            </span>Refresh</a></li>
					                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-ok-sign">
					                            </span>Available</a></li>
					                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-remove">
					                            </span>Busy</a></li>
					                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-time"></span>
					                                Away</a></li>
					                            
					                        </ul>
					                    </div>
					                </div>


					                <div class="panel-body">
					                    <ul class="chat">


					                    @foreach ($messages as $message)

											<div class="col-md-12 ">
									

					<li class="clearfix">


						@if ($message->sender_id === auth::user()->id)						

							<div class="message_pic pull-left">
								<img src="{{ asset('upload/avatars/' . auth::user()->avatar) }}" class="img-circlechat-left" />	
							</div>


	                        <div class="chat-body clearfix">

	                            <div class="header">
	                                <strong class="primary-font">{{  $message->userSender->name  }}</strong> 

	                                <small class="pull-right text-muted">
	                                    <span class="glyphicon glyphicon-time"></span>
	                                    {{ $message->created_at->diffForHumans() }}
	                                </small>

	                            </div>
	                            {!! $message->messages !!}
	                        </div>

						@else
							<div class="message_pic_right pull-right">
								<img src="{{ asset('upload/avatars/' . $message->userSender->avatar) }}" class="img-circlechat_right" />	

							</div>	

							<div class="chat-body-left clearfix">

	                            <div class="header">
	                                
									<strong class="primary-font">{{  $message->userSender->name  }}</strong> 
	                                <small class="pull-right text-muted">
	                                    <span class="glyphicon glyphicon-time"></span>
	                                    {{ $message->created_at->diffForHumans() }}
	                                </small>

	                            </div>
	                            {!! $message->messages !!}
	                        </div>

						@endif 

						

                    


                    </li>
     


											</div> 	
					                    @endforeach


					                    </ul>
					                </div>
					                <div class="panel-footer">
					                   

					<form  method="POST" action="{{ route('messages.store') }}" >
					    {{ csrf_field() }}
						{{ Form::hidden('sender_id', Auth::user()->id ) }}  
						{{ Form::hidden('receiver_id', 2 ) }}  

						<div class="input-group {{ $errors->has('messages') ? 'has-error' :'' }}">	
							<input id="messages" name="messages" type="text" class="form-control input-sm" placeholder="Type your message here..." />
						
							<span class="input-group-btn">
								<button type="submit" class="btn btn-warning btn-sm">
					                Send</button>
					        </span>
						</div>		

					</form>



					                
					                </div>
					            </div>


					        </div>
					    </div>
					</div>

		        </div>


	    	</div>

	    
	    </div>
  	</div>

</div>


@stop




@push('scripts')
<script>







	$(document).ready(function(){
 		$(function() {



            



        });	
	});

</script>
@endpush 





