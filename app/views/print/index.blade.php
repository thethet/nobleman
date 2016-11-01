@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
{{ HTML::style("assets/css/custom-style.css") }}
@stop

@section('content')
<div class="col-md-12">

    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Print Schedule </h3>
        </div>
        <div class="panel-body">

        <div class="form-group ptxt">
            <div class="col-sm-1" style="margin-top:5px;">
                <label>Date</label>
            </div>
            {{ Form::open(array('url'=>'print/show','method'=>'post')) }}
            <div class="col-sm-2" style="padding:0px;">
                <input type="text" name="prdate" placeholder="To" id="prdate" class="form-control input-sm">
            </div><button type="submit" class="btn btn-red">Show</button>

            {{ Form::close() }}
        </div>

        <div style="margin-top:10px;margin-bottom:10px;">
        {{ Form::open(array('url'=>'print/downloadall','method'=>'post')) }}
        <!-- <a href="{{ URL::to('/print/download') }}">Download</a> -->
        <button type="submit" class="btn btn-red">Download</button>
        {{ Form::close() }}
        </div>

         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Course Name</th>
                        <th>Session</th>
                        <th>Date</th>
                        <!-- <th>Lesson</th> -->
                    </tr>
                </thead>
                <tbody>

                    @foreach($appointments as $key=> $appointments)
                        <tr>
                            <td>{{studententry::where('id','=',$appointments->student_id)->pluck('name')}}</td>
                            <td>{{CoursesEntry::where('id','=',$appointments->course_id)->pluck('course_name')}}</td>
                            <td>{{$appointments->session}}</td>
                            <td>{{$appointments->date}}</td>

                        </tr>
                    @endforeach

                    </tbody>

            </table>


        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->

</div>

@stop

@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js') }}
{{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}


<script>
var no = 0;
$(".formdel").submit(function(ev) {
	if (no == 0)
	{
		var id = $(this).attr('id');
		Boxy.confirm("Are you sure?", function() { no = 1; $("#"+id).submit(); }, {title: 'Confirm'});
		return false;
	}
});

jQuery(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate()+1);
    $('#prdate').datepicker({
        format: "yyyy-mm-dd",
        //daysOfWeekDisabled: "0,1",
        //startDate: date,
        todayHighlight: true
    });
});


</script>
@stop
