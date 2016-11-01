@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/plugins/datepicker/css/datepicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }}
    {{ HTML::style("assets/css/custom-style.css") }}
@stop

@section('content')
{{ Form::open(array('url'=>'students/create','method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>'true','name'=>'createstdfrm')) }}
<div class="col-sm-12">
  @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif

    
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
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Picture
                </label>
                <div class="col-sm-9">
                    <!-- <img src="http://placehold.it/200/200" id="screenshot" /> -->
                    <img src="{{url()}}/assets/img/default-img-200x200.png" width="200px" height="200px">
                    {{Form::file('chooseImage1')}}
            </div>
            </div>
            <div class=" form-group">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Name <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="name" placeholder="" id="form-field-13" class="form-control input-sm" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        I/C or Passport No. <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="nric" placeholder="" id="form-field-13" class="form-control input-sm" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Branch <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <select name="branch_id" class="form-control input-sm">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Gender 
                    </label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" class=" contributor-gender" value="Female" name="gender">
                            Female
                        </label>
                        <label class="radio-inline">
                            <input type="radio" checked class=" contributor-gender" value="Male" name="gender">
                            Male
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Nationality
                    </label>
               		<div class="col-sm-9">
                    	<select name="nationality" id="nationality" class="input-sm search-select nationality" onchange="return checkNationality(this);">
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
                        <select class="col-sm-4" name="day">
                            <?php
                            for ( $n = 1; $n <= 31; $n++)
                            {
                                if( $n < 10)
                                {
                            ?>
                                    <option value="0{{ $n }}">0{{ $n }}</option>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <select class="col-sm-4" name="month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select class="col-sm-4" id="year" name="year" onchange="return changeAge(this);">
                        <?php
                        // $startdate = 1960;
                        $startdate = 1915;
                        $current_year = date("Y");
                        $years = range ($startdate,$current_year);
                        ?>
                        <div id="current_year" value="{{$current_year}}" hidden="hidden">{{$current_year}}</div>
                            <?php                                
                                foreach($years as $year)
                                {
                                ?>
                                <option @if ($year == 1990) selected @endif value="{{ $year }}">{{ $year }}</option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Age
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="age" id="age" readonly="readonly" class="form-control input-sm">
                    </div>
            </div>


            <div class="clearfix"></div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Race
                    </label>
               		<div class="col-sm-9">		
                    	<select name="race" class="input-sm search-select">
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
                        Mobile Number <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="text" name="country_code" id="form-field-13" class="form-control input-sm country_code" placeholder="+65">
                            </div>
                            <div class="col-sm-10">
                                <input type="text" name="mobile_contact" id="mobile_contact" placeholder="" id="form-field-13" class="form-control input-sm mobile_contact" required>
                            </div>
                        </div>
                        <span id="mobile_contact_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Residential Number
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="residential_contact" id="residential_contact" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="residential_contact_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        E-mail <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="email" id="email" placeholder="" id="form-field-13" class="form-control input-sm" required>
                        <span id="email_err"></span>
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
                        Local Address <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="local_address" placeholder="" id="form-field-13" class="form-control input-sm" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Unit No
                    </label>
                    <div class="col-sm-9">
                       <div class="col-sm-1">#</div>
                       <div class="col-sm-4"><input type="text" name="unitno1" class="form-control"></div>
                       <div class="col-sm-1">-</div>
                       <div class="col-sm-4"><input type="text" name="unitno2"  class="form-control"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Street name
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="street_name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                      Residential Address
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="apartment_name	" placeholder="" id="form-field-13" class="form-control input-sm apartment_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Postal Code
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="postal_code" id="postal_code" placeholder="" id="form-field-13" class="form-control input-sm postal_code">
                        <span id="postal_code_err"></span>  
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Occupation
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="occupation" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Intro Lesson 
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" class=" contributor-gender" value="Yes" name="introlesson" checked>
                            Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class=" contributor-gender" value="No" name="introlesson">
                            No
                        </label>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Job related to floristy <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input type="radio" class=" contributor-gender" value="Yes" name="floral_related" checked>
                            Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class=" contributor-gender" value="No" name="floral_related">
                            No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Education
                    </label>
               		<div class="col-sm-9">		
                    	<select name="education" id="education" class="form-control input-sm">
                        	<option value="University">University</option>
                        	<option value="College">College</option>
                        	<option value="Diploma">Diploma</option>
                        	<option value="A-Level">A-Level</option>
                        	<option value="O-Level">O-Level</option>
                        	<option value="ITE">ITE</option>
                        	<option value="Others">Others</option>
                        </select>		
                        <!-- <input type="text" id="otherform" placeholder="Enter other education" class="form-control"> -->
                    </div>
                </div>


                <div class="form-group" id="eduothers_field" style="display:none;">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Others
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="edu_others" id="edu_others" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>                

                <div class="form-group sponsor">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Sponsor by Company
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input clicked type="radio" class="sponsor_company" value="Yes" onclick="gaga();" name="sponsor" id="syes">
                            Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="sponsor_company" value="No" name="sponsor" id="sno">
                            No
                        </label>
                    </div>
                </div>
        </div>
    </div>
    
    <div class="panel panel-white" id="cihide">
        <div class="panel-heading">
            <h4 class="panel-title">Company <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
               
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Company Name <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact Person <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="contact_person" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Designation 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="designation" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_address" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Postal Code 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_postalcode" id="company_postalcode" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="company_postalcode_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact No: 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_contact_no" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Fax No 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_fax" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Email <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_email" id="company_email" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="company_email_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Website 
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="company_website" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>

                <div class="form-group sponsor">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Foreign Student
                    </label>
                    <div class="col-sm-8">
                        <label class="radio-inline">
                            <input clicked type="radio" class="foreign_std" value="Yes" onclick="gaga();" name="foreign_std" id="foreign_std_yes">
                            Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="foreign_std" value="No" name="foreign_std" id="foreign_std_no">
                            No
                        </label>
                    </div>
                </div>
 
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
 <div class="panel panel-white ocform" id="overseafrm">
        <div class="panel-heading">
            <h4 class="panel-title">Overseas Contact & <span class="text-bold">Mailing Address</span></h4>
        </div>
        <div class="panel-body">
               
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="oversea_address" placeholder="" id="form-field-13" class="form-control input-sm oversea_address">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Zip Code
                    </label>
                    <div class="col-sm-5">
                        <input type="text" name="oversea_zipcode" placeholder="" id="form-field-13" class="form-control input-sm oversea_zipcode">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Overseas Contact <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="oversea_contact" id="oversea_contact" placeholder="" id="form-field-13" class="form-control input-sm oversea_contact">
                        <span id="oversea_contact_err"></span>
                    </div>
                </div>

                <input type="checkbox" name="abvsame" value="abvsame" id="abvsame" />
                <span>Tick if the address and zip code same as above Primary Information.</span>
                
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
    <!-- start: TEXT FIELDS PANEL -->
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Emergency <span class="text-bold">Contact</span></h4>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact Person <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="emergency_contact_person" placeholder="" id="form-field-13" class="form-control input-sm" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact No <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="emergency_contact_number" id="emergency_contact_number" placeholder="" id="form-field-13" class="form-control input-sm" required>
                        <span id="emergency_contact_number_err"></span>
                    </div>
                </div>
            </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
 <div class="col-sm-12">
    
    <div class="panel panel-white" style="display: none;">
        <div class="panel-heading">
            <h4 class="panel-title">Course <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Course apply for <span style="color:red;">*</span>
                    </label>
                    <div class="col-sm-9">
                        <select name="module_apply0" id="module_apply0" class="form-control input-sm">
                            <option value="0">Choose course</option>
                            @foreach($courses as $key => $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Other <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
               <!--  <div class="form-group">
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
                </div> -->

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Your experience in flower designing
                    </label>
                    <div class="col-sm-9">
                       <select name="exp_flower_design">
                           <option value="Not at All">Not at All</option>
                           <option value="A Bit">A Bit</option>
                           <option value="Average">Average</option>
                           <option value="Good">Good</option>
                       </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        (Please provide us the details if you have prior experience or previous lesson attended elsewhere or in NSFD)
                    </label>
                    <div class="col-sm-9">
                        <textarea name="exp_detail" rows="2" style="width:100%;"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Enrollment Reason:
                    </label>
                    <div class="col-sm-9">
                        <select name="enrollment_reason">
                            <option value="Interest">Interest</option>
                            <option value="Hobbies">Hobbies</option>
                            <option value="Career">Career</option>
                            <option value="Company Send">Company Send</option>
                            <option value="Self-Upgrading">Self-Upgrading</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-12">                   
                        <b>Please tell us from where & how you get to know our school?</b>
                    </div>  
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       1. Internet Site
                    </label>
                    <div class="col-sm-9">
                        <select name="internet_site">
                            <option value="Google">Google</option>
                            <option value="Yahoo">Yahoo</option>
                            <option value="Yellow pages">Yellow pages</option>
                            <option value="General Site">General Site</option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       2. News Paper & Directory
                    </label>
                    <div class="col-sm-9">
                        <select name="news_directory">
                            <option value="Strait-Time">Strait-Time</option>
                            <option value="Today">Today</option>
                            <option value="Morning">Morning</option>
                            <option value="Evening">Evening</option>
                            <option value="Yellow Pages">Yellow Pages</option>
                        </select>
                    </div>
                </div>
             
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       3. Magazine
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="magazine" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Friends or Company
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="friend_company" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Others
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="others" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
             
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>



   <!--  <div class="panel panel-white">

        <div class="panel-heading">
            <h4 class="panel-title">Other <span class="text-bold"></span></h4>
        </div>
        <div class="panel-body">
            
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

    </div> --><!-- .panel-white -->


    <!-- Start Examination -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Examination Information <span class="text-bold"></span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group" style="margin-bottom:30px;">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Examination Require? 
                </label>
                <div class="col-sm-9">
                    <select name="exam_require" id="exam_require" class="form-control input-sm">
                        <option value="No">No</option> 
                        <option value="Yes">Yes</option>                       
                    </select>
                </div>
            </div>

            
            <div class="row" style="margin-left:0px;margin-right:0px;">

            <div class="col-md-2">

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">                    
                    </div>                  
                </div>


                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Data/Time : 
                    </label>  
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Duration : 
                    </label>
                    </div>                    
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        1st Assessor Name : 
                    </label> 
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        2nd Assessor Name : 
                    </label>
                    </div>                   
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Result : 
                    </label> 
                    </div>                   
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:70px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Remarks : 
                    </label>  
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Scores : 
                    </label>  
                    </div>                  
                </div>

            </div><!-- /span -->


            <div class="col-md-4">            	
                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <b>Final Exam</b>
                    </div>                  
                </div>

                <div class="form-group">	                
	                <div class="col-sm-9">
	                    <input type="text" name="final_exam_date" id="final_exam_date" class="form-control input-sm" disabled>
	                </div>
	            </div>

	            <div class="form-group">
	                
	                <div class="col-sm-9">
	                    <input type="number" name="final_exam_duration" id="final_exam_duration" class="form-control input-sm" disabled>
	                </div>
	            </div>

	            <div class="form-group">
	               
	                <div class="col-sm-9">
	                    <input type="text" name="final_ass_name1" id="final_ass_name1" class="form-control input-sm" disabled>
	                </div>
	            </div>

	            <div class="form-group">
	                
	                <div class="col-sm-9">
	                    <input type="text" name="final_ass_name2" id="final_ass_name2" class="form-control input-sm" disabled> 
	                </div>
	            </div>

	            <div class="form-group">
	                
	                <div class="col-sm-9">
	                    <input type="number" name="final_exam_result" id="final_exam_result" class="form-control input-sm" disabled>
	                </div>
	            </div>

	            <div class="form-group">
	                
	                <div class="col-sm-9">
	                    <textarea class="form-control input-sm" name="final_exam_remark" id="final_exam_remark" disabled></textarea>
	                </div>
	            </div>

                <div class="form-group">
                    
                    <div class="col-sm-9">
                        <input type="text" name="final_exam_scores" id="final_exam_scores" class="form-control input-sm" disabled>
                    </div>
                </div>


            </div><!-- /span -->

            <div class="col-md-4">

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">
                    <b>Re-Test</b>
                    </div>                  
                </div>


                <div class="form-group">                    
                    <div class="col-sm-9">
                        <input type="text" name="retest_exam_date" id="retest_exam_date" class="form-control input-sm" disabled>
                    </div>
                </div>

                <div class="form-group">                    
                    <div class="col-sm-9">
                        <input type="number" name="retest_exam_duration" id="retest_exam_duration" class="form-control input-sm" disabled>
                    </div>
                </div>

                <div class="form-group">                    
                    <div class="col-sm-9">
                        <input type="text" name="retest_ass_name1" id="retest_ass_name1" class="form-control input-sm" disabled>
                    </div>
                </div>


                <div class="form-group">                    
                    <div class="col-sm-9">
                        <input type="text" name="retest_ass_name2" id="retest_ass_name2" class="form-control input-sm" disabled>
                    </div>
                </div>

            
                <div class="form-group">                    
                    <div class="col-sm-9">
                        <input type="number" name="retest_exam_result" id="retest_exam_result" class="form-control input-sm" disabled>
                    </div>
                </div>

                <div class="form-group">                    
                    <div class="col-sm-9">
                        <textarea class="form-control input-sm" name="retest_exam_remark" id="retest_exam_remark" disabled></textarea>
                    </div>
                </div>


                <div class="form-group">
                    
                    <div class="col-sm-9">
                        <input type="text" name="retest_exam_scores" id="retest_exam_scores" class="form-control input-sm" disabled>
                    </div>
                </div>


            </div><!-- /span -->

        </div><!-- .row -->


        </div>
    </div><!-- .panel-white -->

    <!-- End Examination -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Course <span class="text-bold"></span>
                <span class="pull-right text-danger"><i class="glyphicon glyphicon-remove"></i></span>
            </h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course apply for <span style="color:red;">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="module_apply" id="module_apply" class="form-control input-sm">
                        <option value="0">Choose course</option>
                        @foreach($courses as $key => $course)
                            <option value="{{$course->id}}">{{$course->course_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date Of Registration
                </label>
                <div class="col-sm-9">
                    <input type="text" name="date_of_registration" placeholder="yyyy-mm-dd" id="date_of_registration" class="date-picker form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date Of Commencement
                </label>
                <div class="col-sm-9">
                    <input type="text" name="date_of_commencement" placeholder="yyyy-mm-dd" id="date_of_commencement" class="date-picker form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date Of Actual Completion
                </label>
                <div class="col-sm-9">
                    <input type="text" name="date_of_completion" placeholder="yyyy-mm-dd" id="date_of_completion" class="date-picker form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Payment Mode <span style="color:red;">*</span>
                </label>
                <div class="col-sm-9">
                    <select name="payment_mode" id="payment_mode" class="form-control input-sm">
                        <option value="0">Choose payment mode</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Direct Payment">Direct Payment</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date Of Payment
                </label>
                <div class="col-sm-9">
                    <input type="text" name="date_of_payment" placeholder="yyyy-mm-dd" id="date_of_payment" class="form-control input-sm date-picker">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Invoice Number
                </label>
                <div class="col-sm-9">
                    <input type="text" name="invoice_number" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div> 

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Receipt Number
                </label>
                <div class="col-sm-9">
                    <input type="text" name="receipt_number" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Payment Receive By
                </label>
                <div class="col-sm-9">
                    <select name="payment_receive_by" class="form-control">
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}"> {{ $admin->show_id }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

           <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Payment Note
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control input-sm" name="payment_note"></textarea>
                </div>
            </div>
        </div>
    </div>

    </div>

</div>
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" id="std_createbtn" value="Create" onClick="return validateCreateFormForStd()">
        <a href="{{ URL::to('students') }}"><input type="button" class="btn btn-warning" value="Back"></a>
    </div>
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
    

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalfrm">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="info@noblemanschool.com.sg">
    <input type="hidden" name="item_name" value="Registration Fee">
    <input type="hidden" name="amount" value="100">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="currency_code" value="SGD">
    <input type="hidden" name="return" value="http://noblemanweb.stag-innov8te.com/paypal_success.php?status=1">
    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." id="paybut">
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" id="paybut">
</form>
    
    <script>
    $(document).ready(function(){

        /* Checking paypal */      
        /* $(document).on('click', '#std_createbtn', function(){
            alert('click!');

            document.getElementById('paypalfrm').submit();


            return false;

        });*/

        /****************************************************/

        $('body').on('keyup', '#email', function(e){   
          var email = $('#email').val();
          var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

          if (!re.test(email))
          {
              $("#email_err").html("Please enter a valid email address.").show();
              return false;
          }else{
              $("#email_err").html("Please enter a valid email address.").hide();
          }
           
          if(email.length === 0){
              $("#email_err").html("This field is required.").show();
              return false;
          }else{
              $("#email_err").html("This field is required.").hide();
          }
        });


        /****************************************************************/

        $('body').on('keyup', '#company_email', function(e){   
          var company_email = $('#company_email').val();
          var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

          if (!re.test(company_email))
          {
              $("#company_email_err").html("Please enter a valid email address.").show();
              return false;
          }else{
              $("#company_email_err").html("Please enter a valid email address.").hide();
          }
           
          if(company_email.length === 0){
              $("#company_email_err").html("This field is required.").show();
              return false;
          }else{
              $("#company_email_err").html("This field is required.").hide();
          }
        });

        /****************************************************************/

         $('body').on('keyup', '#mobile_contact', function(e){
           
            //if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            if(e.which > 57 && e.which != 61){
                $('#mobile_contact').val('');
                $("#mobile_contact_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var mobile_contact = $('#mobile_contact').val();

            if(mobile_contact.length === 0){
                $("#mobile_contact_err").html("This field is required.").show();
                return false;
            }else{
                $("#mobile_contact_err").html("This field is required.").hide();
            }

            if(mobile_contact.length < 8){
                $("#mobile_contact_err").html("Please enter at least 8 digits.").show();
                return false;
            }

        });

        /****************************************************************/

        $('body').on('keyup', '#residential_contact', function(e){
           
            //if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            if(e.which > 57 && e.which != 61){
                $('#residential_contact').val('');
                $("#residential_contact_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var residential_contact = $('#residential_contact').val();

            if(residential_contact.length === 0){
                $("#residential_contact_err").html("This field is required.").show();
                return false;
            }else{
                $("#residential_contact_err").html("This field is required.").hide();
            }

            if(residential_contact.length < 8){
                $("#residential_contact_err").html("Please enter at least 8 digits.").show();
                return false;
            }

        });

        /****************************************************************/


        $('body').on('keyup', '#postal_code', function(e){
            
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $('#postal_code').val('');
                $("#postal_code_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var postal_code = $('#postal_code').val();

            if(postal_code.length === 0){
                $("#postal_code_err").html("This field is required.").show();
                return false;
            }else{
                $("#postal_code_err").html("This field is required.").hide();
            }

            if(postal_code.length < 6){
                $("#postal_code_err").html("Please enter at least 6 digits.").show();
                return false;
            }

        });

        /****************************************************************/

        $('body').on('keyup', '#company_postalcode', function(e){
            
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $('#company_postalcode').val('');
                $("#company_postalcode_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var company_postalcode = $('#company_postalcode').val();

            if(company_postalcode.length === 0){
                $("#company_postalcode_err").html("This field is required.").show();
                return false;
            }else{
                $("#company_postalcode_err").html("This field is required.").hide();
            }

            if(company_postalcode.length < 6){
                $("#company_postalcode_err").html("Please enter at least 6 digits.").show();
                return false;
            }

        });


        /****************************************************************/

        $('body').on('keyup', '#oversea_contact', function(e){        

            //if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            if(e.which > 57 && e.which != 61){
                $('#oversea_contact').val('');
                $("#oversea_contact_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var oversea_contact = $('#oversea_contact').val();

            if(oversea_contact.length === 0){
                $("#oversea_contact_err").html("This field is required.").show();
                return false;
            }else{
                $("#oversea_contact_err").html("This field is required.").hide();
            }

            if(oversea_contact.length < 6){
                $("#oversea_contact_err").html("Please enter at least 6 digits.").show();
                return false;
            }

        });

        /****************************************************************/

        $("#education").change(function () {
            var edu = $(this).val();
            if(edu == 'Others'){
              $("#eduothers_field").fadeIn('300');
            }else{
              $("#eduothers_field").fadeOut('300');
            }
        });


        /****************************************************************/

        $('body').on('keyup', '#emergency_contact_number', function(e){        

            //if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            if(e.which > 57 && e.which != 61){
                $('#emergency_contact_number').val('');
                $("#emergency_contact_number_err").html("You will need to enter whole numbers!").show();
                return false;
            }

            var emergency_contact_number = $('#emergency_contact_number').val();

            if(emergency_contact_number.length === 0){
                $("#emergency_contact_number_err").html("This field is required.").show();
                return false;
            }else{
                $("#emergency_contact_number_err").html("This field is required.").hide();
            }

            if(emergency_contact_number.length < 6){
                $("#emergency_contact_number_err").html("Please enter at least 6 digits.").show();
                return false;
            }

        });


        /****************************************************************/

});// End
        
/****************************************************************/

        jQuery(document).ready(function() {

            var date = new Date();
            date.setDate(date.getDate()+1);


            $('#date_of_payment').datepicker({
                format: "yyyy-mm-dd",
                // daysOfWeekDisabled: "0,1",
                //startDate: date,
                todayHighlight: true
            });

            $('#final_exam_date').datepicker({
                format: "yyyy-mm-dd",
                // daysOfWeekDisabled: "0,1",
                //startDate: date,
                todayHighlight: true
            });

            $('#retest_exam_date').datepicker({
                format: "yyyy-mm-dd",
                // daysOfWeekDisabled: "0,1",
                //startDate: date,
            });
            $('#date_of_payment').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true
            });

            $('.date-picker').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true
            });

            Main.init();
            SVExamples.init();
            FormElements.init();
            $("#otherform").hide();
            

/****************************************************************/



        });


		$("#education").change(function(){
			if ($("#education").val() == "Others")
			{
				$("#otherform").show();
			}
            else
                $("#otherform").hide();
		});
		$(".nationality").change(function(){
			if ($(".nationality").val() == "Singaporen")
			{
				$(".ocform").show();
			}
            else
                $(".ocform").hide();
		});
        $("#syes").click(function(){
            $("#cihide").fadeIn('300');
        });
        $("#sno").click(function()
        {
            $("#cihide").fadeOut('300');
            $("#overseafrm").fadeOut('300');
        });
        $('input:radio[name="sponsor"][value="Yes"]').prop('checked', true);


        $("#foreign_std_yes").click(function(){
            $("#overseafrm").fadeIn('300');
        });
        $("#foreign_std_no").click(function()
        {
            $("#overseafrm").fadeOut('300');
        });
        $('input:radio[name="foreign_std"][value="Yes"]').prop('checked', true);




        /* For DOB */
        function changeAge(form)
        {
            var year = document.getElementById("year").value;    
            
            var d = new Date();
            var current_year = d.getFullYear(); 
            //var current_year = document.getElementById("current_year").value;

            var age = current_year -year;
            document.getElementById("age").value = age;
        }


        /***************************************************/

        /* check the nationality */
        function checkNationality()
        {
          var nat = document.getElementById('nationality').value;
          if (nat == 'Singaporean') {
            document.getElementById("foreign_std_no").checked = true;
          }else{
            document.getElementById("foreign_std_yes").checked = true;
          }

        }



       /* function checkPaypal()
        {
            alert('check paypal');
        }*/



        jQuery("#exam_require").change(function(){
            var choose = document.getElementById('exam_require').value;

            if (choose == 'Yes') {
                $("input#final_exam_date").prop("disabled", false);
                $("input#final_exam_duration").prop("disabled", false);
                $("input#final_ass_name1").prop("disabled", false);
                $("input#final_ass_name2").prop("disabled", false);
                $("input#final_exam_result").prop("disabled", false);
                $("textarea#final_exam_remark").prop("disabled", false);
                $("input#final_exam_scores").prop("disabled", false);

                $("input#retest_exam_date").prop("disabled", false);
                $("input#retest_exam_duration").prop("disabled", false);
                $("input#retest_ass_name1").prop("disabled", false);
                $("input#retest_ass_name2").prop("disabled", false);
                $("input#retest_exam_result").prop("disabled", false);
                $("textarea#retest_exam_remark").prop("disabled", false);
                $("input#retest_exam_scores").prop("disabled", false);

            }else{
                $("input#final_exam_date").prop("disabled", true);
                $("input#final_exam_duration").prop("disabled", true);
                $("input#final_ass_name1").prop("disabled", true);
                $("input#final_ass_name2").prop("disabled", true);
                $("input#final_exam_result").prop("disabled", true);
                $("textarea#final_exam_remark").prop("disabled", true);
                $("input#final_exam_scores").prop("disabled", true);

                $("input#retest_exam_date").prop("disabled", true);
                $("input#retest_exam_duration").prop("disabled", true);
                $("input#retest_ass_name1").prop("disabled", true);
                $("input#retest_ass_name2").prop("disabled", true);
                $("input#retest_exam_result").prop("disabled", true);
                $("textarea#retest_exam_remark").prop("disabled", true);
                $("input#retest_exam_scores").prop("disabled", true);

            }

            
        });


        /*******************************************/

        /*jQuery("#std_createbtn").submit(function(){
            alert('submit');
            return false;
        });*/


        function validateCreateFormForStd()
        {
            var std_name = document.forms["createstdfrm"]["name"].value;
            var nric = document.forms["createstdfrm"]["nric"].value;
            var mobile_contact = document.forms["createstdfrm"]["mobile_contact"].value;

            var email = document.forms["createstdfrm"]["email"].value;
            var local_address = document.forms["createstdfrm"]["local_address"].value;

            if (std_name == null || std_name == "") {
                alert('Please enter the student name!');
                document.forms["createstdfrm"]["name"].focus();
                return false;
            }

            if (nric == null || nric == "") {
                alert('Please enter the nric!');
                document.forms["createstdfrm"]["nric"].focus();
                return false;
            }

            if (mobile_contact == null || mobile_contact == "") {
                alert('Please enter the mobile number!');
                document.forms["createstdfrm"]["mobile_contact"].focus();
                return false;
            }

            if (email == null || email == "") {
                alert('Please enter the email!');
                document.forms["createstdfrm"]["email"].focus();
                return false;
            }

            if (local_address == null || local_address == "") {
                alert('Please enter the local address!');
                document.forms["createstdfrm"]["local_address"].focus();
                return false;
            }


                var sponsor_company = $("input:radio[name=sponsor]:checked").val();
                var foreign_std = $("input:radio[name=foreign_std]:checked").val();

                if (sponsor_company == 'Yes') {
                  var company_name = document.forms["createstdfrm"]["company_name"].value;
                  var contact_person = document.forms["createstdfrm"]["contact_person"].value;

                  if (company_name == null || company_name == "") {
                    alert('Please enter the company name!');
                    document.forms["createstdfrm"]["company_name"].focus();
                    return false;                
                  }

                  if (contact_person == null || contact_person == "") {
                    alert('Please enter the contact person!');
                    document.forms["createstdfrm"]["contact_person"].focus();
                    return false; 
                  }
                
                }//end if

                /* if (foreign_std == 'Yes') {                
                    var oversea_contact = document.forms["createstdfrm"]["oversea_contact"].value;
                    
                    if (oversea_contact == null || oversea_contact == "") {
                        alert('Please enter the oversea contact!');
                        document.forms["createstdfrm"]["oversea_contact"].focus();
                        return false;
                    }
                }*///end if


                var e = document.getElementById("module_apply");
                var module_apply = e.options[e.selectedIndex].value;

                if (module_apply == 0) {
                    alert('Please choose for module apply!');
                    return false;
                }


                var e1 = document.getElementById("payment_mode");
                var payment_mode = e1.options[e1.selectedIndex].value;

                if (payment_mode == 0) {
                    alert('Please choose for payment mode!');
                    return false;
                }
            
        }//end


        /***************************************/

        $('#abvsame').on('change', function() { 
            if (this.checked) {
                var address = $('.apartment_name').val();
                var zipcode = $('.postal_code').val();
                var countrycode = $('.country_code').val();
                var mobile_contact = $('.mobile_contact').val();
                var oversea_contact = countrycode + ' ' + mobile_contact;

                $('.oversea_address').val(address);
                $('.oversea_zipcode').val(zipcode);
                $('.oversea_contact').val(oversea_contact);
            }else{
                $('.oversea_address').val('');
                $('.oversea_zipcode').val('');
                $('.oversea_contact').val('');
            }
        });

    </script>
@stop