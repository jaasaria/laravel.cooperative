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
			<h3 class="box-title"> {{ $form }} <small>Referencial file</small></h3>
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



	{{-- <div class="col-md-3">

		<img class="profile-user-img img-responsive img-circle" src="" alt="User profile picture" style="margin-bottom: 5px;">

		{!! Form::open(['method' => 'POST', 'url' => 'user', 'class' => 'form-horizontal','enctype'=>'multipart/form-data', 'files'=>true]) !!}

				<div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}">
				    {!! Form::file('avatar', ['required' => 'required','accept' =>'image/*']) !!}
				    <small class="text-danger">{{ $errors->first('avatar') }}</small>
				</div>

			{!! Form::submit('Update Avatar', ['class' => 'btn btn-success btn-block']) !!}
			<button id="btndelete" type="button" class="btn btn-warning btn-block" >Clear Avatar</button>
		{!! Form::close() !!}
	</div> --}}

	<div class="col-md-10 col-md-offset-1">

      	<form  method="POST" action="{{ (empty($data) ? route( $route . '.store'):route( $route . '.update',$data->id)) }}" class="form-horizontal">

	        {{ csrf_field() }}
	        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
	        {{ (empty($data) ? null :  method_field('PUT')) }}  
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


			<div class="form-group">		
		        <label class="control-label col-md-2 col-sm-2 col-xs-12">Password: </label>
		        <div class="col-md-10 col-sm-10 col-xs-12">
		        	<input id="password" name="password" type="password" class="cls-controls form-control" placeholder="Password"  value="{{ (empty($data)?  old('password'):old('password', $data->password)) }}" required autofocus>
		        </div>
			</div>

			<div class="form-group">		
		        <label class="control-label col-md-2 col-sm-2 col-xs-12">Confirm Password: </label>
		        <div class="col-md-10 col-sm-10 col-xs-12">
		        	<input id="password_confirmation" name="password_confirmation" type="password" class="cls-controls form-control" placeholder="Confirm Password"  value="{{ (empty($data)?  old('password_confirmation'):old('password_confirmation', $data->password_confirmation)) }}" required autofocus>
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
@stop




@push('scripts')
<script>
	$(document).ready(function(){

	


	    
	});
</script>
@endpush 





