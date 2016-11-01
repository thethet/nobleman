@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Course <span class="text-bold">List</span> <!-- <a class="btn-s btn-primary" href="{{ URL::to('students/create') }}"><i class="fa fa-plus white"></i></a> --></h3>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Duration Of Course</th>
                        <th>No Of Lesson</th>
                        <th>Attendance</th>
                        <th>Status</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
				@foreach ($studentcourse as $key => $studentcourses)
                    <tr>
                        	<td>{{courseentry::where('id','=',$studentcourses->course_id)->pluck('course_name')}}</td>
                            <td>{{courseentry::where('id','=',$studentcourses -> course_id)->pluck('duration_of_course')}}</td>
                            <td>{{courseentry::where('id','=',$studentcourses -> course_id)->pluck('no_of_lesson')}}</td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">{{count(appointmententry::where('student_id','=',$studentcourses->student_id)->where('course_id','=',$studentcourses->course_id)->where('attend','=','1')->get())}} / {{courseentry::where('id','=',$studentcourses -> course_id)->pluck('no_of_lesson')}}</span></td>
                            <td>
								@if ($studentcourses->status == 1)
                          	      <span class="label label-info"> Active</span>
                                @else
                               	 <span class="label label-default"> Inactive</span>
                                @endif
							</td>
                            <!-- <td>
                                <a class="btn btn-info" href="{{ URL::to('students/listattendance/'.$studentcourses->course_id) }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </td>-->
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
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js') }}
{{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}

<script>
    jQuery('#sample_1').DataTable( {
        responsive: true
    } );
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