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
			<a href=" {{ url('category/create') }} " class="btn btn-success">Create New</a>
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


		            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">


		                <thead>
		                    <tr role="row">
		                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 71px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">First name</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 69px;" aria-label="Last name: activate to sort column ascending">Last name</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 155px;" aria-label="Position: activate to sort column ascending">Position</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 67px;" aria-label="Office: activate to sort column ascending">Office</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 27px;" aria-label="Age: activate to sort column ascending">Age</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 64px;" aria-label="Start date: activate to sort column ascending">Start date</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 46px;" aria-label="Salary: activate to sort column ascending">Salary</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 36px;" aria-label="Extn.: activate to sort column ascending">Extn.</th>
		                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 148px;" aria-label="E-mail: activate to sort column ascending">E-mail</th>
		                    </tr>
		                </thead>

		                <tbody>

		                    <tr role="row" class="odd">
		                        <td tabindex="0" class="sorting_1">Airi</td>
		                        <td>Satou</td>
		                        <td>Accountant</td>
		                        <td>Tokyo</td>
		                        <td>33</td>
		                        <td>2008/11/28</td>
		                        <td>$162,700</td>
		                        <td>5407</td>
		                        <td>a.satou@datatables.net</td>
		                    </tr>
		                  
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





