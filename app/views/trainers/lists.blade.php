@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Trainers <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('trainers/create') }}"><i class="fa fa-plus white"></i></a>

            <div class="mig-wrap" style="float:right;padding-right:30px;">                
                <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('trainers/export') }}">Export</a>
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
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="hidden-xs"> Email</th>
                        <th class="hidden-xs"> Contact</th>
                        <!-- <th class="hidden-xs"> Status</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainers as $key => $trainer)
                        <tr>
                            <td>{{$trainer->id}}</td>
                            <td>{{$trainer->trainer_name}}</td>
                            <td>{{$trainer->email}}</td>
                            <td>{{$trainer->contact}}</td>
                            <!-- <td>
                            @if ($trainer->status == 1)
                            Active
                            @else
                            Inactive
                            @endif
                            </td> -->
                           
                            <td>                          
                            <a class="btn btn-green" href="{{ URL::to('trainers/'.$trainer->id) }}" style="float:left;margin-right:3px;"><i class="fa fa-arrow-circle-right"></i></a>
                            {{ Form::open(array('url'=>'trainers','class'=>'formdel','id'=>$trainer->id)) }}
                            {{ Form::hidden('id',$trainer->id) }}
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