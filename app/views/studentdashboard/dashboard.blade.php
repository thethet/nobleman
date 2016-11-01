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

	.bookbtn{
		border: 1px solid #353434;
		padding: 2px;
		/*width: 40px;*/
		height: auto;
		display: block;
		text-align: center;
		border-radius: 3px;
		color: #353434;
		font-size: 10px;
		margin-top: 5px;
	}
	#session_val{
		float: left;
		padding-right: 5px;
	}
	#vacancy{
		float: left;
	}

	.fc-right{
		display: none;
	}

	.fc button {
		width: auto;
	}


</style>
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
      
        <div class="panel-body"> 
           <div id="stdid" style="display:none;" value="{{$std_id}}"></div>
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

		//var start = '2016-05-Mon';

		//var startDate = $.fullCalendar.formatDate( start, "YYYY-MM-ddd"); 
		var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DDD');


		//start = $.fullCalendar.formatDate(start, "D F Y");
		//$.fullCalendar.formatDate( start, "D F Y" );
		 

		$('#calendar').fullCalendar({

			//defaultDate: formatDate,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			/*titleFormat: {
			day: 'yyyy-MM-ddd'   //whatever date format you want here
			} ,*/

			events: [			

			<?php
				function getDay($day)
				{
				    $days = ['Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thur' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7];

				    $today = new \DateTime();
				    $today->setISODate((int)$today->format('o'), (int)$today->format('W'), $days[ucfirst($day)]);
				    return $today;
				}

				foreach ($appointments as $appo) {
					$id = 'ald' . $appo->id;
					$course_id = $appo->course_id;
					$session = $appo->session;
					$startdate = $appo->date;
					$v_limit = 14;					

					$vacancy_count = DB::table('appointment')->where('course_id','=',$appo->course_id)->where('date','=',$startdate)->where('session','=',$session)->where('booking_status','=','book')->count();
					if($vacancy_count == 14){			
						$vacancy = "FULL";
						$bookbtn_text = 'Add me to waiting list';
					}else{
						$vacancy = $v_limit - $vacancy_count . " left";

						$chkbook = DB::table('appointment')->where('course_id','=',$appo->course_id)->where('date','=',$startdate)->where('session','=',$session)->where('student_id','=',$std_id)->where('booking_status','=','book')->count();
						if($chkbook == 1){
							$bookbtn_text = 'UNBOOK';							
						}else{
							$bookbtn_text = 'BOOK';
						}

					}
					

				?>
				{
					title: "<div id='course_id' value=<?php echo $course_id; ?>></div><div id='session_val'><?php echo $session; ?></div><div id='vacancy'> (<?php echo $vacancy; ?>) </div> <br /><button class='bookbtn' id=<?php echo $startdate; ?><?php echo $id; ?> value=<?php echo $startdate; ?>><?php echo $bookbtn_text; ?></button>",
					start: "<?php echo $startdate; ?>"							
				},
				<?php
				}//end foreach

		    $course_list = StudentCourseEntry::where('student_id','=',$std_id)->get();

		    foreach ($course_list as $key => $value) {
		        	
		        $sessions = DB::table('lesson_sessions')->where('course_id','=',$value->course_id)->where('status','=',1)->get();

				foreach ($sessions as $ses) {
					$id = $ses->id;
					$session = $ses->session;
					$v_limit = 14;
					$course_id = $ses->course_id;
					$startdate = getDay($ses->day)->format('Y-m-d');


					if ($session == 'A') {
						$session_time = '11am - 12pm';
					}
					if ($session == 'B') {
						$session_time = '2pm - 4pm';
					}
					if ($session == 'C') {
						$session_time = '7pm - 9pm';
					}
					if ($session == 'D') {
						$session_time = '10am - 12pm';
					}

					$chk = DB::table('appointment')->where('course_id','=',$ses->course_id)->where('date','=',$startdate)->where('session','=',$session_time)->where('student_id','=',$std_id)->count();

					if ($chk != 1) {						

						$vacancy_count = DB::table('appointment')->where('course_id','=',$ses->course_id)->where('date','=',$startdate)->where('session','=',$session_time)->where('booking_status','=','book')->count();
						if($vacancy_count == 14){			
							$vacancy = "FULL";
							$bookbtn_text = 'Add me to waiting list';
						}else{
							$vacancy = $v_limit - $vacancy_count . " left";

							$chkbook = DB::table('appointment')->where('course_id','=',$ses->course_id)->where('date','=',$startdate)->where('session','=',$session_time)->where('student_id','=',$std_id)->where('booking_status','=','book')->count();
							if($chkbook == 1){
								$bookbtn_text = 'UNBOOK';							
							}else{
								$bookbtn_text = 'BOOK';
							}

						}

						$startdate = $startdate;
					

					}else{
						$startdate = '0';
					}// End chk if
					


				?>
				{
					title: "<div id='course_id' value=<?php echo $course_id; ?>></div><div id='session_val'><?php echo $session_time; ?></div><div id='vacancy'> (<?php echo $vacancy; ?>) </div> <br /><button class='bookbtn' id=<?php echo $startdate; ?><?php echo $id; ?> value=<?php echo $startdate; ?>><?php echo $bookbtn_text; ?></button>",
					//start: "Mon May 2016"
					start: "<?php echo $startdate; ?>"					
				},
					
				<?php
				}//end foreach

				}//end foreach

				?>	
			],
			//dateFormat: 'D F Y'
			//start=moment(start).format('D F Y');
			//start = $.fullCalendar.formatDate(start, "yyyy-MM-dd");
			//start = moment().format('YYYY-MM-ddd')


			
			eventRender: function(event, element) {       

				element.find('.fc-title').html(event.title);
				//element.find('#session_val').html(event.title);
				
				element.click(function() {
		           //alert($(".bookbtn").attr('value', event.value));	
		           //alert($(".bookbtn").attr(event.value));
		           //alert("HTML: " + $(".bookbtn").val());
		           //alert("Value: " + $("#bookbtn").val());
		           //alert($("#bookbtn").attr("href"));
		        });		

		        eventsdate = moment(event.start).format('yyyy-MM-dd');
		        element.find('.fc-time').html(eventsdate);

			},

			dayRender: function (date, cell) {
		        //var today = new Date();
		        /*if (date.getDate() === today.getDate()) {
		            cell.css("background-color", "red");
		        }*/
		         date = new Date();
		         //date = $.fullCalendar.formatDate(date, 'YYYY-MM-ddd');
		         date = moment("2016-05-04", 'yyyy-MM-dd').format('yyyy-MM-dd');
		         $('.fc-day[data-date="'+ date +'"]').addClass('cellBg');
		    }

		});


	/*******************************************************/

	/*$( document ).ajaxError(function( event, request, settings ) {	  
	  alert(settings.url);
	});*/


	//$(".bookbtn").click(function(){  
	$("button").click(function(){     
	    //var stdid = document.getElementById("stdid").value;
	    var stdid = $("#stdid").attr("value");
	    var idname = $(this).attr("id");
	    var date = $(this).attr("value");
	    var session = $(this).parent().find('#session_val').text();
	    var course_id = $(this).parent().find('#course_id').attr("value");

	    var postData ={'stdid': stdid, 'course_id': course_id, 'date': date, 'session': session}; 

	    var l = window.location;
		var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[0];
	    var url_link = base_url + "/stdschedules/bookingajax";

	    var bookbtn_text = $(this).text();
	   
	    if (bookbtn_text == 'UNBOOK') {
	    	var r=confirm("Are you sure you want to cancel this booking?");
			if (r==true)
			{
			  //alert("You pressed OK!");
			  var unbook_url_link = base_url + "/stdschedules/unbookingajax";
			  $.ajax({
			        type: "POST",
			        dataType: "json",
			        url: unbook_url_link,
			        data: postData,
			        cache: false,
			        beforeSend: function(data){
			            //alert("send");
			        },
			        success: function(data)
			        {	
			          if (data.html == 'success') 
			          {
			          	
			          	$("#"+idname).text('BOOK');
			          	/*$("#"+idname).val('BOOK');*/
			          }else{
			          	alert('You cannot make the unbooking this class!')
			          }

			        },
			        error: function(data){
			            alert("error");
			        }
			    }); //End ajax
			}
			else
			{
			  //alert("You pressed Cancel!");
			}
	    
		}
		else if (bookbtn_text == 'Add me to waiting list') {
	    	var k=confirm("We will send you an email if there is cancellation of class from other students. If you do not receive any email, it means that there will be no more vacancy and do try for another day.");
			if (k==true){
				var waitbook_url_link = base_url + "/stdschedules/waitbookingajax";
				  $.ajax({
				        type: "POST",
				        dataType: "json",
				        url: waitbook_url_link,
				        data: postData,
				        cache: false,
				        beforeSend: function(data){
				            //alert("send");
				        },
				        success: function(data)
				        {
				          /*if (data.limit != 0) 
				          {
				          	alert(data.limit);
				          }*/
				          if (data.html == 'success') {
				          }

				        },
				        error: function(data){
				            alert("error");
				            //alert(data.html);
				        }
				    }); //End ajax
			}else{

			}


	    }else{
	    	$.ajax({
		        type: "POST",
		        dataType: "json",
		        url: url_link,
		        data: postData,
		        cache: false,
		        beforeSend: function(data){
		            //alert("send");
		        },
		        success: function(data)
		        {
		          //$(".sessionwrap").html(data.html);   
		          //alert("success" + data.html);
		          if (data.html == 'success') 
		          {
		          	$("#"+idname).text('UNBOOK');
		          	/*$("#"+idname).val('UNBOOK');*/
		          }else{
		          	alert(data.limit);
		          }


		        },
		        error: function(data){
		            alert("error");
		        }
		    }); //End ajax
	    }

    });
		
		
	});
</script>
@stop