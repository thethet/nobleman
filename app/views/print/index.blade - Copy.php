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
            <h3 class="panel-title">Print Schedule </h3>
        </div>
        <div class="panel-body">

        <div class="form-group ptxt">
            <div class="col-sm-1">
                <label>Date</label>
            </div>
            {{ Form::open(array('url'=>'print/show','method'=>'post')) }}
            <div class="col-sm-2" style="padding:0px;">
                <input type="text" name="date" placeholder="To" id="date" class="form-control input-sm">
            </div><button type="submit" class="btn btn-red">Show</button>

            {{ Form::close() }}
        </div>

        <!-- <a href="{{ URL::to('/print/modules') }}">Download</a> -->


         <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Module Name</th>
                        <th>Session</th>
                        <th>Date</th>
                        <th>Lesson</th>
                    </tr>
                </thead>
                <tbody>

                @if($haveDate == 0)

                    @foreach($appointments as $key=> $appointments)
                        <tr>
                            <td>{{studententry::where('id','=',$appointments->student_id)->pluck('name')}}</td>
                            <td>{{modulesentry::where('id','=',$appointments->module_id)->pluck('module_name')}}</td>
                            <td>{{$appointments->session}}</td>
                            <td>{{$appointments->date}}</td>
                            <td>
                                <select name="lesson">
                                    @foreach ( lessonsentry::where('module_id','=',$appointments->module_id)->where('id','!=',$appointments->lesson_id)->get() as $key => $lessons )
                                        <option value="{{$lessons->id}}">{{$lessons->lesson_name}}</option>
                                    @endforeach

                                    <!-- @foreach ( DB::table('lessons') ->leftJoin('appointment', 'lessons.module_id', '=', 'appointment.module_id') ->where('lessons.module_id','=',$appointments->module_id)->where('appointment.attend','=',1)->get() as $key => $lessons )
                                        @if($appointments->attend != 1)
                                        <option value="{{$lessons->id}}">{{$lessons->lesson_name}}</option>
                                        @else
                                        <option>fsdfsd</option>
                                        @endif
                                    @endforeach -->

                                </select>

                            </td>

                        </tr>
                    @endforeach

                @else

                    @foreach($getdate_appointments as $key=> $appointments)
                        <tr>
                            <td>{{studententry::where('id','=',$appointments->student_id)->pluck('name')}}</td>
                            <td>{{modulesentry::where('id','=',$appointments->module_id)->pluck('module_name')}}</td>
                            <td>{{$appointments->session}}</td>
                            <td>{{$appointments->date}}</td>
                            <td>
                                <select name="lesson">
                                    @foreach ( lessonsentry::where('module_id','=',$appointments->module_id)->where('id','!=',$appointments->lesson_id)->get() as $key => $lessons )
                                        <option value="{{$lessons->id}}">{{$lessons->lesson_name}}</option>
                                    @endforeach

                                    <!-- @foreach ( DB::table('lessons') ->leftJoin('appointment', 'lessons.module_id', '=', 'appointment.module_id') ->where('lessons.module_id','=',$appointments->module_id)->where('appointment.attend','=',1)->get() as $key => $lessons )
                                        @if($appointments->attend != 1)
                                        <option value="{{$lessons->id}}">{{$lessons->lesson_name}}</option>
                                        @else
                                        <option>fsdfsd</option>
                                        @endif
                                    @endforeach -->

                                </select>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                @endif

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
var no = 0;
$(".formdel").submit(function(ev) {
	if (no == 0)
	{
		var id = $(this).attr('id');
		Boxy.confirm("Are you sure?", function() { no = 1; $("#"+id).submit(); }, {title: 'Confirm'});
		return false;
	}
});

jQuery(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate()+1);
    $('#date').datepicker({
        format: "yyyy-mm-dd",
        //daysOfWeekDisabled: "0,1",
        //startDate: date,
        todayHighlight: true
    });
});


</script>
@stop
