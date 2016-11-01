<?php

class StudentsController extends BaseController {


/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function lists()
	{
		if(Auth::user()->role ==1 ) {
		$students = StudentEntry::get();
		$this->layout->content =  View::make('students.lists')
									->with('students',$students);

		}//end
	}

	public function create()
	{
		if(Auth::user()->role ==1 ) {

		$countries = CountryEntry::get();
		$courses = CoursesEntry::get();
		$admins = User::where('role',1)->get();
		$branches = Branch::get();
		$this->layout->content =  View::make('students.create')
									->with('countries',$countries)
									->with('courses',$courses)
									->with('branches',$branches)
									->with('admins',$admins);

		}//end
	}
	
	public function listcourse($id)
	{
		if(Auth::user()->role ==1 ) {

		$students = StudentEntry::find($id);
		$course = CourseEntry::get();
		$studentcourse = StudentCourseEntry::where('student_id','=',$id)->get();
		$this->layout->content =  View::make('students.listcourse')
										->with('students',$students)
										->with('course',$course)
										->with('studentcourse',$studentcourse);
		}//end
	}


	public function addcourse()
	{
		if(Auth::user()->role == 1 ) {
		$countries = CountryEntry::get();
		$course = CourseEntry::get();
		$this->layout->content =  View::make('students.addcourse')->with('countries',$countries)->with('course',$course);
		}//end
	}
	public function editd()
	{
		if(Auth::user()->role ==1 ) {
		$countries = CountryEntry::get();
		$this->layout->content =  View::make('students.edit')->with('countries',$countries);		
		}//end
	}
	
	public function view($id) 
	{
		if(Auth::user()->role ==1 ) {
		$student = StudentEntry::find($id);
		$blacklist = array();
		$n = 0;
		// Omit the students that already supervisors nor suboordinates from the option, if it doesn't exits, just select all
		if (count($blacklist) > 0)
			$students = StudentEntry::whereNotIn('id',$blacklist)->get();
		else
			$students = StudentEntry::all();

		$countries = CountryEntry::get();
		$courses = CoursesEntry::get();
		$studentcourse = StudentCourseEntry::where('student_id','=',$id)->get()->first();

		$studentcourses = StudentCourseEntry::where('student_id','=',$id)->get();
		$branches = Branch::get();
		$admins = User::where('role',1)->get();		

		 return View::make('students.view')
				->with('countries',$countries)
            	->with('student', $student)
            	->with('students', $students)
			 	->with('courses',$courses)
			 	->with('studentcourse',$studentcourse)
			 	->with('studentcourses',$studentcourses)
				->with('admins',$admins)
				->with('branches',$branches);			 	
		}//end
	}
	
	public function delete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		$studententry = StudentEntry::find($id);

		$smail = $studententry->email ;
		$sid = UserEntry::where('email','=',$smail)->pluck('id');

		StudentEntry::find($id)->delete();	

		StudentCourseEntry::where('student_id',$id)->delete();
		
		UserEntry::find($sid)->delete();

		return Redirect::to('students');

		}//end
	}

	public function store()
	{

		if(Auth::user()->role == 1) {
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');

		//$hash_password = Hash::make($password);

		// if ($password == $cfm_password)
		// {
			//$email_count = StudentEntry::where('email','=',Input::get('email'))->count();

			$email_count = UserEntry::where('email','=',Input::get('email'))->count();					

			if($email_count == 0){

				$company_sponsor = Input::get('sponsor');
				$foreign_std = Input::get('foreign_std');

				if ($company_sponsor == 'Yes' && $foreign_std == 'Yes') {
					$rules = array(
						'name'     => 'required',
						'nric'     => 'required', 
						'email'    => 'required',
						'nationality'  => 'required',
						'mobile_contact'  => 'required',
						'local_address' => 'required',
						'floral_related'  =>  'required',						
						//'company_name' => 'required',
						//'contact_person' => 'required',
						//'oversea_contact' => 'required',
						'emergency_contact_person' => 'required',
						'emergency_contact_number' => 'required',
						'module_apply' => 'required|not_in:0',
						'payment_mode' => 'required|not_in:0',
						'branch_id'	=>	'required'
					);
				}elseif($company_sponsor == 'Yes' && $foreign_std == 'No') {
					$rules = array(
						'name'     => 'required',
						'nric'     => 'required',
						'email'    => 'required',
						'nationality'  => 'required',
						'mobile_contact'  => 'required',
						'local_address' => 'required',
						'floral_related'  =>  'required',
						//'company_name' => 'required',
						//'contact_person' => 'required',
						'emergency_contact_person' => 'required',
						'emergency_contact_number' => 'required',
						'module_apply' => 'required|not_in:0',
						'payment_mode' => 'required|not_in:0',
						'branch_id'	=>	'required'
					);
				}else{
					$rules = array(
						'name'     => 'required',
						'nric'     => 'required',
						//'gender'   => 'required',
						'email'    => 'required',
						'nationality'  => 'required',
						'mobile_contact'  => 'required',
						'local_address' => 'required',
						'floral_related'  =>  'required',						
						'emergency_contact_person' => 'required',
						'emergency_contact_number' => 'required',
						'module_apply' => 'required|not_in:0',
						'payment_mode' => 'required|not_in:0',
						'branch_id'	=>	'required'
					);
				}

			
			$validator = Validator::make(Input::all(), $rules);


			if ($validator->fails()) {
				return Redirect::to('students/create')
					->withErrors($validator);
			} else {

			$payment_mode = Input::get('payment_mode');
			if ($payment_mode == 'Paypal') { 					
				$course_fee = CoursesEntry::where('id','=',Input::get('module_apply'))->pluck('cost_of_course');
				
				$stdDataArr = array(
							'name' => Input::get('name'),
							'password' => Input::get('password'),
							'email' => Input::get('email'),
							'chooseImage1' => Input::file('chooseImage1'),
							'id' => Input::get('id'),
							'nric' => Input::get('nric'),
							'gender' => Input::get('gender'),
							'nationality' => Input::get('nationality'),
							'year' => Input::get('year'),
							'month' => Input::get('month'),
							'day' => Input::get('day'),
							'age' => Input::get('age'),
							'race' => Input::get('race'),
							'country_code' => Input::get('country_code'),
							'mobile_contact' => Input::get('mobile_contact'),
							'residential_contact' => Input::get('residential_contact'),
							'local_address' => Input::get('local_address'),
							'unitno1' => Input::get('unitno1'),
							'unitno2' => Input::get('unitno2'),
							'street_name' => Input::get('street_name'),
							'apartment_name' => Input::get('apartment_name'),
							'postal_code' => Input::get('postal_code'),
							'occupation' => Input::get('occupation'),
							'intro_lesson' => Input::get('introlesson'),
							'floral_related' => Input::get('floral_related'),
							'education' => Input::get('education'),
							'emergency_contact_person' => Input::get('emergency_contact_person'),
							'emergency_contact_number' => Input::get('emergency_contact_number'),
							'sponsor' => Input::get('sponsor'),
							'payment_mode' => Input::get('payment_mode'),
							'date_of_payment' => Input::get('date_of_payment'),
							'company_name' => Input::get('company_name'),
							'contact_person' => Input::get('contact_person'),
							'designation' => Input::get('designation'),
							'company_address' => Input::get('company_address'),
							'company_postalcode' => Input::get('company_postalcode'),
							'company_contact_no' => Input::get('company_contact_no'),
							'company_fax' => Input::get('company_fax'),
							'company_email' => Input::get('company_email'),
							'company_website' => Input::get('company_website'),
							'foreign_std' => Input::get('foreign_std'),
							'oversea_address' => Input::get('oversea_address'),
							'oversea_zipcode' => Input::get('oversea_zipcode'),
							'oversea_contact' => Input::get('oversea_contact'),
							'exp_flower_design' => Input::get('exp_flower_design'),
							'exp_detail' => Input::get('exp_detail'),
							'enrollment_reason' => Input::get('enrollment_reason'),
							'internet_site' => Input::get('internet_site'),
							'news_directory' => Input::get('news_directory'),
							'magazine' => Input::get('magazine'),
							'friend_company' => Input::get('friend_company'),
							'others' => Input::get('others'),
							'course_id' => Input::get('module_apply'),
							'course_fee' => $course_fee,
							'branch_id'	=>	Input::get('branch_id'),
							'date_of_registration' => Input::get('date_of_registration'),
							'date_of_completion' =>	Input::get('date_of_completion'),
							'date_of_commencement' => Input::get('date_of_commencement'),
							'date_of_payment' => Input::get('date_of_payment'),
							'invoice_number' =>	Input::get('invoice_number'),
							'receipt_number' =>	Input::get('receipt_number'),
							'payment_note'	=> Input::get('payment_note'),
							'payment_mode' => Input::get('payment_note')
						   );

				$stdData = http_build_query($stdDataArr);

				return Redirect::to('students/create/paypal/'.$course_fee.'/'.$stdData);
			}else{

				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());

				$UserEntry = new UserEntry;
				$UserEntry->show_id = Input::get('name');
				//$UserEntry->password = Hash::make($password);
				$UserEntry->email = Input::get('email');
				$UserEntry->role = 3 ;
				$UserEntry->status = 0 ;

				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$UserEntry->created_at		   = $date;
				$UserEntry->updated_at		   = $date;
				$UserEntry->updated_by		   = Auth::user()->id;
				$UserEntry -> save();


				//$get_useremail = UserEntry::find(Input::get('email'));
				#kalayar added some function werwe
				//$get_userArray = UserEntry::where('email', '=', Input::get('email'))->get();
				$get_userid = UserEntry::where('email', '=', Input::get('email'))->pluck('id');

				//var_dump($get_userArray);
				#$getuserID= DB::table('users')->where('email', Input::get('email'))->value('id');


				$StudentEntry = new StudentEntry;
				if (Input::file('chooseImage1'))
				{
					if (Input::file('chooseImage1')->isValid())
					{
						$files1 = Input::file('chooseImage1');
						$temp = explode(".", Input::file('chooseImage1')->getClientOriginalName());
						$newfilename = round(microtime(true)) . '.' . end($temp);
						//$files1->move('uploads', Input::file('chooseImage1')->getClientOriginalName());
						$files1->move('uploads', $newfilename);
						$filesname1 = Input::file('chooseImage1')->getClientOriginalName();
						$StudentEntry->profile_picture = $newfilename;
					}
				}else{
						$StudentEntry->profile_picture = 'default-img-200x200.png';
				}
				$StudentEntry->id       = Input::get('id');
				$StudentEntry->user_id       = $get_userid;
				$StudentEntry->name       = Input::get('name');
				$StudentEntry->nric       = Input::get('nric');
				$StudentEntry->email	   = Input::get('email');
				$StudentEntry->gender       = Input::get('gender');
				$StudentEntry->nationality       = Input::get('nationality');
				$StudentEntry->doby       =  Input::get('year');
				$StudentEntry->dobm       =  Input::get('month');
				$StudentEntry->dobd       =  Input::get('day');
				$StudentEntry->age       =  Input::get('age');
				$StudentEntry->race	   = Input::get('race');				
				$StudentEntry->country_code	   = Input::get('country_code');
				$StudentEntry->mobile_contact	   = Input::get('mobile_contact');
				$StudentEntry->residential_contact	   = Input::get('residential_contact');
				$StudentEntry->local_address       = Input::get('local_address');
				$StudentEntry->unit_no		   = Input::get('unitno1') . Input::get('unitno2');
				$StudentEntry->street_name		   = Input::get('street_name');
				$StudentEntry->apartment_name  = Input::get('apartment_name');
				$StudentEntry->postal_code		   = Input::get('postal_code');
				$StudentEntry->occupation		   = Input::get('occupation');
				$StudentEntry->intro_lesson		   = Input::get('introlesson');
				$StudentEntry->floral_related		   = Input::get('floral_related');
				$StudentEntry->education		   = Input::get('education');
				$edu_others = Input::get('education');
				if($edu_others == 'Others'){
					$StudentEntry->education	= Input::get('edu_others');
				}
				$StudentEntry->emergency_contact_person		   = Input::get('emergency_contact_person');
				$StudentEntry->emergency_contact_number		   = Input::get('emergency_contact_number');
				
				$StudentEntry->receipt_number = Input::get('receipt_number');
				$StudentEntry->invoice_number = Input::get('invoice_number');
				$StudentEntry->payment_receive_by = Input::get('payment_receive_by');
				$StudentEntry->payment_note = Input::get('payment_note');


				$StudentEntry->sponsorship = Input::get('sponsor');

				$payment_mode = Input::get('payment_mode');


				$StudentEntry->payment_mode = Input::get('payment_mode');
				$StudentEntry->date_of_payment = Input::get('date_of_payment');

				
				$StudentEntry->created_at		   = $date;
				$StudentEntry->updated_at		   = $date;
				$StudentEntry->updated_by		   = Auth::user()->id;

				/* Company Information */
				$StudentEntry->company_name = Input::get('company_name');
				$StudentEntry->contact_person = Input::get('contact_person');
				$StudentEntry->designation = Input::get('designation');
				$StudentEntry->company_address = Input::get('company_address');
				$StudentEntry->company_postalcode = Input::get('company_postalcode');
				$StudentEntry->company_contact_no = Input::get('company_contact_no');
				$StudentEntry->company_fax = Input::get('company_fax');
				$StudentEntry->company_email = Input::get('company_email');
				$StudentEntry->company_website = Input::get('company_website');

				$StudentEntry->foreign_student = Input::get('foreign_std');


				/* Overseas Contact & Mailing Address */
				$StudentEntry->oversea_address = Input::get('oversea_address');
				$StudentEntry->oversea_zipcode = Input::get('oversea_zipcode');
				$StudentEntry->oversea_contact = Input::get('oversea_contact');


				/* Other Information */
				$StudentEntry->exp_flower_design = Input::get('exp_flower_design');
				$StudentEntry->exp_detail = Input::get('exp_detail');
				$StudentEntry->enrollment_reason = Input::get('enrollment_reason');
				$StudentEntry->internet_site = Input::get('internet_site');
				$StudentEntry->news_directory = Input::get('news_directory');
				$StudentEntry->magazine = Input::get('magazine');
				$StudentEntry->friend_company = Input::get('friend_company');
				$StudentEntry->others = Input::get('others');

				$StudentEntry->status = 0;
				/* Start examination information */
				
				//$StudentEntry->exam_require = Input::get('exam_require');
				if (Input::get('exam_require') == 'Yes') {
					$StudentEntry->final_exam_date = Input::get('final_exam_date');
					$StudentEntry->final_exam_duration = Input::get('final_exam_duration');
					$StudentEntry->final_ass_name1 = Input::get('final_ass_name1');
					$StudentEntry->final_ass_name2 = Input::get('final_ass_name2');
					$StudentEntry->final_exam_result = Input::get('final_exam_result');
					$StudentEntry->final_exam_remark = Input::get('final_exam_remark');
					$StudentEntry->final_exam_scores = Input::get('final_exam_scores');

					$StudentEntry->retest_exam_date = Input::get('retest_exam_date');
					$StudentEntry->retest_exam_duration = Input::get('retest_exam_duration');
					$StudentEntry->retest_ass_name1 = Input::get('retest_ass_name1');
					$StudentEntry->retest_ass_name2 = Input::get('retest_ass_name2');
					$StudentEntry->retest_exam_result = Input::get('retest_exam_result');
					$StudentEntry->retest_exam_remark = Input::get('retest_exam_remark');
					$StudentEntry->retest_exam_scores = Input::get('retest_exam_scores');
				}

				/* End examination information */
				$StudentEntry->branch_id = Input::get('branch_id');
				$StudentEntry->save();

				$StudentEntry->nobleman_student_id = $this->getNobleManId($StudentEntry->branch->code,$StudentEntry->id);
				$StudentEntry->save();

				Session::flash('message', 'Successfully created students!');
				$StudentCourseEntry = new StudentCourseEntry;
				$StudentCourseEntry->student_id = $StudentEntry->id; 
				$StudentCourseEntry->course_id = Input::get('module_apply');
				$StudentCourseEntry->date_of_registration = Input::get('date_of_registration'); 
				$StudentCourseEntry->date_of_completion = Input::get('date_of_completion');
				$StudentCourseEntry->date_of_commencement = Input::get('date_of_commencement');
				$StudentCourseEntry->date_of_payment = Input::get('date_of_payment');
				$StudentCourseEntry->invoice_number = Input::get('invoice_number');
				$StudentCourseEntry->receipt_number = Input::get('receipt_number');
				$StudentCourseEntry->payment_note = Input::get('payment_note');
				$StudentCourseEntry->payment_mode = Input::get('payment_mode');
				$StudentCourseEntry->status = 0;
				$StudentCourseEntry ->save();
				 
				/*$UserEntry = new UserEntry;
				$UserEntry->show_id = Input::get('name');
				$UserEntry->email = Input::get('email');
				//$UserEntry->password = Hash::make($password);
				$UserEntry->email = Input::get('email');
				$UserEntry->role = 3 ;*/
				// $UserEntry->status = 0 ;

				/*if ($payment_mode == 'Paypal') {
					$UserEntry->status = 1 ;

					if(Input::get('password') == ''){
						$loginpassword = 'n@b$lm8n0std&';
					}else{
						$loginpassword = Input::get('password');
					}
					$UserEntry->password = Hash::make($loginpassword);

				}else{
					$UserEntry->status = 0 ;
					$UserEntry->password = Hash::make($password);
				}*/


				/*date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$UserEntry->created_at		   = $date;
				$UserEntry->updated_at		   = $date;
				$UserEntry->updated_by		   = Auth::user()->id;
				$UserEntry -> save();*/

				/* send email */	
				/*$to_email = Input::get('email');
				$subject = "Thanks for your registration from nobleman school";

				$message_body = '<html><body>
								<h6>Thank you for your registration.</h6>
								</body></html>';
				$nb_email = "nan.kalayar@innov8te.com.sg";	

			    $headers = 'From: '.$nb_email.'' . "\r\n" .
			    'Reply-To: '.$nb_email.'' . "\r\n" .
			    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			   
			   mail($to_email, $subject, $message_body, $headers);*/

			   /* End send mail */
			   return Redirect::to('students');
			}
		}

		}else{
			Session::flash('message', 'Your email address is already registered in Nobleman!');
			return Redirect::to('students/create');
		}
		//}
		
		}//end
	}
	public function edit()
	{
		if(Auth::user()->role ==1 ) {
		$sid = Input::get('id'); 
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');

		$hash_password = Hash::make($password);


		if ($password == $cfm_password)
		{
			$rules = array(
				'name'     => 'required',
				'nric'     => 'required',
				'gender'     => 'required',
				'email'     => 'required',
				'nationality'     => 'required',
				'mobile_contact'     => 'required',
				'branch_id'		=>	'required'
			);
			$validator = Validator::make(Input::all(), $rules);
	
			if ($validator->fails()) {
				return Redirect::to('students/'.$sid)
					->withErrors($validator);
			} else {

				$get_user_id = StudentEntry::where('id','=',$sid)->pluck('user_id');

				$check_useremail = UserEntry::where('email','=',Input::get('email'))->where('id','=',$get_user_id)->count();
				if($check_useremail == 0){
					//insert the new email for edit user
					$check_email_count = UserEntry::where('email','=',Input::get('email'))->where('id','!=',$get_user_id)->count();
					if($check_email_count == 0){
						//no duplicated email
						$UserEntry = UserEntry::find($get_user_id);
						$UserEntry->email = Input::get('email');
						if(Input::get('password') != ''){
						$UserEntry->password = Hash::make($password);
						}
						$UserEntry->save();
					}else{
						Session::flash('message', 'Your email address is already registered in Nobleman!');
						return Redirect::to('students/' . $sid);
					}

				}else{
					$UserEntry = UserEntry::find($get_user_id);
					if(Input::get('password') != ''){
					$UserEntry->password = Hash::make($password);
					}
					$UserEntry->save();
				}


				$StudentEntry = StudentEntry::find(Input::get('id'));

				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				
				if(Input::get('changeProfile')){	
					if (Input::hasFile('chooseImage'))
					{
						if (Input::file('chooseImage')->isValid())
						{
							$files1 = Input::file('chooseImage');
							$temp1 = explode(".", Input::file('chooseImage')->getClientOriginalName());
							$newfilename1 = round(microtime(true)) . '.' . end($temp1);
							//$files1->move('uploads', Input::file('chooseImage')->getClientOriginalName());
							$files1->move('uploads', $newfilename1);
							$filesname1 = Input::file('chooseImage')->getClientOriginalName();
							$StudentEntry->profile_picture = $newfilename1;

						}
					}
				}

				$StudentEntry->id       = Input::get('id');
				$StudentEntry->name       = Input::get('name');
				$StudentEntry->nric       = Input::get('nric');
				$StudentEntry->email	   = Input::get('email');
				$StudentEntry->gender       = Input::get('gender');
				$StudentEntry->nationality       = Input::get('nationality');
				$StudentEntry->doby       =  Input::get('year');
				$StudentEntry->dobm       =  Input::get('month');
				$StudentEntry->dobd       =  Input::get('day');
				$StudentEntry->age       =  Input::get('age');
				$StudentEntry->race	   = Input::get('race');
				$StudentEntry->country_code	   = Input::get('country_code');
				$StudentEntry->mobile_contact	   = Input::get('mobile_contact');
				$StudentEntry->residential_contact	   = Input::get('residential_contact');
				$StudentEntry->local_address       = Input::get('local_address');
				$StudentEntry->unit_no		   = Input::get('unitno1') . Input::get('unitno2');
				$StudentEntry->street_name		   = Input::get('street_name');
				$StudentEntry->apartment_name  = Input::get('apartment_name');
				$StudentEntry->postal_code		   = Input::get('postal_code');
				$StudentEntry->occupation		   = Input::get('occupation');
				$StudentEntry->intro_lesson		   = Input::get('introlesson');
				$StudentEntry->floral_related		   = Input::get('floral_related');
				$StudentEntry->education		   = Input::get('education');
				$StudentEntry->emergency_contact_person		   = Input::get('emergency_contact_person');
				$StudentEntry->emergency_contact_number		   = Input::get('emergency_contact_number');

				//$StudentEntry->password	   = $hash_password;
				/*if(Input::get('password') != ''){
				$StudentEntry->password	   = Hash::make($password);
				}*/

				if(Input::get('password') != ''){

						$loginpassword = Input::get('password');
						$StudentEntry->password	   = Hash::make($loginpassword);
						/* send email for activated account */
						/*$std_name = Input::get('name');
						$to_email = Input::get('email');
						$subject = "Activated account for Nobleman registration.";
						$message_body = '<html><body>
										<p>Hi '.$std_name.',</p>
										<P></p>
										<p>Thank you for your registration Your account has been activated. Now you can login to system by using this password. Later you can reset the password in your login dashboard.</p>
										<P>Login email : '.$to_email.'</p>
										<P>Password : '.$loginpassword.'</p>
										<P></p>
										</body></html>';
						$nb_email = "nan.kalayar@innov8te.com.sg";	

					    $headers = 'From: '.$nb_email.'' . "\r\n" .
					    'Reply-To: '.$nb_email.'' . "\r\n" .
					    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
					    'X-Mailer: PHP/' . phpversion();
					   
					   mail($to_email, $subject, $message_body, $headers);*/

				}//end password check
					

				$StudentEntry->sponsorship = Input::get('sponsor');

				$payment_mode = Input::get('payment_mode');
				
				if ($payment_mode == 'Paypal') {
					//$StudentEntry->status = 1;
					$StudentEntry->payment_status = 1;
				}else{
					//$StudentEntry->status = 0;
					$StudentEntry->payment_status = 0;
				}

				$StudentEntry->payment_mode = Input::get('payment_mode');
				$StudentEntry->date_of_payment = Input::get('date_of_payment');

				
				//$StudentEntry->created_at		   = $date;
				$StudentEntry->updated_at		   = $date;
				$StudentEntry->updated_by		   = Auth::user()->id;


				/* Company Information */
				$StudentEntry->company_name = Input::get('company_name');
				$StudentEntry->contact_person = Input::get('contact_person');
				$StudentEntry->designation = Input::get('designation');
				$StudentEntry->company_address = Input::get('company_address');
				$StudentEntry->company_postalcode = Input::get('company_postalcode');
				$StudentEntry->company_contact_no = Input::get('company_contact_no');
				$StudentEntry->company_fax = Input::get('company_fax');
				$StudentEntry->company_email = Input::get('company_email');
				$StudentEntry->company_website = Input::get('company_website');

				$StudentEntry->foreign_student = Input::get('foreign_std');
				

				/* Overseas Contact & Mailing Address */
				$StudentEntry->oversea_address = Input::get('oversea_address');
				$StudentEntry->oversea_zipcode = Input::get('oversea_zipcode');
				$StudentEntry->oversea_contact = Input::get('oversea_contact');


				/* Other Information */
				$StudentEntry->exp_flower_design = Input::get('exp_flower_design');
				$StudentEntry->exp_detail = Input::get('exp_detail');
				$StudentEntry->enrollment_reason = Input::get('enrollment_reason');
				$StudentEntry->internet_site = Input::get('internet_site');
				$StudentEntry->news_directory = Input::get('news_directory');
				$StudentEntry->magazine = Input::get('magazine');
				$StudentEntry->friend_company = Input::get('friend_company');
				$StudentEntry->others = Input::get('others');


				/* Start examination information */

				// $StudentEntry->exam_require = Input::get('exam_require');

				if (Input::get('exam_require') == 'Yes') {
					$StudentEntry->final_exam_date = Input::get('final_exam_date');
					$StudentEntry->final_exam_duration = Input::get('final_exam_duration');
					$StudentEntry->final_ass_name1 = Input::get('final_ass_name1');
					$StudentEntry->final_ass_name2 = Input::get('final_ass_name2');
					$StudentEntry->final_exam_result = Input::get('final_exam_result');
					$StudentEntry->final_exam_remark = Input::get('final_exam_remark');
					$StudentEntry->final_exam_scores = Input::get('final_exam_scores');

					$StudentEntry->retest_exam_date = Input::get('retest_exam_date');
					$StudentEntry->retest_exam_duration = Input::get('retest_exam_duration');
					$StudentEntry->retest_ass_name1 = Input::get('retest_ass_name1');
					$StudentEntry->retest_ass_name2 = Input::get('retest_ass_name2');
					$StudentEntry->retest_exam_result = Input::get('retest_exam_result');
					$StudentEntry->retest_exam_remark = Input::get('retest_exam_remark');
					$StudentEntry->retest_exam_scores = Input::get('retest_exam_scores');
				}
				/* End examination information */

				/* Update Noble Man Student Id If null */
				$StudentEntry->branch_id = Input::get('branch_id');

				if($StudentEntry->nobleman_student_id=='' && Input::get('branch_id') !=null ){
					$StudentEntry->nobleman_student_id = $this->getNobleManId($StudentEntry->branch->code,$StudentEntry->id);
					$StudentEntry->save();
				}

				$StudentEntry->save();
	
				Session::flash('message', 'Successfully edited students!');

				// $studentmodule = StudentModuleEntry::where('student_id','=',$sid)->get()->first();
				// $studentmodule->module_id = Input::get('module_apply');
				// $studentmodule->save();


				//$studentmodule = StudentModuleEntry::where('student_id', '=', $sid)->update(array('module_id' => Input::get('module_apply')));
				//$studentmodule->save();

				return Redirect::to('students');
			}
		}else{
			Session::flash('message', 'Password is unmatched.');
			return Redirect::to('students/'.$sid);
		}
	}
}


	public function changestatus($id)
	{
		if(Auth::user()->role ==1 ) {
		$studententry = StudentEntry::find($id);
		$em = $studententry->email ;

		//$loginpassword = 'n@b$lm8n0std&';
		$loginpassword = sha1(md5($em));

		$ss = $studententry -> status;
		if ($ss == 0){
			$studententry -> status = 1;			
			$studententry->password	 = Hash::make($loginpassword);
		}
		else
		{
			$studententry -> status = 0;
		}

		$studententry -> save();
		$smail = $studententry -> email ;
		$sid = UserEntry::where('email','=',$smail)->pluck('id');
		$uentry = UserEntry::find($sid);
		$uss = $uentry ->status;
		if ($uss == 0){
			$uentry -> status = 1;

			$uentry->password	 = Hash::make($loginpassword);			
		}
		else
		{
			$uentry -> status = 0;
		}
		$uentry -> save();

		if($studententry->status == 1){
			/* send email for activated account */
			$to_email = $studententry->email;
			$std_name = $studententry->name;
			$subject = "Activated account for Nobleman registration.";
			// $loginpassword = 'n@b$lm8n0std&';
			$message_body = '<html><body>
							<p>Hi '.$std_name.',</p>
							<P></p>
							<p>Thank you for your registration!Your account has been activated.</p>
							<p>We have received your payment.Your account credentials is as follow:</p>
							<P>Login email : '.$to_email.'</p>
							<P>Password : '.$loginpassword.'</p>
							<P></p>
							</body></html>';
			$nb_email = "nan.kalayar@innov8te.com.sg";	

		    $headers = 'From: '.$nb_email.'' . "\r\n" .
		    'Reply-To: '.$nb_email.'' . "\r\n" .
		    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		   
		    mail($to_email, $subject, $message_body, $headers);

		}

		Session::flash('message', 'Successfully changed status!');
		return Redirect::to('students');

		}//end
	}


	function linkpaypal($mf, $data)
	{
		$this->layout->content =  View::make('students.paypalform')->with('coursefee', $mf)->with('stddata', $data);

	}


	function linkpaypalsuccess() 
	{
		$UserEntry = new UserEntry;
		$UserEntry->show_id = Input::get('name');
		$UserEntry->email = Input::get('email');
		$UserEntry->role = 3 ;
		$UserEntry->status = 0 ;

		date_default_timezone_set('Asia/Singapore');
		$date = date('Y-m-d h:i:s', time());
		$UserEntry->created_at= $date;
		$UserEntry->updated_at = $date;
		$UserEntry->updated_by = Auth::user()->id;
		$UserEntry -> save();

		$StudentEntry = new StudentEntry;
		if (Input::hasFile('chooseImage1'))
		{
			if (Input::file('chooseImage1')->isValid())
			{
				$files1 = Input::file('chooseImage1');
				$files1->move('uploads', Input::file('chooseImage1')->getClientOriginalName());
				$filesname1 = Input::file('chooseImage1')->getClientOriginalName();
				$StudentEntry->profile_picture = $filesname1;
			}
		}else{ 
				$StudentEntry->profile_picture = 'default-img-200x200.png';
		}

		$get_userid = UserEntry::where('email', '=', Input::get('email'))->pluck('id');

		$StudentEntry->id       = Input::get('id');
		$StudentEntry->user_id       = $get_userid;
		$StudentEntry->name       = Input::get('name');
		$StudentEntry->nric       = Input::get('nric');
		$StudentEntry->email	   = Input::get('email');
		$StudentEntry->gender       = Input::get('gender');
		$StudentEntry->nationality       = Input::get('nationality');
		$StudentEntry->doby       =  Input::get('year');
		$StudentEntry->dobm       =  Input::get('month');
		$StudentEntry->dobd       =  Input::get('day');
		$StudentEntry->age       =  Input::get('age');
		$StudentEntry->race	   = Input::get('race');
		$StudentEntry->country_code	   = Input::get('country_code');
		$StudentEntry->mobile_contact	   = Input::get('mobile_contact');
		$StudentEntry->residential_contact	   = Input::get('residential_contact');
		$StudentEntry->local_address       = Input::get('local_address');
		$StudentEntry->unit_no		   = Input::get('unitno1') . Input::get('unitno2');
		$StudentEntry->street_name		   = Input::get('street_name');
		$StudentEntry->apartment_name  = Input::get('apartment_name');
		$StudentEntry->postal_code		   = Input::get('postal_code');
		$StudentEntry->occupation		   = Input::get('occupation');
		$StudentEntry->intro_lesson		   = Input::get('introlesson');
		$StudentEntry->floral_related		   = Input::get('floral_related');
		$StudentEntry->education		   = Input::get('education');
		$edu_others = Input::get('education');
		if($edu_others == 'Others'){
			$StudentEntry->education	= Input::get('edu_others');
		}
		$StudentEntry->emergency_contact_person		   = Input::get('emergency_contact_person');
		$StudentEntry->emergency_contact_number		   = Input::get('emergency_contact_number');

		$StudentEntry->receipt_number = Input::get('receipt_number');
		$StudentEntry->invoice_number = Input::get('invoice_number');
		$StudentEntry->payment_receive_by = Input::get('payment_receive_by');
		$StudentEntry->payment_note = Input::get('payment_note');

		date_default_timezone_set('Asia/Singapore');
		$date = date('Y-m-d h:i:s', time());

		$StudentEntry->sponsorship = Input::get('sponsor');

		$payment_mode = Input::get('payment_mode');

		$StudentEntry->payment_status = 1;					
		$StudentEntry->status = 1;
		if(Input::get('password') == ''){
			//$loginpassword = 'n@b$lm8n0std&';
			$em = Input::get('email');
			$loginpassword = sha1(md5($em));

		}else{
			$loginpassword = Input::get('password');
		}

		$StudentEntry->password	   = Hash::make($loginpassword);

		/* send email for activated account */
		$std_name = Input::get('name');
		$to_email = Input::get('email');
		$subject = "Activated account for Nobleman registration.";
		// $loginpassword = 'n@b$lm8n0std&';
		$message_body = '<html><body>
						<p>Hi '.$std_name.',</p>
						<P></p>
						<p>Thank you for your registration!Your account has been activated.</p>
						<p>Payment is successful.Your account credentials is as follow:</p>
						<P>Login email : '.$to_email.'</p>
						<P>Password : '.$loginpassword.'</p>
						<P></p>
						</body></html>';
		$nb_email = "nan.kalayar@innov8te.com.sg";	

	    $headers = 'From: '.$nb_email.'' . "\r\n" .
	    'Reply-To: '.$nb_email.'' . "\r\n" .
	    "Content-Type: text/html; charset=ISO-8859-1\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	   
	    mail($to_email, $subject, $message_body, $headers);

	    $StudentEntry->payment_mode = Input::get('payment_mode');
		$StudentEntry->date_of_payment = Input::get('date_of_payment');

		
		$StudentEntry->created_at		   = $date;
		$StudentEntry->updated_at		   = $date;
		$StudentEntry->updated_by		   = Auth::user()->id;

		/* Company Information */
		$StudentEntry->company_name = Input::get('company_name');
		$StudentEntry->contact_person = Input::get('contact_person');
		$StudentEntry->designation = Input::get('designation');
		$StudentEntry->company_address = Input::get('company_address');
		$StudentEntry->company_postalcode = Input::get('company_postalcode');
		$StudentEntry->company_contact_no = Input::get('company_contact_no');
		$StudentEntry->company_fax = Input::get('company_fax');
		$StudentEntry->company_email = Input::get('company_email');
		$StudentEntry->company_website = Input::get('company_website');

		$StudentEntry->foreign_student = Input::get('foreign_std');


		/* Overseas Contact & Mailing Address */
		$StudentEntry->oversea_address = Input::get('oversea_address');
		$StudentEntry->oversea_zipcode = Input::get('oversea_zipcode');
		$StudentEntry->oversea_contact = Input::get('oversea_contact');


		/* Other Information */
		$StudentEntry->exp_flower_design = Input::get('exp_flower_design');
		$StudentEntry->exp_detail = Input::get('exp_detail');
		$StudentEntry->enrollment_reason = Input::get('enrollment_reason');
		$StudentEntry->internet_site = Input::get('internet_site');
		$StudentEntry->news_directory = Input::get('news_directory');
		$StudentEntry->magazine = Input::get('magazine');
		$StudentEntry->friend_company = Input::get('friend_company');
		$StudentEntry->others = Input::get('others');
		$StudentEntry->save();

		$StudentEntry->nobleman_student_id = $this->getNobleManId($StudentEntry->branch->code,$StudentEntry->id);
		$StudentEntry->save();

		Session::flash('message', 'Successfully created students!');
		$StudentCourseEntry = new StudentCourseEntry;
		$StudentCourseEntry->student_id = $StudentEntry->id; 
		$StudentCourseEntry->course_id = Input::get('module_apply');
		$StudentCourseEntry->date_of_registration = Input::get('date_of_registration'); 
		$StudentCourseEntry->date_of_completion = Input::get('date_of_completion');
		$StudentCourseEntry->date_of_commencement = Input::get('date_of_commencement');
		$StudentCourseEntry->date_of_payment = Input::get('date_of_payment');
		$StudentCourseEntry->invoice_number = Input::get('invoice_number');
		$StudentCourseEntry->receipt_number = Input::get('receipt_number');
		$StudentCourseEntry->payment_note = Input::get('payment_note');
		$StudentCourseEntry->payment_mode = Input::get('payment_mode');
		$StudentCourseEntry->status = 0;
		$StudentCourseEntry ->save();
				 

		return Redirect::to('students');
	}


	/* Download for each student */
	function download($id)
	{
		if (Auth::user()->role == 1) {
			$student = StudentEntry::find($id);		
			$receiver = User::find($student->payment_receive_by);
			$receiver = $receiver != null ? $receiver->show_id : '' ;	

			$logo = $_SERVER["DOCUMENT_ROOT"] . 'nobleman/assets/img/noblemanlogo.png';

			$html = '<html><head><style>
					body{ font-family:helvetica;font-size:10px;color:#4d4c4b; } 
					table{ border-collapse:collapse;border: 1px solid #d7d6d5;}
					table, th, td { border: 1px solid #d7d6d5;padding:10px;}</style>
					</head><body>'
					.'<div>'
					.'<div style="padding-top:15px;text-align:center;">'
					.'<img src="'.$logo.'" />'
					.'<p style="font-size:15px;font-family:helvetica!important">Student Detail</p>'
					.'</div>'
					.'<table>'					
					.'<tbody>';		

			//$html = $html .'<tr><td>Name : </td><td>'.$student['name'].'</td></tr>';

			$html = $html .'<tr><td>Name : </td><td>'.$student['name'].'</td></tr>';
			$html = $html .'<tr><td>I/C or Passport No. : </td><td>'.$student['nric'].'</td></tr>';
			$html = $html .'<tr><td>Gender : </td><td>'.$student['gender'].'</td></tr>';
			$html = $html .'<tr><td>Nationality : </td><td>'.$student['nationality'].'</td></tr>';
			$html = $html .'<tr><td>Date of Birth  : </td><td>'.$student['dobd']. '/' .$student['dobm']. '/' .$student['doby'].'</td></tr>';
			$html = $html .'<tr><td>Age : </td><td>'.$student['age'].'</td></tr>';
			$html = $html .'<tr><td>Race : </td><td>'.$student['race'].'</td></tr>';
			$html = $html .'<tr><td>Mobile Number : </td><td>'.$student['country_code'].' '.$student['mobile_contact'].'</td></tr>';
			$html = $html .'<tr><td>Residential Number : </td><td>'.$student['residential_contact'].'</td></tr>';
			$html = $html .'<tr><td>E-mail : </td><td>'.$student['email'].'</td></tr>';
			$html = $html .'<tr><td>Local Address : </td><td>'.$student['local_address'].'</td></tr>';
			$html = $html .'<tr><td>Unit No : </td><td>'.$student['unit_no'].'</td></tr>';
			$html = $html .'<tr><td>Street Name : </td><td>'.$student['street_name'].'</td></tr>';
			$html = $html .'<tr><td>Residential Address : </td><td>'.$student['apartment_name'].'</td></tr>';
			$html = $html .'<tr><td>Postal Code : </td><td>'.$student['postal_code'].'</td></tr>';
			$html = $html .'<tr><td>Occupation : </td><td>'.$student['occupation'].'</td></tr>';
			$html = $html .'<tr><td>Intro Lesson : </td><td>'.$student['intro_lesson'].'</td></tr>';
			$html = $html .'<tr><td>Job related to florist : </td><td>'.$student['floral_related'].'</td></tr>';
			$html = $html .'<tr><td>Education : </td><td>'.$student['education'].'</td></tr>';
			$html = $html .'<tr><td>Sponsor by Company : </td><td>'.$student['sponsorship'].'</td></tr>';


			if ($student['sponsorship'] == 'Yes') {
				$html = $html .'<tr><td colspan="2"><b>Company Information</b> </td></tr>';
				$html = $html .'<tr><td>Company Name : </td><td>'.$student['company_name'].'</td></tr>';
				$html = $html .'<tr><td>Contact Person : </td><td>'.$student['contact_person'].'</td></tr>';
				$html = $html .'<tr><td>Designation : </td><td>'.$student['designation'].'</td></tr>';
				$html = $html .'<tr><td>Address : </td><td>'.$student['company_address'].'</td></tr>';
				$html = $html .'<tr><td>Postal Code : </td><td>'.$student['company_postalcode'].'</td></tr>';
				$html = $html .'<tr><td>Contact No : </td><td>'.$student['company_contact_no'].'</td></tr>';
				$html = $html .'<tr><td>Fax No : </td><td>'.$student['company_fax'].'</td></tr>';
				$html = $html .'<tr><td>Email : </td><td>'.$student['company_email'].'</td></tr>';
				$html = $html .'<tr><td>Website : </td><td>'.$student['company_website'].'</td></tr>';
			}

			if ($student['foreign_student'] == 'Yes') {
				$html = $html .'<tr><td colspan="2"><b>Overseas Contact & Mailing Address</b> </td></tr>';
				$html = $html .'<tr><td>Address : </td><td>'.$student['oversea_address'].'</td></tr>';
				$html = $html .'<tr><td>Zip Code : </td><td>'.$student['oversea_zipcode'].'</td></tr>';
				$html = $html .'<tr><td>Overseas Contact : </td><td>'.$student['oversea_contact'].'</td></tr>';				
			}


			$html = $html .'<tr><td colspan="2"><b>Emergency Contact</b> </td></tr>';
			$html = $html .'<tr><td>Contact Person : </td><td>'.$student['emergency_contact_person'].'</td></tr>';
			$html = $html .'<tr><td>Contact No : </td><td>'.$student['emergency_contact_number'].'</td></tr>';

			
			$course_id = StudentCourseEntry::where('student_id','=',$id)->pluck('course_id');
			$course_name = CoursesEntry::where('id','=',$course_id)->pluck('course_name');			
			$html = $html .'<tr><td colspan="2"><b>Course Information</b> </td></tr>';
			$html = $html .'<tr><td>Contact Person : </td><td>'.$course_name.'</td></tr>';


			$html = $html .'<tr><td colspan="2"><b>Other Information</b> </td></tr>';
			$html = $html .'<tr><td>Your experience in flower designing : </td><td>'.$student['exp_flower_design'].'</td></tr>';
			$html = $html .'<tr><td>(Please provide us the details if you have prior experience or previous lesson <br /> attended elsewhere or in NSFD) : </td><td>'.$student['exp_detail'].'</td></tr>';
			$html = $html .'<tr><td>Enrollment Reason : </td><td>'.$student['enrollment_reason'].'</td></tr>';		
			$html = $html .'<tr><td>Please tell us from where & how <br /> you get to know our school? : </td><td></td></tr>';		
			$html = $html .'<tr><td>1. Internet Site : </td><td>'.$student['internet_site'].'</td></tr>';		
			$html = $html .'<tr><td>2. News Paper & Directory : </td><td>'.$student['news_directory'].'</td></tr>';		
			$html = $html .'<tr><td>3. Magazine : </td><td>'.$student['magazine'].'</td></tr>';		
			$html = $html .'<tr><td>Friends or Company : </td><td>'.$student['friend_company'].'</td></tr>';
			$html = $html .'<tr><td>Others : </td><td>'.$student['others'].'</td></tr>';		

			$html = $html .'<tr><td colspan="2"><b>Others</b> </td></tr>';
			$html = $html .'<tr><td>Payment Mode : </td><td>'.$student['payment_mode'].'</td></tr>';
			$html = $html .'<tr><td>Date Of Payment : </td><td>'.$student['date_of_payment'].'</td></tr>';
			$html = $html .'<tr><td>Invoice Number: </td><td>'.$student['invoice_number'].'</td></tr>';
			$html = $html .'<tr><td>Receipt Number : </td><td>'.$student['receipt_number'].'</td></tr>';
			$html = $html .'<tr><td>Payment Note : </td><td>'.$student['payment_note'].'</td></tr>';
			$html = $html .'<tr><td>Payment Received By : </td><td>'.$receiver.'</td></tr>';

			$html = $html .'</tbody>';
			$html = $html .'</table>';
			$html = $html .'</div>';
			PDF::load($html, 'A4', 'portrait')->download('student_PDF');
			return Redirect::to('students');


		}//end
	}


	/* Import */
	function import()
	{		
		if (Auth::user()->role == 1) {
			
			$csv_file = Input::file('importfile');

			if (($handle = fopen($csv_file, "r")) !== FALSE) {
			    fgetcsv($handle);   
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			        $num = count($data);
			        for ($c=0; $c < $num; $c++) {
			          $col[$c] = $data[$c];
			        }

					$name = $col[0];
					$std_id = $col[1];
					$nric = $col[2];
					$get_email = $col[3];
					$branch = $col[4];
					$gender = $col[5];					
					$nationality = $col[6];
					$dob = $col[7];
					$age = $col[8];
					$race = $col[9];
					$country_code = $col[10];
					$mobile_contact = $col[11];					
					$residential_contact = $col[12];
					$local_address = $col[13];
					$unitno = $col[14];
					$street_name = $col[15];
					$residential_address = $col[16];
					$postal_code = $col[17];
					$occupation = $col[18];
					$intro_lesson = $col[19];
					$floral_related = $col[20];
					$education = $col[21];
					$company_sponsor = $col[22];


					$company_name = $col[23];
					$contact_person = $col[24];
					$designation = $col[25];
					$company_address = $col[26];
					$company_postalcode = $col[27];
					$company_contact_no = $col[28];
					$company_fax = $col[29];
					$company_email = $col[30];
					$company_website = $col[31];

					$foreign_std = $col[32];
					$oversea_address = $col[33];
					$oversea_zipcode = $col[34];
					$oversea_contact = $col[35];

					$emergency_contact_person = $col[36];
					$emergency_contact_number = $col[37];

					$exp_flower_design = $col[35];
					$exp_detail = $col[36];
					$enrollment_reason = $col[37];
					$internet_site = $col[38];
					$news_directory = $col[39];
					$magazine = $col[40];
					$friend_company = $col[41];
					$others = $col[42];

					$course = $col[43];
					$date_of_registration = $col[44];
					$date_of_commencement = $col[45];
					$date_of_completion = $col[46];
					$payment_mode = $col[47];
					$date_of_payment = $col[48];
					$invoice_number = $col[49];
					$receipt_number = $col[50];
					$payment_receive_by  = $col[51];
					$payment_note = $col[52];


					$dob_data = explode("/", $dob);
					$dob_day = $dob_data[0]; 
					$dob_month = $dob_data[1]; 
					$dob_year = $dob_data[2]; 

					$email = trim($get_email);
					$email_count = UserEntry::where('email','=',$email)->count();	
					if($email_count == 0){

						// SQL Query to insert data into DataBase			
						$UserEntry = new UserEntry;
						$UserEntry->show_id = $name;						
						$UserEntry->email = $email;
						$UserEntry->role = 3 ;
						$UserEntry->status = 0 ;

						date_default_timezone_set('Asia/Singapore');
						$date = date('Y-m-d h:i:s', time());
						$UserEntry->created_at		   = $date;
						$UserEntry->updated_at		   = $date;
						$UserEntry->updated_by		   = Auth::user()->id;
						$UserEntry -> save();


						$get_userid = UserEntry::where('email', '=', $email)->pluck('id');
						
						/* student table */
						$StudentEntry = new StudentEntry;
						$StudentEntry->user_id       = $get_userid;
						$StudentEntry->name       = $name;
						$StudentEntry->nobleman_student_id = $std_id;
						$StudentEntry->nric       = $nric;
						$StudentEntry->email	   = $email;
						$StudentEntry->branch_id       = $branch;
						$StudentEntry->gender       = $gender;
						$StudentEntry->nationality       = $nationality;
						$StudentEntry->doby       =  $dob_year;
						$StudentEntry->dobm       =  $dob_month;
						$StudentEntry->dobd       =  $dob_day;
						$StudentEntry->age       =  $age;
						$StudentEntry->race	   = $race;
						$StudentEntry->country_code	   = $country_code;
						$StudentEntry->mobile_contact	   = $mobile_contact;
						$StudentEntry->residential_contact	   = $residential_contact;
						$StudentEntry->local_address       = $local_address;
						$StudentEntry->unit_no		   = $unitno;
						$StudentEntry->street_name		   = $street_name;
						$StudentEntry->apartment_name  = $residential_address;
						$StudentEntry->postal_code		   = $postal_code;
						$StudentEntry->occupation		   = $occupation;
						$StudentEntry->intro_lesson		   = $intro_lesson;
						$StudentEntry->floral_related		   = $floral_related;
						$StudentEntry->education		   = $education;	

						$StudentEntry->emergency_contact_person		   = $emergency_contact_person;
						$StudentEntry->emergency_contact_number		   = $emergency_contact_number;
					

						date_default_timezone_set('Asia/Singapore');
						$date = date('Y-m-d h:i:s', time());

						$StudentEntry->sponsorship = $company_sponsor;
						
						$StudentEntry->created_at = $date;
						$StudentEntry->updated_at = $date;
						$StudentEntry->updated_by = Auth::user()->id;

						/* Company Information */
						$StudentEntry->company_name = $company_name;
						$StudentEntry->contact_person = $contact_person;
						$StudentEntry->designation = $designation;
						$StudentEntry->company_address = $company_address;
						$StudentEntry->company_postalcode = $company_postalcode;
						$StudentEntry->company_contact_no = $company_contact_no;
						$StudentEntry->company_fax = $company_fax;
						$StudentEntry->company_email = $company_email;
						$StudentEntry->company_website = $company_website;

						$StudentEntry->foreign_student = $foreign_std;

						/* Overseas Contact & Mailing Address */
						$StudentEntry->oversea_address = $oversea_address;
						$StudentEntry->oversea_zipcode = $oversea_zipcode;
						$StudentEntry->oversea_contact = $oversea_contact;


						/* Other Information */
						$StudentEntry->exp_flower_design = $exp_flower_design;
						$StudentEntry->exp_detail = $exp_detail;
						$StudentEntry->enrollment_reason = $enrollment_reason;
						$StudentEntry->internet_site = $internet_site;
						$StudentEntry->news_directory = $news_directory;
						$StudentEntry->magazine = $magazine;
						$StudentEntry->friend_company = $friend_company;
						$StudentEntry->others = $others;


						$StudentEntry->status = 0;

						$StudentEntry->save();	
						
						$get_stdid = StudentEntry::where('email', '=', $email)->pluck('id');	

						$get_course_apply = trim($course);				

						$get_courseid = CoursesEntry::where('course_name', '=', $get_course_apply)->pluck('id');

						if (!$get_courseid) {
							$get_courseid = 0;
						}


						$StudentCourseEntry = new StudentCourseEntry;
						$StudentCourseEntry->student_id = $get_stdid;
						$StudentCourseEntry->course_id = $get_courseid;
						$StudentCourseEntry->date_of_registration = $date_of_registration; 						
						$StudentCourseEntry->date_of_commencement = $date_of_commencement;
						$StudentCourseEntry->date_of_completion = $date_of_completion;
						$StudentCourseEntry->payment_mode = $payment_mode;
						$StudentCourseEntry->date_of_payment = $date_of_payment;						
						$StudentCourseEntry->invoice_number = $invoice_number;
						$StudentCourseEntry->receipt_number = $receipt_number;
						$StudentCourseEntry->payment_receive_by = $payment_receive_by;
						$StudentCourseEntry->payment_note = $payment_note;

						$StudentCourseEntry->status = 0;
						$StudentCourseEntry ->save();					

					}					   
					
				}//end while
			 
			    fclose($handle);
			}//end if

			return Redirect::to('students');

		}//end

	}



	function export()
	{		

		if (Auth::user()->role == 1) {

		   header('Content-Encoding: UTF-8');
		   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
		   header("Content-Disposition: attachment; filename=Students_Export_Data".date('d-m-Y_his').".csv");
		   header("Pragma: no-cache"); 
		   header("Expires: 0");

			$data ='';
			$line = '';
			$header='';

	$header='Name' . ",\t".'Student ID' . ",\t".'I/C or Passport No' . ",\t".'Email' . ",\t".'Branch' . ",\t".'Gender' . ",\t".'Nationality' . ",\t".'Date of Birth' . ",\t" . 'Age'. ",\t" .'Race'. ",\t".'Country Code' . ",\t" .'Mobile Number' . ",\t" . 'Residential Number'. ",\t" . 'Local Address'. ",\t" . 'Unit No'. ",\t" .'Street name'. ",\t" .'Residential Address'. ",\t" . 'Postal Code'. ",\t" . 'Occupation'. ",\t".'Intro Lesson' . ",\t" . 'Job related to floristy'. ",\t" . 'Education'. ",\t" . 'Sponsor by Company'. ",\t" . 'Company Name'. ",\t" . 'Contact Person'. ",\t" . 'Designation'. ",\t" . 'Address'. ",\t" . 'Postal Code'. ",\t" . 'Contact No'. ",\t" . 'Fax No'. ",\t" . 'Email' . ",\t" . 'Website'. ",\t" . 'Foreign Student'. ",\t" . 'Overseas Address'. ",\t" . 'Zip Code'. ",\t" . 'Overseas Contact'. ",\t" . 'Emergency Contact Person'. ",\t" . 'Emergency Contact No'. ",\t" . 'Experience in flower designing'. ",\t" . 'Describe experience detail'. ",\t" . 'Enrollment Reason'. ",\t" . 'Internet Site'. ",\t" . 'News Paper & Directory'. ",\t" . 'Magazine'. ",\t" . 'Friends or Company'. ",\t" . 'Others'. ",\t" . 'Course'. ",\t" . 'Date Of Registration'. ",\t" . 'Date Of Commencement'. ",\t" . 'Date Of Actual Completion'. ",\t" . 'Payment Mode'. ",\t" . 'Date Of Payment'. ",\t" . 'Invoice Number'. ",\t" . 'Receipt Number'. ",\t" . 'Payment Receive By'. ",\t" . 'Payment Note';


			$student_query = DB::select("SELECT st.name ,st.nobleman_student_id,st.nric,st.email,b.name,st.gender,st.nationality,CONCAT_WS('/',st.dobd,st.dobm,st.doby) AS dob,st.age,st.race,st.country_code,st.mobile_contact,st.residential_contact,st.local_address,st.unit_no,st.street_name,st.apartment_name,st.postal_code,st.occupation,st.intro_lesson,case st.floral_related when '1' then 'Yes' when '0' then 'No' end as floral_related,st.education,st.sponsorship,st.company_name,st.contact_person,st.designation,st.company_address,st.company_postalcode,st.company_contact_no,st.company_fax,st.company_email,st.company_website,st.foreign_student,st.oversea_address,st.oversea_zipcode,st.oversea_contact,st.emergency_contact_person,st.emergency_contact_number,st.exp_flower_design,st.exp_detail,st.enrollment_reason,st.internet_site,st.news_directory,st.magazine,st.friend_company,st.others,m.course_name,sm.date_of_registration,sm.date_of_commencement,sm.date_of_completion,sm.payment_mode,sm.date_of_payment,sm.invoice_number,sm.receipt_number,sm.payment_receive_by,sm.payment_note FROM students AS st LEFT JOIN student_course AS sm ON st.id=sm.student_id LEFT JOIN courses AS m ON sm.course_id=m.id LEFT JOIN branches b ON st.branch_id=b.id GROUP BY st.id ");


			foreach( $student_query as $row )
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
			$data = str_replace( "\r" , "" ,$data);

			
			//ob_end_clean();			
		
   			$csv_data= "$header\n$data";			
			print $csv_data;
			exit;		 

		}//end
	}


	
	/*Export Data*/
    public function testexport(){       
        $countries=DB::table('courses')->select('course_type','module_code')->get();
        $tot_record_found=0;
        if(count($countries)>0){
            $tot_record_found=1;
            //First Methos          
            $export_data="Country Id,Country Name\n";
            foreach($countries as $value){
                $export_data.=$value->module_category.','.$value->module_code."\n";
            }
            //ob_end_clean();

            header('Content-Encoding: UTF-8');
            header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			header("Content-Disposition: attachment; filename=Export.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			print "\n$export_data";                 
        }
       
    }
	
    public function signUpModule($studentId)
    {
		$StudentCourseEntry = new StudentCourseEntry;
		$StudentCourseEntry->student_id = $studentId; 
		$StudentCourseEntry->course_id = Input::get('module_apply');
		$StudentCourseEntry->date_of_registration = Input::get('date_of_registration'); 
		$StudentCourseEntry->date_of_completion = Input::get('date_of_completion');
		$StudentCourseEntry->date_of_commencement = Input::get('date_of_commencement');
		$StudentCourseEntry->date_of_payment = Input::get('date_of_payment');
		$StudentCourseEntry->invoice_number = Input::get('invoice_number');
		$StudentCourseEntry->receipt_number = Input::get('receipt_number');
		$StudentCourseEntry->payment_note = Input::get('payment_note');
		$StudentCourseEntry->payment_mode = Input::get('payment_mode');
		$StudentCourseEntry->status = 0;
		$StudentCourseEntry ->save();
		return Redirect::back();  
    }

    public function removeSignUpModule($studentId,$moduleId)
    {
		$StudentCourseEntry = StudentCourseEntry::where('student_id',$studentId)->where('course_id',$moduleId)->first();
		$StudentCourseEntry->delete();
		return Redirect::back();  
    }

   public function updateModule($studentId,$moduleId)
    {
		print_r($moduleId);exit;
		$StudentCourseEntry = StudentCourseEntry::where('student_id',$studentId)->where('course_id',$moduleId)->first();
		$StudentCourseEntry->date_of_registration = Input::get('date_of_registration'); 
		$StudentCourseEntry->date_of_completion = Input::get('date_of_completion');
		$StudentCourseEntry->date_of_commencement = Input::get('date_of_commencement');
		$StudentCourseEntry->date_of_payment = Input::get('date_of_payment');
		$StudentCourseEntry->invoice_number = Input::get('invoice_number');
		$StudentCourseEntry->receipt_number = Input::get('receipt_number');
		$StudentCourseEntry->payment_note = Input::get('payment_note');
		$StudentCourseEntry->payment_mode = Input::get('payment_mode');
		$StudentCourseEntry->payment_receive_by = Input::get('payment_receive_by');
		$StudentCourseEntry->status = 0;
		$StudentCourseEntry ->save();
		return Redirect::back();
    }

    protected function getNobleManId($branchCode,$id)
    {
    	$now = Carbon\Carbon::now();
    	$prefix = '00';
    	$number = 1000 + $id;
    	$serialize = $prefix.$number;
    	$lastTwoDigitOfYear = substr($now->year, -2);
    	return $branchCode.$lastTwoDigitOfYear.$now->weekOfYear.$serialize;
    }

}//End class

?>