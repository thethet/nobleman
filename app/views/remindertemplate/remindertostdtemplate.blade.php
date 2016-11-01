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

    {{ HTML::style("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css") }}
    {{ HTML::style("assets/css/editor/froala_editor.css") }}
    {{ HTML::style("assets/css/editor/froala_style.css") }}
    {{ HTML::style("assets/css/editor/code_view.css") }}
    {{ HTML::style("assets/css/editor/image_manager.css") }}
    {{ HTML::style("assets/css/editor/image.css") }}
    {{ HTML::style("assets/css/editor/table.css") }}
    {{ HTML::style("assets/css/editor/video.css") }}
    {{ HTML::style("assets/css/editor/codemirror.min.css") }}

    <style type="text/css">
        .fr-box.fr-basic .fr-element{
            min-height: 430px;
        }
    </style>

@stop

@section('content')
{{ Form::open(array('url'=>'remindertostudents-template','method'=>'post','role'=>'form','class'=>'form-horizontal','files'=>'true','name'=>'temstdfrm')) }}
<div class="col-sm-12">
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Reminder To Student Template</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Email Content
                </label>
                <div class="col-sm-9">
                    <textarea id='edit' style="margin-top: 30px;" name="email_content" required>{{$template_content}}</textarea>
                </div>
            </div>
        </div>

<!-- end: TEXT FIELDS PANEL -->
 </div>

 
</div>
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
</div>
</div>
{{ Form::close() }}
@stop

@section ('scripts')

<!-- {{ HTML::script("https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js") }} -->
{{ HTML::script("https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js") }}
{{ HTML::script("https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js") }}
{{ HTML::script("assets/js/editor/froala_editor.min.js") }}
{{ HTML::script("assets/js/editor/align.min.js") }}
{{ HTML::script("assets/js/editor/code_beautifier.min.js") }}
{{ HTML::script("assets/js/editor/code_view.min.js") }}
{{ HTML::script("assets/js/editor/draggable.min.js") }}
{{ HTML::script("assets/js/editor/image.min.js") }}
{{ HTML::script("assets/js/editor/image_manager.min.js") }}
{{ HTML::script("assets/js/editor/link.min.js") }}
{{ HTML::script("assets/js/editor/lists.min.js") }}
{{ HTML::script("assets/js/editor/paragraph_format.min.js") }}
{{ HTML::script("assets/js/editor/paragraph_style.min.js") }}
{{ HTML::script("assets/js/editor/table.min.js") }}
{{ HTML::script("assets/js/editor/video.min.js") }}
{{ HTML::script("assets/js/editor/url.min.js") }}
{{ HTML::script("assets/js/editor/entities.min.js") }}
<script>

    $(function(){
        $('#edit')
          .on('froalaEditor.initialized', function (e, editor) {
            $('#edit').parents('form').on('submit', function () {
              console.log($('#edit').val());
              return true;
            })
          })
          .froalaEditor({enter: $.FroalaEditor.ENTER_P, placeholderText: null})
    });
</script>
@stop