@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
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
            <div class="form-group">
                <label class="col-sm-1 control-label" for="form-field-13">
                    Date
                </label>
                <div class="col-sm-2">
                    <input type="text" name="date" placeholder="     Click here to pick a date" id="datepicker1" class="form-control input-sm">
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="col-sm-1 control-label" for="form-field-13">
                    Session :
                </label>
                <div class="col-sm-2">
                    <select class="col-sm-4" name="hour">
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                    </select>
                </div><input type="submit" class="btn btn-primary" value="Search">
            </div>
            <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Session</th>
                        <th>Course Name</th>
                        <th>Module Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        	<td>RCP001</td>
                        	<td>Fulbert</td>
                        	<td>11/04/2015</td>
                        	<td>A</td>
                        	<td>Lifestyle Floral Deisgn 2</td>
                        	<td><select name="hour">
                                    <option>Wedding flower arrangement</option>
                                    <option>Flower arrangement</option>
                                    <option>Opening flower arrangement</option>
                                </select>
                            </td>
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP002</td>
                        	<td>Jonathan</td>
                            <td>11/04/2015</td>
                            <td>A</td>
                            <td>Lifestyle Floral Deisgn 2</td>
                            <td><select name="hour">
                                    <option>Wedding flower arrangement</option>
                                    <option>Flower arrangement</option>
                                    <option>Opening flower arrangement</option>
                                </select>
                            </td>
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP003</td>
                        	<td>Rave</td>
                            <td>11/04/2015</td>
                            <td>A</td>
                            <td>Lifestyle Floral Deisgn 2</td>
                            <td><select name="hour">
                                    <option>Wedding flower arrangement</option>
                                    <option>Flower arrangement</option>
                                    <option>Opening flower arrangement</option>
                                </select>
                            </td>
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP004</td>
                        	<td>Tricia Leong</td>
                            <td>11/04/2015</td>
                            <td>A</td>
                            <td>Lifestyle Floral Deisgn 2</td>
                            <td><select name="hour">
                                    <option>Wedding flower arrangement</option>
                                    <option>Flower arrangement</option>
                                    <option>Opening flower arrangement</option>
                                </select>
                            </td>
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                    
                            </td>
                        </tr>
                    	<tr>
                        	<td>RCP005</td>
                        	<td>Erica</td>
                            <td>11/04/2015</td>
                            <td>A</td>
                            <td>Lifestyle Floral Deisgn 2</td>
                            <td><select name="hour">
                                    <option>Wedding flower arrangement</option>
                                    <option>Flower arrangement</option>
                                    <option>Opening flower arrangement</option>
                                </select>
                            </td>
                        	<td>
                                <a class="btn btn-info">
                                    <i class="fa fa-check-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger"><i class="fa fa-times"></i> </button>
                                    
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
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}

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
$(document).ready(function () {
    var date = new Date();
    date.setDate(date.getDate());
    $('#datepicker1').datepicker({
        format: "dd/mm/yyyy",
        daysOfWeekDisabled: "0,1",
        endDate: date,
        todayHighlight: true
    });

});
</script>
@stop