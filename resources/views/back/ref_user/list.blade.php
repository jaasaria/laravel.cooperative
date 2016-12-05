@extends('back.layouts.admin')

@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}
		
		.w5 {width:5%;text-align: center;}
		.w20 {width:20%;}
		.w25 {width:25%;}
		.w40 {width:40%;text-align: center;}

 		.td-description{
	        text-overflow: ellipsis;
	        white-space: nowrap;
	        overflow: hidden; 
	        padding-right: 30px
	    }
	    th{
	    	background-color: #2f4358;
	    	color: white
	    }

		.img-avatar {
		    width: 29px;
		    height: 29px;
		    border-radius: 50%;
		    /*margin-right: 10px;*/
		    /*vertical-align: middle*/
		    /*align-items: center;*/
		    /*float: center;*/
		}

	</style>
@stop



@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title">{{ $form }} <small>Referencial file</small></h3>
		</span>
		<span class="pull-right">
			<a href=" {{ url( $route . '/create') }} " class="btn btn-success">Create New</a>
		</span>
	</div>


<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="x_panel">
		    <div class="x_title">
		        <h2>Listing</h2>
			        <ul class="nav navbar-right panel_toolbox">
			          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          </li>
			        </ul>
		        	<div class="clearfix"></div>
		    </div>
	     <div class="x_content">

			<div class="row">
		        <div class="col-sm-12">


		            <table id="table" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

		                <thead>
		                    <tr role="row">

		                        <th class="w5"></th>
		                        <th class="w20">Name</th>
		                        <th class="w20">Address</th>
		                        <th class="w25 hidden-xs hidden-sm">Notes</th>
		                        <th class="w15 hidden-xs hidden-sm">Date</th>
		                        <th class="w15">Action</th>

		                    </tr>
		                </thead>

		                <tbody>
		                </tbody>

		            </table>




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

 		$(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url( $route . '/data') !!}',
                order: [[3, 'desc']],		//start with Zero(0)
                columns: [
                    { data: 'avatar', name: 'avatar' ,"searchable": true},
                    { data: 'code', name: 'code' ,"searchable": true},
                    { data: 'name', name: 'name' ,"searchable": true},
                    { data: 'description', name: 'description' ,"searchable": true},
                    { data: 'created_at', name: 'created_at' ,"searchable": true },
                    { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
                ]
            });


            $(document).on('click', '#btndelete', function(){  

		    var token = $(this).data("token");
		    var docid = $(this).data("docid");

	       	swal({ title: "Are you sure?",   text: "You will not be able to recover this record!",   
	       			type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: true }, 
	       		function(){   

  					var value = {
                        'id':docid,
                        _token:$('meta[name="csrf-token"]').attr('content')
                    };

					$.ajax({  
                         url:'{!! URL::to( $route . '/delete') !!}', 			//URL::to('/category/delete')
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


	
	});
</script>
@endpush 





