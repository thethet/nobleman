<?php

class UsersController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function lists()
	{
		$users = UserEntry::get();
		$this->layout->content =  View::make('users.lists')->with('users',$users);	
	}
	public function create()
	{
		$user_roles = UserRoleEntry::get();
		$countries = CountryEntry::get();
		$this->layout->content =  View::make('users.create')->with('countries',$countries)->with('user_roles',$user_roles);	
	}
	public function view($id)
	{
		$user = UserEntry::find($id);
		$blacklist = array();
		$n = 0;
		// Limit the option to only those users that are not supervisors nor suborrdinates
		foreach ($supervisors as $key=>$value)
		{
				$blacklist[$n++] = $value->supervisor_id;
		}
		foreach ($suboordinates as $key=>$value)
		{
				$blacklist[$n++] = $value->user_id;
		}
		// Omit the users that already supervisors nor suboordinates from the option, if it doesn't exits, just select all
		if (count($blacklist) > 0)
			$users = UserEntry::whereNotIn('id',$blacklist)->get();
		else
			$users = UserEntry::all();
			
		$user_roles = UserRoleEntry::get();
		$countries = CountryEntry::get();
		 return View::make('users.view')
			->with('countries',$countries)
            ->with('user', $user)
            ->with('users', $users)
			->with('supervisors',$supervisors)
			->with('suboordinates',$suboordinates)
            ->with('user_roles', $user_roles);
	}
	
	public function delete()
	{
		$id = Input::get('id');
		UserEntry::find($id)->delete();
		return Redirect::to('users');
	}
	public function store()
	{
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');
		if ($password == $cfm_password)
		{
			$rules = array(
				'first_name'     => 'required',
				'show_id'      => 'required|unique:users',
				'email'			=> 'unique:users',
			);
			$validator = Validator::make(Input::all(), $rules);
	
			if ($validator->fails()) {
				return Redirect::to('users/create')
					->withErrors($validator);
			} else {
				$UserEntry = new UserEntry;
				$UserEntry->show_id       = Input::get('show_id');
				$UserEntry->first_name       = Input::get('first_name');
				$UserEntry->last_name	   = Input::get('last_name');
				$UserEntry->password	   = Hash::make($password);
				$UserEntry->dob       =  date('Y-m-d', strtotime(Input::get('dob')));
				$UserEntry->email		   = Input::get('email');
				$UserEntry->address	   = Input::get('address');
				$UserEntry->contact       = Input::get('contact');
				$UserEntry->role		   = Input::get('role');
				$UserEntry->country		   = Input::get('country');
				$UserEntry->race		   = Input::get('race');
				$UserEntry->gender		   = Input::get('gender');
				$UserEntry->position		   = Input::get('position');
				$UserEntry->nationality		   = Input::get('nationality');
				$UserEntry->status		   = 1;
				date_default_timezone_set('Singapore');
				$date = date('Y-m-d h:i:s', time());
				$UserEntry->created_at		   = $date;
				$UserEntry->updated_at		   = $date;
				$UserEntry->updated_by		   = Auth::user()->id;
				$UserEntry->save();
	
				Session::flash('message', 'Successfully created users!');
				return Redirect::to('users');
			}
		}
	}
	public function edit()
	{
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');
		if ($password == $cfm_password)
		{
			$rules = array(
				'first_name'     => 'required',
				'show_id'      => 'required'
			);
			$validator = Validator::make(Input::all(), $rules);
	
			if ($validator->fails()) {
				return Redirect::to('users/create')
					->withErrors($validator);
			} else {
				$UserEntry = UserEntry::find(Input::get('id'));
				$UserEntry->show_id       = Input::get('show_id');
				$UserEntry->salutation       = Input::get('salutation');
				$UserEntry->first_name       = Input::get('first_name');
				$UserEntry->last_name	   = Input::get('last_name');
				if ($password != "")
					$UserEntry->password	   = Hash::make($password);
				$UserEntry->dob       =  date('Y-m-d', strtotime(Input::get('dob')));
				$UserEntry->email		   = Input::get('email');
				$UserEntry->address	   = Input::get('address');
				$UserEntry->contact       = Input::get('contact');
				$UserEntry->role		   = Input::get('role');
				$UserEntry->payroll		   = Input::get('payroll');
				$UserEntry->country		   = Input::get('country');
				$UserEntry->race		   = Input::get('race');
				$UserEntry->gender		   = Input::get('gender');
				$UserEntry->marital_status		   = Input::get('marital_status');
				$UserEntry->position		   = Input::get('position');
				$UserEntry->nationality		   = Input::get('nationality');
				$UserEntry->status		   = 1;
				$UserEntry->next_to_kin		   = Input::get('next_to_kin');
				$UserEntry->next_to_kin_relationship		   = Input::get('next_to_kin_relationship');
				$UserEntry->next_to_kin_contact		   = Input::get('next_to_kin_contact');
				date_default_timezone_set('Singapore');
				$date = date('Y-m-d h:i:s', time());
				$UserEntry->updated_at		   = $date;
				$UserEntry->updated_by		   = Auth::user()->id;
				$UserEntry->save();
	
				Session::flash('message', 'Successfully edited users!');
				return Redirect::to('users');
			}
		}
	}
	public function delete_supervisor()
	{
		$SupervisorEntry = SupervisorEntry::find(Input::get('id'))->delete();
		return Redirect::to('users/'.Input::get('user_id'));
	}
	public function delete_suboordinate()
	{
		$SupervisorEntry = SupervisorEntry::find(Input::get('id'))->delete();
		return Redirect::to('users/'.Input::get('user_id'));
	}
	
	public function add_supervisor()
	{
		$SupervisorEntry = new SupervisorEntry;
		$SupervisorEntry->user_id = Input::get('user_id');
		$SupervisorEntry->supervisor_id = Input::get('supervisor_id');
		$SupervisorEntry->save();
		return Redirect::to('users/'.Input::get('user_id'));
	}
	public function add_suboordinate()
	{
		$SupervisorEntry = new SupervisorEntry;
		$SupervisorEntry->user_id =  Input::get('suboordinate_id');
		$SupervisorEntry->supervisor_id = Input::get('user_id');
		$SupervisorEntry->save();
		return Redirect::to('users/'.Input::get('user_id'));
	}
	public function list_user_roles()
	{
		$user_roles = UserRoleEntry::get();
		$this->layout->content =  View::make('users.roles')->with('user_roles',$user_roles);	
	}
	public function delete_user_role()
	{
		$id = Input::get('id');
		UserRoleEntry::find('id')->delete();
		return Redirect::to('users/roles');
	}
}
?>