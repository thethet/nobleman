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
                        <th>Module ID</th>
                        <th>Module Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                        <tr>
                        	<td>RCP001</td>
                        	<td>Round Flower Arrangement</td>
                        	<td> ---- </td>
                        	
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check"></i>  
                                </a>
                              
                                
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP002</td>
                        	<td>Horizontal Flower arrangement</td>
                        	<td> ---- </td>
                        	
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check"></i>  
                                </a>
                              
                                
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP003</td>
                        	<td>Inverted T Design Form</td>
                        	<td> ---- </td>
                        	
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check"></i>  
                                </a>
                              
                                
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP004</td>
                        	<td>Crescent Design Form</td>
                        	<td> 15-02-2015 </td>
                        	
                        	<td>
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                              
                                
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP005</td>
                        	<td>Parallel Design</td>
                        	<td> ---- </td>
                        	
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check"></i>  
                                </a>
                              
                                
                                    
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