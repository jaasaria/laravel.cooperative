@extends('back.layouts.admin')
@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
	</style>
@stop

@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title"> {{ $form }} <small>Transaction form</small></h3>
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
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{ (empty($data) ? null :  method_field('PUT')) }}  
		        {{-- use for update only --}}


		            
				<div class="col-md-4">
					
					{{-- Item Code --}}
					<div class="form-group">		
				        <div class="col-md-12 col-sm-12 col-xs-12">
				        	<input id="code" type="text" class="cls-controls form-control" placeholder="Item Code" name="code" value="{{ (empty($data)?  old('code'):old('code', $data->code)) }}" required autofocus>
				        </div>
					</div>

					{{-- Supplier --}}
					<div class="form-group">		
				        <div class="col-md-12 col-sm-12 col-xs-12">
				        	<select id="category_id" name="category_id"  value="" class="form-control">
								<option></option>
                    		</select>
				        </div>
					</div>
			

					{{-- Description --}}
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">	
				        	<textarea id="description" name="notes" class="form-control" rows="4" placeholder="Description">{{ (empty($data)?  old('description'): $data->description) }}</textarea>
				        </div>
					</div>


				

				</div>


				<div class="col-md-4">

					<div class="controls">
                        <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="Purchase Date" aria-describedby="inputSuccess2Status4">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                        </div>
                    </div>
					<div class="controls">
                        <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" id="single_cal4" placeholder="Delivery Date" aria-describedby="inputSuccess2Status4">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                        </div>
                    </div>

				</div>


				<div class="col-md-4">

						<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                          </div>
                          <div class="count">179</div>

                          <h3>New Sign ups</h3>
                          <p>Lorem ipsum psdea itgum rixt.</p>
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
	          placeholder: "Select a Supplier",
	          allowClear: true
	    });
	


	    
	});
</script>
@endpush 





