@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Courses <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('courses/create') }}"><i class="fa fa-plus white"></i></a>

            <div class="mig-wrap" style="float:right;padding-right:30px;">
                <a class="btn btn-green" style="float:left;margin-right:3px;" href="#" id="myBtn">Import</a>
                <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('courses/export') }}">Export</a>
            </div>

            </h3>
                

            <!-- /* Choosing the file for import to database */ -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 style="color:black;">Choose file to import</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(array('url'=>'courses/import','method'=>'post','role'=>'form','files'=>'true')) }}
                <div class="form-group">
                  <input type="file" name="importfile" class="form-control input-sm">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-green">Import</button>
                </div>
                {{ Form::close() }}
                </div>
              </div>
            </div>
            </div> 
            <!-- /* End */ -->


        </div>
        <div class="panel-body">
            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course Code</th>
                        <th width="120px;">Course Name </th>
                        <th>Course Type</th>
                        <th width="80px;">Cost of Course ($SGD) </th>
                        <th width="60px;">Duration Of Course</th>
                        <th>No Of Lesson </th>
			            <!-- <th>No of Hours <br /> Per Lesson -->
                        <!-- <th>Status </th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				@foreach ($courses as $key => $course)
                    <tr>
                        	<td>{{$course -> id}}</td>
                            <td>{{$course -> course_code}}</td>
                            <td>{{$course -> course_name}}</td>
                            <td>{{$course -> course_type}}</td>
                            <td>{{$course -> cost_of_course}}</td>
                            <td>{{$course -> duration_of_course}}</td>
                            <td>{{$course -> no_of_lesson}}</td>
			                <!-- <td>{{$course -> no_hours_per_lesson}}</td> -->
                            <!-- <td>
								@if ($course->status == 1)
                          	      <span class="label label-info"> Active</span>
                                @else
                               	 <span class="label label-default"> Inactive</span>
                                @endif
							</td> -->
                        	<td>
                                <a class="btn btn-warning" style="float:left;margin-right:3px;" href="{{ URL::to('courses/download/'.$course->id) }}"><i class="fa fa-download"></i></a>
                                {{ Form::open(array('url'=>'courses','class'=>'formdel','id'=> $course -> id)) }}
                                <a class="btn btn-info" href="{{ URL::to('courses/'.$course->id) }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                {{ Form::hidden('id',$course->id) }}
                                    <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                {{ Form::close() }}
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

$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
}); 

</script>
@stop