@extends('layouts.main')

@section('styles')
 	{{ HTML::style("assets/css/fullcalendar.css") }}
    {{ HTML::style("assets/css/fullcalendar.print.css", array('media' => 'print')) }}

<style>	
	#calendar {
		/*max-width: 900px;*/
		margin-left: 30px;
	}

	.fc-state-highlight {
	    background: #e6f7fe !important;
	}
	.marquee{
		background-color: #e6edd6;
		width: 100%;
		padding: 15px;
		color: #333;
		margin-bottom: 15px;
		font-weight: bold;
	}
</style>
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
      
        <div class="panel-body"> 
        
	        <!-- @foreach($announcement as $announcement_data)
	        <marquee scrolldelay="50" behavior="scroll" direction="left">
	        	{{ $announcement_data->announcement_title}}
	        	</marquee>
	        @endforeach  	 -->

	        <!-- <div class="marquee">
		        <marquee onmouseover="this.setAttribute('scrollamount', 1, 0);" onmouseout="this.setAttribute('scrollamount', 4, 0);" name="m1" direction="rtl" scrollamount="4" scrolldelay="70" width="100%" title="rrr">
			        @foreach($announcement as $announcement_data)
			        	{{ $announcement_data->announcement_title }}
			        	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
			        @endforeach
		        </marquee>
	    	</div> --><!-- .marquee -->



           <div id='calendar'></div>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>
@stop


@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/js/table-data.js') }}

{{ HTML::script("assets/js/moment.min.js") }}
{{ HTML::script("assets/js/fullcalendar.min.js") }}

<script>
$(document).ready(function() {
		
	    var nowDate		= new Date();
		var nowDay		= ((nowDate.getDate().toString().length) == 1) ? '0'+(nowDate.getDate()) : (nowDate.getDate());
		var nowMonth	= ((nowDate.getMonth().toString().length) == 1) ? '0'+(nowDate.getMonth()+1) : (nowDate.getMonth()+1);
		var nowYear		= nowDate.getFullYear();
		var formatDate	= nowYear + "-" + nowMonth + "-" + nowDay;
		//alert(formatDate);


		$('#calendar').fullCalendar({
			defaultDate: formatDate,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [			

			<?php
				foreach ($trainer_schedule as $tsdata) {
					//$title = $tsdata['session'];
					$title = '';

					$trainer_schedule_session = DB::table('trainer_schedule_session')->where('trainer_schedule_id','=',$tsdata->id)->get();

					foreach ($trainer_schedule_session as $tss_val) {
						$title .= $tss_val->session.',';
					}

					$start = $tsdata['date'];

					$course_name = DB::table('courses')->where('id','=',$tsdata->course_id)->pluck('course_name');
					
				?>
				{
					title: "- <?php echo $title; ?> \n - <?php echo $course_name; ?> ",
					start: "<?php echo $start; ?>"
				},
					
				<?php
				}//end foreach
				?>	
			]
		});
		
		
	});
</script>
@stop