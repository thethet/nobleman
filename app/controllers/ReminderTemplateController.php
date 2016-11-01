<?php

class ReminderTemplateController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $layout = "layouts.main";

	public function index()
	{
		//
	}

	/*  Reminder to students template */
	public function remindertostudentsTempalte()
	{
		if(Auth::user()->role ==1 ) {
			$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Students')->pluck('template_content');
			$this->layout->content =  View::make('remindertemplate.remindertostdtemplate')->with('template_content',$template_content);
		}//end if
	}


	public function remindertostudentsTempalteSave()
	{
		if(Auth::user()->role ==1 ) {	
			ReminderTemplateEntry::where("template_name", "=", 'Reminder Students')->update(array("template_content" => Input::get('email_content')));
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('remindertostudents-template');
		}//end if
	}


	/*  Reminder to trial students template */
	public function remindertotrialstudentsTempalte()
	{
		if(Auth::user()->role ==1 ) {
			$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Trial Students')->pluck('template_content');
			$this->layout->content =  View::make('remindertemplate.remindertotrialstdtemplate')->with('template_content',$template_content);
		}//end if
	}

	public function remindertotrialstudentsTempalteSave()
	{
		if(Auth::user()->role ==1 ) {	
			ReminderTemplateEntry::where("template_name", "=", 'Reminder Trial Students')->update(array("template_content" => Input::get('email_content')));
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('remindertotrialstudents-template');
		}//end if
	}


	/*  Reminder to trainer template */
	public function remindertotrainersTempalte()
	{
		if(Auth::user()->role ==1 ) {
			$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Trainers')->pluck('template_content');
			$this->layout->content =  View::make('remindertemplate.remindertotrainers')->with('template_content',$template_content);
		}//end if
	}

	public function remindertotrainersTempalteSave()
	{
		if(Auth::user()->role ==1 ) {	
			ReminderTemplateEntry::where("template_name", "=", 'Reminder Trainers')->update(array("template_content" => Input::get('email_content')));
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('remindertotrainers-template');
		}//end if
	}


	/*  Reminder for course expire template */
	public function reminderforcourseexpireTempalte()
	{
		if(Auth::user()->role ==1 ) {
			$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Courses Expire')->pluck('template_content');
			$this->layout->content =  View::make('remindertemplate.reminderforcourseexpire')->with('template_content',$template_content);
		}//end if
	}

	public function reminderforcourseexpireTempalteSave()
	{
		if(Auth::user()->role ==1 ) {	
			ReminderTemplateEntry::where("template_name", "=", 'Reminder Courses Expire')->update(array("template_content" => Input::get('email_content')));
			Session::flash('message', 'Successfully updated!');
			return Redirect::to('reminderforcourseexpire-template');
		}//end if
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
