@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Appointment <span class="text-bold">List</span></h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Duration Of Course</th>
                        <th>No Of Lesson</th>
                        <th>Booking</th>
                        <th>Attendance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               <tbody>
                        @foreach($studentcourse as $key => $studentcourseval)
                            <tr>
                                <td>{{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('course_code')}}</td>
                                <td>{{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('course_name')}}</td>
                                <td>{{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('duration_of_course')}}</td>
                                <td>{{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('no_of_lesson')}}</td>
                                <td><span class="label label-warning" style="float:left;margin-right:10px">{{DB::table('appointment')->where('student_id','=',$studentcourseval->student_id)->where('course_id','=',$studentcourseval->course_id)->where('booking_status','=','book')->count()}} / {{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('no_of_lesson')}}</span></td>
                                <td><span class="label label-warning" style="float:left;margin-right:10px">{{DB::table('appointment')->where('student_id','=',$studentcourseval->student_id)->where('course_id','=',$studentcourseval->course_id)->where('attend','=','1')->count()}} / {{coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('no_of_lesson')}}</span></td>
                                <td>
                                    @if(DB::table('appointment')->where('student_id','=',$studentcourseval->student_id)->where('course_id','=',$studentcourseval->course_id)->where('booking_status','=','book')->count() <= coursesentry::where('id','=',$studentcourseval -> course_id)->pluck('no_of_lesson'))
                                    <a class="btn btn-info" href="{{ URL::to('appointment/'.$studentcourseval->course_id) }}">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    @else

                                    @endif

                                </td>
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

</script>
@stop
