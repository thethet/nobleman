@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Schedules <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('trainerschedule/create') }}"><i class="fa fa-plus white"></i></a>
            
            <div class="mig-wrap" style="float:right;padding-right:30px;">                
                <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('trainerschedule/export') }}">Export</a>
            </div>

            </h3>            
        </div>
        <div class="panel-body">
        <div class="form-group ptxt">
                {{ Form::open(array('url'=>'trainerschedule/datefilter','method'=>'post')) }}           
                <div class="row">
                    <div class="col-sm-3" style="margin-top:5px;">
                        <label>From</label>
                        <input type="text" name="fromdate" placeholder="" id="filterdate" class="input-sm">
                    </div>

                    <div class="col-sm-3" style="margin-left:-15px;margin-top:5px;">
                        <label>To</label>
                        <input type="text" name="todate" placeholder="" id="filterdate1" class="input-sm">
                    </div>

                    <button type="submit" class="btn btn-green btn-sm">Filter</button>
                </div>
                
                {{ Form::close() }}
            </div>

            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Trainer</th>
                        <th>Course Name</th>
                        <!-- <th>Lesson Name</th> -->
                        <th>Date</th>                       
                        <th>Session </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				@foreach ($trainerschedule as $key => $tsdata)
                    <tr>
                    	<td>{{$tsdata -> id}}</td>
                        <td>
                            {{ DB::table('trainers') 
                                ->leftJoin('trainer_schedule', 'trainers.user_id', '=', 'trainer_schedule.trainer_id')                                                
                                ->where('trainer_schedule.trainer_id','=',$tsdata->trainer_id)
                                ->pluck('trainer_name') }}
                        </td>
                        <td>{{ DB::table('courses') 
                            ->leftJoin('trainer_schedule', 'courses.id', '=', 'trainer_schedule.course_id')                                                
                            ->where('trainer_schedule.course_id','=',$tsdata->course_id)
                            ->pluck('course_name') }}
                        </td>
                        <!-- <td>{{ DB::table('lessons') 
                            ->leftJoin('trainer_schedule', 'lessons.id', '=', 'trainer_schedule.lesson_id')                                                
                            ->where('trainer_schedule.lesson_id','=',$tsdata->lesson_id)
                            ->pluck('lesson_name') }}
                        </td> -->
                        <td>{{$tsdata -> date}}</td>
                        <td>
                        <?php
                        $tss_list = DB::table('trainer_schedule_session')->where('trainer_schedule_id','=',$tsdata->id)->get();
                        foreach ($tss_list as $tss_data) {
                            echo $tss_data->session . '<br />';
                        }
                        ?>
                        </td>
                    	<td>
                            {{ Form::open(array('url'=>'trainerschedule','class'=>'formdel','id'=> $tsdata -> id)) }}
                            <a class="btn btn-info" href="{{ URL::to('trainerschedule/'.$tsdata->id) }}">
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                            {{ Form::hidden('id',$tsdata->id) }}
                                <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
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
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js') }}
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

    /***********************************/

    var date = new Date();
    date.setDate(date.getDate());
    $('#filterdate,#filterdate1').datepicker({
        format: "yyyy-mm-dd",
        /*daysOfWeekDisabled: "0,1",
        endDate: date,*/
        todayHighlight: true
    });


}); 



</script>
@stop