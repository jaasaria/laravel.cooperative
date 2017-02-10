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

		.error {
    color: #a94442;
    margin: 0;
}

.table-error > select,
.table-error > input {
    background: #f2dede;
}
.datepicker.picker_1 {
    background: #34495E;
    color: #ECF0F1;
}
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

<div id="appDirect">

{{-- <pre>
	@{{ $data |  }}
</pre> --}}

	<div>
		<div class='alert alert-danger' v-if='withErrors'>
	        <strong>Error Found!</strong>
	        <ul>
	            <li v-for='error in errors'>
	                @{{ error }}
	            </li>
	        </ul>
		</div>
	</div>

	<form  method="POST" action="{{ (empty($data) ? route( $route . '.store'):route( $route . '.update',$data->id)) }}" class="form-horizontal">

	        {{ csrf_field() }}
	        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
	        {{ (empty($data) ? null :  method_field('PUT')) }}  


	      		<input id="id" 
        		name="id" type="hidden" class="cls-controls form-control" placeholder="Item Code"  value="{{  empty($data) ? '' : $data->id   }}"  
        		v-model="form.id">

				<input id="crudstat" 
        		name="crudstat" type="hidden" class="cls-controls form-control" placeholder="Item Code"  value="{{  empty($data) ? 'create' : 'edit'   }}"  
        		v-model="form.crudstat">


					<div class="col-md-4">
						<div class="form-group">		
					        <div class="col-md-12 col-sm-12 col-xs-12">
					        	<input id="trcode" 
					        		name="trcode" type="text" class="cls-controls form-control" placeholder="Item Code"  
					        		autofocus
					        		v-model="form.trcode">
					        </div>
						</div>

						<div class="form-group">		
					        <div class="col-md-12 col-sm-12 col-xs-12">
					        	<select id="supplier_id" 
					        			name="supplier_id" required class="form-control"
					        			v-model="form.supplier_id">

						        		<option value="" disabled selected></option>
													@foreach($supplier as $id => $name)	
														@if(empty($data))
															<option value="{{ $id }}">{{ $name }}</option> 
														@else
															<option  {{ ( $data->supplier_id === $id ?'selected="selected"':'') }} value="{{ $id }}">{{ $name  }}
															</option>
														@endif
													@endforeach
	                    		</select>
					        </div>
						</div>

						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">	
					        	<textarea id="description" name="description" class="form-control" rows="4" placeholder="Description"
					        	v-model="form.description"></textarea>
					        </div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="controls">
                <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                    <input type="text" value="" name="dateTrans" id="dateTrans" required class="form-control has-feedback-left calendar"  placeholder="Date"
                    v-model="form.dateTrans">
                    <span class="fa fa-calendar-o form-control-feedback left"></span>
              </div>
	          </div>
					</div>


					<div class="col-md-4">
							<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
	              <div class="tile-stats">
	                <div class="icon"><i class="fa fa-check-square-o"></i>
	                </div>
	                <div class="count green"> @{{ trtotal.toFixed(2)  }}</div>
										<h3> {{ ucfirst($route)  }} </h3> 
										<p> Total Amount</p>
	              </div>
	            </div>
					</div>




					<table class="table table-striped jambo_table">
	          <thead>
	            <tr class="headings">
	              <th>
									<a class="btn btn-success btn-xs fa fa-plus-square" 
	        							v-on:click="addRow()">
		  						</a>
	              </th>
	              <th class="w20">Item Code</th>
	              <th class="w30">Item Name</th>
	              <th class="w10c">Qty</th>
	              <th class="w15c">Cost</th>
	              <th class="w15">Sub Total</th>
	              <th class="w10 last"><span class="nobr">Action</span></th>
	            </tr>
	          </thead>
	        	<tbody>

	            <tr v-for="row in form.rows">
	               <td class="table-delete">                         
	                 	<a class="btn btn-danger fa fa-minus-square btn-xs" 
	                 		v-on:click="deleteRow(row)"
	                 	></a>
	               </td>

	               <td class="table-code" :class="{'table-error': errors['rows.' + $index + '.item_id']}">
		               	<select name="itemcode[]" v-model="row.item_id" @change="onChange(row)" class="form-control item_id">
										<option></option>
										@foreach($items as $item)	
											@if(empty($data))
												<option  v-bind:value="{{ $item->id }}">{{ $item->code }}</option>
											@else
												<option  v-bind:value="{{ $item->id }}" {{ ( $data->item_id === $id ?'selected="selected"':'') }} value="{{ $id }}">{{ $item->code  }}</option>
											@endif
										@endforeach
		                </select>
	                </td>

	             
	             <td class="table-name" :class="{'table-error': errors['rows.' + $index + '.item_id']}">
	              	<select name="itemname[]" v-model="row.item_id" @change="onChange(row)" class="form-control item_id">
										<option></option>
										@foreach($items as $item)	
										@if(empty($data))
											<option  v-bind:value="{{ $item->id }}">{{ $item->name }}</option>
										@else
											<option  v-bind:value="{{ $item->id }}" {{ ( $data->item_id === $id ?'selected="selected"':'') }} value="{{ $id }}">{{ $item->name  }}</option>
										@endif
									@endforeach
	                </select>
	              </td>

	              <td class="table-qty"  :class="{'table-error': errors['rows.' + $index + '.qty']}">
	                <input name="itemqty[]" type="number" @change="onChangeSubTotal(row)" v-model="row.qty"  class="form-control" placeholder="Qty" >
	              </td>

	             	<td class="table-cost" :class="{'table-error': errors['rows.' + $index + '.cost']}">
									<div class="form-group">
	              		<input name="itemcost[]" type="number" @change="onChangeSubTotal(row)"  v-model="row.cost"  class="form-control" placeholder="Cost">
	          			</div>
	             	</td>
	             	<td class="table-subtotal green">
	             		<strong><h4>  @{{ row.qty * row.cost  }} </h4></strong>
	             		<input type="hidden"  name="itemsubtotal[]"  v-model="row.subtotal">
	             	</td>
	              <td class="table-view last"><a href="" target="_blank">View</a></td>
	          	</tr>
	       		</tbody>
	       	</table>

          <a class="btn btn-success  btn-sm" 
  							v-on:click="addRow()">
  							<i class="fa fa-shopping-cart"></i>
  							Add Item
  				</a>


			
					<div class="rows" name="Grandtotal">
							<div class="col-md-3 pull-right">
								<div class="row">
									<span class="pull-left col-md-6">
										<h4>Sub Total:</h4>
									</span>
									<span class="pull-right col-md-6 alignRight">
										<h4> @{{ trsubtotal.toFixed(2) }}</h4>
									</span>
								</div>
								<div class="row clearfix">
									<span class="pull-left col-md-6">
										<h4>Discount:</h4>
									</span>
									<span class="pull-right col-md-6">
										 <input type="text" name="trdiscount" v-model="form.trdiscount" class="form-control alignRight"  placeholder="Discount">
									</span>
								</div>
								<div class="row clearfix">
									<span class="pull-left col-md-6">
										<h4>Total:</h4>
									</span>
									<span class="pull-right col-md-6 alignRight">
										 <h4> @{{ trtotal.toFixed(2)  }}</h4>
									</span>
								</div>
							</div>
					</div>


					<div class="clearfix"></div>
					<div class="ln_solid"></div>

			   	<div class="form-group text-center">
						<a href="{{ url(  $route ) }}" class="btn btn-warning">Cancel</a>
			   		<button type="submit" @click="onSubmit" :disabled="isProcessing" class="btn btn-success">{{ (empty($data)? 'Save Data': 'Update Data') }}</button>
			    </div>
			        
	</form>
</div> {{-- end of app - vuejs --}}


</div>
</div>
</div>

</div>
@stop




@push('scripts')


	@if (! empty($data))		{{-- proceed to edit --}}

		<script type="text/javascript">
			Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';

			window._form = {
		    	id:'123',
				crudstat:'edit'
		    };
		    window._form = {!! $data->toJson() !!}
		    
		</script>
		<script src=" {{ asset('js/stockOut.js') }} "></script>


	@else


		<script>
			Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';
			window._form = {
				id:'',
				crudstat:'',
				trcode:'{{ (empty($data)?  old('trcode',$trCode): old('trcode', $data->trcode)) }}',
				description:'',
				supplier_id:'',
				dateTrans:'{{ old('datePurchase', date('m/d/Y')) }}',
				trsubtotal:0,
				trdiscount:0,
				trtotal:0.00,
		    rows: [{
		        item_id: '',
		        cost: 0,
		        qty: 1,
		        total:0
		    }]
		  };
		</script>
		<script src=" {{ asset('js/stockOut.js') }} "></script>        
	@endif



<script>
	$(document).ready(function(){

 		$(function() {
		$( ".calendar" ).datepicker();
		});
 	});
</script>


@endpush 





