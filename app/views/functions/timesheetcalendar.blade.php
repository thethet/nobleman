<?php
	// Disable dates of previous leaves, public holidays and weekends
	$activeperiod = TermEntry::where('active','=',1)->pluck('id');
	
	$confirmedtimesheets = TimesheetEntry::where('user_id','=',Auth::user()->id)->where('status','!=',3)->get();
	$timesheets = array();
	$i = 0;
	foreach ($confirmedtimesheets as $value){
			$endDate = strtotime(date('Y-m-d 23:59:59', strtotime($value->period_end)));
			$current = strtotime($value->period_start);
			
			while ($current <= $endDate) {
				$timesheets[$i++] = date('n-j-Y',$current);
				$current = strtotime('+1 day', $current);
			}
	}
	$timesheetjson = json_encode($timesheets);
?>
<script>
	var disabledSpecificDays = <?php echo $timesheetjson; ?>;
	//var confirmedleaves = 
	 
	function disableSpecificDaysAndWeekends(date) {
		var m = date.getMonth();
		var d = date.getDate();
		var y = date.getFullYear();
	 
		for (var i = 0; i < disabledSpecificDays.length; i++) {
			if ($.inArray((m + 1) + '-' + d + '-' + y, disabledSpecificDays) != -1) {
				return [false];
			}
		}
	 
		var noWeekend = $.datepicker.noWeekends(date);
		return !noWeekend[0] ? noWeekend : [true];
	}
	var runDatePicker = function() {
		$('.date-picker').datepicker({
	 	   beforeShowDay: disableSpecificDaysAndWeekends,
		   maxDate: new Date
		});
	};
	runDatePicker();
</script>