@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Holidays <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('holiday/create') }}"><i class="fa fa-plus white"></i></a></h3>
        </div>
        <div class="panel-body">
            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Of Holiday</th>
                        <th>Date(From) </th>  
                        <th>Date(To) </th>                    
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				@foreach ($holidays as $key => $holiday)
                    <tr>
                        	<td>{{$holiday -> id}}</td>
                            <td>{{$holiday -> h_name}}</td>
                            <td>{{$holiday -> hf_date}}</td>
                            <td>{{$holiday -> ht_date}}</td>
                        	<td>
                                {{ Form::open(array('url'=>'holiday','class'=>'formdel','id'=> $holiday -> id)) }}
                                <a class="btn btn-info" href="{{ URL::to('holiday/'.$holiday->id) }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                {{ Form::hidden('id',$holiday->id) }}
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
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js') }}
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

</script>
@stop