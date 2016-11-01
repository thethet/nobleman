<?php

class AnnouncementController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	public function index()
	{
		$announcement = AnnouncementEntry::get();
		$studentCourse = StudentCourseEntry::get();
		$courses = CoursesEntry::get();
		$student = StudentEntry::get();
		$lessons = LessonsEntry::get();
		$this->layout->content =  View::make('announcement.index')
									->with('courses',$courses)
									->with('student',$student)
									->with('lessons',$lessons)
									->with('announcement',$announcement)
									->with('studentcourse',$studentCourse);

	}	

	public function stdannouncementshow()
	{
		$announcement = AnnouncementEntry::get();
		$studentCourse = StudentCourseEntry::get();
		$courses = CoursesEntry::get();
		$student = StudentEntry::get();
		$lessons = LessonsEntry::get();
		$this->layout->content =  View::make('announcement.stdannouncement')
									->with('courses',$courses)
									->with('student',$student)
									->with('lessons',$lessons)
									->with('announcement',$announcement)
									->with('studentcourse',$studentCourse);
	}

	// public function show($id)
	// {
	// 	//
	// 	//$Announcement = AnnouncementEntry::find($id);
	// 	$announcement = AnnouncementEntry::where('id','=',$id)->get();
	// 	return View::make('announcement.view')
	// 		->with('announcement', $announcement);
	// }





	public function lists()
	{
		$announcement = AnnouncementEntry::get();
		$this->layout->content =  View::make('announcement.view')
									->with('announcement',$announcement);

	}	
	
	public function create()
	{
		$announcement = AnnouncementEntry::get();
		$studentCourse= StudentCourseEntry::get();
		$courses = CoursesEntry::get();
		$student = StudentEntry::get();
		$lessons = LessonsEntry::get();
		$this->layout->content =  View::make('announcement.create')
									->with('courses',$courses)
									->with('student',$student)
									->with('lessons',$lessons)
									->with('announcement',$announcement)
									->with('studentcourse',$studentCourse);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$AnnouncementEntry = new AnnouncementEntry;
		$AnnouncementEntry->announcement_title = Input::get('announcement_title');
		$AnnouncementEntry->announcement_date = Input::get('announcement_date');
		$AnnouncementEntry->announcement_content = Input::get('announcement_content');
		$AnnouncementEntry->save();
		Session::flash('message', 'Successfully make appointment!');
		return Redirect::to('announcement');
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
		$announcement = AnnouncementEntry::find($id);
		//$announcement = AnnouncementEntry::where('id','=',$id)->get();
		return View::make('announcement.view')
			->with('announcement', $announcement);

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
			$id = Input::get('id');
			$rules = array(
				'announcement_title' => 'required',
				//'announcement_date' => 'required',
				'announcement_content' => 'required',
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('announcement/' . $id)
					->withErrors($validator);
			} else {
				$AnnouncementEntry = AnnouncementEntry::find(Input::get('id'));
				$AnnouncementEntry->id = Input::get('id');
				$AnnouncementEntry->announcement_title = Input::get('announcement_title');
				$AnnouncementEntry->announcement_date = Input::get('announcement_date');
				$AnnouncementEntry->announcement_content = Input::get('announcement_content');
				$AnnouncementEntry->save();

				Session::flash('message', 'Successfully created students!');
				return Redirect::to('announcement');
			}
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


	public function delete(){
		$id = Input::get('id');
		AnnouncementEntry::find($id)->delete();
		return Redirect::to('announcement');
	}
	


}
