<?php

class SettingsController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	// Leave Types
	public function get_leave_types()
	{
	    $leave_types = LeaveTypeEntry::all();
		$this->layout->content =  View::make('settings.leave_type')->with('leave_types',$leave_types);	
	}
	public function add_leave_type()
	{
	    $LeaveTypeEntry = new LeaveTypeEntry;
		$LeaveTypeEntry->name = Input::get('leave_type');
		$LeaveTypeEntry->save();
	   	
	    $leave_types = LeaveTypeEntry::all();
		$this->layout->content =  View::make('settings.leave_type')->with('leave_types',$leave_types);	
	}
	public function delete_leave_types()
	{
		for ($n = 0; $n < Input::get('numberoftypes'); $n++)
		{
			if (Input::get('del'.$n))
			{
	   			LeaveTypeEntry::find(Input::get('del'.$n))->delete();
			}
		}
	   	
	    $leave_types = LeaveTypeEntry::all();
		$this->layout->content =  View::make('settings.leave_type')->with('leave_types',$leave_types);	
	}
	
	public function update_status()
	{
		$LeaveTypeEntry = LeaveTypeEntry::find(Input::get('leave_type'));
		if ($LeaveTypeEntry->active == 0)
			$LeaveTypeEntry->active = 1;
		else
			$LeaveTypeEntry->active = 0;
		$LeaveTypeEntry->save();
		return Redirect::to('leave_types');
	}
	
	// Leave Periods
	public function get_term()
	{
		$leave_period = TermEntry::all();
		$amount_forwardable = SettingEntry::find(0);
		$activeperiod = TermEntry::where('active','=',1)->pluck('period_start');
		$this->layout->content =  View::make('settings.leave_period')->with('leave_period',$leave_period)->with('activeperiod',$activeperiod)->with('amount_forwardable',$amount_forwardable);	
	}
	public function set_term()
	{
		DB::table('terms')->update(array('active'=>0));
		$count = TermEntry::where('period_start','=',Input::get('leave_period').'-01-01')->count();
		if ($count == 1)			
			$TermEntry = TermEntry::where('period_start','=',Input::get('leave_period').'-01-01')->update(array("active"=>"1"));
		else
		{
			$TermEntry = new TermEntry;
			$TermEntry->period_start = Input::get('leave_period').'-01-01';
			$TermEntry->period_end = Input::get('leave_period').'-12-31';
			$TermEntry->active = 1;
			$TermEntry->save();
		}
		
		$this->get_term();
	}
	public function add_forwardable()
	{
		$count = SettingEntry::where('id','=',0)->count();
		if ($count > 0)
		{
			$SettingEntry = SettingEntry::find(0);
		}
		else
		{
			$SettingEntry = new SettingEntry;
		}
		$SettingEntry->leave_amount_forwardable = Input::get('leaves_amount');
		$SettingEntry->leave_forwardable_limit = Input::get('days');
		$SettingEntry->save();
		$this->get_term();
	}
	public function show_cpf()
	{
		$cpf = CPFEntry::first();
		$this->layout->content =  View::make('settings.cpf')->with('cpf',$cpf);	
	}
	public function set_cpf()
	{
		$CPFEntry = CPFEntry::find(1);
		$CPFEntry->below_35 = Input::get('below_35');
		$CPFEntry->between_45 = Input::get('between_45');
		$CPFEntry->between_50 = Input::get('between_50');
		$CPFEntry->between_55 = Input::get('between_55');
		$CPFEntry->between_60 = Input::get('between_60');
		$CPFEntry->between_65 = Input::get('between_65');
		$CPFEntry->above_65 = Input::get('above_65');
		$CPFEntry->save();
		
		$cpf = CPFEntry::first();
		$this->layout->content =  View::make('settings.cpf')->with('cpf',$cpf);	
	}
	public function get_public_holidays()
	{
		$activeperiod = TermEntry::where('active','=',1)->first();
	    $public_holidays = PublicHolidayEntry::where('date','>=',$activeperiod->period_start)->where('date','<=',$activeperiod->period_end)->get();
		$this->layout->content =  View::make('settings.public_holiday')->with('public_holidays',$public_holidays);	
	}
	public function add_public_holiday()
	{
		$activeperiod = TermEntry::where('active','=',1)->first();
	    $PublicHolidayEntry = new PublicHolidayEntry;
		$PublicHolidayEntry->name = Input::get('public_holiday');
		$PublicHolidayEntry->date = date('Y-m-d',strtotime(Input::get('date')."-".Input::get('month')."-".date('Y',strtotime($activeperiod->period_start))));

		$PublicHolidayEntry->save();
	   	
	    $public_holidays = PublicHolidayEntry::all();
		$this->layout->content =  View::make('settings.public_holiday')->with('public_holidays',$public_holidays);	
	}
	public function delete_public_holidays()
	{
		for ($n = 0; $n < Input::get('numberoftypes'); $n++)
		{
			if (Input::get('del'.$n))
			{
	   			PublicHolidayEntry::find(Input::get('del'.$n))->delete();
			}
		}
	   	
	    $public_holidays = PublicHolidayEntry::all();
		$this->layout->content =  View::make('settings.public_holiday')->with('public_holidays',$public_holidays);	
	}
	public function update_holiday_status()
	{
		$PublicHolidayEntry = PublicHolidayEntry::find(Input::get('public_holiday'));
		if ($PublicHolidayEntry->status == 0)
			$PublicHolidayEntry->status = 1;
		else
			$PublicHolidayEntry->status = 0;
		$PublicHolidayEntry->save();
		return Redirect::to('public_holidays');
	}
}
?>