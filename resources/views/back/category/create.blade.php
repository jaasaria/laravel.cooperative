@extends('back.layouts.admin')

@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}	
	</style>
@stop



@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title">Category <small>Referencial file</small></h3>
		</span>
		<span class="pull-right">
			<a href=" {{ url('category') }} " class="btn btn-warning">Back</a>
			
		</span>
	</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">

	@include('closure.errors')

	    <div class="x_panel">
		    <div class="x_title">
		        <h2>Create</h2>
			        <ul class="nav navbar-right panel_toolbox">
			          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          </li>
			        </ul>
		        	<div class="clearfix"></div>
		    </div>

		    

	    <div class="x_content">
	

		    <form  method="POST" action="{{ (empty($data) ? route('category.store'): route('category.update',$data->id)) }}" class="form-horizontal">

		        {{ csrf_field() }}
		            

				<div class="form-group">		
			        <label class="control-label col-md-3 col-sm-3 col-xs-12">Category: *</label>
			        <div class="col-md-9 col-sm-9 col-xs-12">
			        	<input id="name" type="text" class="cls-controls form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>	
			        </div>
				</div>

				<div class="form-group">		
			        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description:</label>
			        <div class="col-md-9 col-sm-9 col-xs-12">
			        	<textarea id="description" name="description" class="form-control" rows="3" placeholder="Description">{{ old('description') }}</textarea>
			        </div>
				</div>

				<div class="ln_solid"></div>

		   		<div class="form-group text-center">
					<a href="{{ url('category') }}" class="btn btn-warning">Cancel</a>
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
                ajax: '{!! url('request/data') !!}',
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


	    $(document).on('click', '#btndelete', function(){  

		    var href = $(this).data("href");
		    var docid = $(this).data("docid");


	       	swal({ title: "Are you sure?",   text: "You will not be able to recover this record!",   
	       			type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: true }, 
	       		function(){   

  					var value = {
                        'id':docid,
                        _token:$('meta[name="csrf-token"]').attr('content') 
                    };

					$.ajax({  
                         url:'{{ URL::to('request/delete') }}',  
                         type:"delete",  
                         data: value,  
                         success:function(){ 
                         	$('#table').DataTable().ajax.reload();
							toastr["success"]("Record was successfully deleted.", "Success")
                         }  
                    });  
                 });
	    });
	});
</script>
@endpush 





