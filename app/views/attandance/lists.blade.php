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
                        <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('trainer/attendance/export') }}">Export</a>
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
	            <div class="col-sm-1" style="margin-top:5px;">
	                <label>Date</label>
	            </div>
	            {{ Form::open(array('url'=>'trainer/attendance-filter','method'=>'post')) }}
	            <div class="col-sm-3" style="padding:0px;">
	                <input type="text" name="filterdate" placeholder="" id="filterdate" class="input-sm">
	            </div><button type="submit" class="btn btn-green">Filter</button>

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
                        <th>Trainer Name</th>
                        <th>Session</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Attendance</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php


                        foreach($trainer_schedule as $key=> $ts_data){
                            /*$t_appointment = AppointmentEntry::where('date','=',$ts_data->date)->where('session','=',$ts_data->session)->where('course_id','=',$ts_data->course_id)->where('trainer_id','=',$ts_data->trainer_id)->where('booking_status','=','book')->get();*/

                            $t_appointment = AppointmentEntry::where('date','=',$ts_data->date)->where('session','=',$ts_data->session)->where('course_id','=',$ts_data->course_id)->where('booking_status','=','book')->get();


                            foreach($t_appointment as $app_data) {
                                //echo $app_data->student_id;
                                echo '<tr>';
                                echo Form::open(array('url'=>'trainer/attendance','method'=>'post','id'=>$app_data -> id));
                                echo '<td>';
                                echo studententry::where('id','=',$app_data->student_id)->pluck('name');
                                echo '</td>';

                                echo '<td>';
                                echo coursesentry::where('id','=',$app_data->course_id)->pluck('course_name');
                                echo '</td>';

                                echo '<td>';
                                echo TrainersEntry::where('id','=',$app_data->trainer_id)->pluck('trainer_name');
                                echo '</td>';

                                echo '<td>';
                                echo $app_data->session;
                                echo '</td>';

                                echo '<td>';
                                echo $app_data->date;
                                echo '</td>';


                                /*echo '<td>';
                                echo '<select name="lesson">';
                                foreach ( lessonsentry::where('module_id','=',$app_data->module_id)->get() as $key => $lessons ){
                                    if ($lessons->id == $app_data->lesson_id) {
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo '<option value="'.$lessons->id.'" '.$selected.'>'.$lessons->lesson_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';*/

                                echo '<td>';
                                echo Form::hidden('id',$app_data->id);
                                echo '<button type="submit" name="attend" class="btn btn-info" value="1"><i class="fa fa-check-square"></i></button>&nbsp;';
                                echo '<button type="submit" name="absence" class="btn btn-danger"><i class="fa fa-times"></i> </button>';
                                echo Form::close();
                                echo '</td>';

                                echo '<td>';
                                if($app_data->attend == 1){
                                    echo '<span>Attended</span>';
                                }elseif($app_data->attend == 'N/A'){
                                    echo '<span>N/A</span>';
                                }else{
                                    echo '<span>Absent</span>';
                                }
                                echo '</td>';



                                echo Form::close();
                                echo '</tr>';
                            }
                        }
                    ?>
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
    <!-- {{ HTML::script('https://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.columnFilter.js') }}
    {{ HTML::script('https://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.js') }}
    {{ HTML::style('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css') }} -->
    {{ HTML::script('assets/js/jquery.dataTables.columnFilter.js') }}
    {{ HTML::script('assets/js/jquery.dataTables.js') }}
    {{ HTML::style('assets/css/jquery.dataTables.css') }}

    {{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
	{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js') }}
	{{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}

    <script>
        $(document).ready(function(){
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
