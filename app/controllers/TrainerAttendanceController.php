<?php

class TrainerAttendanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	public function index()
	{
		if(Auth::user()->role == 2 ) {		

		$today_date = date('Y-m-d', time());
		$appointment = AppointmentEntry::where('booking_status','=','book')->orderBy('date', 'desc')->get();
		//$appointment = AppointmentEntry::where('date','=',$today_date)->orderBy('date', 'desc')->get();

		$studentCourse = StudentCourseEntry::get();
		$courses = CoursesEntry::get();
		$student = StudentEntry::get();
		$lessons = LessonsEntry::get();

		$trainer_id = Auth::user()->id;
		//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('date','=',$today_date)->get();

		$trainer_schedule = DB::table('trainer_schedule as ts')
            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
            ->where('trainer_id','=',$trainer_id)
            ->where('date','=',$today_date)
            ->get();


		$this->layout->content =  View::make('attandance.lists')
									->with('courses',$courses)
									->with('student',$student)
									->with('lessons',$lessons)
									->with('appointment',$appointment)
									->with('studentcourse',$studentCourse)
									->with('showdate',$today_date)
									->with('trainerid',$trainer_id)
									->with('trainer_schedule',$trainer_schedule);
		}//end
	}


	public function mark()
	{
		if(Auth::user()->role == 2 ) {
		$id = Input::get('id');

		$trainer_id = Auth::user()->id;
		$lesson_id = Input::get('lesson');

			if(Input::get('attend') == 1){				

				DB::table('appointment')
		            ->where('id','=',$id)
		            ->update(['attend' => 1, 'trainer_id' => $trainer_id, 'lesson_id' => $lesson_id]);

				Session::flash('message', 'Successfully mark attendance!');
				return Redirect::to('trainer/attendance');
			}else{
				
				DB::table('appointment')
		            ->where('id','=',$id)
		            ->update(['attend' => 0, 'trainer_id' => $trainer_id, 'lesson_id' => $lesson_id]);

				Session::flash('message', 'Successfully mark attendance!');
				return Redirect::to('trainer/attendance');
			}

		}//end
	}

	public function markflt()
	{
		if(Auth::user()->role == 2 ) {
		$id = Input::get('id');

		$trainer_id = Auth::user()->id;
		$lesson_id = Input::get('lesson');

			$today_date = date('Y-m-d', time());
			$getdate = Input::get('getdate');		
			//$getdate = '2016-04-30';		 	
			$studentCourse = StudentCourseEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();
			$lessons = LessonsEntry::get();

			if ($getdate == '') {
				$date = date('Y-m-d', time());				
				$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('date','=',$date)->get();
			}else{
				$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('date','=',$getdate)->get();
			}

			if(Input::get('attend') == 1){				

				DB::table('appointment')
		            ->where('id','=',$id)
		            ->update(['attend' => 1, 'trainer_id' => $trainer_id, 'lesson_id' => $lesson_id]);

			$this->layout->content =  View::make('attandance.filter')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)										
										->with('studentcourse',$studentCourse)
										->with('getdate',$getdate)
										->with('todaydate',$today_date)
										->with('trainerid',$trainer_id)
										->with('trainer_schedule',$trainer_schedule);
				
			}else{
				
				DB::table('appointment')
		            ->where('id','=',$id)
		            ->update(['attend' => 0, 'trainer_id' => $trainer_id, 'lesson_id' => $lesson_id]);

				$this->layout->content =  View::make('attandance.filter')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)										
										->with('studentcourse',$studentCourse)
										->with('getdate',$getdate)
										->with('todaydate',$today_date)
										->with('trainerid',$trainer_id)
										->with('trainer_schedule',$trainer_schedule);
				
			}

		}//end
	}


	public function filter()
	{
		if (Auth::user()->role == 2) {
			$today_date = date('Y-m-d', time());
			$getdate = Input::get('filterdate');			

			if ($getdate == '') {
				$date = date('Y-m-d', time());				
				$getdate_appointments = AppointmentEntry::where('date','=',$date)->where('booking_status','=','book')->orderBy('date', 'desc')->get();
			}else{
				$getdate_appointments = AppointmentEntry::where('date','=',$getdate)->where('booking_status','=','book')->orderBy('date', 'desc')->get();
			}

			$studentCourse = StudentCourseEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();
			$lessons = LessonsEntry::get();

			$trainer_id = Auth::user()->id;	
			if ($getdate == '') {
				$date = date('Y-m-d', time());				
				//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('date','=',$date)->get();

				$trainer_schedule = DB::table('trainer_schedule as ts')
						            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
						            ->where('trainer_id','=',$trainer_id)
						            ->where('date','=',$date)
						            ->get();


			}else{
				//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('date','=',$getdate)->get();

				$trainer_schedule = DB::table('trainer_schedule as ts')
						            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
						            ->where('trainer_id','=',$trainer_id)
						            ->where('date','=',$getdate)
						            ->get();
			}


			$this->layout->content =  View::make('attandance.filter')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)
										->with('appointment',$getdate_appointments)
										->with('studentcourse',$studentCourse)
										->with('getdate',$getdate)
										->with('todaydate',$today_date)
										->with('trainerid',$trainer_id)
										->with('trainer_schedule',$trainer_schedule);


		}//end
	}



	function export()
	{
		if (Auth::user()->role == 2) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Course Name' . ",\t".'Trainer Name'. ",\t".'Session' . ",\t".'Date' . ",\t";


			   $todaydate = date('Y-m-d', time());		
			   $trainer_id = Auth::user()->id;	

			 
			   $attendance_query = DB::select("SELECT st.name,m.course_name,t.trainer_name,ap.session,ap.date FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id LEFT JOIN trainers AS t ON ap.trainer_id=t.user_id WHERE ap.date='".$todaydate."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");


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



	function filterexport()
	{
		if (Auth::user()->role == 2) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Course Name' . ",\t".'Session' . ",\t".'Date' . ",\t";

			    $getdate = Input::get('getdate');
				$getdate_set = trim($getdate);
				$trainer_id = Auth::user()->id;

			   
			    $attendance_query = DB::select("SELECT st.name,m.course_name,ap.session,ap.date FROM appointment AS ap LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ap.course_id=m.id WHERE ap.date='".$getdate_set."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");


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
