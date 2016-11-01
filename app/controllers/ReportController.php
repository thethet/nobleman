<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	protected $layout = "layouts.main";
	public function certifiedStudents()
	{
	
		$certifiedStudents = CertEntry::join('students','students.id','=','cert.stdname')
									  ->join('courses','cert.course','=','courses.id')
									  ->select(['students.id','students.*','courses.course_name',DB::raw('cert.date as certified_date')])
									  ->where('cert.received_certificate',true)
									  ->get();

		return View::make('report.student.student_certified_report',compact('certifiedStudents'));
	}

	function certifiedStudentsExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Certified_Students_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   

			   $header='Student ID' . ",".'Student Name' . ",".'Course'. ",".'Student Email' . ",".'Contact' .",".'NRIC' . ",".'Certified Date' . ",";


			   $query = DB::select("SELECT st.id,st.name,m.course_name,st.email,st.mobile_contact,st.nric,ce.date FROM students AS st JOIN cert AS ce ON st.id=ce.stdname JOIN courses AS m ON ce.course=m.id WHERE ce.received_certificate=true");


			   foreach( $query as $row )
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function attendanceStudents()
	{
		$attendanceStudents = AppointmentEntry::join('students','students.id','=','appointment.student_id')
									  ->join('courses','courses.id','=','appointment.course_id')
									  ->select(['students.id','students.*','courses.course_name','appointment.date','appointment.attend','appointment.session'])
									  ->get();

		return View::make('report.student.student_attendant_report',compact('attendanceStudents'));
	}

	function attendanceStudentsExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Students_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   $header='Student ID' . ",".'Student Name' . ",".'Course'. ",".'Student Email' . ",".'Contact' .",".'NRIC' . ",".'Attend'. ",".'Session' . ",".'Attend Date' . ",";


			   $query = DB::select("SELECT st.id,st.name,m.course_name,st.email,st.mobile_contact,st.nric,If(ap.attend = 1, 'Yes', 'No'),ap.session,ap.date FROM students AS st JOIN appointment AS ap ON st.id=ap.student_id JOIN courses AS m ON m.id=ap.course_id");



			   foreach( $query as $row )
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


	public function trialstudentsHistory()
	{		

		$trialstd_list = DB::table('student_course')
								->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
					            ->leftJoin('students', 'student_course.student_id', '=', 'students.id')
					            ->where('course_type','=','Trial')	
					            ->select(['student_course.*','students.*','courses.*'])
					            ->get();

		return View::make('report.student.trialstudent_history_report',compact('trialstd_list'));

	}

	function trialStudentsExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Attendance_Students_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   $header='Student ID' . ",".'Student Name' . ",".'Course'. ",".'Student Email' . ",".'Contact' .",".'NRIC' . ",";

			   

			  /* $query = DB::select("SELECT st.id,st.name,m.course_name,st.email,st.mobile_contact,st.nric FROM students AS st JOIN appointment AS ap ON st.id=ap.student_id JOIN courses AS m ON m.id=ap.course_id");*/

			  $query = DB::select("SELECT s.id,s.name,c.course_name,s.email,s.mobile_contact,s.nric FROM student_course AS sc LEFT JOIN courses AS c ON sc.student_id=c.id LEFT JOIN students AS s ON sc.student_id=s.id WHERE c.course_type=Trial ");

print_r($header);exit;

			   foreach( $query as $row )
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


	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function trainerCourseTaught()
	{
		$trainerCourses = TrainersEntry::join('trainer_schedule','trainers.user_id','=','trainer_schedule.trainer_id')
										->join('courses','trainer_schedule.course_id','=','courses.id')
										->select(['trainers.*','courses.*','trainer_schedule.*'])
									  	->get();
		return View::make('report.trainer.trainer_course_taught',compact('trainerCourses'));
	}

	function trainerCourseTaughtExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Trainer_Course_Taught_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   $header='Trainer ID' . ",".'Trainer Name' . ",".'Trainer Email' .",".'Course' . ",".'Date'. ",".'Session' . ",";


			   $query = DB::select("SELECT t.id,t.trainer_name,t.email,cs.course_name,ts.date,ts.session FROM trainers AS t JOIN trainer_schedule AS ts ON t.user_id=ts.trainer_id JOIN courses AS cs ON ts.course_id=cs.id");



			   foreach( $query as $row )
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


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function trainerStudentTaught()
	{
		$trainerTaughts = AppointmentEntry::join('students','students.id','=','appointment.student_id')
									  ->join('courses','courses.id','=','appointment.course_id')
									  ->join('trainers','appointment.trainer_id','=','trainers.user_id')
									  ->select(['students.*','trainers.*',DB::raw('appointment.date as appointment_date'),'appointment.session',DB::raw('trainers.email as trainer_email'),'courses.*'])
									  ->get();

		return View::make('report.trainer.trainer_student_taught',compact('trainerTaughts'));
	}


	function trainerStudentTaughtExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Trainer_Student_Taught_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   $header='Trainer Name' . ",".'Trainer Email' . ",".'Student Name'. ",".'Student Email' . ",".'Student NRIC' .",".'Student Contact' . ",".'Course'. ",".'Date' . ",".'Session' . ",";


			   $query = DB::select("SELECT t.trainer_name,t.email,st.name,st.email AS studentemail,st.nric,st.mobile_contact,m.course_name,ap.date,ap.session FROM appointment AS ap JOIN students AS st ON st.id=ap.student_id JOIN courses AS m ON m.id=ap.course_id JOIN trainers AS t ON ap.trainer_id=t.user_id");



			   foreach( $query as $row )
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
	

	public function courseHistory()
	{
		$dateObj = new DateTime;
		$current_year = $dateObj->format("Y");
		$course_history = StudentCourseEntry::where('date_of_registration','like',$current_year.'%')->groupBy('course_id')->get();	
		return View::make('report.course.course_history',compact('course_history','current_year'));    
	}

	function courseHistoryExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Course_History_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   

			   $header='Course Name' . ",".'Students Count'. ",".'Year' . ",";

			    $dateObj = new DateTime;
				$current_year = $dateObj->format("Y");

			   $query = DB::select("SELECT m.course_name,count(distinct sm.student_id) as student_count,'".$current_year."' FROM student_course AS sm LEFT JOIN courses AS m ON sm.course_id=m.id WHERE date_of_registration LIKE '".$current_year."%'  GROUP BY sm.course_id");


			   foreach( $query as $row )
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


	public function courseHistoryFilter()
	{
		$filter_year = Input::get('selectyear');
		if ($filter_year != 0) {
			$course_history = StudentCourseEntry::where('date_of_registration','like',$filter_year.'%')->groupBy('course_id')->get();
			return View::make('report.course.filter_course_history',compact('course_history','filter_year')); 
		}else{
			$dateObj = new DateTime;
			$current_year = $dateObj->format("Y");
			$course_history = StudentCourseEntry::where('date_of_registration','like',$current_year.'%')->groupBy('course_id')->get();	
			$filter_year = $current_year;
			return View::make('report.course.filter_course_history',compact('course_history','filter_year')); 
		}
		
		   
	}

	function courseHistoryFilterExport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Course_History_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';
			   

			   $header='Course Name' . ",".'Students Count'. ",".'Year' . ",";

			   $filter_year_val = Input::get('selectyear_val');

			   $query = DB::select("SELECT m.course_name,count(distinct sm.student_id) as student_count,'".$filter_year_val."' FROM student_course AS sm LEFT JOIN courses AS m ON sm.course_id=m.id WHERE date_of_registration LIKE '".$filter_year_val."%'  GROUP BY sm.course_id");


			   foreach( $query as $row )
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


	


}//end class
