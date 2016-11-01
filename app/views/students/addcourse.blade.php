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
    <div class="col-lg-8">
{{ Form::open(array('url'=>'students/'.$student->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
            <div class="panel panel-white">
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
                <img src="http://localhost/app/uploads/{{ $student->profile_picture }}" width="200px" height="200px">
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
                I/C or Passport No.
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="nric" value="{{ $student->nric }}" placeholder="" id="form-field-13" class="form-control input-sm">
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
                <select disabled class="col-sm-4" name="year">
                    <?php
                    for ( $n = 2015; $n >= 1960; $n--)
                    {
                    ?>
                    <option @if ($student->doby == $n) selected @endif value="{{ $n }}">{{ $n }}</option>
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
                Mobile Contact
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="mobile_contact" value="{{ $student->mobile_contact }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Residential Contact
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="residential_contact" value="{{ $student->residential_contact }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                E-mail
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="email" value="{{ $student->email }}" placeholder="" id="form-field-13" class="form-control input-sm">
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
                Apartment name
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="apartment_name" value="{{ $student->apartment_name }}" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Postal Code
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="postal_code" value="{{ $student->postal_code }}" placeholder="" id="form-field-13" class="form-control input-sm">
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
                <input disabled type="text" id="otherform" placeholder="Enter other education" class="form-control">
            </div>
        </div>
        <div class="form-group sponsor">
            <label class="col-sm-2 control-label" for="form-field-13">
                Sponsor by Company
            </label>
            <div class="col-sm-8">
                @if($student->sponsorship == '0')
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

<div class="panel panel-white" id="cihide">
    <div class="panel-heading">
        <h4 class="panel-title">Company <span class="text-bold">Information</span></h4>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Company Name
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Contact Person
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_relationship" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Designation
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Postal Code
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Contact No:
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Fax No
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Email
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Website
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="panel panel-white ocform">
    <div class="panel-heading">
        <h4 class="panel-title">Overseas Contact & <span class="text-bold">Mailing Address</span></h4>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Address
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Zip Code
            </label>
            <div class="col-sm-5">
                <input disabled type="text" name="next_to_kin_relationship" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Overseas Contact
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
            </div>
        </div>

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
                    <input disabled type="text" name="emergency_contact_number" value="{{ $student->emergency_contact_number }}" placeholder="" id="form-field-13" class="form-control input-sm">
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
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    ID*
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="show_id" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Login Email
                </label>
                <div class="col-sm-9">
                    <input disabled type="email" name="login_email" placeholder="" id="form-field-13" class="form-control input-sm">
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


        <!-- end: TEXT FIELDS PANEL -->
    </div>
 </div>
        </div>
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
        });
    </script>
@stop