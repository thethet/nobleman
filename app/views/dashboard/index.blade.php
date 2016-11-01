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
            <h3 class="panel-title">Dashboard <span class="text-bold">Monthly Report</span> </h3>
        </div>

        <div class="panel-heading">
            <h3 class="panel-title">Number of new students for the month</h3>
        </div>
        <div class="panel-body dashboard">

            <div class="form-group">
                {{ Form::open(array('url'=>'dashboard/newstdreport','method'=>'post')) }}
                    <select class="dashsel col-sm-4" name="syear">
                       <?php
                          $startdate = 2014;
                          //year to end with - this is set to current year. You can change to specific year
                          $enddate = date("Y");
                          $years = range ($startdate,$enddate);
                          foreach($years as $year)
                            {
                                ?>

                            <option value="{{$year}}">{{$year}}</option>
                            <?php
                            }
                        ?>
                    </select>
                    <select class="dashsel col-sm-4" name="month">
                            <?php
                            for ( $n = 1; $n <= 12; $n++)
                            {
                                if( $n < 10)
                                {
                            ?>
                                    <option value="0{{ $n }}">0{{ $n }}</option>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                            <?php
                                }
                            }
                            ?>
                    </select>
                        <button type="submit" class="btn btn-red">Report</button>
                    {{ Form::close() }}
            </div>

            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Number of new students</th>
                    </tr>
                </thead>

                <tbody>
                    @if($students == 0)
                    <tr>
                    <?php
                    $current_year = date('Y', time());
                    $current_month = date('m', time());
                    $date = $current_year . '-' . $current_month;
                    ?>
                        <td>{{$current_year}}</td>
                        <td>{{$current_month}}</td>
                        <td>{{count(StudentEntry::where('created_at','like',$date.'%')->get())}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{$syear}}</td>
                        <td>{{$month}}</td>
                        <td>{{$students_count}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
    <!-- end: DYNAMIC TABLE PANEL -->


    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Payment received for month </h3>
        </div>
        <div class="panel-body dashboard">

             <div class="form-group">
                {{ Form::open(array('url'=>'dashboard/paymentreport','method'=>'post')) }}
                    <select class="dashsel col-sm-4" name="syear">
                       <?php
                          $startdate = 2014;
                          //year to end with - this is set to current year. You can change to specific year
                          $enddate = date("Y");
                          $years = range ($startdate,$enddate);
                          foreach($years as $year)
                            {
                                ?>

                            <option value="{{$year}}">{{$year}}</option>
                            <?php
                            }
                        ?>
                    </select>
                    <select class="dashsel col-sm-4" name="month">
                            <?php
                            for ( $n = 1; $n <= 12; $n++)
                            {
                                if( $n < 10)
                                {
                            ?>
                                    <option value="0{{ $n }}">0{{ $n }}</option>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                            <?php
                                }
                            }
                            ?>
                    </select>
                        <button type="submit" class="btn btn-red">Report</button>
                    {{ Form::close() }}
            </div>

            <table class="display" id="sample_2">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Total Revenue</th>
                        <th>Total Received</th>
                        <th>Outstanding</th>
                    </tr>
                </thead>

                <tbody>
                    @if($payment == 0)
                    <tr>
                    <?php
                    $current_year = date('Y', time());
                    $current_month = date('m', time());
                    $date = $current_year . '-' . $current_month;
                    ?>
                        <td>{{$current_year}}</td>
                        <td>{{$current_month}}</td>
                        <?php
                            $total_revenue = DB::table('student_course')
                                                ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
                                                ->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
                                                ->where('students.created_at','like',$date.'%')
                                                ->sum('cost_of_course');
                        ?>
                        <td>{{$total_revenue}}</td>
                        <?php
                        $total_received = DB::table('student_course')
                                                ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
                                                ->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
                                                ->where('students.created_at','like',$date.'%')
                                                ->where('students.status','=',1)
                                                ->sum('cost_of_course');
                        ?>
                        <td>{{$total_received}}</td>
                        <?php
                        $outstanding = DB::table('student_course')
                                                ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
                                                ->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
                                                ->where('students.created_at','like',$date.'%')
                                                ->where('students.status','=',0)
                                                ->sum('cost_of_course');
                        ?>
                        <td>{{$outstanding}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{$syear}}</td>
                        <td>{{$month}}</td>
                        <td>{{$total_revenue}}</td>
                        <td>{{$total_received}}</td>
                        <td>{{$outstanding}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->


    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">No of students sponsored by company </h3>
        </div>
        <div class="panel-body dashboard">

            <div class="form-group">
                {{ Form::open(array('url'=>'dashboard/sponsorreport','method'=>'post')) }}
                    <select class="dashsel col-sm-4" name="syear">
                       <?php
                          $startdate = 2014;
                          //year to end with - this is set to current year. You can change to specific year
                          $enddate = date("Y");
                          $years = range ($startdate,$enddate);
                          foreach($years as $year)
                            {
                                ?>

                            <option value="{{$year}}">{{$year}}</option>
                            <?php
                            }
                        ?>
                    </select>
                    <select class="dashsel col-sm-4" name="month">
                            <?php
                            for ( $n = 1; $n <= 12; $n++)
                            {
                                if( $n < 10)
                                {
                            ?>
                                    <option value="0{{ $n }}">0{{ $n }}</option>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                            <?php
                                }
                            }
                            ?>
                    </select>
                        <button type="submit" class="btn btn-red">Report</button>
                    {{ Form::close() }}
            </div>
            <table class="display" id="sample_3">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Number of new students</th>
                    </tr>
                </thead>

                <tbody>
                    @if($sponsor == 0)
                    <tr>
                    <?php
                    $current_year = date('Y', time());
                    $current_month = date('m', time());
                    $date = $current_year . '-' . $current_month;
                    ?>
                        <td>{{$current_year}}</td>
                        <td>{{$current_month}}</td>
                        <td>{{count(studententry::where('created_at','like',$date.'%')->where('sponsorship','=','Yes')->get())}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{$syear}}</td>
                        <td>{{$month}}</td>
                        <td>{{$sponsor_std_count}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->

    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Show no. of courses in course type </h3>
        </div>

        <div class="panel-body dashboard">

            <div class="form-group">
                {{ Form::open(array('url'=>'dashboard/coursereport','method'=>'post')) }}
                    <select class="dashsel col-sm-4" name="syear">
                       <?php
                          $startdate = 2014;
                          //year to end with - this is set to current year. You can change to specific year
                          $enddate = date("Y");
                          $years = range ($startdate,$enddate);
                          foreach($years as $year)
                            {
                                ?>

                            <option value="{{$year}}">{{$year}}</option>
                            <?php
                            }
                        ?>
                    </select>
                    <select class="dashsel col-sm-4" name="month">
                            <?php
                            for ( $n = 1; $n <= 12; $n++)
                            {
                                if( $n < 10)
                                {
                            ?>
                                    <option value="0{{ $n }}">0{{ $n }}</option>
                            <?php
                                }
                                else
                                {
                            ?>
                                    <option value="{{ $n }}">{{ $n }}</option>
                            <?php
                                }
                            }
                            ?>
                    </select>
                        <button type="submit" class="btn btn-red">Report</button>
                    {{ Form::close() }}
            </div>
            <table class="display" id="sample_4">
                <thead>
                    <tr>
                        <th>Course Type</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Number of courses in course type</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($course_type_list as $coursetype)

                    @if($course == 0)
                    <tr>
                    <?php
                    $current_year = date('Y', time());
                    $current_month = date('m', time());
                    $date = $current_year . '-' . $current_month;
                    ?>
                        <td>{{ $coursetype['name'] }}</td>
                        <td>{{$current_year}}</td>
                        <td>{{$current_month}}</td>
                        <td>{{count(CoursesEntry::where('course_type','=',$coursetype['value'])->where('created_at','like',$date.'%')->get())}}</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $coursetype['name'] }}</td>
                        <td>{{$syear}}</td>
                        <td>{{$month}}</td>
                        <td>{{count(CoursesEntry::where('course_type','=',$coursetype['value'])->where('created_at','like',$date1.'%')->get())}}</td>
                    </tr>
                    @endif
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

    jQuery(document).ready(function() {
        $('#sample_1').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );


        $('#sample_2').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );

        $('#sample_3').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );


         $('#sample_4').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );




    } );



jQuery(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate()+1);
    $('#date').datepicker({
        format: "mm/dd/yyyy",
        daysOfWeekDisabled: "0,1",
        startDate: date,
        todayHighlight: true
    });
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
