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
{{ Form::open(array('url'=>'addmorecourse','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-12">
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
            <h4 class="panel-title">Add More<span class="text-bold"> Course</span></h4>
        </div>

        <div class="panel-heading">
            <h4 class="panel-title">Course Information</h4>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course apply for <span style="color:red;">*</span>
                </label>
                <div class="col-sm-9">
                    <select class="col-sm-12" name="course" id="course"> 
                        <option value="0">Choose course</option>       
                        @foreach($courses as $value)
                            <option value="{{ $value['id'] }}">{{ $value['course_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="module_data_wrapper">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Code
                </label>
                <div class="col-sm-9">
                    <input type="text" readonly name="course_code" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Total Course Fee 
                </label>
                <div class="col-sm-9">
                    <input type="text" readonly name="course_feed" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Total No. of Lesson
                </label>
                <div class="col-sm-9">
                    <input type="text" readonly name="total_no_lessons" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Training Hours
                </label>
                <div class="col-sm-9">
                    <input type="text" readonly name="total_training_hours" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Duration
                </label>
                <div class="col-sm-9">
                    <input type="text" readonly name="course_duration" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>

            </div><!-- .module_data_wrapper -->

            
           
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>

 <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        
        <div class="panel-heading">
            <h4 class="panel-title">Payment</h4>
        </div>

        <div class="panel-body">
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

            <div class="form-group" id="direct_payment" style="margin:50px 15px 15px 15px;display:none;">                
                <div class="col-sm-12">
                    <p>Please kindly make your way down to our school to make payment within 2 days after you registered otherwise your registration will not be considered.</p>

                    <div style="margin-top:25px;margin-bottom:0px;">We are located at: </div> <br />

                    Blk 10, North Bridge Road, #02-5107, <br />
                    Singapore 190 010 <br />
                    Tel: (+65) 6296 3977     Fax: (+65) 6291 3192.<br />

                    
                    <div style="margin-top:25px;margin-bottom:0px;">Our Operating Hours:- </div><br />

                    Monday, Wednesday, Friday                 :           11am - 6pm <br />

                    Tuesday, Thursday                         :           11am - 9pm <br />

                    Saturday                                  :           10am – 12pm <br />

                    Sunday & Public Holiday                   :           Closed <br />
                </div>
            </div>

            <div class="form-group" id="bank_transfer" style="margin:50px 15px 15px 15px;display:none;">                
                <div class="col-sm-12">
                    <p>We will temporary reserve your slots. Kindly transfer your fee (Using FAST if transferring from
different bank) to the <b class="btxt"><u>UOB 145-3011-041</u></b> within 3 days to confirm your slot. Kindly notify us by
email to info@noblemanschool.com.sg upon successful transfer and retain your transaction receipt
for verification purpose.</p>
                </div>
            </div>

           
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>

</div>
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{ URL::to('registercourse') }}"><input type="button" class="btn btn-warning" value="Back"></a>
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
        $(document).ready(function() {
                  
            $('#cost_of_course').on("input", function() {
              var dInput = this.value;
              //console.log(dInput);
              var dot = dInput.indexOf(".");
              var length = dInput.length;
              var mykey = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "."];
              var count = 0;
              while(count<length){
                var chara = dInput.charAt(count);
                var result = mykey.indexOf(chara);
                if(result === -1){
                    dInput = dInput.slice(0, count)+dInput.slice(count+1);
                    length-1;
                    count-1;
                }
                console.log("c : " +chara);
                count++;
              }
              if(dot!==-1){
                    if(parseInt(parseInt(length)-3)===dot){
                        dInput = dInput.slice(0, (dot+2));
                    }else{
                    }
              }
              $("#cost_of_course").val(dInput);
              //$('#cost_of_course_err').text(dInput);
            });

        });

        /*********************************************************************/


        jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
        });
		$("#education").change(function(){
			if ($("#education").val() == "Other")
			{
				$("#otherform").show();
			}
            else
                $("#otherform").hide();
		});

        /********************************************************/

        $('#course').on("change", function() {
            var course_name = $("#course option:selected").text();
            var m = document.getElementById("course");
            var course_id = m.options[m.selectedIndex].value;

            var postData ={'course_name': course_name, 'course_id': course_id}; 

            var l = window.location;
            var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[0];
            var url_link = base_url + "/addmorecourse/moduledataajax";

            $.ajax({
            type: "POST",
            dataType: "json",
            url: url_link,
            data: postData,
            cache: false,
            beforeSend: function(data){
                //alert("send");
            },
            success: function(data)
            {
                $("#module_data_wrapper").html(data.html);  
                //alert("success" + data.html);    
            },
            error: function(data){
                alert("error");
            }
        }); //End ajax

        });

        /********************************************************/

        $('#payment_mode').on("change", function() {
            var payment_mode = $("#payment_mode option:selected").text();
            if (payment_mode == 'Direct Payment') {
                $("#direct_payment").fadeIn('300');
            }else{
                $("#direct_payment").fadeOut('300');
            }

            if (payment_mode == 'Bank Transfer') {
                $("#bank_transfer").fadeIn('300');
            }else{
                $("#bank_transfer").fadeOut('300');
            }

            
        });
  
    </script>
@stop