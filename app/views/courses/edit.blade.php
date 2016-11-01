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
{{ Form::open(array('url'=>'courses','method'=>'get','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-12">

    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Course<span class="text-bold"> Flower Arrangement</span></h4>
        </div>
        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
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
                    <input type="text" name="name" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$courses->product_code}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course Name
                </label>
                <div class="col-sm-9">
                    <input type="text" name="name" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$courses->course_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Cost of Course ($SGD)
                </label>
                <div class="col-sm-9">
                    <input type="text" name="nric" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$courses->cost_of_course}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Duration of Course (Hours)
                </label>
                <div class="col-sm-9">
                    <select class="col-sm-4" name="hour">
                        <?php
                        for ( $n = 0; $n <= 20 ; $n++)
                        {
                        ?>
                        <option @if ($n == 9) selected @endif value="{{ $n }}">{{ $n }}</option>
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

                    <select class="col-sm-4" name="no_of_lesson">
                        <?php
                        for ( $n = 0; $n <= 10 ; $n++)
                        {
                        ?>
                        <option @if ($n == 9) selected @endif value="{{ $n }}">{{ $n }}</option>
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
                        for ( $n = 1; $n <= 3 ; $n++)
                        {
                        ?>
                        <option value="{{ $n }}">{{ $n }}</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="panel panel-white">
            <div class="panel-body right padding">
                <input type="submit" class="btn btn-primary" value="Edit">
                <a href="{{ URL::previous() }}"><input type="button" class="btn btn-warning" value="Back"></a>
            </div>
        </div>
        <!-- end: TEXT FIELDS PANEL -->
    </div>

    <!-- end: TEXT FIELDS PANEL -->
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