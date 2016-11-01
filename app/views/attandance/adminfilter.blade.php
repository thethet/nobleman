@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <!-- {{ HTML::style("assets/css/datepicker.css") }} -->

    <style type="text/stylesheet">
    input#filterdate[type="text"]{
	    border-radius: 5px !important;
	    height: 34px !important;
	    padding: 5px !important;
	    width: 160px !important;
	}
    </style>
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->

        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Attendance <span class="text-bold">List</span>

                    <div class="mig-wrap" style="float:right;padding-right:30px;">
			        {{ Form::open(array('url'=>'attendance/filterexport','method'=>'post')) }}
			        <input type="hidden" name="getfromdate" id="getfromdate" value="{{$from_date}}" />
                    <input type="hidden" name="gettodate" id="gettodate" value="{{$to_date}}" />
                    <input type="hidden" name="gettrainerid" id="gettrainerid" value="{{$trainer_id}}" />
                    <input type="hidden" name="getmoduleid" id="getmoduleid" value="{{$module_id}}" />
			        <button type="submit" class="btn btn-primary" style="float:left;margin-right:3px;">Export</button>
			        {{ Form::close() }}
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
                     <div class="col-sm-4" style="margin-top:5px;">
                        <label>From</label>
                        <input type="text" name="fromdate" placeholder="" id="filterdate" class="input-sm" value="{{ $from_date }}">
                    </div>

                    <div class="col-sm-3" style="margin-left:-15px;margin-top:5px;">
                        <label>To</label>
                        <input type="text" name="todate" placeholder="" id="filterdate" class="input-sm" value="{{ $to_date }}">
                    </div>

                    <div class="col-sm-2" style="padding-left:10px;margin-top:5px;">
                        <label></label>
                        <select class="col-sm-12 input-sm" name="trainer">
                                <option value="0">Choose trainer</option>
                            @foreach($trainers as $trainer)
                                @if($trainer_id == $trainer->user_id)
                                    <option value="{{$trainer->user_id}}" selected>{{$trainer->trainer_name}}</option>
                                @else
                                    <option value="{{$trainer->user_id}}">{{$trainer->trainer_name}}</option>
                                @endIf
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2" style="padding-left:10px;margin-top:5px;">
                        <label></label>
                        <select class="col-sm-12 input-sm" name="module">
                            <option value="0">Choose course</option>
                            @foreach($courses as $course)
                                @if($course->id == $module_id)
                                    <option value="{{$course->id}}" selected>{{$course->course_name}}</option>
                                @else
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endIf
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-green btn-sm">Filter</button>
	            </div>
	            {{ Form::close() }}
	        </div>


                <!--<div class="form-group">
                    <label class="col-sm-1 control-label" for="form-field-13">
                        Date
                    </label>
                    <div class="col-sm-2">
                        <input type="text" name="date" placeholder="Click here to pick a date" id="datepicker1" class="form-control input-sm">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="form-field-13">
                        Session :
                    </label>
                    <div class="col-sm-2">
                        <select class="col-sm-4" name="hour">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div><input type="submit" class="btn btn-primary" value="Search">
                </div> -->
                <table class="display" id="sample_1">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Course Name</th>
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
                            <td>{{studententry::where('id','=',$appointments->student_id)->pluck('name')}}</td>
                            <td>{{coursesentry::where('id','=',$appointments->course_id)->pluck('course_name')}}</td>
                            <td>{{$appointments->session}}</td>
                            <td>{{$appointments->date}}</td>
                            <!-- <td>
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
            var date = new Date();
            date.setDate(date.getDate());
            $('#datepicker1,#filterdate').datepicker({
                format: "yyyy-mm-dd",
                /*daysOfWeekDisabled: "0,1",
                endDate: date,*/
                todayHighlight: true
            });

            /*******************************/

            $('#sample_1').dataTable()
                   /* .columnFilter({ 	sPlaceHolder: "head:before",
                        aoColumns: [ 	{ type: "text" },
                            { type: "date-range"  },
                            { type: "select" },
                            { type: "select" },
                        ]

                    });*/

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
