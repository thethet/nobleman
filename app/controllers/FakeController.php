<?php

class FakeController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	public function students()
	{
		$this->layout->content =  View::make('fake.students');	
	}
	public function courses()
	{
		$this->layout->content =  View::make('fake.courses');	
	}
	public function courses_create()
	{
		$this->layout->content =  View::make('courses.create');
	}
	public function courses_edit()
	{
		$this->layout->content =  View::make('courses.edit');
	}
	public function modules()
	{
		$this->layout->content =  View::make('fake.module');
	}
	public function attendance()
	{
		$this->layout->content =  View::make('fake.attendance');	
	}
	public function trainers()
	{
		$this->layout->content =  View::make('fake.trainers');	
	}
	public function users()
	{
		$this->layout->content =  View::make('fake.admins');
	}
	public function users_create()
	{
		$user_roles = UserRoleEntry::get();
		$countries = CountryEntry::get();
		$this->layout->content =  View::make('users.create')->with('countries',$countries)->with('user_roles',$user_roles);
	}
	public function markattendance()
	{
		$this->layout->content =  View::make('fake.markattendance');	
	}
	public function marksheetattendance()
	{
		$this->layout->content =  View::make('fake.marksheetattendance');	
	}
}
?>