<?php

class StudentDashboardScheduleWaitBookingAjaxController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	/* For unbooking ajax */
	public function waitbookingajax()
	{
		$stdid = Input::get('stdid');
		$course_id = Input::get('course_id');
		$date = Input::get('date');
		$session = Input::get('session');

		$book_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->count();

		$check_booking_limit = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('booking_status','=','book')->count();					
		$no_lessons = DB::table('courses')->where('id','=',$course_id)->pluck('no_of_lesson');

		if($check_booking_limit >= $no_lessons){
			$limit = 'Sorry! You can not book for this course!';
			$html = $check_booking_limit;
		}else{
			if ($book_count > 14) {
				$appo_id = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->pluck('id');
				/*$appointmententry = AppointmentEntry::find($appo_id);	
				$appointmententry->booking_status = 'waiting';
				date_default_timezone_set('Asia/Singapore');
				$updatedtime = date('Y-m-d h:i:s', time());
				$appointmententry->updated_date = $updatedtime;
				$appointmententry->save();*/

				date_default_timezone_set('Asia/Singapore');
				$updatedtime = date('Y-m-d h:i:s', time());
				DB::table('appointment')->where('id', $appo_id)->update(array('booking_status' => 'waiting', 'updated_date' => $updatedtime));
			}
			$html = 'success';
			$limit = 0;
		}//end if
		
		$data = array('html'=>$html, 'limit'=>$limit);
		echo json_encode($data);	
	
		
	}



}//End Class