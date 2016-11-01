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
{{ Form::open(array('url'=>'courses/'.$courses->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
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
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Type
                </label>
                <div class="col-sm-9">
                    <select name="course_type" disabled>
                        <option value="Full Course" @if($courses->course_type == 'Full Course') selected @endif>Full Course</option>
                        <option value="Individual Course" @if($courses->course_type == 'Individual Course') selected @endif>Individual Course</option>
                        <option value="Trial" @if($courses->course_type == 'Individual Course') selected @endif>Trial</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Code
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="course_code" placeholder="" value="{{$courses->course_code}}" id="form-field-13" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Name
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="course_name" placeholder="" id="form-field-13" value="{{$courses->course_name}}" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Cost of Course ($SGD)
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="cost_of_course" id="cost_of_course" placeholder="" id="form-field-13" value="{{$courses->cost_of_course}}" class="form-control input-sm" required>
                    <span id="cost_of_module_err"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Duration of Course (Days)
                </label>
                <div class="col-sm-9">
                    <select disabled class="col-sm-4" name="duration_of_course">
                        <?php
                        for ( $n = 0; $n <= 20 ; $n++)
                        {
                        ?>
                        <option @if ($n == $courses->duration_of_course) selected @endif value="{{ $n }}">{{ $n }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    No. of Lesson
                </label>
                <div class="col-sm-9">

                    <select disabled class="col-sm-4" name="no_of_lesson">
                        <?php
                        for ( $n = 0; $n <= 10 ; $n++)
                        {
                        ?>
                        <option @if ($n == $courses->no_of_lesson) selected @endif value="{{ $n }}">{{ $n }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
	    
	    <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    No. of Hours Per Lesson
                </label>
                <div class="col-sm-9">

                    <select disabled class="col-sm-4" name="no_hours_per_lesson">
                        <?php
                        for ( $n = 1; $n <= 3 ; $n++)
                        {
                        ?>
                        <option @if ($n == $courses->no_hours_per_lesson) selected @endif value="{{ $n }}">{{ $n }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- end: TEXT FIELDS PANEL -->
    </div>
    <!-- end: TEXT FIELDS PANEL -->

    <div class="panel panel-white" id="cihide">
    <div class="panel-heading">
        <h4 class="panel-title">Certificate <span class="text-bold">Template</span></h4>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Certification Name
            </label>
            <div class="col-sm-9">
                <input disabled type="text" name="certname" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$certificate->name}}" required>
            </div>
        </div>         
       
       <div class="form-group">
            <label class="col-sm-2 control-label" for="form-field-13">
                Certification Code
            </label>

            <div class="col-sm-9">
                <input disabled type="text" name="certid" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$certificate->serial}}" required>
            </div>
        </div>  

        </div><!-- .panel-body -->
    </div><!-- .panel -->


</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
    {{ Form::hidden('id',$courses->id) }}
    {{ Form::close() }}
 
  <div class="col-sm-12">
    
    <div class="panel panel-white">
    	<div class="panel-body right padding">
        	<input type="button" class="btn btn-info" value="Edit" id="edit">
        	<input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
            <a href="{{ URL::to('courses') }}"><input type="button" class="btn btn-warning" value="Back"></a>
        </div>
    </div>
 </div>
</div>
<div class="clear"></div>


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
             // $('body').on('keyup', '#cost_of_module', function(e){
             //    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 190) {
             //        //alert('You will need to enter whole numbers!');
             //        $('#cost_of_module').val('');
             //        $("#cost_of_module_err").html("You will need to enter whole numbers!").show();
             //        return false;
             //    }
             //    var cost_of_module = $('#cost_of_module').val();

             //    if(cost_of_module.length === 0){
             //        $("#cost_of_module_err").html("This field is required.").show();
             //        return false;
             //    }else{
             //        $("#cost_of_module_err").html("This field is required.").hide();
             //    }

            
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
              //$('#cost_of_module_err').text(dInput);


        });

        /*********************************************************************/

            Main.init();
            SVExamples.init();
            FormElements.init();
			
        });
		jQuery("#edit").click(function(){
			$("#edit").hide();
			$("#save").show();
			$("body input").prop("disabled", false);
			$("body select").prop("disabled", false);
		});
    </script>
@stop