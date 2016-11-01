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
{{ Form::open(array('url'=>'students/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-6">

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
                        Name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="Uren Chen" name="name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        I/C or Passport No.
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="G1042124K" name="ic" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Gender* 
                    </label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" selected class="grey contributor-gender" value="Female" name="gender">
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
                        Date of Birth
                    </label>
               		<div class="col-sm-9">
                    	<select class="col-sm-4">
                        	<?php
                            	for ( $n = 1; $n <= 31; $n++)
                            	{
									?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                                    <?php
								}
                            ?>
                        </select>		
                    	<select class="col-sm-4">
                        	<option value="January">January</option>
                        	<option value="January">February</option>
                        	<option value="January">March</option>
                        	<option value="January">April</option>
                        	<option value="January">January</option>
                        	<option value="January">May</option>
                        	<option value="January">June</option>
                        	<option value="January">July</option>
                        	<option value="January">August</option>
                        	<option value="January">September</option>
                        	<option value="January">October</option>
                        	<option value="January">November</option>
                        	<option value="January">December</option>
                        </select>		
                    	<select class="col-sm-4">
                        	<?php
                            	for ( $n = 2015; $n >= 1960; $n--)
                            	{
									?>
                                    <option @if ($n == 1990) selected @endif value="{{ $n }}">{{ $n }}</option>
                                    <?php
								}
                            ?>
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
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Mobile Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="82141255" name="contact" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Residential Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="64213002" name="contact" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Local Address
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="23 Jalan Sultan Road" name="address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Unit No
                    </label>
                    <div class="col-sm-9">
                       <div class="col-sm-1">#</div>
                       <div class="col-sm-4"><input type="text" value="03" name="unitno1" class="form-control"></div>
                       <div class="col-sm-1">-</div>
                        <div class="col-sm-4"><input type="text" value="42" name="unitno2"  class="form-control"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Street name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="address" value="Bellicoe road" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                      Apartment name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="---" name="address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Postal Code
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="494124" name="address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Occupation
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="Web Developer" name="address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="form-field-13">
                        Job related to floristy
                    </label>
                    <div class="col-sm-8">
                        <input type="checkbox" checked> Yes / <input type="checkbox"> No
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Education
                    </label>
               		<div class="col-sm-9">		
                    	<select name="marital_status" id="education" class="form-control input-sm">
                        	<option value="Single">University</option>
                        	<option value="Married">College</option>
                        	<option value="Widowed">Diploma</option>
                        	<option value="Single">A-Level</option>
                        	<option selected value="Married">O-Level</option>
                        	<option value="Widowed">ITE</option>
                        	<option  value="Widowed">Others</option>
                        </select>		
                        <input type="text" id="otherform" placeholder="Enter other education" class="form-control">
                    </div>
                </div>
        </div>
    </div>
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Next-to-kin <span class="text-bold">Details</span></h4>
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
                        Name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="Katherine" name="next_to_kin" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Relationship
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="Wife"  name="next_to_kin_relationship" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="8120424"  name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{ URL::to('students') }}"><input type="button" class="btn btn-warning" value="Back"></a>
    </div>
</div>
</div>
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Company <span class="text-bold">Information</span></h4>
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
                        Company Name
                    </label>
                    <div class="col-sm-9">
                        <input value="Innov8te"  type="text" name="show_id" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact Person
                    </label>
                    <div class="col-sm-9">
                        <input value="Katherine"  type="text" name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Designation
                    </label>
                    <div class="col-sm-9">
                        <input value="Miss" type="text" name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address
                    </label>
                    <div class="col-sm-9">
                        <input value="42 Ininga road" type="text" name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Postal Code
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="842144"  name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact No
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="8124210"  name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Fax No
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="91024244"  placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="katherine@gmail.com"  name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Website
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="www.innov8te.com"  name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
 <div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Overseas Contact <span class="text-bold">& Mailing Address</span></h4>
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
                        Address
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="812 Jellicoe Road"  name="show_id" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Zip Code
                    </label>
                    <div class="col-sm-9">
                        <input type="text" value="842145" name="email" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="email" value="061923424" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
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
		$("#education").change(function(){
			if ($("#education").val() == "Other") 
			{
				$("#otherinput").show();
			}
		});
    </script>
@stop