<?php

class AppointmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	public function index()
	{
		$aid = Auth::user()->id;
		$mail = UserEntry::where('id','=',$aid)->pluck('email');
		$sid = StudentEntry::where('email','=',$mail)->pluck('id');
		$studentCourse = StudentCourseEntry::where('student_id','=',$sid)->get();;
		$courses = CoursesEntry::get();
		$this->layout->content =  View::make('appointment.index')
									->with('courses',$courses)
									->with('studentcourse',$studentCourse);
	}

	public function book()
	{
		$aid = Auth::user()->id;
		$mail = UserEntry::where('id','=',$aid)->pluck('email');
		$sid = StudentEntry::where('email','=',$mail)->pluck('id');
		$studentCourse = StudentCourseEntry::where('student_id','=',$sid)->get();
		$courses = CoursesEntry::get();
		$this->layout->content =  View::make('appointment.book')
									->with('courses',$courses)
									->with('studentcourse',$studentCourse);
	}
	public function lists($id)
	{
		$aid = Auth::user()->id;
		$mail = UserEntry::where('id','=',$aid)->pluck('email');

		
		$sid = StudentEntry::where('email','=',$mail)->pluck('id');
		$studentCourse = AppointmentEntry::where('student_id','=',$sid)->where('course_id','=',$id)->where('booking_status','=','book')->get();
		$courses = CoursesEntry::get();
		$lessons = LessonsEntry::get();
		$this->layout->content =  View::make('appointment.lists')
									->with('courses',$courses)
									->with('lessons',$lessons)
									->with('studentcourse',$studentCourse);
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
		$aid = Auth::user()->id;
		$mail = UserEntry::where('id','=',$aid)->pluck('email');
		$sid = StudentEntry::where('email','=',$mail)->pluck('id');
		//$checks = AppointmentEntry::where('student_id','=',Auth::user()->id)->where('date','=',Input::get('date'))->where('session','=',Input::get('session'))->count();
		$checks = AppointmentEntry::where('student_id','=',$sid)->where('date','=',Input::get('date'))->where('session','=',Input::get('session'))->count();

		if($checks >= 1){
			$validator = 'You Have Made An Appointment On This Session Before.';
			return Redirect::to('appointment/book')
				->withErrors($validator);
		}
		else{

			$rules = array(
					'course' => 'required',
					'date' => 'required',
					'session' => 'required',
				);
				$validator = Validator::make(Input::all(), $rules);

				if ($validator->fails()) {
					return Redirect::to('appointment/book')
						->withErrors($validator);
				} else {

					//check school holiday
					$date = input::get('date');
					$holiday_count = HolidaysEntry::where('hf_date','=',$date)->count();
					if ($holiday_count != 0) {
						$validator = 'School is closed for this day!';
						return Redirect::to('appointment/book')
							->withErrors($validator);
					}

					//check empty session
					$day = date("D", strtotime($date));
					$course_id = Input::get('course');
					$course_name = CoursesEntry::where('id','=',$course_id)->pluck('course_name');

					$session_count = SessionsEntry::where('day','=',$day)->where('course_id','=',$course_id)->where('status','=',1)->count();
					if ($session_count == 0) {
						$validator = 'There is no session on this day!';


						return Redirect::to('appointm

							ent/book')
							->withErrors($validator);
					}

					$count = AppointmentEntry::where('date','=',Input::get('date'))->where('session','=',Input::get('session'))->count();
					if($count > 13) {
						$validator = 'This Session Is FULL! Please Choose Another Session.';
						return Redirect::to('appointment/book')
							->withErrors($validator);
					}			

					//$check_booking_limit = AppointmentEntry::where('student_id','=',$sid)->where('course_id','=',Input::get('course'))->count();
					$check_booking_limit = AppointmentEntry::where('student_id','=',$sid)->where('course_id','=',Input::get('course'))->where('booking_status','=','book')->count();
					
					$no_lessons = coursesentry::where('id','=',Input::get('course'))->pluck('no_of_lesson');

					if($check_booking_limit >= $no_lessons){
						$validator = 'Sorry! You can not book for this course!';
						return Redirect::to('appointment/book')
							->withErrors($validator);
					}
					

					$studentcourseentry = new AppointmentEntry;
					$studentcourseentry->student_id = $sid;

					$studentcourseentry->course_id = Input::get('course');
					$studentcourseentry->date = Input::get('date');
					$studentcourseentry->session = Input::get('session');
					$studentcourseentry->attend = 'N/A';
					$studentcourseentry->booking_status = 'book';
					date_default_timezone_set('Asia/Singapore');
					$createtime = date('Y-m-d h:i:s', time());
					$studentcourseentry->created_date = $createtime;
					$studentcourseentry->save();
					Session::flash('message', 'Successfully make appointment!');
					return Redirect::to('appointment');
				}
			
		}

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



	public function delete()
	{
		$id = Input::get('id');
		AppointmentEntry::find($id)->delete();
		return Redirect::to('appointment');

	}


}
