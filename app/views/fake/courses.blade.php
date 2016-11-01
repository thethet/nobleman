@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Courses <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('courses/create') }}"><i class="fa fa-plus white"></i></a></h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Course Name</th>
                        <th>Course Categories</th>
                        <th>Cost of Course($SGD)</th>
                        <th>Duration of Lesson</th>
                        <th>No. of Lesson</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                        	<td>N101-1</td>
                        	<td>Lifestyle Floral Design</td>
                            <td>Floral Courses</td>
                        	<td>200</td>
                        	<td>9</td>
                        	<td>9</td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('courses/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>>
                        <tr>
                        	<td>N101-2</td>
                        	<td>Lifestyle Floral Deisgn 2</td>
                            <td>Floral Courses</td>
                        	<td>200</td>
                        	<td>9</td>
                        	<td>9</td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('courses/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>

                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>

                            </td>
                        </tr>

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