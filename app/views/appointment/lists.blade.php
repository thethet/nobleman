@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Attendance <span class="text-bold">List</span></h3>

            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                    <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Date</th>
                        <th>Session</th>
                        <th>Marked By</th>
                        <th>Attendance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($studentcourse as $key => $sc)
                        <tr>
                                <td>{{CoursesEntry::where('course_id','=',$sc->course_id)->pluck('course_name');}}</td>
                                <td>{{$sc->date}}</td>
                                <td>{{$sc->session}}</td>
                                <td>{{UserEntry::where('id','=',$sc->trainer_id)->pluck('show_id');}}</td>
                                <td>
                                    @if(($sc->attend) == 1)
                                        <span class="btn btn-info"><i class="fa fa-check"></i></span>
                                    @elseif(($sc->attend == 0))

                                    {{ Form::open(array('url'=>'appointment','class'=>'formdel','id'=>$sc->id)) }}
                                    {{ Form::hidden('id',$sc->id) }}
                                    <!--<button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>-->
                                    {{ Form::close() }}

                                    @endif
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <span style="float:left"><i>Session A: 11am-1pm; Session B: 2-4pm; Session C: 7pm-9pm; Session D: 10am-12pm</i></span>
            </div>
        </div>
        <!-- end: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-body right padding">
                <a href="{{ URL::to('appointment/book') }}"><input type="button" class="btn btn-primary" value="Book A New Appointment"></a>
                <a href="{{ URL::to('appointment') }}"><input type="button" class="btn btn-warning" value="Back"></a>
            </div>
        </div>
    </div>

@stop

@section ('scripts')
    {{ HTML::script('assets/plugins/select2/select2.min.js') }}
    {{ HTML::script('assets/js/table-data.js') }}

    <script>
        jQuery(document).ready(function() {
            TableData.init();
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
