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
{{ Form::open(array('url'=>'courses/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
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
            <h4 class="panel-title">Create New<span class="text-bold"> Course</span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Type
                </label>
                <div class="col-sm-9">
                    <select name="course_type">
                        <option value="Full Course">Full Course</option>
                        <option value="Individual Course">Individual Course</option>
                        <option value="Trial">Trial</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Code
                </label>
                <div class="col-sm-9">
                    <input type="text" name="course_code" placeholder="" id="form-field-13" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Name
                </label>
                <div class="col-sm-9">
                    <input type="text" name="course_name" placeholder="" id="form-field-13" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Cost of Course ($SGD)
                </label>
                <div class="col-sm-9">
                    <input type="text" name="cost_of_course" id="cost_of_course" placeholder="" id="form-field-13" class="form-control input-sm" required>
                    <span id="cost_of_module_err"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Duration of Course (Days)
                </label>
                <div class="col-sm-9">
			<input type="number" name="duration_of_course" placeholder="" id="form-field-13" class="form-control input-sm" min="0" max="999" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    No. of Lesson
                </label>
                <div class="col-sm-9">

                    <select class="col-sm-4" name="no_of_lesson">
                        <?php
                        for ( $n = 0; $n <= 10 ; $n++)
                        {
                        ?>
                        <option @if ($n == 10) selected @endif value="{{ $n }}">{{ $n }}</option>
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

                    <select class="col-sm-4" name="no_hours_per_lesson">
                        <?php
                        //for ( $n = 1; $n <= 3 ; $n++)
                        //{
                        ?>
                        <!-- <option value="{{ $n }}">{{ $n }}</option> -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <?php
                        //}
                        ?>
                    </select>
                </div>
            </div>
        </div><!-- .panel-body -->


    <!-- end: TEXT FIELDS PANEL -->
 </div><!-- .panel -->


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
            <input type="text" name="certname" placeholder="" id="form-field-13" class="form-control input-sm" required>
        </div>
    </div>         
   
   <div class="form-group">
        <label class="col-sm-2 control-label" for="form-field-13">
            Certification Code
        </label>

        <div class="col-sm-9">
            <input type="text" name="certid" placeholder="" id="form-field-13" class="form-control input-sm" required>
        </div>
    </div>  

    </div><!-- .panel-body -->
</div><!-- .panel -->


 
</div>
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{ URL::to('courses') }}"><input type="button" class="btn btn-warning" value="Back"></a>
    </div>
</div>
</div>
{{ Form::close() }}
@stop

@section ('scripts')
	{{ HTML::script("assets/plugins/jquery-inputlimit
    er/jquery.inputlimiter.1.3.1.min.js") }}
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
              //$('#cost_of_module_err').text(dInput);
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
  
    </script>
@stop