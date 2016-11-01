<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.2 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Nobleman School Of Florist</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		{{ HTML::style("assets/plugins/bootstrap/css/bootstrap.min.css") }}
		{{ HTML::style("assets/plugins/font-awesome/css/font-awesome.min.css") }}
		{{ HTML::style("assets/plugins/animate.css/animate.min.css") }}
		{{ HTML::style("assets/plugins/iCheck/skins/all.css") }}
		{{ HTML::style("assets/css/styles.css") }}
		{{ HTML::style("assets/css/styles-responsive.css") }}
		{{ HTML::style("assets/plugins/iCheck/skins/all.css") }}
		<!--[if IE 7]>
		{{ HTML::style("assets/plugins/font-awesome/css/font-awesome-ie7.min.css") }}
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				@if (Session::has('message'))
			        <div class="alert alert-danger">{{ Session::get('message') }}</div>
			    @endif

			    @if (Session::has('sendmessage'))
			        <div class="alert alert-success">{{ Session::get('message') }}</div>
			    @endif

				<div class="logo">
			
				</div>
				<!-- start: LOGIN BOX -->
				<div class="box-login">
					<h3> Password Reset </h3>
					<p>						
					</p>
					{{ Form::open(array("action"=>"CoverController@processResetPassword")) }}
						
						<fieldset>
							
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i>									
							</div>

							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="confirm_password" placeholder="Confirm Password" required>
									<i class="fa fa-lock"></i>									
							</div>

							<div class="form-actions">
								
								<button type="submit" class="btn btn-green pull-right">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							
						</fieldset>
					{{ Form::close() }}
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						<?php echo date('Y'); ?> © Nobleman Pte Ltd.
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				
			</div>
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		{{ HTML::script("assets/plugins/respond.min.js") }}
		{{ HTML::script("assets/plugins/excanvas.min.js") }}
		<script type="text/javascript" src="assets/plugins/jQuery/jquery-1.11.1.min.js") }}
		<![endif]-->
		<!--[if gte IE 9]><!-->
		{{ HTML::script("assets/plugins/jQuery/jquery-2.1.1.min.js") }}
		<!--<![endif]-->
		{{ HTML::script("assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js") }}
		{{ HTML::script("assets/plugins/bootstrap/js/bootstrap.min.js") }}
		{{ HTML::script("assets/plugins/iCheck/jquery.icheck.min.js") }}
		{{ HTML::script("assets/plugins/jquery.transit/jquery.transit.js") }}
		{{ HTML::script("assets/plugins/TouchSwipe/jquery.touchSwipe.min.js") }}
		{{ HTML::script("assets/js/main.js") }}
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		{{ HTML::script("assets/plugins/jquery-validation/dist/jquery.validate.min.js") }}
		{{ HTML::script("assets/js/login.js") }}
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>