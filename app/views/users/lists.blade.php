@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Users <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('users/create') }}"><i class="fa fa-plus white"></i></a></h3>
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
                        <th>Position </th>
                        <th class="hidden-xs"> Email</th>
                        <th class="hidden-xs"> Contact</th>
                        <th class="hidden-xs"> Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $t = 0; ?>
                    @foreach ($users as $key=>$value)
                        <tr>
                            <td>{{ $value->show_id }}</td>
                            <td>{{ $value->salutation." ".$value->first_name." ".$value->last_name }}</td>
                            <td>{{ $value->position }}</td>
                            <td class="hidden-xs">{{ $value->email }}</td>
                            <td class="hidden-xs">{{ $value->contact }}</td>
                            <td class="hidden-xs">
                                @if ($value->status == 1)
                          	      <span class="label label-info"> Active</span>
                                @else
                               	 <span class="label label-default"> Inactive</span>
                                @endif
                            </td>
                            <td>
                            	{{ Form::open(array('url'=>'users','class'=>'formdel','id'=>$t)) }}
                                <a class="btn btn-green" href="{{ URL::to('users/'.$value->id) }}"><i class="fa fa-arrow-circle-right"></i></a>
                              	  {{ Form::hidden('id',$value->id) }}
                            	@if ($value->id != Auth::user()->id)
                                	<button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                @endif
                                {{ Form::close() }}
                                <?php $t++; ?>
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