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
                <h3 class="panel-title">Announcement <span class="text-bold">List</span><a class="btn-s btn-primary" href="{{ URL::to('announcement/create') }}"><i class="fa fa-plus white"></i></a></h3>
            </div>
            <div class="panel-body">
                <!--<div class="form-group">
                    <label class="col-sm-1 control-label" for="form-field-13">
                        Date
                    </label>
                    <div class="col-sm-2">
                        <input type="text" name="date" placeholder="     Click here to pick a date" id="datepicker1" class="form-control input-sm">
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
                        <th>Announcement Title</th>
                        <th>Announcement Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($announcement as $key=> $announcements)
                        <tr>
                            {{ Form::open(array('url'=>'announcement','method'=>'post','id'=>$announcements -> id)) }}
                            <td>{{$announcements->announcement_title}}</td>
                            <td>{{$announcements->announcement_date}}</td>
                            <td>
                                {{ Form::open(array('url'=>'announcement','class'=>'formdel','id'=> $announcements -> id)) }}
                                <a class="btn btn-info" href="{{ URL::to('announcement/'.$announcements->id) }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                {{ Form::hidden('id',$announcements->id) }}
                                    <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                {{ Form::close() }}
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
