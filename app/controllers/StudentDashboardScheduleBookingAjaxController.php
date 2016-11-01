<?php

class StudentDashboardScheduleBookingAjaxController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function bookingajax()
	{
		$stdid = Input::get('stdid');
		$course_id = Input::get('course_id');
		$date = Input::get('date');
		$session = Input::get('session');


		//check school holiday
		$holiday_count = DB::table('holidays')->where('hf_date','=',$date)->count();
		if ($holiday_count != 0) {
			$school_holiday = 'School is closed for this day!';	
			$data = array('school_holiday'=>$school_holiday);
			echo json_encode($data);		
		}else{

			//$book_count = AppointmentEntry::where('date','=',$date)->where('session','=',$session)->count();
			$book_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->count();
			
			$check_booking_limit = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('booking_status','=','book')->count();					
			$no_lessons = DB::table('courses')->where('id','=',$course_id)->pluck('no_of_lesson');

			if($check_booking_limit >= $no_lessons){
				$limit = 'Sorry! You can not book for this course!';
				$html = 'unsuccess';
			}else{
				if ($book_count <= 14) {
					$check_unbooktobook = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->count();					
					if($check_unbooktobook == 0){
						/*$appointmententry = new AppointmentEntry;
						$appointmententry->student_id = $stdid;
						$appointmententry->course_id = $course_id;
						$appointmententry->date = $date;
						$appointmententry->session = $session;
						$appointmententry->attend = 'N/A';
						$appointmententry->booking_status = 'book';
						date_default_timezone_set('Asia/Singapore');
						$createtime = date('Y-m-d h:i:s', time());
						$appointmententry->created_date = $createtime;
						$appointmententry->save();*/

						date_default_timezone_set('Asia/Singapore');
						$createtime = date('Y-m-d h:i:s', time());
						DB::table('appointment')->insert(
						    ['student_id' => $stdid, 'course_id' => $course_id, 'date' => $date, 'session' => $session, 'attend' => 'N/A', 'booking_status' => 'book', 'created_date' => $createtime]
						);

					}else{
						$appo_id = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->pluck('id');
						/*$appointmententry = AppointmentEntry::find($appo_id);	
						$appointmententry->booking_status = 'book';
						date_default_timezone_set('Asia/Singapore');
						$updatedtime = date('Y-m-d h:i:s', time());
						$appointmententry->updated_date = $updatedtime;
						$appointmententry->save();*/

						date_default_timezone_set('Asia/Singapore');
						$updatedtime = date('Y-m-d h:i:s', time());
						DB::table('appointment')->where('id', $appo_id)->update(array('booking_status' => 'book', 'updated_date' => $updatedtime));
					}
					
				}
				$limit = 0;
				$html = 'success';

			}//end if

			

			$data = array('html'=>$html, 'limit'=>$limit);
			echo json_encode($data);	
		}
		
	}


}//End Class