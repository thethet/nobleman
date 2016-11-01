<?php

class StudentsRegisterMoreCourseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $layout = "layouts.main";
	protected $module_categories;

	public function __construct()
	{
		
		$this->module_categories = CoursesEntry::get();

		View::share('module_categories', $this->module_categories);
	}

	public function index()
	{
		if(Auth::user()->role == 3 ) {	
			$user_id = Auth::user()->id;	
			$std_id = StudentEntry::where('user_id','=',$user_id)->pluck('id');

			$reg_lists = StudentCourseEntry::where('student_id','=',$std_id)->get();

			$this->layout->content =  View::make('studentdashboard.registerdlists')->with('reglists',$reg_lists);
		}
	}

	public function createCourse()
	{
		if(Auth::user()->role == 3 ) {
			$courses = CoursesEntry::get();
			$this->layout->content =  View::make('studentdashboard.createcourse')->with('courses',$courses);
		}//end
	}

	public function storeCourse()
	{
		if(Auth::user()->role == 3 ) {
			$user_id = Auth::user()->id;	
			$std_id = StudentEntry::where('user_id','=',$user_id)->pluck('id');
			
			$rules = array(
						'course' => 'required|not_in:0',
						'payment_mode' => 'required|not_in:0'
					);
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails()){
				return Redirect::to('addmorecourse')
					->withErrors($validator);
			}else{
				$StudentCourseEntry = new StudentCourseEntry;

				if (Input::get('payment_mode') == 'Paypal') { 					
					$course_fee = CoursesEntry::where('id','=',Input::get('course'))->pluck('cost_of_course');

					$stdDataArr = array(
						    'std_id' => $std_id,
							'course_id' => Input::get('course'),
							'payment_mode' => Input::get('payment_mode')							
					);

					$stdData = http_build_query($stdDataArr);

					return Redirect::to('addmorecourse/paypal/'.$course_fee.'/'.$stdData);


				}else{

					$StudentCourseEntry->student_id = $std_id;
					$StudentCourseEntry->course_id = Input::get('course');
					$StudentCourseEntry->payment_mode = Input::get('payment_mode');
					
					date_default_timezone_set('Asia/Singapore');
					$date = date('Y-m-d', time());

					$StudentCourseEntry->date_of_registration = $date;

					$StudentCourseEntry ->save();

					return Redirect::to('registercourse');
				}
			}

		}
	}

	function linkpaypal($mf, $data)
	{
		$this->layout->content =  View::make('studentdashboard.paypalform')->with('coursefee', $mf)->with('stddata', $data);
	}


	function linkpaypalsuccess()
	{
		$StudentCourseEntry = new StudentCourseEntry;
		$StudentCourseEntry->student_id = Input::get('std_id');
		$StudentCourseEntry->course_id = Input::get('course_id');
		$StudentCourseEntry->payment_mode = Input::get('payment_mode');
		
		date_default_timezone_set('Asia/Singapore');
		$date = date('Y-m-d', time());

		$StudentCourseEntry->date_of_registration = $date;

		$StudentCourseEntry ->save();

		return Redirect::to('registercourse');
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
