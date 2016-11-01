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
{{ Form::open(array('url'=>'module/edit','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-6">

    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Module Code
                </label>
                <div class="col-sm-9">
                    <input type="text" name="module_code" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$module->module_code}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Module Name
                </label>
                <div class="col-sm-9">
                    <input type="text" name="module_name" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$module->module_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Name
                </label>
                <div class="col-sm-9">
                    <select class="col-sm-12" name="course_name">
                        @foreach ($courses as $key => $courses)
                            <option @if($module->course_name==$courses->course_name){{selected}} value="{{ $courses->course_name }}">{{ $courses->course_name }}</option>
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
		$("#education").change(function(){
			if ($("#education").val() == "Other") 
			{
				$("#otherinput").show();
			}
		});
    </script>
@stop