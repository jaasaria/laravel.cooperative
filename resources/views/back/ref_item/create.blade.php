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


	    <span class="section">General Info</span>


	

			<form  method="POST" action="{{ (empty($data) ? route( $route . '.store'):route( $route . '.update',$data->id)) }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{ (empty($data) ? null :  method_field('PUT')) }}  
		        {{-- use for update only --}}


		            
				<div class="col-md-8  col-md-offset-2">
					
					{{-- Item Code --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Code: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="code" type="text" class="cls-controls form-control" placeholder="Item Code" name="code" value="{{ (empty($data)?  old('code'):old('code', $data->code)) }}" required autofocus>
				        </div>
					</div>

					{{-- Item Code --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Name: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="name" type="text" class="cls-controls form-control" placeholder="Item Name" name="name" value="{{ (empty($data)?  old('name'): $data->name) }}" required autofocus>
				        </div>
					</div>

					<br>

					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Category: *</label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
							
							<select id="category_id" name="category_id"  value="" class="form-control">
								<option></option>
								@foreach($category as $id => $name)

									@if(empty($data))
										<option {{ ( old('category_id') ===$id?'selected="selected"':'') }} value="{{ $id }}">{{ $name }}</option> 
									@else
										<option  {{ ( $data->category_id === $id ?'selected="selected"':'') }} value="{{ $id }}">{{ $name  }}</option>
									@endif
								@endforeach
							</select>

				        </div>
					</div>

					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Unit: *</label>
				        <div class="col-md-6 col-sm-6 col-xs-12">

				        	<select id="unit_id" name="unit_id" class="form-control">

				        		<option></option>
								@foreach($unit as $id => $name)	


									@if(empty($data))
										<option value="{{ $id }}">{{ $name }}</option> 
									@else
										<option  {{ ( $data->unit_id === $id ?'selected="selected"':'') }} value="{{ $id }}">{{ $name  }}</option>
									@endif
								@endforeach


                    		</select>
				        </div>
					</div>



<br>
					{{-- Barcode --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Barcode.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="barcode" type="text" class="cls-controls form-control" placeholder="Barcode" name="barcode" value="{{ (empty($data)?  old('barcode'): $data->barcode) }}">
				        </div>
					</div>
					
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Description:</label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<textarea id="description" name="notes" class="form-control" rows="4" placeholder="description">{{ (empty($data)?  old('description'): $data->description) }}</textarea>
				        </div>
					</div>
									

				

							{{-- Cost --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Cost.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="cost" type="text" class="cls-controls form-control" placeholder="Cost" name="cost" value="{{ (empty($data)?  old('cost','0.00'): number_format($data->cost,2)) }}">
				        </div>
					</div>

					{{-- Price --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Price.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="price" type="text" class="cls-controls form-control" placeholder="Price" name="price" value="{{ (empty($data)?  old('price','0.00'): number_format($data->price,2)) }}">
				        </div>
					</div>
	

					{{-- Tax --}}
					<div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Tax.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="tax" type="text" class="cls-controls form-control" placeholder="Tax" name="tax" value="{{ (empty($data)? old('tax',12) : number_format($data->tax,2)  ) }}">
				        	<span class="label label-default">Default Value: 12</span>
				        </div>

					</div>

					{{-- <br> --}}

					{{-- Qty --}}
					{{-- <div class="form-group">		
				        <label class="control-label col-md-2 col-sm-2 col-xs-12">Qty.: </label>
				        <div class="col-md-10 col-sm-10 col-xs-12">
				        	<input id="qty" type="text"  readonly class="cls-controls form-control" placeholder="Qty" name="qty" value="{{ (empty($data)?  old('qty'): $data->qty) }}">
				        </div>
					</div> --}}

					<br>

					<div class="form-group">
                            <label for="active" class="control-label col-md-2 col-sm-2 col-xs-12">Status:</label> 
							<div class="col-md-10 col-sm-10 col-xs-12">
                                {!! Form::checkbox('active', 1  ,  (empty($data)? 1: $data->active), ['id' => 'active','class'=>'flat']) !!} As Active?
                            </div>
                    </div>


				</div>
{{-- 

				<div class="col-md-5">
				</div> --}}





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





