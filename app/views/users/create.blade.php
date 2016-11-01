@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/plugins/datepicker/css/datepicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }}
@stop

@section('content')
{{ Form::open(array('url'=>'users/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-6">
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        First Name*
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="first_name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Last Name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="last_name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Gender* 
                    </label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" class="grey contributor-gender" value="Female" name="gender">
                            Female
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="grey contributor-gender" value="Male" name="gender">
                            Male
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="contact" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Position
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="position" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Date of Birth
                    </label>
               		<div class="col-sm-9">
						<input type="text" name="dob" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">				
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Country of Birth
                    </label>
               		<div class="col-sm-9">
                    
                    	<select name="country" class="form-control input-sm search-select">
                            @foreach ($countries as $key=>$value)
                                <option @if($value->country_name == "Singapore") selected @endif value="{{ $value->country_name }}">{{ $value->country_name }}</option>    
                            @endforeach
                        </select>					
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Nationality
                    </label>
               		<div class="col-sm-9">
                    	<select name="nationality" class="form-control input-sm search-select">
                            @foreach ($countries as $key=>$value)
                                <option @if($value->country_name == "Singapore") selected @endif value="{{ $value->nationality }}">{{ $value->nationality }}</option>    
                            @endforeach
                        </select>			
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Race
                    </label>
               		<div class="col-sm-9">		
                    	<select name="race" class="form-control input-sm search-select">
                        	<option value="Chinese">Chinese</option>
                        	<option value="Indian">Indian</option>
                        	<option value="Malay">Malay</option>
                        	<option value="Eurasian">Eurasian</option>
                        	<option value="Other">Other</option>
                        </select>		
                    </div>
                </div>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
 <div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{ URL::to('users') }}"><input type="button" class="btn btn-warning" value="Back"></a>
    </div>
</div>
</div>
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Log-in <span class="text-bold">Credentials</span></h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        ID*
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="show_id" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input type="email" name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       	Password
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="password" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Confirm Password
                    </label>
                    <div class="col-sm-9">
                        <input type="password" name="confirm_password" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Role
                    </label>
                    <div class="col-sm-9">
                    	<select name="role" class="form-control input-sm">
                            @foreach ($user_roles as $key=>$value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>


 
</div>
{{ Form::close() }}
@stop

@section ('scripts')
	{{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/autosize/jquery.autosize.min.js") }}
    {{ HTML::script("assets/plugins/select2/select2.min.js") }}
    {{ HTML::script("assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js") }}
    {{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/jquery-maskmoney/jquery.maskMoney.js") }}
    {{ HTML::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/commits.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js") }}
    {{ HTML::script("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") }}
    {{ HTML::script("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js") }}
    {{ HTML::script("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js") }}
    {{ HTML::script("assets/plugins/ckeditor/ckeditor.js") }}
    {{ HTML::script("assets/plugins/ckeditor/adapters/jquery.js") }}
    {{ HTML::script("assets/js/form-elements.js") }}
    
    
    <script>
        jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
        });
    </script>
@stop