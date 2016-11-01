@extends('layouts.main')

@section('styles')

    {{ HTML::style("assets/plugins/select2/select2.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

@stop

@section('content')
{{ Form::open(array('url'=>'announcement/'.$announcement->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
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
            <h4 class="panel-title">Announcement <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Title
                </label>
                <div class="col-sm-9">
                    <input disabled type="text" name="announcement_title" placeholder="" value="{{$announcement->announcement_title}}" id="form-field-13" class="form-control input-sm" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date
                </label>
                <div class="col-sm-3">
                    <input disabled type="text" name="announcement_date" value="{{$announcement->announcement_date}}" id="date" class="form-control input-sm">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Content
                </label>
                <div class="col-sm-9">
                   <textarea disabled name="announcement_content" rows="2" class="form-control input-sm" style="border:1px solid #E6E8E8;">{{$announcement->announcement_content}}</textarea>
                </div>
            </div>

       </div>
        <!-- end: TEXT FIELDS PANEL -->
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
    {{ Form::hidden('id',$announcement->id) }}
    {{ Form::close() }}

  <div class="col-sm-12">

    <div class="panel panel-white">
        <div class="panel-body right padding">
            <input type="button" class="btn btn-info" value="Edit" id="edit">
            <input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
            <a href="{{ URL::to('announcement') }}"><input type="button" class="btn btn-warning" value="Back"></a>
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
    jQuery(document).ready(function() {
            var date = new Date();
            date.setDate(date.getDate());
            $('#date').datepicker({
                format: "yyyy-mm-dd",
                daysOfWeekDisabled: "0,1",
                startDate: date,
                todayHighlight: true
            });
        });

        $(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();

        });




        jQuery("#edit").click(function(){
            $("#edit").hide();
            $("#save").show();
            $("body input").prop("disabled", false);
            $("body select").prop("disabled", false);
            $("body textarea").prop("disabled", false);
        });
    </script>
@stop
