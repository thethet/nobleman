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
{{ Form::open(array('url'=>'cert/certificates/'.$certificate->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}

<div class="col-sm-12">

    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Certificate<span class="text-bold"> </span></h4>
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
                    Certification Name
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="certname" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$certificate->name}}">
                </div>
            </div>         
           
           <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Certification Code
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="certid" placeholder="" id="form-field-13" class="form-control input-sm" value="{{$certificate->serial}}">
                </div>
            </div>  

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                </label>
                <div class="col-sm-9" style="text-align:right;">
                    <input type="button" class="btn btn-info" value="Edit" id="edit">
                    <input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
                    <a href="{{ URL::to('cert/certificates') }}"><input type="button" class="btn btn-warning" value="Back"></a>
                </div>
            </div>         
        </div>
       
        <!-- end: TEXT FIELDS PANEL -->
    </div>

    <!-- end: TEXT FIELDS PANEL -->
 </div>
 {{ Form::hidden('id',$certificate->id) }}
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

        jQuery("#edit").click(function(){
            $("#edit").hide();
            $("#save").show();
            $("body input").prop("disabled", false);
            $("body select").prop("disabled", false);
        });

    </script>
@stop