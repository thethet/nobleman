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
 
        @yield('styles')
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: SLIDING BAR (SB) -->
		
		<!-- end: SLIDING BAR -->
		<div class="main-wrapper">
			<!-- start: TOPBAR -->

			<!-- end: TOPBAR -->
			<!-- start: PAGESLIDE LEFT -->
			<a class="closedbar inner hidden-sm hidden-xs" href="#">
			</a>
			<nav id="pageslide-left" class="pageslide inner">
				<div class="navbar-content">
					<!-- start: SIDEBAR -->
					<div class="main-navigation left-wrapper transition-left">
						<div class="navigation-toggler hidden-sm hidden-xs">
							<a href="#main-navbar" class="sb-toggle-left">
							</a>
						</div>
                        
						<div class="user-profile border-top padding-horizontal-10 block">
							<div class="table-left">
									<img src="{{ URL::to('assets/img/noblemanlogo.png') }}">
							</div>
                            <div class="clear"></div>
						</div>
						<div class="user-profile border-top padding-horizontal-10 block" style="text-align: center;margin-top: 15px;">
							<div class="">
								@if(DB::table('students')->where('id', Auth::user()->id)->pluck('profile_picture'))
									<img src="uploads/{{DB::table('students')->where('id', Auth::user()->id)->pluck('profile_picture')}}" width="150px">
								@else
									<img src="{{ URL::to('assets/images/avatar-1.jpg') }}" alt="">
								@endif
							</div>
							<div class="">
                            	<div class="medmargin">
                                    <h4 class="no-margin"> {{ Auth::user()->show_id}} </h4><br>
								</div>
							</div>
                            <div class="clear"></div>
						</div>
						<!-- start: MAIN NAVIGATION MENU -->
						@if (Auth::user()->role == 1)
								<ul class="main-navigation-menu">
									<li>
										<a href="{{ URL::to('home') }}"><i class="fa fa-home"></i> Home</a>
									</li>
									<li>
										<a href="{{ URL::to('/dashboard') }}"><i class="fa fa-dashboard"></i> <span class="title"> Dashboard </span></a>
									</li>
									<li>
										<a class="setdrop"><i class="fa fa-bullhorn"></i> <span class="title"> Settings </span><span class="fa fa-chevron-down"></span></a>
										<ul class="setmenu nav child_menu" style="display: none">
											<li><a href="{{ URL::to('/sessions/show') }}">Operation Hours</a></li>
											<li><a href="{{ URL::to('/holidays')}}">Holidays</a></li>
										</ul>
									</li>

									<li>
										<a href="{{ URL::to('/print') }}"><i class="fa fa-print"></i> <span class="title"> Print Schedule </span></a>
									</li>
									<li>
										<a href="{{ URL::to('/payment') }}"><i class="fa fa-money"></i> <span class="title"> Payment Tracking </span></a>
									</li>
									<li>
										<a href="{{ URL::to('/students') }}"><i class="fa fa-user"></i> <span class="title"> Students </span></a>
									</li>
									<li>
										<a href="{{ URL::to('/branch') }}"><i class="fa fa-building"></i> <span class="title"> Branches </span></a>
									</li>									
									<li style="display:none;">
										<a href="{{ URL::to('/courses1') }}"><i class="fa fa-book"></i> <span class="title"> Courses(Remove)</span></a>
									</li>
									<li>
										<a href="{{ URL::to('/courses') }}"><i class="fa fa-book"></i> <span class="title"> Courses </span></a>
									</li>
									<li style="display:none;">
										<a href="{{ URL::to('/lessons') }}"><i class="fa fa-codepen"></i> <span class="title"> Lessons(Remove) </span></a>
									</li>
									<li>
										<a href="{{ URL::to('/attendance') }}"><i class="fa fa-calendar"></i> <span class="title"> Attendance </span></a>
									</li>
									<li>
										<a href="{{ URL::to('/trainers') }}"><i class="fa fa-support"></i> <span class="title"> Trainers </span></a>
									</li>

									<li>
										<a class="setdropschedule"><i class="fa fa-certificate"></i> <span class="title"> Trainers Schedules </span><span class="fa fa-chevron-down"></span></a>
										<ul class="setmenuschedule nav child_menu" style="display: none">
											<li><a href="{{ URL::to('/trainerschedule/create') }}">Create Schedule</a></li>
											<li><a href="{{ URL::to('/trainerschedule')}}">Lists Schedule</a></li>
										</ul>
									</li>

									<!-- <li>
										<a href="{{ URL::to('/cert') }}"><i class="fa fa-certificate"></i> <span class="title"> Certificate </span></a>
									</li> -->

									<li>
										<a class="setdropcert"><i class="fa fa-certificate"></i> <span class="title"> Certificate </span><span class="fa fa-chevron-down"></span></a>
										<ul class="setmenucert nav child_menu" style="display: none">
											<li><a href="{{ URL::to('/cert/generatecertlists') }}">Generate Certificate</a></li>
											<li style="display:none;"><a href="{{ URL::to('/cert/certificates')}}">Certificate Template</a></li>
										</ul>
									</li>
									
									<li>
										<a href="{{ URL::to('/announcement') }}"><i class="fa fa-bullhorn"></i> <span class="title"> Announcement </span></a>
									</li>
									<li>
										<a class="setdropreport"><i class="fa fa-certificate"></i> <span class="title"> Report </span><span class="fa fa-chevron-down"></span></a>						
										<ul class="setmenureport nav child_menu" style="display: none">
											
											<a href="{{ URL::to('/reports/certified-students') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Student Certified Report </span></a>
											<a href="{{ URL::to('/reports/attendance-students') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Student Attendance Report </span></a>
											
											<a href="{{ URL::to('/reports/trainer-course-taught') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Trainer Course Report </span></a>
											<a href="{{ URL::to('/reports/trainer-students') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Trainer Student Report </span></a>

											<a href="{{ URL::to('/reports/course-history') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Course History </span></a>

											<a href="{{ URL::to('/reports/trialstudents-history') }}"><i class="fa fa-file-text-o"></i> <span class="title"> Trial Students History </span></a>
										</ul>
									</li>

									<li>
										<a class="setdropreminder"><i class="fa fa-certificate"></i> <span class="title"> Reminder </span><span class="fa fa-chevron-down"></span></a>
										<ul class="setmenureminder nav child_menu" style="display: none">
											<li><a href="{{ URL::to('/remindertostudents') }}">Reminder to students</a></li>
											<li><a href="{{ URL::to('/remindertotrialstudents') }}">Reminder to trial students</a></li>
											<li><a href="{{ URL::to('/remindertotrainers')}}">Reminder to trainers</a></li>
											<li><a href="{{ URL::to('/reminderforcourseexpire')}}">Reminder for course expire</a></li>
										</ul>
									</li>

									<li>
										<a class="setdropreminder_template"><i class="fa fa-certificate"></i> <span class="title"> Reminder Email Template </span><span class="fa fa-chevron-down"></span></a>
										<ul class="setmenureminder_template nav child_menu" style="display: none">
											<li><a href="{{ URL::to('/remindertostudents-template') }}">Reminder to students</a></li>
											<li><a href="{{ URL::to('/remindertotrialstudents-template') }}">Reminder to trial students</a></li>
											<li><a href="{{ URL::to('/remindertotrainers-template')}}">Reminder to trainers</a></li>
											<li><a href="{{ URL::to('/reminderforcourseexpire-template')}}">Reminder for course expire</a></li>
										</ul>
									</li>
									
								</ul>
					@elseif (Auth::user()->role == 2)
							<ul class="main-navigation-menu">
								<li>
									<a href="{{ URL::to('/trainer/schedules') }}"><i class="fa fa-calendar"></i> <span class="title"> Schedules </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/trainer/attendance') }}"><i class="fa fa-calendar"></i> <span class="title"> Attendance </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/trainer/stdbylesson') }}"><i class="fa fa-calendar"></i> <span class="title"> Students by course </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/trainer/announcement') }}"><i class="fa fa-user"></i> <span class="title"> Announcement </span></a>
								</li> 
							</ul>
					@elseif (Auth::user()->role == 3)
							<ul class="main-navigation-menu">
								<li>
									<a href="{{ URL::to('/stdschedules') }}"><i class="fa fa-user"></i> <span class="title"> Booking Schedules </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/stdannouncement') }}"><i class="fa fa-user"></i> <span class="title"> Announcement </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/appointment') }}"><i class="fa fa-user"></i> <span class="title"> Appointment </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/changepassword') }}"><i class="fa fa-user"></i> <span class="title"> Change Password </span></a>
								</li>
								<li>
									<a href="{{ URL::to('/registercourse') }}"><i class="fa fa-user"></i> <span class="title"> Courses </span></a>
								</li>
							</ul>
					@endif
						<!-- end: MAIN NAVIGATION MENU -->
					</div>
					<!-- end: SIDEBAR -->
				</div>
				<div class="slide-tools">
					<div class="col-xs-6 text-left no-padding">
						<a class="btn btn-sm status" href="#">
							Status <i class="fa fa-dot-circle-o text-green"></i> <span>Online</span>
						</a>
					</div>
					<div class="col-xs-6 text-right no-padding">
                    	{{ Form::open(array('action'=>'CoverController@logout')) }}
						<a class="btn btn-sm log-out text-right" href="{{ URL::to('logout') }}">
							<i class="fa fa-power-off"></i> Log Out
						</a>
                        {{ Form::close() }}
					</div>
				</div>
			</nav>
			<!-- end: PAGESLIDE LEFT -->
			<!-- start: MAIN CONTAINER -->
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content">
					<!-- start: PANEL CONFIGURATION MODAL FORM -->
					<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title">Panel Configuration</h4>
								</div>
								<div class="modal-body">
									Here will be a configuration form
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
										Close
									</button>
									<button type="button" class="btn btn-primary">
										Save changes
									</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- end: SPANEL CONFIGURATION MODAL FORM -->
                    
                        <?php
						$request = explode($URL,$_SERVER['REQUEST_URI']);
						$crumbs = explode('/',$request[1]);
						?>
					<div class="container">
						<!-- start: PAGE HEADER -->
						<!-- start: TOOLBAR -->
						<div class="toolbar row">
							<div class="col-sm-6 hidden-xs">
								<div class="page-header">
									<h1>
									<?php 
									if (ucwords(str_replace('_', ' ', $crumbs[0])) == 'Stdannouncement') {
										echo 'Announcement';
									}else if(ucwords(str_replace('_', ' ', $crumbs[0])) == 'Changepassword'){
										echo 'Change Password';
									}else{
										echo ucwords(str_replace('_', ' ', $crumbs[0])); 
									}
									
									?>
									</h1>
                                    <ol class="breadcrumb">
										@for ($n = 0; $n < count($crumbs); $n++)
                                        <li>
                                            <a href="{{ URL::to($crumbs[$n]) }}">
                                                <?php //echo ucwords(str_replace('_', ' ', $crumbs[$n])); ?>
                                            </a>
                                        </li>
											@endfor
								</ol>
								</div>
							</div>
							<div class="col-sm-6 col-xs-12">
								<a href="#" class="back-subviews">
									<i class="fa fa-chevron-left"></i> BACK
								</a>
								<a href="#" class="close-subviews">
									<i class="fa fa-times"></i> CLOSE
								</a>
								<div class="toolbar-tools pull-right">
									<!-- start: TOP NAVIGATION MENU -->
									<ul class="nav navbar-right">
										<!-- start: TO-DO DROPDOWN -->
										
									</ul>
									<!-- end: TOP NAVIGATION MENU -->
								</div>
							</div>
						</div>
						<!-- end: TOOLBAR -->
						<!-- end: PAGE HEADER -->
						<!-- start: BREADCRUMB -->
						<div class="row">
							<div class="col-md-12">
								
							</div>
						</div>
						<!-- end: BREADCRUMB -->
						<!-- start: PAGE CONTENT -->
						<div class="row">
                        	@yield('content')
                        </div>
						<!-- end: PAGE CONTENT-->
					</div>
					<div class="subviews">
						<div class="subviews-container"></div>
					</div>
				</div>
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			<!-- start: FOOTER -->
			<footer class="inner">
				<div class="footer-inner">
					<div class="pull-left">
						<?php echo date('Y'); ?> © Innov8te pte ltd. v.0.3
					</div>
					<div class="pull-right">
						<span class="go-top"><i class="fa fa-chevron-up"></i></span>
					</div>
				</div>
			</footer>
			<!-- end: FOOTER -->
			<!-- start: SUBVIEW SAMPLE CONTENTS -->
			<!-- *** NEW NOTE *** -->
			<div id="newNote">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new note</h3>
					<form class="form-note">
						<div class="form-group">
							<input class="note-title form-control" name="noteTitle" type="text" placeholder="Note Title...">
						</div>
						<div class="form-group">
							<textarea id="noteEditor" name="noteEditor" class="hide"></textarea>
							<textarea class="summernote" placeholder="Write note here..."></textarea>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-note" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** READ NOTE *** -->
			<div id="readNote">
				<div class="barTopSubview">
					<a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
				</div>
				<div class="noteWrap col-md-8 col-md-offset-2">
					<div class="panel panel-note">
						<div class="e-slider owl-carousel owl-theme">
							<div class="item">
								<div class="panel-heading">
									<h3>This is a Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
									</div>
									<div class="note-content">
										Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.
										Quis aute iure reprehenderit in <strong>voluptate velit</strong> esse cillum dolore eu fugiat nulla pariatur.
										<br>
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
										<br>
										Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
										<br>
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
										<br>
										Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
										<br>
										Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
									</div>
									<div class="note-options pull-right">
										<a href="#readNote" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									</div>
									<span class="author-note">Nicole Bell</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
							<div class="item">
								<div class="panel-heading">
									<h3>This is the second Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nemo enim ipsam voluptatem, quia voluptas sit...
									</div>
									<div class="note-content">
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
										<br>
										Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
										<br>
										Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
										<br>
										Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
									</div>
									<div class="note-options pull-right">
										<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									</div>
									<span class="author-note">Steven Thompson</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
							<div class="item">
								<div class="panel-heading">
									<h3>This is yet another Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores...
									</div>
									<div class="note-content">
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
										<br>
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
									</div>
									<div class="note-options pull-right">
										<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									</div>
									<span class="author-note">Ella Patterson</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- *** SHOW CALENDAR *** -->
			<div id="showCalendar" class="col-md-10 col-md-offset-1">
				<div class="barTopSubview">
					<a href="#newEvent" class="new-event button-sv" data-subviews-options='{"onShow": "editEvent()"}'><i class="fa fa-plus"></i> Add new event</a>
				</div>
				<div id="calendar"></div>
			</div>
			<!-- *** NEW EVENT *** -->
			<div id="newEvent">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new event</h3>
					<form class="form-event">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input class="event-id hide" type="text">
									<input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
								</div>
							</div>
							<div class="no-all-day-range">
								<div class="col-md-8">
									<div class="form-group">
										<div class="form-group">
											<span class="input-icon">
												<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
												<i class="fa fa-clock-o"></i> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="all-day-range">
								<div class="col-md-8">
									<div class="form-group">
										<div class="form-group">
											<span class="input-icon">
												<input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
												<i class="fa fa-calendar"></i> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="hide">
								<input type="text" class="event-start-date" name="eventStartDate"/>
								<input type="text" class="event-end-date" name="eventEndDate"/>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control selectpicker event-categories">
										<option data-content="<span class='event-category event-cancelled'>Cancelled</span>" value="event-cancelled">Cancelled</option>
										<option data-content="<span class='event-category event-home'>Home</span>" value="event-home">Home</option>
										<option data-content="<span class='event-category event-overtime'>Overtime</span>" value="event-overtime">Overtime</option>
										<option data-content="<span class='event-category event-generic'>Generic</span>" value="event-generic" selected="selected">Generic</option>
										<option data-content="<span class='event-category event-job'>Job</span>" value="event-job">Job</option>
										<option data-content="<span class='event-category event-offsite'>Off-site work</span>" value="event-offsite">Off-site work</option>
										<option data-content="<span class='event-category event-todo'>To Do</span>" value="event-todo">To Do</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="summernote" placeholder="Write note here..."></textarea>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-new-event" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** READ EVENT *** -->
			<div id="readEvent">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-12">
							<h2 class="event-title">Event Title</h2>
							<div class="btn-group options-toggle pull-right">
								<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
									<i class="fa fa-cog"></i>
									<span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu dropdown-light pull-right">
									<li>
										<a href="#newEvent" class="edit-event">
											<i class="fa fa-pencil"></i> Edit
										</a>
									</li>
									<li>
										<a href="#" class="delete-event">
											<i class="fa fa-times"></i> Delete
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6">
							<span class="event-category event-cancelled">Cancelled</span>
							<span class="event-allday"><i class='fa fa-check'></i> All-Day</span>
						</div>
						<div class="col-md-12">
							<div class="event-start">
								<div class="event-day"></div>
								<div class="event-date"></div>
								<div class="event-time"></div>
							</div>
							<div class="event-end"></div>
						</div>
						<div class="col-md-12">
							<div class="event-content"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- *** NEW CONTRIBUTOR *** -->
			<div id="newContributor">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new contributor</h3>
					<form class="form-contributor">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="contributor-id hide" type="text">
									<label class="control-label">
										First Name <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Insert your First Name" class="form-control contributor-firstname" name="firstname">
								</div>
								<div class="form-group">
									<label class="control-label">
										Last Name <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Insert your Last Name" class="form-control contributor-lastname" name="lastname">
								</div>
								<div class="form-group">
									<label class="control-label">
										Email Address <span class="symbol required"></span>
									</label>
									<input type="email" placeholder="Text Field" class="form-control contributor-email" name="email">
								</div>
								<div class="form-group">
									<label class="control-label">
										Password <span class="symbol required"></span>
									</label>
									<input type="password" class="form-control contributor-password" name="password">
								</div>
								<div class="form-group">
									<label class="control-label">
										Confirm Password <span class="symbol required"></span>
									</label>
									<input type="password" class="form-control contributor-password-again" name="password_again">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Gender <span class="symbol required"></span>
									</label>
									<div>
										<label class="radio-inline">
											<input type="radio" class="grey contributor-gender" value="F" name="gender">
											Female
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey contributor-gender" value="M" name="gender">
											Male
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										Permits <span class="symbol required"></span>
									</label>
									<select name="permits" class="form-control contributor-permits" >
										<option value="View and Edit">View and Edit</option>
										<option value="View Only">View Only</option>
									</select>
								</div>
								<div class="form-group">
									<div class="fileupload fileupload-new contributor-avatar" data-provides="fileupload">
										<div class="fileupload-new thumbnail"><img src="assets/images/anonymous.jpg" alt="" width="50" height="50"/>
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail"></div>
										<div class="contributor-avatar-options">
											<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
												<input type="file">
											</span>
											<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
												<i class="fa fa-times"></i> Remove
											</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										SEND MESSAGE (Optional)
									</label>
									<textarea class="form-control contributor-message"></textarea>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>

							</div>
							<div class="btn-group">
								<button class="btn btn-info save-contributor" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** SHOW CONTRIBUTORS *** -->
			<div id="showContributors">
				<div class="barTopSubview">
					<a href="#newContributor" class="new-contributor button-sv"><i class="fa fa-plus"></i> Add new contributor</a>
				</div>
				<div class="noteWrap col-md-10 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="contributors">
								<div class="options-contributors hide">
									<div class="btn-group">
										<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
											<i class="fa fa-cog"></i>
											<span class="caret"></span>
										</button>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">
											<li>
												<a href="#newContributor" class="show-subviews edit-contributor">
													<i class="fa fa-pencil"></i> Edit
												</a>
											</li>
											<li>
												<a href="#" class="delete-contributor">
													<i class="fa fa-times"></i> Delete
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end: SUBVIEW SAMPLE CONTENTS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
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

				/**************************************/

				$(".setdrop").click(function(){
				    $(".setmenu").toggle("slow");
				    $(".setmenu").css("display", "block");
				});

				$(".setdropcert").click(function(){
				    $(".setmenucert").toggle("slow");
				    $(".setmenucert").css("display", "block");
				});

				$(".setdropschedule").click(function(){
				    $(".setmenuschedule").toggle("slow");
				    $(".setmenuschedule").css("display", "block");
				});

				
				$(".setdropreport").click(function(){
				    $(".setmenureport").toggle("slow");
				    $(".setmenureport").css("display", "block");
				});

				$(".setdropreminder").click(function(){
				    $(".setmenureminder").toggle("slow");
				    $(".setmenureminder").css("display", "block");
				});

				$(".setdropreminder_template").click(function(){
				    $(".setmenureminder_template").toggle("slow");
				    $(".setmenureminder_template").css("display", "block");
				});
			});
		</script>
        @yield('scripts')
	</body>
	<!-- end: BODY -->
</html>