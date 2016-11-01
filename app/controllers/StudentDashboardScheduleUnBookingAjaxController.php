<?php

class StudentDashboardScheduleUnBookingAjaxController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	/* For unbooking ajax */
	public function unbookingajax()
	{
		$stdid = Input::get('stdid');
		$course_id = Input::get('course_id');
		$date = Input::get('date');
		$session = Input::get('session');


		$time = time();
		$pre2day = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time) +2 ,date("Y", $time)));

		$todaydate = date('Y-m-d', time());

		if($date >= $pre2day){
			$appo_id = DB::table('appointment')->where('student_id','=',$stdid)->where('course_id','=',$course_id)->where('date','=',$date)->where('session','=',$session)->pluck('id');			

			/*$appointmententry = AppointmentEntry::find($appo_id);				
			$appointmententry->booking_status = 'unbook';
			date_default_timezone_set('Asia/Singapore');
			$updatedtime = date('Y-m-d h:i:s', time());
			$appointmententry->updated_date = $updatedtime;
			$appointmententry->save();*/

			date_default_timezone_set('Asia/Singapore');
			$updatedtime = date('Y-m-d h:i:s', time());
			DB::table('appointment')->where('id', $appo_id)->update(array('booking_status' => 'unbook', 'updated_date' => $updatedtime));


			$get_waitinglist = DB::table('appointment')->where('date','=',$date)->where('session','=',$session)->where('booking_status','=','waiting')->orderBy('id', 'ASC')->first();

			if ($get_waitinglist) {
				foreach ($get_waitinglist as $value) {
					/*$appointmententry = AppointmentEntry::find($value->id);		
					$appointmententry->booking_status = 'book';
					date_default_timezone_set('Asia/Singapore');
					$updatedtime = date('Y-m-d h:i:s', time());
					$appointmententry->updated_date = $updatedtime;
					$appointmententry->save();*/

					date_default_timezone_set('Asia/Singapore');
					$updatedtime = date('Y-m-d h:i:s', time());
					DB::table('appointment')->where('id', $value->id)->update(array('booking_status' => 'book', 'updated_date' => $updatedtime));


				}

				$get_stdemail = DB::table('students')->where('id','=',$stdid)->pluck('email');
				$get_stdname = DB::table('students')->where('id','=',$stdid)->pluck('name');

				/*send email for activated account */
				$to_email = $get_stdemail;
				$std_name = $get_stdname;
				$subject = "Nobleman Booking";
				$message_body = '<html><body>
								<p>Hi '.$std_name.',</p>
								<P></p>
								<p>Thank you for your waiting our school booking!Now you are booked for this class.</p>
								<p>Date : '.$date.'</p>
								<p>Session : '.$session.'</p>
								<P></p>
								</body></html>';
				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			    mail($to_email, $subject, $message_body, $headers);
			}
			

			$html = 'success';
		}else{
			$html = 'unsuccess';
		}

		$data = array('html'=>$html);
		echo json_encode($data);	
	
		
	}



}//End Class