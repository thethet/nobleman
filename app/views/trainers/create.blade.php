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
{{ Form::open(array('url'=>'trainers/create','method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>'true')) }}
<div class="col-sm-6">
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
            <h4 class="panel-title">Trainers <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Name*
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="name" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="contact" id="contact" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="trainer_contact_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        NRIC
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="nric" id="nric" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="trainer_email_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" placeholder="" id="form-field-13" class="form-control input-sm">
                        <span id="trainer_email_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Photos
                    </label>
                    <div class="col-sm-9">
                        <input type="file" name="profile_picture" id="profile_picture" placeholder="" id="form-field-13" >
                        <span id="trainer_email_err"></span>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Date Of Birth
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="date_of_birth" id="date_of_birth" placeholder="" id="form-field-14" class="form-control input-sm date-picker">
                        <span id="trainer_email_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Joining Date
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="joining_date" id="joining_date" placeholder="" id="form-field-15" class="form-control input-sm date-picker">
                        <span id="trainer_email_err"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control input-sm" name="address"></textarea>
                        <span id="trainer_email_err"></span>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Trainer Note
                    </label>
                    <div class="col-sm-9">
                        <textarea class="form-control input-sm" name="trainer_note"></textarea>
                        <span id="trainer_email_err"></span>
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
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
    <div class="col-sm-12">
        <div class="panel panel-white">
            <div class="panel-body right padding">
                <input type="submit" class="btn btn-primary" value="Create">
                <a href="{{ URL::to('trainers') }}"><input type="button" class="btn btn-warning" value="Back"></a>
            </div>
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
    
    
    <script>
        jQuery(document).ready(function() {

        $('body').on('keyup', '#email', function(e){   
          var email = $('#email').val();
          var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

          if (!re.test(email))
          {
              $("#trainer_email_err").html("Please enter a valid email address.").show();
              return false;
          }else{
              $("#trainer_email_err").html("Please enter a valid email address.").hide();
          }
           
          if(email.length === 0){
              $("#trainer_email_err").html("This field is required.").show();
              return false;
          }else{
              $("#trainer_email_err").html("This field is required.").hide();
          }
        });
        

        /***************************************************************/

            $('body').on('keyup', '#contact', function(e){
            
           /* if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $('#contact').val('');
                $("#trainer_contact_err").html("You will need to enter whole numbers!").show();
                return false;
            }
*/
            var contact = $('#contact').val();

            if(contact.length === 0){
                $("#trainer_contact_err").html("This field is required.").show();
                return false;
            }else{
                $("#trainer_contact_err").html("This field is required.").hide();
            }

            if(contact.length < 6){
                $("#trainer_contact_err").html("Please enter at least 6 digits.").show();
                return false;
            }

        });
           

        $('.date-picker').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true
        });

        /****************************************************************/

        Main.init();
        SVExamples.init();
        FormElements.init();


        });
    </script>
@stop