<?php
	// Disable dates of previous leaves, public holidays and weekends
	$activeperiod = TermEntry::where('active','=',1)->pluck('id');
	$publicholiday = PublicHolidayEntry::where('status','=',1)->lists('date');
	for ($y = 0; $y < count($publicholiday); $y++)
	{
		$publicholiday[$y] = date('n-j-Y', strtotime($publicholiday[$y]));
	}
	$confirmedleaves = LeaveEntry::where('user_id','=',Auth::user()->id)->where('status','!=',2)->where('term','=',$activeperiod)->get();
	$leaves = array();
	$i = 0;
	foreach ($confirmedleaves as $value){
			$endDate = strtotime(date('Y-m-d 23:59:59', strtotime($value->period_end)));
			$current = strtotime($value->period_start);
			
			while ($current <= $endDate) {
				$leaves[$i++] = date('n-j-Y',$current);
				$current = strtotime('+1 day', $current);
			}
	}
	$offdays = array_merge ($publicholiday,$leaves);
	$json =  json_encode($offdays);
	$leavesjson = json_encode($leaves);
?>
<script>
	var disabledSpecificDays = <?php echo $json; ?>;
	var confirmedleaves = <?php echo $leavesjson; ?>;
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
	 	   beforeShowDay: disableSpecificDaysAndWeekends
		});
	};
	runDatePicker();
</script>