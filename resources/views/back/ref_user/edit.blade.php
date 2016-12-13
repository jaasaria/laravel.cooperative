@extends('back.layouts.admin')
@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
		.profile-user-img {
		    margin: 0 auto;
		    width: 100px;
		    padding: 3px;
		    border: 3px solid #d2d6de;
		}

/*		.tabMargin{
			margin-bottom: 20px;
		}
*/

	</style>
@stop

@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title"> {{ $form }} <small>{{ (empty($profile) ? ' Referencial file' : ' Profile')  }}   </small></h3>

			 


		</span>
		<span class="pull-right">
			<a href=" {{ url( $route) }} " class="btn btn-warning">Back</a>
		</span>
	</div>



<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

	@include('closure.errors')

	    <div class="x_panel">
		    <div class="x_title">
		        <h2>{{ (empty($data) ? 'Create' : 'Modify') }} </h2>
			        <ul class="nav navbar-right panel_toolbox">
			          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          </li>
			        </ul>
		        	<div class="clearfix"></div>
		    </div>

		  


<div class="x_content">


	<div class="col-md-3">

	 	<form  method="POST" action="{{ route( $route . '.avatar',$data->id) }}" class="form-horizontal" enctype="multipart/form-data">

	        {{ csrf_field() }}
	        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
	        {{-- {{ (empty($data) ? null :  method_field('PUT')) }}   --}}

 			<img id="uploadPreview" class="profile-user-img img-responsive img-circle" src="{{ '/upload/avatars/' . $data->avatar }}" alt="User profile picture" style="margin-bottom: 5px;" >

			<div class="form-group">
				<input type="file"  id="uploadImage" name="avatar" accept="image/*" onchange="PreviewImage();">		
				<small>Requirements: 160x160px, Max: 3MB File</small>
			</div>

			<button type="submit" class="btn btn-success btn-block">Update Avatar</button>
	 	</form>

	 		<button id="btndelete" type="button" class="btn btn-warning btn-block" >Clear Avatar</button>

	</div>

	<div class="col-md-9">

		<div class="" role="tabpanel" data-example-id="togglable-tabs">

        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          	<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" 	data-toggle="tab" aria-expanded="true">Information</a>
          	</li>
          	<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" 		data-toggle="tab" aria-expanded="false">Password</a>
          	</li>
        </ul>


        <div id="myTabContent" class="tab-content">

{{-- First Tab --}}
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">


          	<form  method="POST" action="{{ route( 'user.update',$data->id) }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{ (empty($data) ? null :  method_field('PUT')) }}  

		        {{ (empty($profile) ? null : Form::hidden('profile', true))  }}  

		        {{-- use for update only --}}

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">First Name: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="name" type="text" class="cls-controls form-control" placeholder="First Name" name="name" value="{{ (empty($data)?  old('name'):old('name', $data->name)) }}" required autofocus>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Middle Name: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="middlename" name="middlename" type="text" class="cls-controls form-control" placeholder="Middle Name"  value="{{ (empty($data)?  old('middlename'):old('middlename', $data->middlename)) }}" required autofocus>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Last Name: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="lastname" name="lastname" type="text" class="cls-controls form-control" placeholder="Last Name"  value="{{ (empty($data)?  old('lastname'):old('lastname', $data->lastname)) }}" required autofocus>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Address:</label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<textarea id="address" name="address" class="form-control" rows="4" placeholder="Address">{{ (empty($data)?  old('address'): $data->address) }}</textarea>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mobile No.: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="mobile" name="mobile" type="text" class="cls-controls form-control" placeholder="Mobile Name"  value="{{ (empty($data)?  old('mobile'):old('mobile', $data->mobile)) }}" required autofocus>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Notes:</label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<textarea id="notes" name="notes" class="form-control" rows="4" placeholder="Notes">{{ (empty($data)?  old('notes'): $data->notes) }}</textarea>
			        </div>
				</div>

				<div class="form-group">
	                <label for="active" class="control-label col-md-2 col-sm-2 col-xs-12">Status:</label> 
					<div class="col-md-10 col-sm-10 col-xs-12">
	                    {!! Form::checkbox('active', 1  ,  (empty($data)? 1: $data->active), ['id' => 'active','class'=>'flat']) !!} As Active?
	                </div>
	    		</div>



				<br>
				<span class="section">User Account Information</span>
				<br>

			

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="email" name="email" type="email" class="cls-controls form-control" placeholder="Email"  value="{{ (empty($data)?  old('email'):old('email', $data->email)) }}" required autofocus>
			        </div>
				</div>


			

				<div class="clearfix"></div>

				<div class="ln_solid"></div>
		   		<div class="form-group text-center">
		   			<button type="submit" class="btn btn-success">{{ (empty($data)? 'Save Data': 'Update Data') }}</button>
		        </div>
		        
			</form>

          </div>


{{-- Second Tab --}}
        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

		<form  method="POST" action="{{ route( $route . '.pass',$data->id) }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{ (empty($data) ? null :  method_field('PUT')) }}
 				{{ (empty($profile) ? null : Form::hidden('profile', true))  }}  



				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Password: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="password" name="password" type="password" class="cls-controls form-control" placeholder="Password"  value="{{ old('password') }}" required autofocus>
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-2 col-sm-2 col-xs-12">Confirm Password: </label>
			        <div class="col-md-10 col-sm-10 col-xs-12">
			        	<input id="password_confirmation" name="password_confirmation" type="password" class="cls-controls form-control" placeholder="Confirm Password"  value="" required autofocus>
			        </div>
				</div>


				<div class="clearfix"></div>

				<div class="ln_solid"></div>
		   		<div class="form-group text-center">
		   			<button type="submit" class="btn btn-success">{{ (empty($data)? 'Save Data': 'Update Data') }}</button>
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
@stop


@push('scripts')
<script>

 	function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };


	$(document).ready(function(){


	    $(document).on('click', '#btndelete', function(){  

	       	swal({ title: "Are you sure?",   text: "You will not be able to recover this avatar!",   
	       			type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: true }, 
	       		function(){   

  					var value = {
                        'id':1234,
                        _token:$('meta[name="csrf-token"]').attr('content') 
                    };

					$.ajax({  
                         url:'{{ URL::to('user/deleteAvatar',$data->id)  }}',  
                         type:"post",  
                         data: value,  
                         success:function(){ 
 							
							location.reload();
							// toastr["success"]("Avatar was successfully deleted.", "Success")

                         }  
                    });  
                 });
	    });



	});


</script>
@endpush 





