<?php

class LeavesController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	protected $activeperiod;

    public function __construct() 
    {
        // Fetch the Site Settings object
		$this->activeperiod = TermEntry::where('active','=',1)->pluck('id');
        View::share('activeperiod', $this->activeperiod);
    }
	public function leave_application()
	{
	
		$LeaveEntitlementEntry = LeaveEntitlementEntry::where('term','=',$this->activeperiod)->where('user_id','=',Auth::user()->id)->get();
		$entitlements = array();
		foreach ($LeaveEntitlementEntry as $value){
			$entitlements[$value->leave_type] = $value->entitlement - $value->taken - $value->on_hold;
		}
		$leave_types = LeaveTypeEntry::where('active','=',1)->get();
		$this->layout->content =  View::make('leaves.apply')->with('leave_types',$leave_types)->with('entitlements',$entitlements);	
	}
	public function apply_leave()
	{
		
		date_default_timezone_set('Singapore');
		$LeaveEntry = new LeaveEntry;
		$LeaveEntry->user_id = Auth::user()->id;
		$LeaveEntry->period_start = date('Y-m-d',strtotime(Input::get('period_start')));
		if ((Input::get('period_end') != ""))
			$period_end = Input::get('period_end');
		else
			$period_end = Input::get('period_start');
		$LeaveEntry->period_end = date('Y-m-d',strtotime($period_end));
		$LeaveEntry->start_duration = Input::get('start_duration');
		$LeaveEntry->end_duration = Input::get('end_duration');
		$LeaveEntry->applied_date = date('Y-m-d h:i:s', time());
		$LeaveEntry->reason = Input::get('comment');
		$LeaveEntry->leave_type = Input::get('leave_type'); 
		$LeaveEntry->term = TermEntry::where('active','=',1)->pluck('id');
		$LeaveEntry->save();
		$leaveid = DB::getPdo()->lastInsertId();
		$supervisors_id = SupervisorEntry::where('user_id','=',Auth::user()->id)->lists('supervisor_id');
		if (count($supervisors_id) > 0)
		{
				$supervisors = UserEntry::whereIn('id',$supervisors_id)->get();
		}
		else
			$supervisors = array();
//		$leavenotif = 123;
		
		$period_start = "";
		$period_end = "";
		if (Input::get('start_duration') == 2)
			$period_start = " Half Day";
		if (Input::get('end_duration') == 2)
			$period_end = "Half Day";
		foreach ($supervisors as $supervisor)
		{
			$data = array(
				'email' => $supervisor->email,
				'username' =>$supervisor->first_name." ".$supervisor->last_name,
				'start_date' => Input::get('period_start'),
				'end_date' => Input::get('period_end'),
				'period_start' => $period_start,
				'period_end' => $period_end,
				'id' => $leaveid
			);
			Mail::send('emails.leavenotification', $data, function($message) use ($data)
			{	
			//	for ($n = 0; $n < count($supervisors) ; $n++)
					$message->to($data['email'])->subject('Leave Application Notification');
			});
		}
		// Edit user's entitlement
        $start = new DateTime(date('Y-m-d',strtotime(Input::get('period_start'))));
		$end = new DateTime(date('Y-m-d',strtotime(Input::get('period_end'))));
		
		$diff = $start->diff($end);         
		if (Input::get('start_duration') == 2)
			$duration = 0.5;
		else
			$duration = $diff->days;
		
		if (Input::get('end_duration') == 2)
			$duration = $duration - 0.5;
		
		$entitlement = LeaveEntitlementEntry::where('user_id','=',Auth::user()->id)->where('leave_type','=',Input::get('leave_type'))->where('term','=',$this->activeperiod)->increment('on_hold',$duration);

		return Redirect::to('leaves/apply');
	}
	public function lists()
	{
		
        $suboordinates = SupervisorEntry::where('supervisor_id', '=',Auth::user()->id)->lists('user_id');
		$msg = "";
		if (count($suboordinates) > 0)
		{
			$leaves = LeaveEntry::where('term','=',$this->activeperiod)->wherein('user_id',$suboordinates)->where('status','=',0)->get();
			$past_leaves = LeaveEntry::where('term','=',$this->activeperiod)->wherein('user_id',$suboordinates)->where('status','!=',0)->get();
		}
		else
		{
			$msg = "You don't have any suboordinates";
			$leaves = array();
			$past_leaves = array();
		}
		$users = UserEntry::all();
		$this->layout->content =  View::make('leaves.lists')->with('leaves',$leaves)->with('past_leaves',$past_leaves)->with('users',$users)->with('msg',$msg);	
	}
	public function entitlement()
	{
		$leave_types = LeaveTypeEntry::where('active','=',1)->get();
		if (Auth::user()->role == 1)
			$users = UserEntry::all();
		else
		{
		    $suboordinates = SupervisorEntry::where('supervisor_id', '=',Auth::user()->id)->lists('user_id');
			if (count($suboordinates) > 0)
				$users = UserEntry::whereIn('id',$suboordinates)->get();
			else
				$users = array();
		}
		$this->layout->content =  View::make('leaves.entitlement')->with('leave_types',$leave_types)->with('users',$users);	
	}
	public function save_entitlement()
	{
		
		
		foreach (Input::get('users') as $key=>$value)
   		{
			for ($n = 0; $n < Input::get('alltypes'); $n++)
			{
				$cnt = LeaveEntitlementEntry::where('user_id','=',$value)->where('term','=',$this->activeperiod)->where('leave_type','=',Input::get('type'.$n))->count();
				if ($cnt == 0 && Input::get('amount'.$n) > 0)
				{
					$LeaveEntitlementEntry = new LeaveEntitlementEntry;
					$LeaveEntitlementEntry->user_id = $value;
					$LeaveEntitlementEntry->leave_type = Input::get('type'.$n);
					$LeaveEntitlementEntry->entitlement = Input::get('amount'.$n);
					$LeaveEntitlementEntry->term = $this->activeperiod;
					$LeaveEntitlementEntry->taken = 0;
					$LeaveEntitlementEntry->on_hold = 0;
					$LeaveEntitlementEntry->save();
				}
				else if (Input::get('amount'.$n) > 0)
				{
					$LeaveEntitlementEntry = LeaveEntitlementEntry::where('user_id','=',$value)->where('term','=',$this->activeperiod)->where('leave_type','=',Input::get('type'.$n))->increment('entitlement',Input::get('amount'.$n));
	
				}
			}
		}
		return Redirect::to('leaves/entitlement');
	}
	public function view_leave($id)
	{
		
		$leave = LeaveEntry::find($id);
		$user = UserEntry::find($leave->user_id);
		$entitlements = LeaveEntitlementEntry::where('user_id','=',$user->id)->where('term','=',$this->activeperiod)->get();
		$this->layout->content =  View::make('leaves.view')->with('leave',$leave)->with('user',$user)->with('entitlements',$entitlements);
		
	}
	public function answer_leave()
	{
		
		date_default_timezone_set('Singapore');
		$LeaveEntry = LeaveEntry::find(Input::get('leave_id'));
		$LeaveEntry->status = Input::get('answertype');
		$LeaveEntry->answer = Input::get('answer');
		$LeaveEntry->answered_by = Auth::user()->id;
		$LeaveEntry->answered_at = date('Y-m-d h:i:s', time());
		$LeaveEntry->update();
		
		LeaveEntitlementEntry::where('user_id','=',Input::get('applicant_id'))->where('leave_type','=',Input::get('leave_type'))->where('term','=',$this->activeperiod)->increment('on_hold',(Input::get('duration')*-1));
		if (Input::get('answertype') == 1)
			LeaveEntitlementEntry::where('user_id','=',Input::get('applicant_id'))->where('leave_type','=',Input::get('leave_type'))->where('term','=',$this->activeperiod)->increment('taken',Input::get('duration'));
		return Redirect::to('leaves');
	}
	public function listmyleaves()
	{
		
		$leaves = LeaveEntry::where('term','=',$this->activeperiod)->where('user_id','=',Auth::user()->id)->where('status','=',0)->get();
		$past_leaves = LeaveEntry::where('term','=',$this->activeperiod)->where('user_id','=',Auth::user()->id)->where('status','!=',0)->get();
		$users = UserEntry::all();
		$this->layout->content =  View::make('leaves.lists')->with('leaves',$leaves)->with('past_leaves',$past_leaves)->with('users',$users);	
	}
}
?>