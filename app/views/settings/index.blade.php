@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@stop

@section('content')

    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Settings </h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Choose Course
                    </label>
                    <div class="col-sm-9">
                    {{ Form::open(array('url'=>'sessions/show','method'=>'post')) }}
                        <select class="col-sm-12" name="course">
                        @foreach($courses as $course)
                          <option value="{{$course->id}}">{{$course->course_name}}</option>
                        @endforeach
                        </select>
                        <button type="submit" class="btn btn-info" style="margin-top:30px;">Choose sessions</button>
                    {{ Form::close() }}
                    </div>
                </div>



            </div>

        </div>
        <!-- end: DYNAMIC TABLE PANEL -->
    </div>

@stop

@section ('scripts')
    {{ HTML::script('assets/plugins/select2/select2.min.js') }}
    {{ HTML::script('assets/js/table-data.js') }}
    {{ HTML::script('https://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.columnFilter.js') }}
    {{ HTML::script('https://jquery-datatables-column-filter.googlecode.com/svn/trunk/media/js/jquery.dataTables.js') }}
    {{ HTML::style('http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css') }}

    <script>
        $(document).ready(function(){
            $('#sample_1').dataTable()
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
            $('#datepicker1').datepicker({
                format: "dd/mm/yyyy",
                daysOfWeekDisabled: "0,1",
                endDate: date,
                todayHighlight: true
            });

        });
    </script>
@stop
