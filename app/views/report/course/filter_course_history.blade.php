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
                <h3 class="panel-title">Course History
                    <div class="mig-wrap" style="float:right;padding-right:30px;">
                       
                        {{ Form::open(array('url'=>'reports/course-history/filter-export','method'=>'post','role'=>'form')) }}
                        {{ Form::hidden('selectyear_val',$filter_year) }}
                        <button type="submit" class="btn btn-primary" style="float:left;margin-right:3px;">Export</button>
                        {{ Form::close() }}

                    </div>
                </h3>   

                <br />

                    <div class="form-group" style="margin-top:15px;margin-bottom:5px;">
                        <label style="margin-top:8px;padding-left:15px;padding-right:15px;float:left;">Filter</label>
                    {{ Form::open(array('url'=>'reports/course-history/filter','method'=>'post')) }}
                        <select class="dashsel col-sm-4" name="selectyear">
                            <option value='0'>select year</option>
                           <?php
                              $startdate = 2007;
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
                        <button type="submit" class="btn btn-red">Report</button>
                        {{ Form::close() }}
                    </div>

            </div>

            <div class="panel-body">
                <div id="reportView">
                    <table class="table table-striped table-bordered table-hover table-full-width" id="report">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Students Count</th>
                                <th>Year</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($course_history == '[]')
                            <tr>
                                <td colspan="3" style="text-align:center;">There is no data!</td>
                            </tr>                            
                            @else
                            @foreach($course_history as $key=> $value)
                                <tr>
                                   <td>{{CoursesEntry::where('id','=',$value->course_id)->pluck('course_name');}}</td>
                                   <td>{{StudentCourseEntry::where('date_of_registration','like',$filter_year.'%')->groupBy('course_id')->count()}}</td>
                                   <td>{{$filter_year}}</td>
                                </tr>   
                            @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
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
    <script type="text/javascript">
        jQuery('#report').DataTable( {
            responsive: true,
            "order": [[ 8, "desc" ]],
        });
    </script>
@stop

