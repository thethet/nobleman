<?php

class TrainerDashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";

	public function index()
	{
		if(Auth::user()->role == 2 ) {	
		$trainer_id = Auth::user()->id;	

		$trainer_schedules = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->get();
		$announcement = AnnouncementEntry::get();
		
		$this->layout->content =  View::make('trainers.dashboard')
									->with('trainer_schedule',$trainer_schedules)
									->with('announcement',$announcement);


									
		}//end
	}

	public function traannouncementshow()
	{
		if(Auth::user()->role == 2 ) {	
			$announcement = AnnouncementEntry::get();
			$this->layout->content =  View::make('announcement.trainerannouncement')
										->with('announcement',$announcement);
		}//end
	}


	public function stdbylesson()
	{
		if(Auth::user()->role == 2 ) {	
			$trainer_id = Auth::user()->id;
			//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->get();

			$trainer_schedule = DB::table('trainer_schedule as ts')
					            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
					            ->where('trainer_id','=',$trainer_id)
					            ->get();


			$appointment = AppointmentEntry::where('booking_status','=','book')->orderBy('date', 'desc')->get();
			$studentCourse = StudentCourseEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();
			$lessons = LessonsEntry::get();

			$this->layout->content =  View::make('trainers.stdbylessonlists')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)
										->with('appointment',$appointment)
										->with('studentcourse',$studentCourse)
										->with('trainerid',$trainer_id)
										->with('trainer_schedule',$trainer_schedule);
			}//end
	}


	public function stdbylessonfilter()
	{
		if(Auth::user()->role == 2 ) {	
			$trainer_id = Auth::user()->id;
			
			$getcourse = Input::get('course');
			if ($getcourse == 0) {
				//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->get();
				$trainer_schedule = DB::table('trainer_schedule as ts')
					            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
					            ->where('trainer_id','=',$trainer_id)
					            ->get();
			}else{
				//$trainer_schedule = TrainerScheduleEntry::where('trainer_id','=',$trainer_id)->where('course_id','=',$getcourse)->get();
				$trainer_schedule = DB::table('trainer_schedule as ts')
					            ->leftJoin('trainer_schedule_session as tss', 'ts.id', '=', 'tss.trainer_schedule_id')
					            ->where('trainer_id','=',$trainer_id)
					            ->where('course_id','=',$getcourse)
					            ->get();
			}

			$appointment = AppointmentEntry::where('booking_status','=','book')->orderBy('date', 'desc')->get();
			$studentCourse = StudentCourseEntry::get();
			$courses = CoursesEntry::get();
			$student = StudentEntry::get();
			$lessons = LessonsEntry::get();


			$this->layout->content =  View::make('trainers.stdbylessonlists_filter')
										->with('courses',$courses)
										->with('student',$student)
										->with('lessons',$lessons)
										->with('appointment',$appointment)
										->with('studentcourse',$studentCourse)
										->with('trainerid',$trainer_id)
										->with('trainer_schedule',$trainer_schedule)
										->with('getcourse',$getcourse);


		}//end
	}



	function export()
	{
		if (Auth::user()->role == 2) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Studentbylesson_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Course Name' . ",\t".'Session' .",\t".'Date' .",\t" .'Attendance' . ",\t";

			  
			   $trainer_id = Auth::user()->id;	

			   //$query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND ts.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");

			   $query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN trainer_schedule_session AS tss ON ts.id=tss.trainer_schedule_id LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND tss.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");


			   foreach( $query as $row )
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
			   header("Content-Disposition: attachment; filename=Studentbylesson_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Course Name' . ",\t".'Session' .",\t".'Date' .",\t" .'Attendance' . ",\t";

			  
			   $trainer_id = Auth::user()->id;	
			   $getcourse = Input::get('getcourse');

			   if ($getcourse == 0) {
			   		//$query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND ts.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");

			   		$query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN trainer_schedule_session AS tss ON ts.id=tss.trainer_schedule_id LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND tss.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");
			   }else{
				   //$query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND ts.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ts.course_id='".$getcourse."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");

			   		$query = DB::select("SELECT st.name,m.course_name,ts.session,ts.date,CASE WHEN ap.attend = 0 THEN 'Absent' ELSE 'Attended' END AS attendance FROM trainer_schedule AS ts LEFT JOIN trainer_schedule_session AS tss ON ts.id=tss.trainer_schedule_id LEFT JOIN appointment AS ap ON ts.trainer_id=ap.trainer_id AND ts.course_id=ap.course_id AND tss.session=ap.session AND ts.date=ap.date LEFT JOIN students AS st ON ap.student_id=st.id LEFT JOIN courses AS m ON ts.course_id=m.id WHERE ts.trainer_id='".$trainer_id."' AND ts.course_id='".$getcourse."' AND ap.trainer_id='".$trainer_id."' AND ap.booking_status='book' ");

				}


			   foreach( $query as $row )
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