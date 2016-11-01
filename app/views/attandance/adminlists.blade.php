@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/css/custom-style.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <!-- {{ HTML::style("assets/css/datepicker.css") }} -->

@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->

   		<div class="panel panel-white" style="padding-top:30px;">

   				@if (Session::has('message'))
                    <div class="alert alert-info" style="margin-left:15px;margin-right:15px;">
                    <a class="boxclose" id="boxclose"></a>
                    {{ Session::get('message') }}
                    </div>
                @endif
            <div class="panel-heading">
                <h3 class="panel-title">Attendance <span class="text-bold">List</span>
                    <div class="mig-wrap" style="float:right;padding-right:30px;">
                        <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('attendance/export') }}">Export</a>
                    </div>
                </h3>
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

            <div class="form-group ptxt">
	            {{ Form::open(array('url'=>'attendance/datefilter','method'=>'post')) }}
                <div class="row">
                    <div class="col-sm-3" style="margin-top:5px;">
                        <label>From</label>
    	                <input type="text" name="fromdate" placeholder="" id="filterdate" class="input-sm">
    	            </div>

                    <div class="col-sm-3" style="margin-left:-15px;margin-top:5px;">
                        <label>To</label>
                        <input type="text" name="todate" placeholder="" id="filterdate" class="input-sm">
                    </div>

                    <div class="col-sm-2" style="padding-left:10px;margin-top:5px;">
                        <label></label>
                        <select class="col-sm-12 input-sm" name="trainer">
                                <option value="0">Choose trainer</option>
                            @foreach($trainers as $trainer)
                                <option value="{{$trainer->user_id}}">{{$trainer->trainer_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2" style="padding-left:10px;margin-top:5px;">
                        <label></label>
                        <select class="col-sm-12 input-sm" name="module">
                            <option value="0">Choose course</option>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-green btn-sm">Filter</button>
                </div>

	            {{ Form::close() }}
	        </div>

                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Course Name</th>
                        <th>Trainer Name</th>
                        <th>Session</th>
                        <th>Date</th>
                        <!-- <th>Mark Lesson</th> -->
                        <th>Attendance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointment as $key=> $appointments)
                        <tr>
                            {{ Form::open(array('url'=>'trainer/attendance','method'=>'post','id'=>$appointments -> id)) }}
                            <td>{{ studententry::where('id','=',$appointments->student_id)->pluck('name')}}</td>
                            <td>{{ coursesentry::where('id','=',$appointments->course_id)->pluck('course_name')}}</td>
                            <td> {{ TrainersEntry::where('user_id','=',$appointments->trainer_id)->pluck('trainer_name') }}</td>
                            <td>{{$appointments->session}}</td>
                            <td>{{$appointments->date}}</td>
                           <!--  <td>
                                {{lessonsentry::where('id','=',$appointments->lesson_id)->pluck('lesson_name')}}
                            </td>   -->
                            <td>
                            @if($appointments->attend == 1)
                            <span>Attended</span>
                            @elseif($appointments->attend == 'N/A')
                            <span>N/A</span>
                            @else
                            <span>Absent</span>
                            @endif
                            </td>

                            {{ form::close()}}
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
        $(document).ready(function(){
            $('#sample_1').dataTable({
                "order": [[ 4, "desc" ]]
            })
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
            date.setDate(date.getDate());
            $('#datepicker1,#filterdate').datepicker({
                format: "yyyy-mm-dd",
                /*daysOfWeekDisabled: "0,1",
                endDate: date,*/
                todayHighlight: true
            });

        });


        $(function() {
		    $('#boxclose').click(function(){
		        $('.alert').fadeOut('fast');
		    });

		});




    </script>
@stop
