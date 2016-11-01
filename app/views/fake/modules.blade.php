@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Modules <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('students/create') }}"><i class="fa fa-plus white"></i></a></h3>
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
        Show Modules from : 
        <select class="search-select">
        	<option>Wedding flower arrangment</option>
        	<option>Flower picking</option>
        	<option>Round flowers creation</option>
        </select> <input type="button" class="btn btn-primary" value="Go"/>
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Module Name</th>
                        <th>Course Name</th>
                        <th>Last Updated</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        	<td>BF0001</td>
                        	<td>Flower arrangement</td>
                        	<td>Round Design Form</td>
                        	<td>15-12-2015 15:23:45 </td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('students/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>BF0002</td>
                        	<td>Flower arrangement</td>
                        	<td>Horizontal Design Form</td>
                        	<td>15-12-2015 15:23:45 </td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('students/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>BF0003</td>
                        	<td>Wedding flower arrangment</td>
                        	<td>Symmetrical triangle</td>
                        	<td>15-12-2015 15:23:45 </td>
                            <td><span class="label label-danger" style="float:left;margin-right:10px">Not Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('students/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>BF0004</td>
                        	<td>Wedding flower arrangment</td>
                        	<td>Assymmetrical triangle</td>
                        	<td>15-12-2015 15:23:45 </td>
                            <td><span class="label label-warning" style="float:left;margin-right:10px">Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('students/edit') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>BF0005</td>
                        	<td>Wedding flower arrangment</td>
                        	<td>Cone Shape Design Form</td>
                        	<td>15-12-2015 15:23:45 </td>
                            <td><span class="label label-danger" style="float:left;margin-right:10px">Not Active</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('students/edit') }}">
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