@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Mark <span class="text-bold">Attendance</span></h3>
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
        	<table class="table table-bordered-table-striped">
            	
            </table>
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Completion </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        	<td>CF001</td>
                        	<td>Flower arrangement</td>
                        	<td><span class="label label-primary" style="float:left;margin-right:10px">12 / 12</span></td>
                        	<td>
                                <a  class="btn btn-info fancybox" href="{{ URL::to('attendance/marksheet') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>CF002</td>
                        	<td>Wedding flower arrangment</td>
                        	<td><span class="label label-warning" style="float:left;margin-right:10px">3 / 9</span></td>
                        	<td>
                                <a class="btn btn-info fancybox" href="{{ URL::to('attendance/marksheet') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>CF003</td>
                        	<td>Flower picking</td>
                        	<td><span class="label label-warning" style="float:left;margin-right:10px">0 / 8</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('attendance/marksheet') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>CF004</td>
                        	<td>Round flowers creation</td>
                        	<td><span class="label label-warning" style="float:left;margin-right:10px">2 / 12</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('attendance/marksheet') }}">
                                    <i class="fa fa-arrow-circle-right"></i>  
                                </a>
                              
                                <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>CF005</td>
                        	<td>Flower Ecommerce</td>
                        	<td><span class="label label-warning" style="float:left;margin-right:10px">9 / 12</span></td>
                        	<td>
                                <a class="btn btn-info" href="{{ URL::to('attendance/marksheet') }}">
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
     
	{{ HTML::script("lib/jquery.mousewheel-3.0.6.pack.js") }}

	<!-- Add fancyBox main JS and CSS files -->
	{{ HTML::script("source/jquery.fancybox.js?v=2.1.5") }}
	{{ HTML::STYLE("source/jquery.fancybox.css?v=2.1.5") }}

	<!-- Add Button helper (this is optional) -->
	{{ HTML::STYLE("source/helpers/jquery.fancybox-buttons.css?v=1.0.5") }}
	{{ HTML::script("source/helpers/jquery.fancybox-buttons.js?v=1.0.5") }}

	<!-- Add Thumbnail helper (this is optional) -->
	{{ HTML::STYLE("source/helpers/jquery.fancybox-thumbs.css?v=1.0.7") }}
	{{ HTML::script("source/helpers/jquery.fancybox-thumbs.js?v=1.0.7") }}

	<!-- Add Media helper (this is optional) -->
	{{ HTML::script("source/helpers/jquery.fancybox-media.js?v=1.0.6") }}
    <script>
	$(".fancybox").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});
	</script>
@stop