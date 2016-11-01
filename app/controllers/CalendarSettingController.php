<?php

class CalendarSettingController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";

	public function __construct()
	{
		
	}

	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$courses = CoursesEntry::get();
		$this->layout->content = View::make('settings.index')->with('courses',$courses);
		}//end
	}



	public function show()
	{

		if(Auth::user()->role ==1 ) {

		echo '<h1>This page is under maintainance!</h1>';die;

		if (Input::get('course_id')) {
			$course_id = Input::get('course_id');
		}else{
			$first_mid = DB::table('courses')->orderBy('id', 'desc')->first();
			$course_id = $first_mid->id;
		}

		$SessionsEntry = new SessionsEntry;
		
		$course_count = SessionsEntry::where('course_id','=',$course_id)->count();

		$day_arr = array('Mon','Tue','Wed','Thur','Fri','Sat','Sun');
		if ($course_count == 0) {
			//For session A
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'A';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session B
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'B';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session C
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'C';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session D
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'D';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			$Mon = SessionsEntry::where('day','=','Mon')->where('course_id','=',$course_id)->get();		
			$Tue = SessionsEntry::where('day','=','Tue')->where('course_id','=',$course_id)->get();
			$Wed = SessionsEntry::where('day','=','Wed')->where('course_id','=',$course_id)->get();
			$Thur = SessionsEntry::where('day','=','Thur')->where('course_id','=',$course_id)->get();
			$Fri = SessionsEntry::where('day','=','Fri')->where('course_id','=',$course_id)->get();
			$Sat = SessionsEntry::where('day','=','Sat')->where('course_id','=',$course_id)->get();
			$Sun = SessionsEntry::where('day','=','Sun')->where('course_id','=',$course_id)->get();

			$courses = CoursesEntry::get();

			$this->layout->content =  View::make('settings.lessonsession')
									  ->with('Mon',$Mon)
									  ->with('Tue', $Tue)
									  ->with('Wed', $Wed)
									  ->with('Thur', $Thur)
									  ->with('Fri', $Fri)
									  ->with('Sat', $Sat)
									  ->with('Sun', $Sun)
									  ->with('courseid',$course_id)
									  ->with('courses',$courses);



		}else{
			$Mon = SessionsEntry::where('day','=','Mon')->where('course_id','=',$course_id)->get();		
			$Tue = SessionsEntry::where('day','=','Tue')->where('course_id','=',$course_id)->get();
			$Wed = SessionsEntry::where('day','=','Wed')->where('course_id','=',$course_id)->get();
			$Thur = SessionsEntry::where('day','=','Thur')->where('course_id','=',$course_id)->get();
			$Fri = SessionsEntry::where('day','=','Fri')->where('course_id','=',$course_id)->get();
			$Sat = SessionsEntry::where('day','=','Sat')->where('course_id','=',$course_id)->get();
			$Sun = SessionsEntry::where('day','=','Sun')->where('course_id','=',$course_id)->get();

			$courses = CoursesEntry::get();

			$this->layout->content =  View::make('settings.lessonsession')
									  ->with('Mon',$Mon)
									  ->with('Tue', $Tue)
									  ->with('Wed', $Wed)
									  ->with('Thur', $Thur)
									  ->with('Fri', $Fri)
									  ->with('Sat', $Sat)
									  ->with('Sun', $Sun)
									  ->with('courseid',$course_id)
									  ->with('courses',$courses);
		}

		}//end
		
	}

	public function store()
	{             
		if(Auth::user()->role ==1 ) {
		$secAArr = Input::get('SecA');
		$secBArr = Input::get('SecB');
		$secCArr = Input::get('SecC');
		$secDArr = Input::get('SecD');  

		$course_id = Input::get('course_id');

		/*$foo = array();
		for ($i = 0; $i < 7; $i++) {
			$foo[$i] = in_array($i, Input::get('SecB')) ? 'on' : 'off';
		}*/
                
        //reset all the session status
        $SessionsEntry = new SessionsEntry;		
		//SessionsEntry::where("course_id", "=", $course_id)->where("status", "=", "1")->update(array("status" => 0));

		$course_count = SessionsEntry::where('course_id','=',$course_id)->count();

		$day_arr = array('Mon','Tue','Wed','Thur','Fri','Sat','Sun');
		if ($course_count == 0) {
			//For session A
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'A';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session B
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'B';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session C
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'C';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

			//For session D
			for($i=0;$i<count($day_arr);$i++){
				$SessionsEntry = new SessionsEntry;
				$SessionsEntry->day = $day_arr[$i];
				$SessionsEntry->session = 'D';
				$SessionsEntry->course_id = $course_id;
				$SessionsEntry->save();
			}

		}else{
			$SessionsEntry = new SessionsEntry;		
			SessionsEntry::where("course_id", "=", $course_id)->where("status", "=", "1")->update(array("status" => 0));
		
		}//end if


		/*$queries = DB::getQueryLog();
		$last_query = end($queries);
		print_r($last_query);die;*/
                              
        //change session status for all checked value session

		if(isset($secAArr)){        
			foreach ($secAArr as $sec_a) {				
				$secA_id = SessionsEntry::where('session', '=', 'A')->where('day', '=', $sec_a)->where("course_id", "=", $course_id)->pluck('id');				
				$SessionsEntry = SessionsEntry::find($secA_id);
				$SessionsEntry->status = 1;
				$SessionsEntry->save();
			}
		}


		if(isset($secBArr)){
			foreach ($secBArr as $sec_b) {
				$secB_id = SessionsEntry::where('session', '=', 'B')->where('day', '=', $sec_b)->where("course_id", "=", $course_id)->pluck('id');
				DB::table('lesson_sessions')->where('session', '=', 'B')->where('day', '=', $sec_b)->where("course_id", "=", $course_id)->toSql();
				$SessionsEntry = SessionsEntry::find($secB_id);
				$SessionsEntry->status = 1;
				$SessionsEntry->save();
				//print_r($secB_id.'<br />');	
			    //SessionsEntry::where("id", "=", $secB_id)->update(array("status" => 1));
			}
		}



		if(isset($secCArr)){
			foreach ($secCArr as $sec_c) {
				$secC_id = SessionsEntry::where('session', '=', 'C')->where('day', '=', $sec_c)->where("course_id", "=", $course_id)->pluck('id');
				$SessionsEntry = SessionsEntry::find($secC_id);
				$SessionsEntry->status = 1;
				$SessionsEntry->save();
			}
		}

		if(isset($secDArr)){
			foreach ($secDArr as $sec_d) {
				$secD_id = SessionsEntry::where('session', '=', 'D')->where('day', '=', $sec_d)->where("course_id", "=", $course_id)->pluck('id');
				$SessionsEntry = SessionsEntry::find($secD_id);
				$SessionsEntry->status = 1;
				$SessionsEntry->save();
			}
		}

		$Mon = SessionsEntry::where('day','=','Mon')->where('course_id','=',$course_id)->get();	
		$Tue = SessionsEntry::where('day','=','Tue')->where('course_id','=',$course_id)->get();
		$Wed = SessionsEntry::where('day','=','Wed')->where('course_id','=',$course_id)->get();
		$Thur = SessionsEntry::where('day','=','Thur')->where('course_id','=',$course_id)->get();
		$Fri = SessionsEntry::where('day','=','Fri')->where('course_id','=',$course_id)->get();
		$Sat = SessionsEntry::where('day','=','Sat')->where('course_id','=',$course_id)->get();
		$Sun = SessionsEntry::where('day','=','Sun')->where('course_id','=',$course_id)->get();
		
		Session::flash('message', 'Successfully created session!');

		$courses = CoursesEntry::get();

		$this->layout->content =  View::make('settings.lessonsession')
									->with('Mon',$Mon)
									->with('Tue', $Tue)
									->with('Wed', $Wed)
									->with('Thur', $Thur)
									->with('Fri', $Fri)
									->with('Sat', $Sat)
									->with('Sun', $Sun)
									//->with('courseid',$course_id)
									->with('courses',$courses);
		}//end
	}

	

}//end class
