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


	    {{-- <span class="section">General Info</span> --}}


			<form  method="POST" action="{{ (empty($data) ? route( $route . '.store'):route( $route . '.update',$data->id)) }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{ (empty($data) ? null :  method_field('PUT')) }}  
		        {{-- use for update only --}}


		            
				<div class="col-md-8  col-md-offset-2">
					

					{{-- Item Code --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Name: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="name" type="text" class="cls-controls form-control" placeholder="Role Name" name="name" value="{{ (empty($data)?  old('name'): $data->name) }}" required autofocus>
				        </div>
					</div>

					<div class="form-group">		
				            <label class="control-label col-md-2 col-sm-2 col-xs-12">Description: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">{{ (empty($data)?  old('description'): $data->description) }}</textarea>
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



		$("#category_id").select2({
	          placeholder: "Select a Category",
	          allowClear: true
	    });
		$("#unit_id").select2({
	          placeholder: "Select a Unit",
	          allowClear: true
	    });


	    
	});
</script>
@endpush 





