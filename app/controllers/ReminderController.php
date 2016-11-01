<?php

class ReminderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";

	public function index()
	{
		//
	}

	public function remindertoStudents()
	{
		if(Auth::user()->role ==1 ) {
			//$appointment = AppointmentEntry::get();

			$next2day = date('Y-m-d', strtotime(' +2 day'));

			$appointment = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','N/A')

				->where('booking_status','=','book')
				->where('date','=',$next2day)
                ->groupBy('course_id')
                ->get();                

			$this->layout->content = View::make('reminder.remindertostudents')->with('appointment',$appointment)->with('next2day',$next2day);
		}//end
	}


	public function sendEmailToStudents()
	{
		if(Auth::user()->role ==1 ) {

		$next2day = date('Y-m-d', strtotime(' +2 day'));
		$id = Auth::user()->id;				

			/* send email */	

				$appointment_email = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','N/A')
				->where('booking_status','=','book')
				->where('date','=',$next2day)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

				$email_list = array();
                foreach ($appointment_email as $apemail_val) {
                	$std_email = StudentEntry::where('id','=',$apemail_val->student_id)->pluck('email');
                	$email_list[] = $std_email;
                }
                $tosend_email_list = join($email_list, ",");


				$subject = "Reminder Email From Nobleman School";

				/*$message_body = '<html><body>
								<h6>Hi,</h6>
								<p>Just a reminder, you have a lesson booked on '.$next2day.' at (timing). Do remember to bring your tools and see you!
								</p>
								<p>
								Regards, <br/>
								June Tan A.I.F.D <br/>
								Nobleman School of Floral Design <br/>
								Blk 10 North Bridge Road #02-5107 <br/>
								Singapore 190010 <br/>
								Tel : +65-62963977 <br/>
								Fax: +65-62913192 <br/>
								</p> 
								</body></html>';*/


				$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Students')->pluck('template_content');
				$message_body = $template_content;

				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			   mail($tosend_email_list, $subject, $message_body, $headers);

			   /* End send mail */

			   $appointment = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','N/A')
				->where('booking_status','=','book')
				->where('date','=',$next2day)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

                date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());

                foreach ($appointment as $key => $value) {
                	$AppointmentEntry = AppointmentEntry::find($value->id);
                	$AppointmentEntry->reminder_email_status = 1;
                	$AppointmentEntry->sendby = $id;
                	$AppointmentEntry->senddate = $date;
                }
                $AppointmentEntry->save(); 

                return Redirect::to('remindertostudents');

			
		}//end		
	}



	public function remindertoTrialStudents()
	{
		if(Auth::user()->role ==1 ) {

			$next2day = date('Y-m-d', strtotime(' +2 day'));

			$appointment = AppointmentEntry::leftJoin('courses','appointment.course_id','=','courses.id')
						->where('appointment.attend','=','N/A')
						->where('appointment.booking_status','=','book')
						->where('appointment.date','=',$next2day)
						->where('courses.course_type','=','Trial')
		                ->groupBy('appointment.course_id')
		                ->orderBy('courses.id', 'desc')
		                ->get(); 

			$this->layout->content =  View::make('reminder.remindertotrialstudents')->with('appointment',$appointment)->with('next2day',$next2day);
		}//end
	}


	public function sendEmailToTrialStudents()
	{
		if(Auth::user()->role ==1 ) {

		$next2day = date('Y-m-d', strtotime(' +2 day'));
		$id = Auth::user()->id;				

			/* send email */	
            $appointment_email = AppointmentEntry::leftJoin('courses','appointment.course_id','=','courses.id')
						->where('appointment.attend','=','N/A')
						->where('appointment.booking_status','=','book')
						->where('appointment.date','=',$next2day)
						->where('courses.course_type','=','Trial')
		                ->groupBy('appointment.course_id')
		                ->orderBy('courses.id', 'desc')
		                ->get(); 

			$email_list = array();
            foreach ($appointment_email as $apemail_val) {
            	$std_email = StudentEntry::where('id','=',$apemail_val->student_id)->pluck('email');
            	$email_list[] = $std_email;
            }
            $tosend_email_list = join($email_list, ",");

			$subject = "Reminder Email From Nobleman School";

			$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Trial Students')->pluck('template_content');
			$message_body = $template_content;

			$nb_email = "nan.kalayar@innov8te.com.sg";	

		    $headers = 'From: '.$nb_email.'' . "\r\n" .
		    'Reply-To: '.$nb_email.'' . "\r\n" .
		    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		   
		   mail($tosend_email_list, $subject, $message_body, $headers);

		   /* End send mail */

		   $appointment = AppointmentEntry::orderBy('id', 'desc')
			->where('attend','=','N/A')
			->where('booking_status','=','book')
			->where('date','=',$next2day)
			->where('course_id','=',Input::get('mid'))
            ->get(); 

            date_default_timezone_set('Asia/Singapore');
			$date = date('Y-m-d h:i:s', time());

            foreach ($appointment as $key => $value) {
            	$AppointmentEntry = AppointmentEntry::find($value->id);
            	$AppointmentEntry->reminder_email_status = 1;
            	$AppointmentEntry->sendby = $id;
            	$AppointmentEntry->senddate = $date;
            }
            $AppointmentEntry->save(); 

            return Redirect::to('remindertotrialstudents');

			
		}//end		
	}


	public function remindertoTrainers()
	{
		if(Auth::user()->role ==1 ) {

			$next2day = date('Y-m-d', strtotime(' +2 day'));

			$trainer_schedule = TrainerScheduleEntry::orderBy('id', 'desc')
				->where('date','=',$next2day)
                ->groupBy('course_id')
                ->get();                

			$this->layout->content =  View::make('reminder.remindertotrainers')->with('trainer_schedule',$trainer_schedule)->with('next2day',$next2day);
		}//end
	}



	public function sendEmailToTrainers()
	{
		if(Auth::user()->role ==1 ) {	

			   $next2day = date('Y-m-d', strtotime(' +2 day'));
			   $id = Auth::user()->id;			

			/* send email */	

				$trainer_email = TrainerScheduleEntry::orderBy('id', 'desc')
				->where('date','=',$next2day)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

				$email_list = array();
                foreach ($trainer_email as $tsemail_val) {
                	$trainer_email = TrainersEntry::where('user_id','=',$tsemail_val->trainer_id)->pluck('email');
                	$email_list[] = $trainer_email;
                }
                $tosend_email_list = join($email_list, ",");


				$subject = "Reminder Email From Nobleman School";

				/*$message_body = '<html><body>
								<h6>Hi,</h6>
								<p>Just a reminder, you have a class to teach on '.$next2day.' at (timing). See you!
								</p>
								<p>
								Regards, <br/>
								June Tan A.I.F.D <br/>
								Nobleman School of Floral Design <br/>
								Blk 10 North Bridge Road #02-5107 <br/>
								Singapore 190010 <br/>
								Tel : +65-62963977 <br/>
								Fax: +65-62913192 <br/>
								</p> 
								</body></html>';*/

				$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Trainers')->pluck('template_content');
				$message_body = $template_content;

				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			   mail($tosend_email_list, $subject, $message_body, $headers);

			   /* End send mail */

			   $trainer_schedule = TrainerScheduleEntry::orderBy('id', 'desc')
				->where('date','=',$next2day)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

                date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());

                foreach ($trainer_schedule as $key => $value) {
                	$TrainerScheduleEntry = TrainerScheduleEntry::find($value->id);
                	$TrainerScheduleEntry->reminder_email_status = 1;
                	$TrainerScheduleEntry->sendby = $id;
                	$TrainerScheduleEntry->senddate = $date;
                }
                $TrainerScheduleEntry->save();                 

                return Redirect::to('remindertotrainers');

			
		}//end		
	}


	public function reminderforCourseExpire()
	{
		if(Auth::user()->role ==1 ) {

			$yesterday = date('Y-m-d', strtotime(' -1 day'));

			$appointment = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','0')
				->where('booking_status','=','book')
				->where('date','=',$yesterday)
                ->groupBy('course_id')
                ->get();                

			$this->layout->content =  View::make('reminder.reminderforcourseexpire')->with('appointment',$appointment)->with('yesterday',$yesterday);
		}//end
	}


	public function sendEmailForCourseExpire()
	{
		if(Auth::user()->role ==1 ) {

		$yesterday = date('Y-m-d', strtotime(' -1 day'));
		$id = Auth::user()->id;				

			/* send email */	

				$appointment_email = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','0')
				->where('booking_status','=','book')
				->where('date','=',$yesterday)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

				$email_list = array();
                foreach ($appointment_email as $apemail_val) {
                	$std_email = StudentEntry::where('id','=',$apemail_val->student_id)->pluck('email');
                	$email_list[] = $std_email;
                }
                $tosend_email_list = join($email_list, ",");


				$subject = "Reminder Email From Nobleman School";

				/*$message_body = '<html><body>
								<h6>Hi,</h6>
								<p>Just a reminder, you have a lesson expired on '.$yesterday.' at (timing)!
								</p>
								<p>
								Regards, <br/>
								June Tan A.I.F.D <br/>
								Nobleman School of Floral Design <br/>
								Blk 10 North Bridge Road #02-5107 <br/>
								Singapore 190010 <br/>
								Tel : +65-62963977 <br/>
								Fax: +65-62913192 <br/>
								</p> 
								</body></html>';*/

				$template_content = ReminderTemplateEntry::where("template_name", "=", 'Reminder Courses Expire')->pluck('template_content');
				$message_body = $template_content;

				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			    mail($tosend_email_list, $subject, $message_body, $headers);

			   /* End send mail */

			   $appointment = AppointmentEntry::orderBy('id', 'desc')
				->where('attend','=','0')
				->where('booking_status','=','book')
				->where('date','=',$yesterday)
				->where('course_id','=',Input::get('mid'))
                ->get(); 

                date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());

                foreach ($appointment as $key => $value) {
                	$AppointmentEntry = AppointmentEntry::find($value->id);
                	$AppointmentEntry->reminder_email_status = 1;
                	$AppointmentEntry->sendby = $id;
                	$AppointmentEntry->senddate = $date;
                }
                $AppointmentEntry->save(); 

                return Redirect::to('reminderforcourseexpire');

			
		}//end		
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
