@extends('back.layouts.admin')


@section('content')

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
			  <div class="count">3</div>
			  <h3>Today Purchase</h3>
			  <a href="" ><p>View purchases listing</p></a>
		</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
			  <div class="count">179</div>
			  <h3>Today Sales</h3>
			  <a href="" ><p>View sales listing</p></a>
		</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
			  <div class="count">55</div>
			  <h3>Today Re-Stock</h3>
			  <a href="" ><p>View re-stock listing</p></a>
		</div>
	</div>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
			  <div class="count">31</div>
			  <h3>Today Pull-Out</h3>
			  <a href="" ><p>View pull-out listing</p></a>
		</div>
	</div>

	<div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transaction Summary <small>Weekly progress</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12">


<div class="demo-container" style="height:280px">
   <div id="placeholder33x" class="demo-placeholder" style="padding: 0px; position: relative;">
      <canvas class="flot-base" width="100%" height="280" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 100%; height: 280px;"></canvas>
      <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
         <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 55px; text-align: center;">16/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 125px; text-align: center;">18/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 196px; text-align: center;">20/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 266px; text-align: center;">22/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 337px; text-align: center;">24/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 408px; text-align: center;">26/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 478px; text-align: center;">28/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 549px; text-align: center;">30/11/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 619px; text-align: center;">02/12/16</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 62px; top: 265px; left: 689px; text-align: center;">04/12/16</div>
         </div>
         <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 247px; left: 12px; text-align: right;">0</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 206px; left: 6px; text-align: right;">20</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 165px; left: 6px; text-align: right;">40</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 124px; left: 6px; text-align: right;">60</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 83px; left: 6px; text-align: right;">80</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 42px; left: 0px; text-align: right;">100</div>
            <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 0px; text-align: right;">120</div>
         </div>
      </div>
      <canvas class="flot-overlay" width="100%" height="280" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 100%; height: 280px;"></canvas>
    
   </div>
</div>
  

                    </div>

                  </div>
                </div>
              </div>

{{-- 
              <div id="app">
                

            <comments> </comments>

              </div>  
 --}}
@stop





{{-- 



@push('scripts')
<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('ecce3514ecfa8d62617e', {
      cluster: 'ap1',
      encrypted: true
    });

    var channel = pusher.subscribe('jaasaria_channel');
    channel.bind('ChatMessageReceived', function(data) {
      alert(data.message);
    });
  </script>
@endpush  --}}






