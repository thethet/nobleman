<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<?php
	$URL = "/";
?>
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Nobleman School of Floral Design</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS --><link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		{{ HTML::style("assets/plugins/bootstrap/css/bootstrap.min.css") }}
		{{ HTML::style("assets/plugins/font-awesome/css/font-awesome.css") }}
		{{ HTML::style("assets/plugins/iCheck/skins/all.css") }}
		{{ HTML::style("assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css") }}
		{{ HTML::style("assets/plugins/animate.css/animate.min.css") }}
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
		{{ HTML::style("assets/plugins/owl-carousel/owl-carousel/owl.carousel.css") }}
		{{ HTML::style("assets/plugins/owl-carousel/owl-carousel/owl.theme.css") }}
		{{ HTML::style("assets/plugins/owl-carousel/owl-carousel/owl.transitions.css") }}
		{{ HTML::style("assets/plugins/summernote/dist/summernote.css") }}
		{{ HTML::style("assets/plugins/fullcalendar/fullcalendar/fullcalendar.css") }}
		{{ HTML::style("assets/plugins/toastr/toastr.min.css") }}
		{{ HTML::style("assets/plugins/bootstrap-select/bootstrap-select.min.css") }}
		{{ HTML::style("assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css") }}
		{{ HTML::style("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css") }}
		{{ HTML::style("assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css") }}
		<!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		{{ HTML::style("assets/plugins/weather-icons/css/weather-icons.min.css") }}
		{{ HTML::style("assets/plugins/nvd3/nv.d3.min.css") }}
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE CSS -->
        {{ HTML::style("assets/css/styles.css") }}
		{{ HTML::style("assets/css/styles-responsive.css") }}
		{{ HTML::style("assets/css/plugins.css") }}
		{{ HTML::style("assets/css/themes/theme-default.css",array('id'=>'skin_color')) }}
		{{ HTML::style("assets/css/print.css", array('media' => 'print')) }}
	    {{ HTML::style('assets/css/boxy.css'); }}
	    {{ HTML::style('//cdn.datatables.net/1.10.7/css/jquery.dataTables.css'); }}
		<!-- end: CORE CSS -->

		{{ HTML::style('assets/css/custom-style.css'); }}

		<style type="text/css">
			body {
			    background-color: #ddd;
			}
			.well{
				min-height: 80px;
				background: #6e7543;
				border: 1px solid #8ba005;
				padding: 15px !important;
			}
			.well a{
				color: #FFFFFF;
			}
			.well a:hover{
				color: #88bbc8;
			}

			.navbar-default {
			    background-color: #22262f;
			    border-color: #22262f;
			}

			.custom-foot{
				text-align: center;
				margin-top: 120px;
			}

			.well h3 {
			    font-size: 20px;
			}


			@media (min-width: 768px){
				.navbar{
					border-radius: 0px;
				}
			}

		</style>
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>


	<nav class="navbar navbar-default" role="navigation" style="min-height:110px;">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

					<div class="col-sm-12" style="margin-top: -8px;">
						<a class="navbar-brand" href="{{ URL::to('/home') }}"><img class="img-responsive" src="{{ URL::to('assets/img/noblemanlogo.png') }}"></a>
					</div>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">


				<ul class="nav navbar-nav navbar-right" style="margin-top:15px;">
					<li class="dropdown">
						    <div style="float:left;">
						    @if(DB::table('students')->where('id', Auth::user()->id)->pluck('profile_picture'))
								<img src="uploads/{{DB::table('students')->where('id', Auth::user()->id)->pluck('profile_picture')}}" width="150px">
							@else
								<img src="{{ URL::to('assets/images/avatar-1.jpg') }}" alt="">
							@endif
							</div>
						<div style="float:left;margin-top:15px;padding-left:15px;">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size:16px;">{{ Auth::user()->show_id}} <b class="caret"></b></a>
						</div>
						<ul class="dropdown-menu">
							<li><a href="{{ URL::to('logout') }}">Log out</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container" style="margin-top: 40px">

		@if (Auth::user()->role == 1)

		<div class="row">
			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('sessions/show') }}"><i class="fa fa-gear"></i> Setting</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('print') }}"><i class="fa fa-print"></i> Print Schedule</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('payment') }}"><i class="fa fa-money"></i> Payment Tracking</a></h3>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('students') }}"><i class="fa fa-user"></i> Students</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('branch') }}"><i class="fa fa-building"></i> Branches</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('courses') }}"><i class="fa fa-book"></i> Courses</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('attendance') }}"><i class="fa fa-calendar"></i> Attendance</a></h3>
				</div>
			</div>

		</div>

		<div class="row">
		    <div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('trainers') }}"><i class="fa fa-support"></i> Trainers</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('trainerschedule') }}"><i class="fa fa-certificate"></i> Trainer Schedule</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/cert/generatecertlists') }}"><i class="fa fa-certificate"></i> Certificate</a></h3>
				</div>
			</div>

			 <div class="col-sm-3 col-lg-3">
		 		<div class="well">
					<h3><a href="{{ URL::to('announcement') }}"><i class="fa fa-bullhorn"></i> Announcement</a></h3>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/reports/certified-students') }}"><i class="fa fa-certificate"></i> Report</a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/remindertostudents') }}"> <i class="fa fa-home"></i> Reminder </a></a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/remindertostudents-template') }}"> <i class="fa fa-home"></i> Reminder Template </a></a></h3>
				</div>
			</div>


		</div>

		@elseif (Auth::user()->role == 2)

			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/trainer/schedules') }}"><i class="fa fa-print"></i>Schedules</a></h3>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/trainer/attendance') }}"><i class="fa fa-calendar"></i> Attendance</a></h3>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3>
						<a href="{{ URL::to('/trainer/stdbylesson') }}"><i class="fa fa-calendar"></i> <span class="title"> Students by course </span></a>
					</h3>
				</div>
			</div>
			<div class="col-sm-3 col-lg-3">
				<div class="well">
					<h3><a href="{{ URL::to('/trainer/announcement') }}"><i class="fa fa-bullhorn"></i> Announcement</a></h3>
				</div>
			</div>

		@elseif (Auth::user()->role == 3)
			<div class="col-sm-3 col-lg-3">
				<div class="well">
				<h3><a href="{{ URL::to('/stdschedules') }}"><i class="fa fa-user"></i> <span class="title"> Booking Schedules </span></a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
				<h3><a href="{{ URL::to('/stdannouncement') }}"><i class="fa fa-user"></i> <span class="title"> Announcement </span></a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
				<h3><a href="{{ URL::to('/appointment') }}"><i class="fa fa-user"></i> <span class="title"> Appointment </span></a></h3>
				</div>
			</div>

			<div class="col-sm-3 col-lg-3">
				<div class="well">
				<h3><a href="{{ URL::to('/changepassword') }}"><i class="fa fa-user"></i> <span class="title"> Change Password </span></a></h3>
				</div>
			</div>


			<div class="col-sm-3 col-lg-3">
				<div class="well">
				<h3><a href="{{ URL::to('/registercourse') }}"><i class="fa fa-user"></i> <span class="title"> Courses </span></a></h3>
				</div>
			</div>

		@endIf

	</div>

	<div class="custom-foot">
		<p>
			<?php echo date('Y'); ?> © Innov8te pte ltd. v.0.3
		</p>
	</div>




		<!--[if lt IE 9]>
		<script src="assets/plugins/respond.min.js"></script>
		<script src="assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		{{ HTML::script("assets/plugins/jQuery/jquery-2.1.1.min.js") }}
		<!--<![endif]-->
		{{ HTML::script("assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap/js/bootstrap.min.js") }}
		{{ HTML::script("assets/plugins/blockUI/jquery.blockUI.js") }}
		{{ HTML::script("assets/plugins/iCheck/jquery.icheck.min.js") }}
		{{ HTML::script("assets/plugins/moment/min/moment.min.js") }}
		{{ HTML::script("assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js") }}
		{{ HTML::script("assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js") }}
		{{ HTML::script("assets/plugins/bootbox/bootbox.min.js") }}
		{{ HTML::script("assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js") }}
		{{ HTML::script("assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js") }}
		{{ HTML::script("assets/plugins/jquery.appear/jquery.appear.js") }}
		{{ HTML::script("assets/plugins/jquery-cookie/jquery.cookie.js") }}
		{{ HTML::script("assets/plugins/velocity/jquery.velocity.min.js") }}
		{{ HTML::script("assets/plugins/TouchSwipe/jquery.touchSwipe.min.js") }}
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		{{ HTML::script("assets/plugins/owl-carousel/owl-carousel/owl.carousel.js") }}
		{{ HTML::script("assets/plugins/jquery-mockjax/jquery.mockjax.js") }}
		{{ HTML::script("assets/plugins/toastr/toastr.js") }}
		{{ HTML::script("assets/plugins/bootstrap-modal/js/bootstrap-modal.js") }}
		{{ HTML::script("assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js") }}
		{{ HTML::script("assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap-select/bootstrap-select.min.js") }}
		{{ HTML::script("assets/plugins/jquery-validation/dist/jquery.validate.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js") }}
		{{ HTML::script("assets/plugins/truncate/jquery.truncate.js") }}
		{{ HTML::script("assets/plugins/summernote/dist/summernote.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap-daterangepicker/daterangepicker.js") }}
		{{ HTML::script("assets/js/subview.js") }}
		{{ HTML::script("assets/js/subview-examples.js") }}
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		{{ HTML::script("assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js") }}
		{{ HTML::script("assets/plugins/nvd3/lib/d3.v3.js") }}
		{{ HTML::script("assets/plugins/nvd3/nv.d3.min.js") }}
		{{ HTML::script("assets/plugins/nvd3/src/models/historicalBar.js") }}
		{{ HTML::script("assets/plugins/nvd3/src/models/historicalBarChart.js") }}
		{{ HTML::script("assets/plugins/nvd3/src/models/stackedArea.js") }}
		{{ HTML::script("assets/plugins/nvd3/src/models/stackedAreaChart.js") }}
		{{ HTML::script("assets/plugins/jquery.sparkline/jquery.sparkline.js") }}
		{{ HTML::script("assets/plugins/easy-pie-chart/dist/jquery.easypiechart.min.js") }}
		{{ HTML::script("assets/js/index.js") }}
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		{{ HTML::script("assets/js/main.js") }}
		{{ HTML::script('assets/js/jquery.boxy.js'); }}
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				SVExamples.init();
				Index.init();
			});
		</script>

	</body>
	<!-- end: BODY -->
</html>
