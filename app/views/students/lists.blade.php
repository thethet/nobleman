@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Students <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('students/create') }}"><i class="fa fa-plus white"></i></a>

            <div class="mig-wrap" style="float:right;padding-right:30px;">
                <a class="btn btn-green" style="float:left;margin-right:3px;" href="#" id="myBtn">Import</a>
                <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('students/export') }}">Export</a>
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
                {{ Form::open(array('url'=>'students/import','method'=>'post','role'=>'form','files'=>'true')) }}
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date of birth </th>                        
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Courses</th>
                        <th>Payment Status</th>
                        <th>Account Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				@foreach ($students as $key => $students)
                    <tr>
                        	<td>{{$students -> id}}</td>
                        	<td>{{$students -> name}}</td>
                        	<td>{{$students -> doby}}-{{$students -> dobm}}-{{$students -> dobd}}</td>
                        	<td>{{$students -> email}}</td>
                        	<td>{{$students -> mobile_contact}}</td>
                           
                            <td>{{ DB::table('student_course') 
                                                ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
                                                ->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
                                                ->where('students.id','=',$students->id)
                                                ->pluck('course_name')}}</td>
                            <td>
                                <!-- @if($students->payment_status == 0)
                                NO
                                @else
                                YES
                                @endif -->

                                <?php
                                $payment_status = DB::table('student_course') 
                                                ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
                                                ->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
                                                ->where('students.id','=',$students->id)
                                                ->pluck('student_course.sm_payment_status');
                                if($payment_status == 0){
                                    echo 'NO';
                                }else{
                                    echo 'YES';
                                }
                                ?>                                                    
                            </td>
                            <td>
                                {{ Form::open(array('url'=>'students/changestatus/'.$students->id,'method'=>'put','role'=>'form','class'=>'form-horizontal')) }}
								@if ($students->status == 1)
                          	        <button type="submit" class="label label-info"> Active</button>
                                @else
                                    <button type="submit" class="label label-default"> Inactive</button>
                                @endif
                                {{ Form::close() }}
							</td>
                            <td>
                                <a class="btn btn-warning" style="float:left;margin-right:3px;" href="{{ URL::to('students/download/'.$students->id) }}"><i class="fa fa-download"></i></a>

                                {{ Form::open(array('url'=>'students','class'=>'formdel','id'=>$students -> id)) }}
                                <a class="btn btn-green" href="{{ URL::to('students/'.$students->id) }}"><i class="fa fa-arrow-circle-right"></i></a>
                                <!-- <a class="btn btn-blue" href="{{ URL::to('students/listcourse/'.$students->id) }}"><i class="fa fa-plus"></i></a> -->
                                {{ Form::hidden('id',$students->id) }}
                                @if ($students->id != Auth::user()->id)
                                    <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                @endif
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