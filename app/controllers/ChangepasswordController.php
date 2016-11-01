<?php

//require_once('class.phpmailer.php');

class ChangepasswordController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function index()
	{
		$this->layout->content =  View::make('changepassword.index');
	}

	public function store()
	{
		

		$rules = array(
				'new_changepass'     => 'required',
				'confirm_changepass'     => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);
	
		if ($validator->fails()) {
			return Redirect::to('changepassword')
				->withErrors($validator);
		} else {

			$password = Input::get('new_changepass');
			$cfm_password =Input::get('confirm_changepass');
			if ($password == $cfm_password)
			{
				$password = Input::get('new_changepass');

				//$StudentEntry = new StudentEntry;	
				$aid = Auth::user()->id;
				$mail = UserEntry::where('id','=',$aid)->pluck('email');
				$sid = StudentEntry::where('email','=',$mail)->pluck('id');

				$StudentEntry = StudentEntry::find($sid);
				$StudentEntry->password = Hash::make($password);
				$StudentEntry->save();

				$UserEntry = UserEntry::find($aid);
				$UserEntry->password = Hash::make($password);
				$UserEntry -> save();


				Session::flash('message', 'Your password have been changed!');


				/* send email for activated account */				
				$to_email = UserEntry::where('id','=',$aid)->pluck('email');
				$std_name = StudentEntry::where('email','=',$to_email)->pluck('name');
				$subject = "Password changed for Nobleman login system.";
				$newpassword = $password;
				$message_body = '<html><body>
								<p>Hi '.$std_name.',</p>
								<P></p>
								<p>Your password have been changed!This is your new password : </p>
								<P>Login email : '.$to_email.'</p>
								<P>Password : '.$newpassword.'</p>
								<P></p>
								</body></html>';
				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			    mail($to_email, $subject, $message_body, $headers);

			    /******************************************************************/
			   
				/*$to_email = UserEntry::where('id','=',$aid)->pluck('email');
				$std_name = StudentEntry::where('email','=',$to_email)->pluck('name');

				// I'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
				$user = array(
					'email'=>$to_email,
					'name'=>$std_name
				);

				// the data that will be passed into the mail view blade template
				$data = array(
					'detail'=>'Your awesome detail here',
					'name'	=> 'Nan'
				);

				// use Mail::send function to send email passing the data and using the $user variable in the closure
				Mail::send('emails.welcome', $data, function($message) use ($user)
				{
				  $message->from('nan.kalayar@innov8te.com.sg', 'Nobleman');
				  $message->to($user['email'], $user['name'])->subject('Password changed for Nobleman login system.');
				});*/

				/*****************************************************************/

				/*$to_email = UserEntry::where('id','=',$aid)->pluck('email');
				$std_name = StudentEntry::where('email','=',$to_email)->pluck('name');
				$nb_email = "nan.kalayar@innov8te.com.sg";				
				$newpassword = $password;
				$message_body = '<html><body>
								<p>Hi '.$std_name.',</p>
								<P></p>
								<p>Your password have been changed!This is your new password : </p>
								<P>Login email : '.$to_email.'</p>
								<P>Password : '.$newpassword.'</p>
								<P></p>
								</body></html>';


				$mail = new PHPMailer(); // defaults to using php "mail()" 
		        $mail->IsSendmail(); // telling the class to use SendMail transport
		        //$body = eregi_replace("[\]",'',$message_body);
		        $mail->AddReplyTo($nb_email);
		        $mail->SetFrom($nb_email);
		        $mail->AddAddress($to_email, $std_name);
		        $mail->Subject    = "Password changed for Nobleman login system.";
		        $mail->MsgHTML($message_body);*/

				return Redirect::to('changepassword');


			}else{
				$validator = 'Your password is did not match.Please try again!!';
				return Redirect::to('changepassword')
				->withErrors($validator);
			}


			
		}

		
	}

	
}// End Class

?>