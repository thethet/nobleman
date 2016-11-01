@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }} 
 
@stop

@section('content')
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Apply <span class="text-bold">Leave</span></h4>
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
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    {{ Form::open(array('action'=>'LeavesController@apply_leave','class'=>'form-horizontal')) }}
                     <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-field-13">
                            Leave Type
                        </label>
                         
                        <div class="col-sm-7">
                        	<select name="leave_type" class="form-control" id="leave_type">
                            	<option value="-1">---</option>
                            	@foreach ($leave_types as $key=>$value)
                                	<option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-field-13">
                            Entitlement Left
                        </label>
                         
                        <div class="col-sm-3">
                        	<input id="entitlement" value="0" class="form-control" disabled>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-field-13">
                            Period Start
                        </label>
                        <div class="col-sm-3">
                            <input disabled type="text" id="period_start" name="period_start" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">				
                        </div>
                         
                        <div class="col-sm-4">
                        	<select disabled name="start_duration" class="form-control" id="start_duration">
                            	<option value="1">Full Day</option>
                            	<option value="2">Half Day</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group" id="endduration">
                    	<label class="col-sm-4 control-label" for="form-field-13">
                            Period End
                        </label>
                        <div class="col-sm-3">
                            <input disabled type="text" id="period_end" name="period_end" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">				
                        </div>
                        <div class="col-sm-4">
                        	<select disabled name="end_duration" class="form-control">
                            	<option value="1">Full Day</option>
                            	<option value="2">Half Day</option>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-field-13">
                            Reason
                        </label>
                        <div class="col-sm-7" style="padding-left:20px;">
                            <textarea disabled class="full-width form-control" rows="5" name="comment"></textarea>
		
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="form-field-13">
                            
                        </label>
                        <div class="col-sm-7" style="padding-left:20px;">
                            <input type="submit" class="btn btn-primary" value="Apply">
							<a href="{{ URL::to('leaves') }}">
                            	<input type="button" class="btn btn-warning" value="Back">
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
              
        </div>
        
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>

<div class="col-md-6">

    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">My <span class="text-bold">Timesheet</span></h4>
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
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
        @if ($nowtimesheet == 0)
        	<div class="redbox">
            You have not created this week's timesheet
            </div>
        @endif
        @if (count($unsubmittedtimesheet) > 0)
        <h4>My Timesheets</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Period</td>
                    <td>User</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($unsubmittedtimesheet as $key=> $value)
                    <tr>
                    	<td>
                        	{{ date('d-m-Y',strtotime($value->period_start)) }} to {{ date('d-m-Y',strtotime($value->period_end)) }}
                        </td>
                        <td>
						<?php 
							$UserEntry = UserEntry::find($value->user_id);
							echo $UserEntry->first_name." ".$UserEntry->last_name;
						?>
                        </td>
                        <td>
                        	{{ Form::open(array('action'=>'TimesheetsController@submit_timesheet')) }}
	                             {{ Form::hidden('id',$value->id) }}
                            	 <a class="btn btn-green" href="{{ URL::to('timesheets/'.$value->id) }}"><i class="fa fa-arrow-circle-right"></i></a>
                                 
                                 @if (Auth::user()->id == $value->user_id)
                                 	<button type="submit"  id="submitbtn" class="btn btn-blue"><i class="fa fa-upload"></i></button>
                                 @endif
                            {{ Form::close() }}
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
        @endif
              
        </div>
        
    </div>
</div>
<?php

?>
@stop
@section ('scripts')

    @include ('functions.leavecalendar')
	{{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/autosize/jquery.autosize.min.js") }}
    {{ HTML::script("assets/plugins/select2/select2.min.js") }}
    {{ HTML::script("assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js") }}
    {{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/jquery-maskmoney/jquery.maskMoney.js") }}
    {{ HTML::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/commits.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js") }}
    {{ HTML::script("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") }}
    {{ HTML::script("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js") }}
    {{ HTML::script("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js") }}
    {{ HTML::script("assets/plugins/ckeditor/ckeditor.js") }}
    {{ HTML::script("assets/plugins/ckeditor/adapters/jquery.js") }}
    {{ HTML::script("assets/js/form-elements.js") }}
    
    <script>
		var entitlements = <?php echo json_encode($entitlements); ?>;
        // Trigger all the Javascripts
		jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
        });
		
		// Update the Entitlement field, if it is 0, disable all field
		$("#leave_type").change(function(){
			// If it is not unpaid leave
			if ($("#leave_type").val() != 1)
			{
				var ent = entitlements[$("#leave_type").val()];
				
				$("#entitlement").val(ent);
				if (ent > 0)
				{
					$(".form-control").prop("disabled",false);
					
					$("#entitlement").prop("disabled",true);
				}
				else if (ent == 1)
				{
					$(".form-control").prop("disabled",false);
					$("#entitlement").prop("disabled",true);
					$("#endduration").hide();
				}
				else 
				{
					$(".form-control").prop("disabled",true);
					$("#leave_type").prop("disabled",false);
					$("#entitlement").prop("disabled",true);
				}
			}
			// If it is unpaid leave
			else
			{
				
				$("#entitlement").val("---");
					$(".form-control").prop("disabled",false);
					$("#entitlement").prop("disabled",true);
			}
		});
		
		// If half day, Leave is assumed as only one half day
		$("#start_duration").change(function(){
			$("#endduration").toggle();
			$("#period_end").val('');
     	    $("#period_start").datepicker("option","maxDate", '');
		});
		
		// On Period Start Change
		// Set the Min Date for Period End
		// Set the Max Date based on Entitlements, Public Holidays, and Leaves Taken
		$("#period_start").change(function(){
			
			$("#period_end").datepicker("option","minDate", $("#period_start").val());
			
			var minDate = new Date($("#period_start").val());
			var tmpDate = new Date($("#period_start").val());
			var maxDate = new Date($("#period_start").val());
			maxDate.setDate(maxDate.getDate() + entitlements[$("#leave_type").val()]);
			
			var tmpMaxDate = maxDate;
			
			// Set Max Date based on Leave Entitlement
			for (var tmpDate = new Date($("#period_start").val()); tmpDate < tmpMaxDate; tmpDate.setDate(tmpDate.getDate() + 1))
			{
			  if (tmpDate.getDay() == 6 || tmpDate.getDay() == 0)
			  {
				  maxDate.setDate(maxDate.getDate() + 1);
			  }
			}
			
			// Set Max Date based on Leaves Taken
			for (var tmp = 0; tmp < confirmedleaves.length; tmp++)
			{
			  if ((new Date(confirmedleaves[tmp]) < maxDate) && (new Date(confirmedleaves[tmp]) > minDate))
			  {
				  maxDate = new Date (confirmedleaves[tmp]);
			  }
			}
				 
			$("#period_end").datepicker("option","maxDate", maxDate);
		});
		
		// Set the Max Date for Period Start
		$("#period_end").change(function(){
			$("#period_start").datepicker("option","maxDate", $("#period_end").val());
		});
		
    </script>
@stop