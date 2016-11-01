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
			        <div class="alert alert-success">{{ Session::get('sendmessage') }}</div>
			    @endif
				<div class="logo">
			
				</div>
				<!-- start: LOGIN BOX -->
				<div class="box-login">
					<h3>Sign in to your account</h3>
					<p>
						Please enter your name and password to log in.
					</p>
					{{ Form::open(array("action"=>"CoverController@authent")) }}
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-user"></i> </span>
							</div>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
									<a class="forgot" href="#">
										I forgot my password
									</a> </span>
							</div>
							<div class="form-actions">
								<label for="remember" class="checkbox-inline">
									<input type="checkbox" class="grey remember" id="remember" name="remember">
									Keep me signed in
								</label>
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
				<!-- end: LOGIN BOX -->
				<!-- start: FORGOT BOX -->
				<div class="box-forgot">
					<h3>Forget Password?</h3>
					<p>
						Enter your e-mail address below to reset your password.
					</p>
					<!-- <form class="form-forgot"> -->
					{{ Form::open(array("action"=>"CoverController@forgot", "class"=>'form-forgot')) }}
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<fieldset>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope"></i> </span>
							</div>
							<div class="form-actions">
								<a class="btn btn-light-grey go-back">
									<i class="fa fa-chevron-circle-left"></i> Log-In
								</a>
								<button type="submit" class="btn btn-green pull-right">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					{{ Form::close() }}
					<!-- </form> -->
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						<?php echo date('Y'); ?> © Nobleman Pte Ltd.
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: FORGOT BOX -->
				<!-- start: REGISTER BOX -->
				<div class="box-register">
					<h3>Sign Up</h3>
					<p>
						Enter your personal details below:
					</p>
					<form class="form-register">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
						</div>
						<fieldset>
							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Full Name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<div>
									<label class="radio-inline">
										<input type="radio" class="grey" value="F" name="gender">
										Female
									</label>
									<label class="radio-inline">
										<input type="radio" class="grey" value="M" name="gender">
										Male
									</label>
								</div>
							</div>
							<p>
								Enter your account details below:
							</p>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" name="password_again" placeholder="Password Again">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<div>
									<label for="agree" class="checkbox-inline">
										<input type="checkbox" class="grey agree" id="agree" name="agree">
										I agree to the Terms of Service and Privacy Policy
									</label>
								</div>
							</div>
							<div class="form-actions">
								Already have an account?
								<a href="#" class="go-back">
									Log-in
								</a>
								<button type="submit" class="btn btn-green pull-right">
									Submit <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
						</fieldset>
					</form>
					<!-- start: COPYRIGHT -->
					<div class="copyright">
						<?php echo date('Y'); ?> © Nobleman Pte Ltd.
					</div>
					<!-- end: COPYRIGHT -->
				</div>
				<!-- end: REGISTER BOX -->
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