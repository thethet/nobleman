<?php

class CoverController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";

	public function __construct()
	{
		Session::start();
	}


	public function index()
	{
		if (Auth::user())
		{
			if (Auth::check())
			{
				if(Auth::user()->status ==1 ) {
					return Redirect::to('/home');
					// if (Auth::user()->role == 1) {
					// 	return Redirect::to('/dashboard');
					// } elseif (Auth::user()->role == 2) {
					// 	return Redirect::to('/trainer/schedules');
					// } else
					// 	return Redirect::to('/stdschedules');
				}
				else
					Auth::logout();
					return Redirect::to('/');
			}
			else
				return Redirect::to('/');
		}
		else
		{
			return View::make('main.login');
		}
	}
	public function authent()
	{
		$email = Input::get('email');
		$pwd = Input::get('password');
		$count = DB::table('users')
                     ->where('email',$email)
                     ->count();
		if ($count > 0)
		{
			$hashedPassword = DB::table('users')->where('email', $email)->first();
			$ID = DB::table('users')->where('email',$email)->pluck('id');
			$firstName = DB::table('users')->where('email',$email)->pluck('show_id');
			$role = DB::table('users')->where('email',$email)->pluck('role');
			$password = Hash::make($pwd);
			
			if (Auth::attempt(array('email' => $email, 'password' => $pwd),true))
			{
				if (Auth::check())	
				{
					if(Auth::user()->status == 1) {
						//return Redirect::to('/home');
						 if (Auth::user()->role == 1) {
							return Redirect::to('/home');
						} elseif (Auth::user()->role == 2) {
					 	    return Redirect::to('/trainer/schedules');
						 } else
							return Redirect::to('/stdschedules');
					}
					else
						Auth::logout();
						return Redirect::to('/');
				}
				else
						return Redirect::to('/');

			}
			else
			{
				return Redirect::to('/')->with('message','Wrong Email or Password!');
			}
			
		}
		else
		{
			return Redirect::to('/')->with('message','Wrong Email or Password!');
		}
		return $view;
	}
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
	public function finishregister()
	{
		$rules = array(
				'UserEmail'         => 'required|email|unique:user',
				'Password'      	=> 'required',
				'ConfirmPassword'		=> 'required|same:Password',
				'firstName'         => 'required',
				'lastName'      	=> 'required',
				'address'           => 'required',
				'contact'      		=> 'required',
			);
			$validator = Validator::make(Input::all(), $rules);
	
			if ($validator->fails()) 
			{
				return Redirect::to('/register')
					->withErrors($validator);
			} 
			
			else 
			{
				$email = Input::get('UserEmail');
				$password = Input::get('Password');
				$oldPwd = $password;
				$firstName = Input::get('firstName');
				$lastName = Input::get('lastName');
				$address = Input::get('address');
				$contact = Input::get('contact');
				$password = Hash::make($password);
				date_default_timezone_set('Singapore');
				$timezone = date('Y/m/d H:i:s a', time());
				
				$latestID = DB::table('user')->orderBy('uID', 'desc')->first();
				$numberID = explode("U", $latestID->id);
				$numberID[1] = $numberID[1] + 1;
				$newID = "U";
				$newID = $newID.$numberID[1];
				
				$latestID = DB::table('user')->orderBy('uID', 'desc')->first();
				$newEID = $latestID->EntityID + 1;
				DB::table('user')->insert(array
					('id'=>$newID,'UserEmail' => $email, 'FirstName'=>$firstName,'LastName'=>$lastName,'Address'=>$address,'ContactNumber'=>$contact,'Password' => $password,'DateJoined'=>$timezone,'AC'=>'9856','EntityID'=>$newEID)
				);
				
				DB::table('accesscontrols')->insert(array
					('UserID' => $newID,'EntityID'=>$newEID, 'DateCreated'=>$timezone)
				);
				if (Auth::attempt(array('UserEmail' => $email, 'password' => $oldPwd),true))
					{
						if (Auth::check())		
							return Redirect::to('/main');
						else
							return Redirect::to('/login');
					}
				
							return Redirect::to('/login');
			}
	}



	/* For forgot email */
	function forgot()
	{
		$email_count = DB::table('users')
                     ->where('email',Input::get('email'))
                     ->count();
			if ($email_count == 1) {		

				/* send email for password reset link */
				$resetLink = $this->generateResetPasswordLink(Input::get('email'));	
				$resetLink_url = 'http://' . $_SERVER['SERVER_NAME'] . $resetLink;
				//return Redirect::to($resetLink);

				$to_email = Input::get('email');
				$subject = "Nobleman password reset link.";
				$passwordreset_link = 'http://localhost/nobleman';
				$message_body = '<html><body>
								<p>Hi,</p>
								<P></p>
								<p>Here is your password reset link:</p>
								<P>Link : <a href="'.$resetLink_url.'">'.$resetLink_url.'</a></p>
								<P></p>
								</body></html>';
				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			    mail($to_email, $subject, $message_body, $headers);

			    Session::flash('sendmessage', 'Reset password link has been sent to your email address.Please check your email!');
				return Redirect::to('/login');

			}else{
				Session::flash('message', 'Invalid User Email!');
				return Redirect::to('/login');
			}
	}


	function resetPassword($email = '', $code = '') 
	{
		if (empty($email) || empty($code)) {
           Session::set('reset_email', $email);
           Session::set('reset_code', $code);
        }
		
		if ($code != $this->generateResetPasswdCode(base64_decode(urldecode($email)))) {
            Session::flash('message', 'Invalid link');
        }

        if (empty($reset_email) || empty($reset_code)) {
            Session::set('reset_email', $email);
            Session::set('reset_code', $code);
        }
        
        return View::make('main.resetpassword');

	}



	function generateResetPasswordLink($email) {
        return '/resetPassword/' . urlencode(base64_encode($email)) . '/' . sha1(md5($email));
    }


    function generateCode($email) {
       return sha1(md5($email));
    }


    function generateResetPasswdCode($email) {
        return $this->generateCode($email);
    }



    // Password reset flow
    function processResetPassword() 
    {
    	$email = Session::get('reset_email');
        $code = Session::get('reset_code');

    	$rules = array(			
			'password' => 'required|same:confirm_password'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {	
        	Session::flash('message', 'Your password did not match!');
        	$resetLink = $this->generateResetPasswordLink($email);				
			return Redirect::to($resetLink);

		} else {
			if ($code != $this->generateResetPasswdCode(base64_decode(urldecode($email)))) {
				Session::flash('message', 'Invalid Reset Password Activation link!');
				$resetLink = $this->generateResetPasswordLink($email);				
				return Redirect::to($resetLink);
	        }
		}

		//Session::flush();

		if ($query = $this->resetPasswordData(base64_decode(urldecode($email)))) {
          
            Session::forget('reset_email');
            Session::forget('reset_code');

            Session::flash('sendmessage', 'Password has been reset successfully.');
            // go to something
            return Redirect::to('/login');
        } else {
            Session::flash('message', 'Error occurred. Please try again later.');
			$resetLink = $this->generateResetPasswordLink($email);				
			return Redirect::to($resetLink);
        }

    }


    function resetPasswordData($email) {       

        $password = Input::get('password');
        $hash_password = Hash::make($password);

        $studentmodule = DB::table('users')->where('email', '=', $email)->update(array('password' => $hash_password));

        return true;

    }




}//End class

?>