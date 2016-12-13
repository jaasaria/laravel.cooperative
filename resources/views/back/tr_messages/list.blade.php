@extends('back.layouts.admin')

@section('css.import')
	<style>
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
    height: 250px;
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
		<span class="pull-right">
			<a href=" {{ url( $route . '/create') }} " class="btn btn-success">Create New</a>
		</span>
	</div>


<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">

	    <div class="x_panel">
		    <div class="x_title">
		        <h2>Users</h2>
			        <ul class="nav navbar-right panel_toolbox">
			          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          </li>
			        </ul>
		        	<div class="clearfix"></div>
		    </div>


	     <div class="x_content">

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

<ul class="list-unstyled top_profiles scroll-view" tabindex="5001" style="overflow: hidden; outline: none; cursor: -webkit-grab;">


                        <li class="media event active">
                          <a class="pull-left border-green profile_thumb">
                            <i class="fa fa-user green"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Ms. Mary Jane</a>
                            <p>Sales Agent </p>
                            <p> <small>Last Online: Today</small>
                            </p>
                          </div>
                        </li>
                       
                         <li class="media event active">
                          <a class="pull-left border-green profile_thumb">
                            <i class="fa fa-user green"></i>
                          </a>
                          <div class="media-body">
                            <a class="title" href="#">Ms. Mary Jane</a>
                            <p>Sales Agent </p>
                            <p> <small>Last Online: Today</small>
                            </p>
                          </div>
                        </li>

                      </ul>

					            
					                   
					                </div>
					                <div class="panel-footer">
										<small>List of Users (8)</small>
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
					                            <li class="divider"></li>
					                            <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-off"></span>
					                                Sign Out</a></li>
					                        </ul>
					                    </div>
					                </div>
					                <div class="panel-body">
					                    <ul class="chat">
					                        <li class="left clearfix"><span class="chat-img pull-left">
					                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
					                        </span>
					                            <div class="chat-body clearfix">
					                                <div class="header">
					                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
					                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
					                                </div>
					                                <p>
					                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
					                                    dolor, quis ullamcorper ligula sodales.
					                                </p>
					                            </div>
					                        </li>
					                        <li class="right clearfix"><span class="chat-img pull-right">
					                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
					                        </span>
					                            <div class="chat-body clearfix">
					                                <div class="header">
					                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
					                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
					                                </div>
					                                <p>
					                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
					                                    dolor, quis ullamcorper ligula sodales.
					                                </p>
					                            </div>
					                        </li>
					                        <li class="left clearfix"><span class="chat-img pull-left">
					                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
					                        </span>
					                            <div class="chat-body clearfix">
					                                <div class="header">
					                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
					                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
					                                </div>
					                                <p>
					                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
					                                    dolor, quis ullamcorper ligula sodales.
					                                </p>
					                            </div>
					                        </li>
					                        <li class="right clearfix"><span class="chat-img pull-right">
					                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
					                        </span>
					                            <div class="chat-body clearfix">
					                                <div class="header">
					                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
					                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
					                                </div>
					                                <p>
					                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
					                                    dolor, quis ullamcorper ligula sodales.
					                                </p>
					                            </div>
					                        </li>
					                    </ul>
					                </div>
					                <div class="panel-footer">
					                    <div class="input-group">

											<input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
					                        <span class="input-group-btn">
					                            <button class="btn btn-warning btn-sm" id="btn-chat">
					                                Send</button>
					                        </span>

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





