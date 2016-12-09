@extends('back.layouts.admin')
@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
		th{
	    	background-color: #2f4358;
	    	color: white
	    }

	    .c {text-align: center;}

	    .icheckbox_flat-green checked {margin: 5px;}

	    .form-horizontal .control-label {
    padding-top: 2px;
}border-style: 


		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 15px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}

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
		        	<span class="label label-danger"> Permission Roles not yet completed </span>
		    </div>

		    

	    <div class="x_content">


			<form  method="POST" action="{{ route( $route . '.storePermission') }}" class="form-horizontal">

		        {{ csrf_field() }}
		        {{ (empty($data) ? null : Form::hidden('id', $data->id)) }}  
		        {{-- {{ (empty($data) ? null :  method_field('PUT')) }}   --}}

		        <input type="hidden" name="rolesId" value="{{ $roleId }}">
		        {{-- use for update only --}}


		            
				<div class="col-md-12 ">
					

		            <table id="tabl1e" class="table table-striped table-hover table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

		                <thead>
		                    <tr role="row">

		                        <th class="col-md-4">Permission Name</th>
		                        <th class="c col-md-4">Rules</th>
		                        <th class="c col-md-4">Action</th>

		                    </tr>
		                </thead>

		                <tbody>



@foreach ($permission as $data)
	<tr>
		<td>
			{{ $data->name }}
			<br>
			<span class="label label-info">{{ $data->description }}</span>
		</td>

		<td>


			  @foreach($data->PermissionRule as $value)


				<label for="roles[{{$data->id  . $value}}]" class="control-label">
		
   					<input type="checkbox"
                        id="roles[{{$data->id . $value}}]"
                        name="roles[{{$data->id  . $value}}]"
                        value="{{$data->id}}"
					
                        {{ ($rolePermission->contains('value',$data->id . $value))  ? 'checked' : ''}}
                        >

 					@if ($value == 'c')
                    	Create
                    @elseif($value == 'r')
                    	Read
                    @elseif($value == 'u')
                    	Update
                    @elseif($value == 'd')
                    	Delete
                   	@elseif($value == 'p')
                    	Permission
                    @endif

				</label>
					
<br>

			  @endforeach	
			 
		</td>

		<td>
			 <div class="text-center">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" data-title="Uncheck All" data-widget="uncheck" data-original-title="" title=""
                onclick="uncheckAll(this)"
                 >
                    <i class="fa fa-square-o"></i>
                </button>

         

                <button type="button" class="btn" data-toggle="tooltip" data-title="Check All" data-widget="check" data-original-title="" title=""
                onclick="checkAll(this)"
                >
                    <i class="fa fa-check-square-o"></i>
                </button>
        	</div>
		</td>
	</tr>


@endforeach


		                </tbody>

		            </table>




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

	
	});

	var checkAll = function(button){
    	$(button).closest('tr').find('input[type=checkbox]').prop('checked', true)
	}

	var uncheckAll = function(button){
    	$(button).closest('tr').find('input[type=checkbox]').prop('checked', false)
	}


</script>
@endpush 





