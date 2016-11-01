<?php

class PayrollsController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	public function show_payroll()
	{
		$activeperiod = TermEntry::where('active','=',1)->first();
		$inbetweens = array();
		$inbetweensval = array();
		$start    = (new DateTime($activeperiod->period_start))->modify('first day of this month');
		$end      = (new DateTime('now'))->modify('first day of this month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		$m = 0;
		foreach ($period as $dt) {
			$inbetweens[$m] = $dt->format("Y F");
			$inbetweensval[$m++] = $dt->format("Y-m-d");
		}
		$user_payroll = PayrollEntry::where('user_id','=',Auth::user()->id)->orderBy('created_at', 'desc')->get();
		$this->layout->content =  View::make('payrolls.view')->with('payrolls',$user_payroll)->with('inbetweens',$inbetweens)->with('inbetweensval',$inbetweensval);
	}
	
	public function generate_payroll()
	{
		$activeperiod = TermEntry::where('active','=',1)->pluck('id');
		$paymonth = Input::get('paymonth');
		$endmonth = date('Y-m-t',strtotime($paymonth));
		
		$begin = strtotime($paymonth);
  		$end   = strtotime($endmonth);
        $no_days  = 0;
        $weekends = 0;
		
		$publicholiday = PublicHolidayEntry::lists('date');
        while ($begin <= $end) {
             // no of days in the given interval
			$checker = true;
			for ($y = 0; $y < count($publicholiday); $y++)
			{
				if ($publicholiday[$y] == date('Y-m-d',$begin))
				{
					$checker = false;
				}
			}
			if ($checker)
			{
				$no_days++;
			}
			
			$what_day = date("N", $begin);
			if ($what_day > 5) { // 6 and 7 are weekend days
				$weekends++;
			};
		    $begin += 86400; // +1 day
        
		};
        $workingdays = $no_days - $weekends;
		$users = UserEntry::where('status','=',1)->get();
		DB::table('payrolls')->where('time','=',$paymonth)->delete();
		foreach ($users as $user){
			
			$totalleaves = LeaveEntry::where('user_id','=',$user->id)->where('leave_type','!=',1)->where('status','!=',2)->where('term','=',$activeperiod)->count();
			$unpaidleaves = LeaveEntry::where('user_id','=',$user->id)->where('period_start','>=',$paymonth)->where('period_end','<=',$endmonth)->where('leave_type','=',1)->where('term','=',$activeperiod)->count();
			
			$payroll = ( $workingdays - $unpaidleaves ) / $workingdays;
			$payroll = $user->payroll * $payroll;
			$PayrollEntry = new PayrollEntry();
			$PayrollEntry->user_id = $user->id;
			$PayrollEntry->initial_payroll = $user->payroll;
			$PayrollEntry->working_days = $workingdays - $unpaidleaves;
			$PayrollEntry->leaves_taken = $totalleaves;
			$PayrollEntry->unpaid_leaves = $unpaidleaves;
			$PayrollEntry->time = $paymonth;
			$PayrollEntry->payroll = $payroll;
			$PayrollEntry->save();
			
		}
		return Redirect::to('payroll');
	}
	public function view_payroll($id)
	{
		$user_payroll = PayrollEntry::where('user_id','=',$id)->orderBy('created_at', 'desc')->get();
		$this->layout->content =  View::make('payrolls.view')->with('payroll',$user_payroll)->with('id',$id);
	}
}
?>