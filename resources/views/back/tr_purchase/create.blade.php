@extends('back.layouts.admin')
@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
		.green {
    		color: #1ABB9C;
		}

		.w15 {width:15%;}
		.w10c {width:10%;text-align: center;}

		.w15 {width:15%;}
		.w15c {width:15%;text-align: center;}
		.w20 {width:20%;}
		.w20c {width:20%;margin-left: 50px;}
		.w30 {width:30%;}
		.w40 {width:35%;}


		.alignRight {text-align: right;}


.table .form-group {
    margin-bottom: 0px;
}

.table>thead>tr>th {
    vertical-align: middle;
    border-bottom: 2px solid #ddd;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    vertical-align: middle;
}


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

<div class="row" id="inv1">

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
                            <input type="text" class="form-control has-feedback-left calendar"  placeholder="Purchase Date">
                            <span class="fa fa-calendar-o form-control-feedback left"></span>
                        </div>
                    </div>
					<div class="controls">
                        <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left calendar"  placeholder="Delivery Date">
                            <span class="fa fa-calendar-o form-control-feedback left" ></span>
                        </div>
                    </div>
				</div>

				<div class="col-md-4">
						<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-check-square-o"></i>
                          </div>
                          <div class="count green"> {{ number_format(179,2) }}</div>
							<h3> {{ ucfirst($route)  }} </h3> 
							<p> Total Amount</p>
                        </div>
                      </div>
				</div>



	<div id="app">
	 	@{{ message1 }}
	</div>














 <table class="table table-striped jambo_table">
                        <thead>
                          <tr class="headings">
                            <th>
                              <button type="" class="btn btn-success btn-xs"> <i class="fa fa-plus-square"></i></button>
                            </th>
                            <th class="w20">Item Code</th>
                            <th class="w40">Item Name</th>
                            <th class="w10c">Qty</th>
                            <th class="w10c">Cost</th>
                            <th class="w15">Sub Total</th>
                            <th class="w10 last"><span class="nobr">Action</span></th>
                          </tr>
                        </thead>

                        <tbody>


                          <tr class="even pointer">
                            <td class="a-center ">
                              <button type="" class="btn btn-danger btn-xs"><i class="fa fa-minus-square"></i></button>
                            </td>
                            <td>00000001</td>
                            <td>Lechon Manok</td>
                            <td>
	                          <div class="form-group">
                            		<input type="text" class="form-control" placeholder="Qty">
                        		</div>
                            </td>
                            <td>
								<div class="form-group">
                            		<input type="text" class="form-control" placeholder="Cost">
                        		</div>
                            </td>

                            <td class="a-right a-right green"><h4>123.00</h4>
                            </td>

                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>

                          <tr class="odd pointer">
                           <td class="a-center ">
                              <button type="" class="btn btn-danger btn-xs"><i class="fa fa-minus-square"></i></button>
                            </td>
                            <td>00000001</td>
                            <td>Lechon Manok</td>
                            <td>
	                           <div class="form-group">
                            		<input type="text" class="form-control" placeholder="Qty">
                        		</div>
                            </td>
                            <td>
								<div class="form-group">
                            		<input type="text" class="form-control" placeholder="Cost">
                        		</div>
                            </td>
                            <td class="a-right a-right green"><h4>55.00</h4>
                            </td>
                            <td class=" last"><a href="#">View</a>
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>




					<div class="rows" name="Grandtotal">
							<div class="col-md-3 pull-right">

								<div class="row">
									<span class="pull-left col-md-6">
										<h4>Sub Total:</h4>
									</span>
									<span class="pull-right col-md-6 alignRight">
										<h4>3,434.00</h4>
									</span>
								</div>
								<div class="row clearfix">
									<span class="pull-left col-md-6">
										<h4>Discount:</h4>
									</span>
									<span class="pull-right col-md-6">
										 <input type="text" class="form-control alignRight"  placeholder="Discount">
									</span>
								</div>
								<div class="row clearfix">
									<span class="pull-left col-md-6">
										<h4>Total:</h4>
									</span>
									<span class="pull-right col-md-6 alignRight">
										 <h4>3,434.00</h4>
									</span>
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

		// $('#datatable-responsive').DataTable();

 		$(function() {




		    $('.calendar').daterangepicker({
		        singleDatePicker: true,
		        calender_style: "picker_1"
		    }, function(start, end, label) {
		        console.log(start.toISOString(), end.toISOString(), label);
		    });


            $('#table1').DataTable({
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





