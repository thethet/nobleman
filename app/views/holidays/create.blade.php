@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    {{ HTML::style("assets/css/custom-style.css") }}

@stop

@section('content')
{{ Form::open(array('url'=>'holiday/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
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
            <h4 class="panel-title">Create New<span class="text-bold"> Holiday</span></h4>
        </div>
        <div class="panel-body">
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Choose Date
                </label>
                <div class="col-sm-2">
                    <input type="text" name="hf_date" placeholder="From" id="hf_date" class="form-control input-sm" required="">                    
                </div>
                <div class="col-sm-2">
                    <input type="text" name="ht_date" placeholder="To" id="ht_date" class="form-control input-sm" required="">                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Name Of Holiday
                </label>
                <div class="col-sm-4">
                    <input type="text" name="holiday_name" id="holiday_name" class="form-control input-sm" required="">
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
        <a href="{{ URL::to('holidays') }}"><input type="button" class="btn btn-warning" value="Back"></a>
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
     
       /* jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
        });
*/

        jQuery(document).ready(function() {
            var date = new Date();
            date.setDate(date.getDate()+1);
            $('#hf_date, #ht_date').datepicker({
                format: "yyyy-mm-dd",
                // daysOfWeekDisabled: "0,1",
                startDate: date,
                todayHighlight: true
            });
        });


		
    </script>
@stop