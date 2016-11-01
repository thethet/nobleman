@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">

    </div>
    {{ Form::open(array('url'=>'appointment/book','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
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
                    <h4 class="panel-title">Make An<span class="text-bold"> Appointment</span></h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Course
                        </label>
                        <div class="col-sm-3">
                            <select name="course">
                                @foreach($studentcourse as $key => $studentcourses)
                                    @foreach (courseentry::where('id','=',$studentcourses->course_id)->get() as $key => $courses)
                                        <option value="{{ $courses->id }}">{{ $courses->course_name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Date
                        </label>
                        <div class="col-sm-3">
                            <input type="text" name="date" placeholder="     Click here to pick a date" id="datepicker" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                           Session :
                        </label>
                        <div class="col-sm-9">
                            <select class="col-sm-4" name="session">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                            </select>
                        </div>
                    </div>
                    <span style="float:left"><i>Session A: 11am-1pm; Session B: 2-4pm; Session C: 7pm-9pm; Session D: 10am-12pm</i></span>
                </div>
                <!-- end: TEXT FIELDS PANEL -->
            </div>

        <div class="panel panel-white">
            <div class="panel-body right padding">
                <input type="submit" class="btn btn-primary" value="Create">
                <a href="{{ URL::to('appointment') }}"><input type="button" class="btn btn-warning" value="Back"></a>
            </div>
        </div>
    {{ Form::close() }}
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

@stop

@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}

<script>
jQuery(document).ready(function() {
	TableData.init();
});
var no = 0;
$(".formdel").submit(function(ev) {
	if (no == 0)
	{
		var id = $(this).attr('id');
		Boxy.confirm("Are you sure?", function() { no = 1; $("#"+id).submit(); }, {title: 'Confirm'});
		return false;
	}
});
$(document).ready(function () {
        var date = new Date();
        date.setDate(date.getDate()+1);
        $('#datepicker').datepicker({
            format: "dd/mm/yyyy",
            daysOfWeekDisabled: "0,1",
            startDate: date,
            todayHighlight: true
        });

});
</script>
@stop