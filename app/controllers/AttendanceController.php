<?php

class AttendanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$appointment = AppointmentEntry::where('booking_status','=','book')->orderBy('date', 'desc')->get();
		$studentCourse = StudentCourseEntry::get();
		$courses = CoursesEntry::get();
		$student = StudentEntry::get();
		$lessons = LessonsEntry::get();
		$trainers = TrainersEntry::get();

		$today_date = date('Y-m-d', time());
		$this->layout->content =  View::make('attandance.adminlists')
									->with('courses',$courses)
									->with('student',$student)
									->with('lessons',$lessons)
									->with('appointment',$appointment)
									->with('studentcourse',$studentCourse)
									->with('showdate',$today_date)
									->with('trainers',$trainers);
		}//end
	}
   

	public function create()
	{
		if(Auth::user()->role ==1 ) {
		$courses = CoursesEntry::get();
		$this->layout->content =  View::make('attandance.create')
								  ->with('courses',$courses);
		}//end						
	}


	public function book()
	{
		if(Auth::user()->role ==1 ) {
		$course = CourseEntry::get();
		$this->layout->content =  View::make('appointment.book')
									->with('course',$course);
		}//end
	}
	public function lists()
	{
		if(Auth::user()->role ==1 ) {
		$this->layout->content =  View::make('appointment.lists');
		}//end
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function mark()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');

		$trainer_id = Auth::user()->id;
		$lesson_id = Input::get('lesson');

		DB::table('appointment')
            ->where('id','=',$id)
            ->update(['attend' => 1, 'trainer_id' => $trainer_id, 'lesson_id' => $lesson_id]);


		Session::flash('message', 'Successfully mark attendance!');
		return Redirect::to('attendance');
		}//end
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


	function export()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",".'Course Name' . ",".'Trainer Name'. ",".'Session' . ",".'Date'."," .'Attendance' . ",";			   

			   $attendance_query = DB::select("SELECT st.name,m.course_name,t.trainer_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id  LEFT JOIN trainers AS t ON t.user_id=ap.trainer_id WHERE ap.booking_status='book'");


			   foreach( $attendance_query as $row )
				{
				    $line = '';
				    foreach( $row as $value )
				    {                                            
				        if ( ( !isset( $value ) ) || ( $value == "" ) )
				        {
				            //$value = "\t";
				            $value = str_replace( '"' , '""' , $value );
			            	$value = $value. ",";
				        }
				        else
				        {
				            $value = str_replace( '"' , '""' , $value );
                			$value = $value. ",";
				        }
				        $line .= $value;
				    }
				    $data .= trim(strip_tags($line)) . "\n";
				}
				$data = str_replace("\r" , "" , $data);

				
				//ob_end_clean();
				
			
	   			$csv_data= "$header\n$data";
				
				print $csv_data;
				exit;



		}//end
	}


	public function datefilter()
	{
		if (Auth::user()->role == 1) {
			$today_date = date('Y-m-d', time());

			$fromdate = Input::get('fromdate');
			$todate = Input::get('todate');
			$trainer_id = Input::get('trainer');
			$module_id = Input::get('module');
			/*if ($getdate == '') {
				$date = date('Y-m-d', time());				
				$getdate_appointments = AppointmentEntry::where('date','=',$date)->orderBy('date', 'desc')->get();
			}else{
				$getdate_appointments = AppointmentEntry::where('date','=',$getdate)->orderBy('date', 'desc')->get();
			}*/

			$q = AppointmentEntry::query();



			if ($fromdate == ''&&$todate=='') {
				$date = date('Y-m-d', time());				
				/*$getappointments = AppointmentEntry::where('date','=',$date)->where('trainer_id','=',$trainer_id)->where('module_id','=',$module_id)->orderBy('date', 'desc')->get();*/
				//$getappointments_a = AppointmentEntry::where('date','=',$date)->get();
				//$q->where('date','=',$date);
			}else{
				/*$getappointments = AppointmentEntry::where('date','=',$getdate)->where('trainer_id','=',$trainer_id)->where('module_id','=',$module_id)->orderBy('date', 'desc')->get();*/
				//$getappointments_a = AppointmentEntry::where('date','=',$getdate)->get();

				$q->whereBetween('date',[$fromdate,$todate]);
			}

			if ($trainer_id != 0) {				
				$q->where('trainer_id','=',$trainer_id);
			}

			if ($module_id != 0) {
				$q->where('course_id','=',$module_id);
			}

			$getappointments = $q->where('booking_status','=','book')->orderBy('date', 'desc')->get();
			
			$studentCourse = StudentCourseEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();
			$lessons = LessonsEntry::get();
			$trainers = TrainersEntry::get();
			
			$this->layout->content =  View::make('attandance.adminfilter')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)
										->with('appointment',$getappointments)
										->with('studentcourse',$studentCourse)
										->with('from_date',$fromdate)
										->with('to_date',$todate)
										->with('todaydate',$today_date)
										->with('trainers',$trainers)
										->with('trainer_id',$trainer_id)
										->with('module_id',$module_id);
		}//end
	}


	function filterexport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Course Name' . ",\t".'Session' . ",\t".'Date' .",\t".'Attendance' . ",\t";

			   /* $getdate = Input::get('getdate');
				$getdate_set = trim($getdate);
				$gettrainer_id = Input::get('gettrainerid');
				$getmodule_id = Input::get('getmoduleid');*/

				$getfromdate = Input::get('getfromdate');
				$getfromdate_set = trim($getfromdate);
				$gettodate = Input::get('gettodate');
				$gettodate_set = trim($gettodate);
				$gettrainer_id = Input::get('gettrainerid');
				$getmodule_id = Input::get('getmoduleid');

				
				if ($getfromdate_set == '' && $gettodate_set == '') {
					if ($gettrainer_id == 0 && $getmodule_id == 0) {
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE ap.booking_status='book' ");
					}elseif ($gettrainer_id != 0 && $getmodule_id != 0){
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE ap.trainer_id='".$gettrainer_id."' AND ap.course_id='".$getmodule_id."' AND ap.booking_status='book' ");
					}elseif ($gettrainer_id == 0 && $getmodule_id != 0){
					
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE ap.course_id='".$getmodule_id."' AND ap.booking_status='book' ");
					}elseif ($gettrainer_id != 0 && $getmodule_id == 0){
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE ap.trainer_id='".$gettrainer_id."' AND ap.booking_status='book' ");
					}

				}else{				
					if ($gettrainer_id == 0 && $getmodule_id == 0) {
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE (ap.date BETWEEN '".$getfromdate_set."' AND '".$gettodate_set."') AND ap.booking_status='book' ");
					}elseif ($gettrainer_id != 0 && $getmodule_id != 0){
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE (ap.date BETWEEN '".$getfromdate_set."' AND '".$gettodate_set."') AND ap.trainer_id='".$gettrainer_id."' AND ap.module_id='".$getmodule_id."' AND ap.booking_status='book' ");
					}elseif ($gettrainer_id == 0 && $getmodule_id != 0){
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE (ap.date BETWEEN '".$getfromdate_set."' AND '".$gettodate_set."') AND ap.course_id='".$getmodule_id."' AND ap.booking_status='book' ");
					}elseif ($gettrainer_id != 0 && $getmodule_id == 0){
						$attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date,case ap.attend when '1' then 'Attended' when '0' then 'Absent' when 'N/A' then 'N/A' end as attend FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE (ap.date BETWEEN '".$getfromdate_set."' AND '".$gettodate_set."') AND ap.trainer_id='".$gettrainer_id."' AND ap.booking_status='book' ");
					}
				}

			   foreach( $attendance_query as $row )
				{
				    $line = '';
				    foreach( $row as $value )
				    {                                            
				        if ( ( !isset( $value ) ) || ( $value == "" ) )
				        {
				            //$value = "\t";
				            $value = str_replace( '"' , '""' , $value );
			            	$value = $value. ",\t";
				        }
				        else
				        {
				            $value = str_replace( '"' , '""' , $value );
                			$value = $value. ",\t";
				        }
				        $line .= $value;
				    }
				    $data .= trim(strip_tags($line)) . "\n";
				}
				$data = str_replace("\r" , "" , $data);

				
				//ob_end_clean();
				
			
	   			$csv_data= "$header\n$data";
				
				print $csv_data;
				exit;



		}//end
	}


}//End Class
