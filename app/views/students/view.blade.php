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
    <div class="col-lg-8">
    {{ Form::open(array('url'=>'students/'.$student->id,'method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>'true')) }}
            <div class="panel panel-white">
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
    <div class="panel-heading">
        <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Profile Picture
            </label>
            <div class="col-sm-9">
            @if($student->profile_picture == '')
                <img src="{{url()}}/uploads/default-img-200x200.png" width="200px" height="200px">
            @else            
                <img src="{{url()}}/uploads/{{ $student->profile_picture }}" width="200px" height="200px">
            @endif
                <p></p>
                <button id="change_profile"> Change Profile</button>
            </div>
        </div> 
        <div class="form-group" id="uploadImage" style="display: none">
            <label class="col-sm-2 control-label" for="form-field-13">
                Upload Image 
            </label>
            <div class="col-sm-9">
                <input type="hidden" name="changeProfile" value="0" />
                {{ Form::file('chooseImage',['disabled'=>'disabled']) }}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Name 
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="name" value="{{ $student->name }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Student Id.
            </label>
            <div class="col-sm-9">
                <input readonly type="text" name="nric" value="{{ $student->nobleman_student_id }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                I/C or Passport No.
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="nric" value="{{ $student->nric }}" placeholder="" id="form-field-13" class="form-control input-sm">
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
                Gender*
            </label>
            <div class="col-sm-9">
                @if( $student->gender == "Male" )
                <label class="radio-inline">
                    <input disabled type="radio" class=" contributor-gender" value="Female" name="gender" >
                    Female
                </label>
                <label class="radio-inline">
                    <input disabled type="radio" class=" contributor-gender" value="Male" name="gender" checked>
                    Male
                </label>
                @else
                    <label class="radio-inline">
                        <input disabled type="radio" class=" contributor-gender" value="Female" name="gender" checked>
                        Female
                    </label>
                    <label class="radio-inline">
                        <input disabled type="radio" class=" contributor-gender" value="Male" name="gender">
                        Male
                    </label>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Nationality
            </label>
            <div class="col-sm-9">
                <select disabled name="nationality" class="form-control input-sm search-select nationality">
                    @foreach ($countries as $key=>$value)
                        <option @if($value->country_name == "Singapore") selected @endif value="{{ $value->nationality }}">{{ $value->nationality }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Date of Birth{{$student->dob}}
            </label>
            <div class="col-sm-9">
                <select disabled class="col-sm-4" name="day">
                    <?php
                    for ( $n = 1; $n <= 31; $n++)
                    {
                    if( $n < 10)
                    {
                    ?>
                    <option @if($student->dobd == $n) selected @endif value="0{{ $n }}">0{{ $n }}</option>
                    <?php
                    }
                    else
                    {
                    ?>
                    <option @if($student->dobd == $n) selected @endif value="{{ $n }}">{{ $n }}</option>
                    <?php
                    }
                    }
                    ?>
                </select>
                <select disabled class="col-sm-4" name="month">
                    <option @if($student->dobm == "01") selected @endif value="01">January</option>
                    <option @if($student->dobm == "02") selected @endif value="02">February</option>
                    <option @if($student->dobm == "03") selected @endif value="03">March</option>
                    <option @if($student->dobm == "04") selected @endif value="04">April</option>
                    <option @if($student->dobm == "05") selected @endif value="05">May</option>
                    <option @if($student->dobm == "06") selected @endif value="06">June</option>
                    <option @if($student->dobm == "07") selected @endif value="07">July</option>
                    <option @if($student->dobm == "08") selected @endif value="08">August</option>
                    <option @if($student->dobm == "09") selected @endif value="09">September</option>
                    <option @if($student->dobm == "10") selected @endif value="10">October</option>
                    <option @if($student->dobm == "11") selected @endif value="11">November</option>
                    <option @if($student->dobm == "12") selected @endif value="12">December</option>
                </select>               


                <select disabled class="col-sm-4" id="year" name="year" onchange="return changeAge(this);">
                        <?php
                        $startdate = 1960;
                        $current_year = date("Y");
                        $years = range ($startdate,$current_year);
                        ?>
                        <div id="current_year" value="{{$current_year}}" hidden="hidden">{{$current_year}}</div>
                            <?php                                
                                foreach($years as $year)
                                {
                                ?>
                                <option @if ($student->doby == $year) selected @endif value="{{ $year }}">{{ $year }}</option>
                                <?php
                                }
                                ?>
                </select>


            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Age
            </label>
            <div class="col-sm-9">
                <input type="text" name="age" id="age" readonly="readonly" class="form-control input-sm" value="{{ $student->age }}">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Race
            </label>
            <div class="col-sm-9">
                <select disabled name="race" class="form-control input-sm search-select">
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
                Mobile Number
            </label>
            
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-2">
                        <input disabled type="text" name="country_code" id="form-field-13" value="{{ $student->country_code }}" class="form-control input-sm country_code" placeholder="+65">
                    </div>
                    <div class="col-sm-10">
                        <input disabled type="text" name="mobile_contact" id="mobile_contact" value="{{ $student->mobile_contact }}" placeholder="" id="form-field-13" class="form-control input-sm mobile_contact" required>
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
                <input disabled type="text" name="residential_contact" id="residential_contact" value="{{ $student->residential_contact }}" placeholder="" id="form-field-13" class="form-control input-sm">
                <span id="residential_contact_err"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                E-mail
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="email" id="email" value="{{ $student->email }}" placeholder="" id="form-field-13" class="form-control input-sm">
                <span id="email_err"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Password
            </label>
            <div class="col-sm-9">
                <input disabled type="password" name="password" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Confirm Password
            </label>
            <div class="col-sm-9">
                <input disabled type="password" name="confirm_password" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Local Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="local_address" value="{{ $student->local_address }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Unit No
            </label>
            <div class="col-sm-9">
                <div class="col-sm-1">#</div>
                <div class="col-sm-4"><input disabled type="text" name="unitno1" class="form-control"></div>
                <div class="col-sm-1">-</div>
                <div class="col-sm-4"><input disabled type="text" name="unitno2"  class="form-control"></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Street name
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="street_name" value="{{ $student->street_name }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Residential Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="apartment_name" value="{{ $student->apartment_name }}" placeholder="" id="form-field-13" class="form-control input-sm apartment_name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Postal Code
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="postal_code" id="postal_code" value="{{ $student->postal_code }}" placeholder="" id="form-field-13" class="form-control input-sm postal_code">
                <span id="postal_code_err"></span>  
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Occupation
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="occupation" value="{{ $student->occupation }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Intro Lesson 
            </label>
            <div class="col-sm-8">
                <label class="radio-inline">
                    <input type="radio" class=" contributor-gender" value="Yes" name="introlesson" @if($student->intro_lesson == 'Yes') checked @endif>
                    Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" class=" contributor-gender" value="No" name="introlesson" @if($student->intro_lesson == 'No') checked @endif>
                    No
                </label>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Job related to florist
            </label>
            <div class="col-sm-8">
                @if($student->floral_related == '0')
                    <label class="radio-inline">
                        <input disabled type="radio" class=" contributor-gender" value="Yes" name="floral_related">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input checked disabled type="radio" class=" contributor-gender" value="No" name="floral_related">
                        No
                    </label>
                @else
                    <label class="radio-inline">
                        <input checked disabled type="radio" class=" contributor-gender" value="Yes" name="floral_related">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input disabled type="radio" class=" contributor-gender" value="No" name="floral_related">
                        No
                    </label>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Education
            </label>
            <div class="col-sm-9">
                <select disabled name="education" id="education" class="form-control input-sm">
                    <option value="University">University</option>
                    <option value="College">College</option>
                    <option value="Diploma">Diploma</option>
                    <option value="A-Level">A-Level</option>
                    <option value="O-Level">O-Level</option>
                    <option value="ITE">ITE</option>
                    <option value="Others">Others</option>
                </select>
                <!-- <input disabled type="text" id="otherform" placeholder="Enter other education" class="form-control"> -->
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
                @if($student->sponsorship == 'No')
                    <label class="radio-inline">
                        <input disabled type="radio" class="contributor-gender" value="Yes" onclick="gaga();" name="sponsor" id="syes">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input checked disabled type="radio" class="contributor-gender" value="No" name="sponsor" id="sno">
                        No
                    </label>
                @else
                    <label class="radio-inline">
                        <input checked disabled type="radio" class="contributor-gender" value="Yes" onclick="gaga();" name="sponsor" id="syes">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input disabled type="radio" class="contributor-gender" value="No" name="sponsor" id="sno">
                        No
                    </label>
                @endif
            </div>
        </div>
    </div>
</div>

@if($student->sponsorship == 'No')
<div class="panel panel-white" id="cihide" style="display:none;">
@else
<div class="panel panel-white" id="cihide">
@endif
    <div class="panel-heading">
        <h4 class="panel-title">Company <span class="text-bold">Information</span></h4>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Company Name
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_name" value="{{ $student->company_name }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Contact Person
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="contact_person" value="{{ $student->contact_person }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Designation
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="designation" value="{{ $student->designation }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_address" value="{{ $student->company_address }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Postal Code
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_postalcode" id="company_postalcode" value="{{ $student->company_postalcode }}" placeholder="" id="form-field-13" class="form-control input-sm">
                <span id="company_postalcode_err"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Contact No:
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_contact_no" value="{{ $student->company_contact_no }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Fax No
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_fax" value="{{ $student->company_fax }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Email
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_email" id="company_email" value="{{ $student->company_email }}" placeholder="" id="form-field-13" class="form-control input-sm">
                <span id="company_email_err"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Website
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="company_website" value="{{ $student->company_website }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group sponsor">
            <label class="col-sm-2 control-label" for="form-field-13">
                Foreign Student
            </label>
            <div class="col-sm-8">
                @if($student->foreign_student == 'No')
                    <label class="radio-inline">
                        <input disabled type="radio" class="contributor-gender" value="Yes" onclick="gaga();" name="foreign_std" id="foreign_std_yes">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input checked disabled type="radio" class="contributor-gender" value="No" name="foreign_std" id="foreign_std_no">
                        No
                    </label>
                @else
                    <label class="radio-inline">
                        <input checked disabled type="radio" class="contributor-gender" value="Yes" onclick="gaga();" name="foreign_std" id="foreign_std_yes">
                        Yes
                    </label>
                    <label class="radio-inline">
                        <input disabled type="radio" class="contributor-gender" value="No" name="foreign_std" id="foreign_std_no">
                        No
                    </label>
                @endif
            </div>
        </div>


    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>

@if($student->foreign_student == 'No')
<div class="panel panel-white ocform" id="overseafrm" style="display:none;">
@else
<div class="panel panel-white ocform" id="overseafrm">
@endif

    <div class="panel-heading">
        <h4 class="panel-title">Overseas Contact & <span class="text-bold">Mailing Address</span></h4>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="oversea_address" value="{{ $student->oversea_address }}" placeholder="" id="form-field-13" class="form-control input-sm oversea_address">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Zip Code
            </label>
            <div class="col-sm-5">
                <input disabled type="text" name="oversea_zipcode" value="{{ $student->oversea_zipcode }}" placeholder="" id="form-field-13" class="form-control input-sm oversea_zipcode">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Overseas Contact
            </label>
            <div class="col-sm-9">            
                <input disabled type="text" id="oversea_contact" name="oversea_contact" value="{{ $student->oversea_contact }}" placeholder="" id="form-field-13" class="form-control input-sm oversea_contact">
                <span id="oversea_contact_err"></span>
            </div>
        </div>

        <input type="checkbox" name="abvsame" value="abvsame" id="abvsame" />
        <span>Tick if the address and zip code same as above Primary Information.</span>

    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>

    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Emergency <span class="text-bold">Contact</span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Contact Person
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="emergency_contact_person" value="{{ $student->emergency_contact_person }}" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Contact No
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="emergency_contact_number" id="emergency_contact_number" value="{{ $student->emergency_contact_number }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    <span id="emergency_contact_number_err"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->


    <!-- end: TEXT FIELDS PANEL -->

    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Other <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Password
                </label>
                <div class="col-sm-9">
                    <input disabled type="password" name="password" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Confirm Password
                </label>
                <div class="col-sm-9">
                    <input disabled type="password" name="confirm_password" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div> -->

            <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Your experience in flower designing
                    </label>
                    <div class="col-sm-9">

                       <select disabled name="exp_flower_design" class="form-control input-sm">                    
                           <option @if($student->exp_flower_design == "Not at All") selected @endif value="Not at All">Not at All</option>
                           <option @if($student->exp_flower_design == "A Bit") selected @endif value="A Bit">A Bit</option>
                           <option @if($student->exp_flower_design == "Average") selected @endif value="Average">Average</option>
                           <option @if($student->exp_flower_design == "Good") selected @endif value="Good">Good</option>
                       </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        (Please provide us the details if you have prior experience or previous lesson attended elsewhere or in NSFD)
                    </label>
                    <div class="col-sm-9">
                        <textarea disabled name="exp_detail" rows="2" style="width:100%;" class="form-control input-sm">{{ $student->exp_detail }}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Enrollment Reason:
                    </label>
                    <div class="col-sm-9">
                        <select disabled name="enrollment_reason" class="form-control input-sm">
                            <option @if($student->enrollment_reason == "Interest") selected @endif value="Interest">Interest</option>
                            <option @if($student->enrollment_reason == "Hobbies") selected @endif value="Hobbies">Hobbies</option>
                            <option @if($student->enrollment_reason == "Career") selected @endif value="Career">Career</option>
                            <option @if($student->enrollment_reason == "Company Send") selected @endif value="Company Send">Company Send</option>
                            <option @if($student->enrollment_reason == "Self-Upgrading") selected @endif value="Self-Upgrading">Self-Upgrading</option>
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
                        <select disabled name="internet_site" class="form-control input-sm">
                            <option @if($student->internet_site == "Google") selected @endif value="Google">Google</option>
                            <option @if($student->internet_site == "Yahoo") selected @endif value="Yahoo">Yahoo</option>
                            <option @if($student->internet_site == "Yellow pages") selected @endif value="Yellow pages">Yellow pages</option>
                            <option @if($student->internet_site == "General Site") selected @endif value="General Site">General Site</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       2. News Paper & Directory
                    </label>
                    <div class="col-sm-9">
                        <select disabled name="news_directory" class="form-control input-sm">
                            <option @if($student->news_directory == "Strait-Time") selected @endif value="Strait-Time">Strait-Time</option>
                            <option @if($student->news_directory == "Today") selected @endif value="Today">Today</option>
                            <option @if($student->news_directory == "æ—©æŠ¥") selected @endif value="æ—©æŠ¥">æ—©æŠ¥</option>
                            <option @if($student->news_directory == "æ™šæŠ¥") selected @endif value="æ™šæŠ¥">æ™šæŠ¥</option>
                            <option @if($student->news_directory == "Yellow Pages") selected @endif value="Yellow Pages">Yellow Pages</option>
                        </select>
                    </div>
                </div>
             
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       3. Magazine
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="magazine" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $student->magazine }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Friends or Company
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="friend_company" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $student->friend_company }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Others
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="others" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $student->others }}">
                    </div>
                </div>


        <!-- end: TEXT FIELDS PANEL -->
    </div>
    </div>

    <!-- <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Other <span class="text-bold"></span></h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Invoice Number
                </label>
                <div class="col-sm-9">
                    <input type="text" name="invoice_number" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $student->invoice_number }}">
                </div>
            </div>

           
             <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Receipt Number
                </label>
                <div class="col-sm-9">
                    <input type="text" name="receipt_number" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $student->receipt_number }}">
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Payment Receive By
                </label>
                <div class="col-sm-9">
                    <select name="payment_receive_by" class="form-control">
                        @foreach($admins as $admin)
                            @if($admin->id == $student->payment_receive_by)
                                <option value="{{ $admin->id }}" selected> {{ $admin->show_id }} </option>
                            @else
                                <option value="{{ $admin->id }}"> {{ $admin->show_id }} </option>              
                            @endIf
                        @endforeach
                    </select>
                </div>
            </div>

               
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Payment Note
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control input-sm" name="payment_note">{{ $student->payment_note }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Password
                </label>
                <div class="col-sm-9">
                    <input disabled type="password" name="password" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Confirm Password
                </label>
                <div class="col-sm-9">
                    <input disabled type="password" name="confirm_password" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

        </div>
    </div> -->


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
                    <select name="exam_require" id="exam_require" class="form-control input-sm" disabled>
                        <option @if($student->exam_require == "No") selected @endif value="No">No</option>
                        <option @if($student->exam_require == "Yes") selected @endif value="Yes">Yes</option>                       
                   </select>
                </div>
            </div>
            
            <div class="row" style="margin-left:0px;margin-right:0px;">

            <div class="col-md-4">

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;">                    
                    </div>                  
                </div>


                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Data/Time : 
                    </label>  
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Duration : 
                    </label>
                    </div>                    
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        1st Assessor Name : 
                    </label> 
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        2nd Assessor Name : 
                    </label>
                    </div>                   
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Result : 
                    </label> 
                    </div>                   
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:70px;padding-left: 0px;padding-right: 0px;">
                    <label class="col-sm-12 control-label" for="form-field-13">
                        Examination Remarks : 
                    </label>  
                    </div>                  
                </div>

                <div class="form-group">
                    <div class="col-sm-9" style="height:30px;padding-left: 0px;padding-right: 0px;">
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
                            <input type="text" name="final_exam_date" id="final_exam_date" class="form-control input-sm" value="{{ $student->final_exam_date }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <input type="number" name="final_exam_duration" id="final_exam_duration" class="form-control input-sm" value="{{ $student->final_exam_duration }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                       
                        <div class="col-sm-9">
                            <input type="text" name="final_ass_name1" id="final_ass_name1" class="form-control input-sm" value="{{ $student->final_ass_name1 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <input type="text" name="final_ass_name2" id="final_ass_name2" class="form-control input-sm" value="{{ $student->final_ass_name2 }}" disabled> 
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <input type="number" name="final_exam_result" id="final_exam_result" class="form-control input-sm"  value="{{ $student->    final_exam_result }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <textarea class="form-control input-sm" name="final_exam_remark" id="final_exam_remark" disabled>{{ $student->    final_exam_remark }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <input type="text" name="final_exam_scores" id="final_exam_scores" class="form-control input-sm" value="{{ $student->    final_exam_scores }}" disabled>
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
                            <input type="text" name="retest_exam_date" id="retest_exam_date" class="form-control input-sm" value="{{ $student->    retest_exam_date }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">                    
                        <div class="col-sm-9">
                            <input type="number" name="retest_exam_duration" id="retest_exam_duration" class="form-control input-sm" value="{{ $student->    retest_exam_duration }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">                    
                        <div class="col-sm-9">
                            <input type="text" name="retest_ass_name1" id="retest_ass_name1" class="form-control input-sm" value="{{ $student->    retest_ass_name1 }}" disabled>
                        </div>
                    </div>


                    <div class="form-group">                    
                        <div class="col-sm-9">
                            <input type="text" name="retest_ass_name2" id="retest_ass_name2" class="form-control input-sm" value="{{ $student->    retest_ass_name2 }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">                    
                        <div class="col-sm-9">
                            <input type="number" name="retest_exam_result" id="retest_exam_result" class="form-control input-sm" value="{{ $student->    retest_exam_result }}" disabled>
                        </div>
                    </div>

                    <div class="form-group">                    
                        <div class="col-sm-9">
                            <textarea class="form-control input-sm" name="retest_exam_remark" id="retest_exam_remark" disabled>{{ $student->        retest_exam_remark }}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        
                        <div class="col-sm-9">
                            <input type="text" name="retest_exam_scores" id="retest_exam_scores" class="form-control input-sm" value="{{ $student->    retest_exam_scores }}" disabled>
                        </div>
                    </div>
                </div><!-- /span -->

            </div><!-- .row -->
        </div>
    </div><!-- .panel-white -->

    <!-- End Examination -->


 </div>
<!-- col-lg-8 end  -->
        
    <div class="panel panel-white col-lg-2">
        <div class="panel-body padding">
            <input type="button" class="btn btn-info" value="Edit" id="edit">
            <input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
            <a href="{{ URL::to('students') }}"><input type="button" class="btn btn-warning" value="Back"></a>
        </div>
    </div>
    <div class="clear"></div>
    {{ Form::hidden('id',$student->id) }}
    {{ Form::close() }}

    <div class="col-lg-8">
        <div class="panel panel-white">
           
            <div class="panel-heading">
                <h4 class="panel-title">Students' Course <span class="text-bold"></span>
                    <a class="btn btn-default pull-right" data-toggle="modal" href='#modal-id'>Add More Course</a>  
                </h4>
            </div>

            <div class="panel-body">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                    @foreach($studentcourses as $index => $studentcourse)
                        <div class="panel-heading" role="tab" id="{{ $studentcourse->id}}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $studentcourse->id }}" aria-expanded="true" aria-controls="collapseOne">
                                    Course {{ $index + 1}} 
                                </a>
                                {{ Form::open(array('url'=>"students/$studentcourse->student_id/delete-module/$studentcourse->course_id",'method'=>'DELETE','role'=>'form','class' => 'pull-right ')) }}
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                {{ Form::close() }}
                            </h4>
                        </div>
                        {{ Form::open(array('url'=>"students/$studentcourse->student_id/update-module/$studentcourse->course_id",'method'=>'PATCH','role'=>'form','class'=>'form-horizontal','files'=>'true')) }}                        
                            <div id="collapse{{ $studentcourse->id }}" class="panel-collapse collapse {{ $index == 0 ? 'in' : '' }}" role="tabpanel" aria-labelledby="{{ $studentcourse->id}}">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Course apply for <span style="color:red;">*</span>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="module_apply" id="module_apply" class="form-control input-sm">
                                                <option value="0">Choose course</option>
                                                @foreach($courses as $key => $course)
                                                    @if($course->id == $studentcourse->course_id )
                                                        <option value="{{$course->id}}" selected>{{$course->course_name}}</option>
                                                    @else
                                                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                    @endIf
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Date Of Registration
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date_of_registration" placeholder="yyyy-mm-dd" id="date_of_registration" class="date-picker form-control input-sm" @if($studentcourse->date_of_registration == '0000-00-00') value="" @else value="{{ $studentcourse->date_of_registration }}" @endif>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Date Of Commencement
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date_of_commencement" placeholder="yyyy-mm-dd" id="date_of_commencement" class="date-picker form-control input-sm" @if($studentcourse->date_of_commencement == '0000-00-00') value="" @else value="{{ $studentcourse->date_of_commencement }}" @endif>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Date Of Actual Completion
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date_of_completion" placeholder="yyyy-mm-dd" id="date_of_completion" class="date-picker form-control input-sm" @if($studentcourse->date_of_completion == '0000-00-00') value="" @else value="{{ $studentcourse->date_of_completion }}" @endif>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Payment Mode <span style="color:red;">*</span>
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="payment_mode" class="form-control input-sm">
                                                <option value="0">Choose payment mode</option>
                                                <option value="Paypal" {{ $studentcourse->payment_mode == 'Paypal' ? 'selected' : '' }} >Paypal</option>
                                                <option value="Bank Transfer" {{ $studentcourse->payment_mode == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                                <option value="Direct Payment" {{ $studentcourse->payment_mode == 'Direct Payment' ? 'selected' : '' }}>Direct Payment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Date Of Payment
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date_of_payment" placeholder="yyyy-mm-dd" id="date_of_payment" class="form-control input-sm date-picker" @if($studentcourse->date_of_payment == '0000-00-00') value="" @else value="{{ $studentcourse->date_of_payment }}" @endif>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Invoice Number
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="invoice_number" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $studentcourse->invoice_number }}">
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Receipt Number
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="receipt_number" placeholder="" id="form-field-13" class="form-control input-sm" value="{{ $studentcourse->receipt_number }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Payment Receive By
                                        </label>
                                        <div class="col-sm-9">
                                            <select name="payment_receive_by" class="form-control">
                                                @foreach($admins as $admin)
                                                    <option value="{{ $admin->id }}" {{ $admin->id == $studentcourse->payment_receive_by ? 'selected': '' }}> {{ $admin->show_id }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                   <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                            Payment Note
                                        </label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control input-sm" name="payment_note">{{ $studentcourse->payment_note }}</textarea>
                                        </div>
                                    </div>
                                   <div class="form-group">
                                        <label class="col-sm-2 control-label" for="form-field-13">
                                        </label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="submit">Update</button>
                                        </div>
                                    </div> 
                                    <br/>                                   
                                </div>
                            </div>
                        {{ Form::close() }}
                    @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div> 
       
</div>

    <style type="text/css">
        .datepicker{z-index:1151 !important;}
    </style>
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Sign Up Course</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url'=>"/students/$student->id/sing-up-module",'method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>'true')) }}

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Course apply for <span style="color:red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name="module_apply" id="module_apply" class="form-control input-sm">
                                <option value="0">Choose module</option>
                                @foreach($courses as $key => $course)
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Date Of Registration
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="date_of_registration" placeholder="yyyy-mm-dd" id="date_of_registration" class="date-picker form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Date Of Commencement
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="date_of_commencement" placeholder="yyyy-mm-dd" id="date_of_commencement" class="date-picker form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Date Of Actual Completion
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="date_of_completion" placeholder="yyyy-mm-dd" id="date_of_completion" class="date-picker form-control input-sm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Payment Mode <span style="color:red;">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name="payment_mode" class="form-control input-sm">
                                <option value="0">Choose payment mode</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="Direct Payment">Direct Payment</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Date Of Payment
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="date_of_payment" placeholder="yyyy-mm-dd" id="date_of_payment" class="form-control input-sm date-picker">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Invoice Number
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="invoice_number" placeholder="" id="form-field-13" class="form-control input-sm">
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Receipt Number
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="receipt_number" placeholder="" id="form-field-13" class="form-control input-sm">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-13">
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
                        <label class="col-sm-3 control-label" for="form-field-13">
                            Payment Note
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control input-sm" name="payment_note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {{ Form::close() }}


    
 </div>
        
    </div>  

    
                     
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

    $(document).ready(function(){

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
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
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
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
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
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
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

        /****************************************************************/

        $('body').on('keyup', '#emergency_contact_number', function(e){        

            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
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

    });
        
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
                todayHighlight: true
            });

            $('.date-picker').datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true 
            });

            Main.init();
            SVExamples.init();
            FormElements.init();
            @if($student->sponsorship == '0')
                $("#cihide").hide();
            @else
                $("#cihide").show();
            @endif
        });
		jQuery("#edit").click(function(){
			$("#edit").hide();
			$("#save").show();
			$("body input").prop("disabled", false);
			$("body select").prop("disabled", false);
            $("body textarea").prop("disabled", false);


                $("#exam_require").prop("disabled", false);

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

        $("#foreign_std_yes").click(function(){

            $("#overseafrm").fadeIn('300');
        });
        $("#foreign_std_no").click(function()
        {
            $("#overseafrm").fadeOut('300');
        });


    jQuery(document).ready(function() {
        var date = new Date();
        date.setDate(date.getDate()+1);
        $('#date').datepicker({
            format: "mm/dd/yyyy",
            daysOfWeekDisabled: "0,1",
            startDate: date,
            todayHighlight: true
        });
    });

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

        $('#change_profile').click(function(e){
            e.preventDefault();
            var changeProfile = $('input[name="changeProfile"]').val();
            if(changeProfile == 0){
                $('#uploadImage').show();
                $(this).text('Not Change Profile')                
            }
            else
            {
                $(this).text('Change Profile')
                $('#uploadImage').hide();                
            }
            $('input[name="changeProfile"]').val(changeProfile == 0 ? 1 : 0);
        });  
        $('.submit').click(function(){
            $(this).closest('form').submit();
        })



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