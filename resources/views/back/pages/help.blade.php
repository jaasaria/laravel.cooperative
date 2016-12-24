@extends('back.layouts.admin')

@section('css.import')
	<style>
		.panel_toolbox {float: left;min-width: 0px;}
		
		.w15 {width:15%;text-align: center;}
		.w10 {width:10%;text-align: center;}
		.w20 {width:20%;}
		.w30 {width:30%;text-align: center;}
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
	</style>
@stop

@section('content')

	<div class="box-header with-border">
		<span class="pull-left">
			<h3 class="box-title">Help <small>Transaction list</small></h3>
		</span>
		<span class="pull-right">
			{{-- <a href=" {{ url( $route . '/create') }} " class="btn btn-success">Create New</a> --}}
		</span>
	</div>


<div class="row">

	<div class="col-md-12 col-sm-12 col-xs-12">

	    <div class="x_panel">
		    <div class="x_title">
		        <h2>Frequently Asked Questions </h2>
			        <ul class="nav navbar-right panel_toolbox">
			          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			          </li>
			        </ul>
		        	<div class="clearfix"></div>
		    </div>


	     <div class="x_content">

			<div class="row">
		        <div class="col-sm-12">


		     <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h4 class="panel-title">Collapsible Group Items #1</h4>
                      </a>


                      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
 						<p><strong>Collapsible Item 2 data</strong>
                          </p>
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,

                         
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Collapsible Group Items #2</h4>
                      </a>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                        <div class="panel-body">
                          <p><strong>Collapsible Item 2 data</strong>
                          </p>
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">Collapsible Group Items #3</h4>
                      </a>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                        <div class="panel-body">
                          <p><strong>Collapsible Item 3 data</strong>
                          </p>
                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor
                        </div>
                      </div>
                    </div>
                  </div>
			

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

     


        });	
	});

</script>
@endpush 





