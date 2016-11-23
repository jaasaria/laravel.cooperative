@extends('back.layouts.admin')
@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
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
	

			<form  method="POST" action="{{ (empty($data) ? route( $route . '.store'):route( $route . '.update',$data->id)) }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : method_field('PUT')) }}  {{-- use for update only --}}

		            
				<div class="col-md-6">
					
					{{-- name --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Name: *</label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="name" type="text" class="cls-controls form-control" placeholder="Name" name="name" value="{{ (empty($data)?  old('name'): $data->name) }}" required autofocus>
				        </div>
					</div>

					{{-- address --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Permanent Address:*</label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="address" type="text" class="cls-controls form-control" placeholder="Permanent Address" name="address" value="{{ (empty($data)?  old('address'): $data->address) }}" required autofocus>
				        </div>
					</div>


					{{-- shipping address --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Shipping Address:</label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="shippingAddress" type="text" class="cls-controls form-control" placeholder="Shipping Address" name="shippingAddress" value="{{ (empty($data)?  old('address'): $data->shippingAddress) }}">
				        </div>
					</div>


					<br>

					{{-- Tel no --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tel No.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="telno" type="text" class="cls-controls form-control" placeholder="Tel No" name="telno" value="{{ (empty($data)?  old('telno'): $data->telno) }}" >
				        </div>
					</div>

					{{-- Mobile --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mobile: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="mobileno" type="text" class="cls-controls form-control" placeholder="Mobile No" name="mobileno" value="{{ (empty($data)?  old('mobileno'): $data->mobileno) }}"  autofocus>
				        </div>
					</div>					

					{{-- Fax No. --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Fax No.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="faxno" type="text" class="cls-controls form-control" placeholder="Fax No" name="faxno" value="{{ (empty($data)?  old('faxno'): $data->faxno) }}"  autofocus>
				        </div>
					</div>
				</div>


				<div class="col-md-6">
					
					{{-- website --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Website: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="website" type="text" class="cls-controls form-control" placeholder="Website" name="website" value="{{ (empty($data)?  old('website'): $data->website) }}"  autofocus>
				        </div>
					</div>					

					{{-- Email --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Email: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="email" type="text" class="cls-controls form-control" placeholder="Email" name="email" value="{{ (empty($data)?  old('email'): $data->email) }}"  autofocus>
				        </div>
					</div>					

					<br>

                    <div class="form-group">
                            <label for="active" class="control-label col-md-2 col-sm-2 col-xs-12">Status:</label> 
							<div class="col-md-10 col-sm-10 col-xs-12">
                                {!! Form::checkbox('active', 1  ,  (empty($data)? 1: $data->active), ['id' => 'active','class'=>'flat']) !!} As Active?
                            </div>
                    </div>

					<br>

					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Notes:</label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<textarea id="notes" name="notes" class="form-control" rows="4" placeholder="Notes">{{ (empty($data)?  old('notes'): $data->notes) }}</textarea>
				        </div>
					</div>


	                     

				</div>





				<div class="clearfix"></div>




				<div class="ln_solid"></div>

		   		<div class="form-group text-center">
					<a href="{{ url(  $route ) }}" class="btn btn-warning">Cancel</a>
		   			<button type="submit" class="btn btn-success">{{ (empty($data)? 'Save Data': 'Update Data') }}</button>
		        </div>
		        
			</form>




	      </div>
	    </div>
  	</div>

</div>
@stop




@push('scripts')
<script>
	$(document).ready(function(){

		$('#datatable-responsive').DataTable();

 		$(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url(  $route . '/data') !!}',
                order: [[3, 'desc']],
                columns: [
                    { data: 'title', name: 'title' ,"searchable": true},
                    { data: 'description', name: 'description' ,"searchable": true},
                    { data: 'xstatus', name: 'xstatus' },
                    { data: 'created_at', name: 'created_at' ,"searchable": true },
                    { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
                ]
            });
        });


	    
	});
</script>
@endpush 





