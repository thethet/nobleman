<?php

class TrainersController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function lists()
	{
		if(Auth::user()->role ==1 ) {
		$trainers = TrainersEntry::get();
		$this->layout->content =  View::make('trainers.lists')->with('trainers',$trainers);
		}//end
	}
	public function create()
	{
		if(Auth::user()->role ==1 ) {
		$this->layout->content =  View::make('trainers.create');
		}//end
	}
	public function view($id)
	{
		if(Auth::user()->role ==1 ) {
		/*$project = ProjectEntry::find($id);
        $users = UserEntry::all();
        $project_users = UserProjectEntry::where('project_id','=',$id)->get();
			
		 return View::make('projects.view')
            ->with('project', $project)
            ->with('project_users', $project_users)
            ->with('users', $users);*/

        $trainer = TrainersEntry::find($id);
		
		 return View::make('trainers.view')
            	->with('trainer', $trainer);


		}//end
	}
	
	public function delete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');

		$trainerentry = TrainersEntry::find($id);
		$user_id = $trainerentry->user_id ;

		TrainersEntry::find($id)->delete();

		UserEntry::find($user_id)->delete();

		return Redirect::to('trainers');
		}//end
	}
	public function store()
	{
		if(Auth::user()->role ==1 ) {
		$email_count = UserEntry::where('email','=',Input::get('email'))->count();		
		if($email_count == 0){
			$rules = array(
				'name'     => 'required',
				'email'    => 'required|unique:trainers',
				'password' => 'required|same:confirm_password'
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('trainers/create')
					->withErrors($validator);
			} else {

				$userentry = new userentry;
				$userentry -> show_id = input::get('name');
				$userentry -> email = input::get('email');
				$pass = input::get('password');
				$userentry -> password = Hash::make($pass);
				$userentry->status       = 1;
				$userentry->role       = 2;
				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$userentry->created_at		   = $date;
				$userentry->updated_at		   = $date;
				$userentry->updated_by		   = Auth::user()->id;
				$userentry -> save();

				$get_userid = UserEntry::where('email', '=', Input::get('email'))->pluck('id');
				$TrainersEntry = new TrainersEntry;
				$TrainersEntry->user_id = $get_userid;
				$TrainersEntry->trainer_name       = Input::get('name');
				$TrainersEntry->email       = Input::get('email');
				$TrainersEntry->contact       = Input::get('contact');
				$TrainersEntry->status       = 1;
				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$TrainersEntry->created_at		   = $date;
				$TrainersEntry->updated_at		   = $date;
				$TrainersEntry->updated_by		   = Auth::user()->id;
				$TrainersEntry->address       =  Input::get('address');
				$TrainersEntry->trainer_note  = Input::get('trainer_note');
				$TrainersEntry->date_of_birth = Input::get('date_of_birth');
				$TrainersEntry->joining_date  = Input::get('joining_date');
				$TrainersEntry->nric = Input::get('nric');

				if (Input::file('profile_picture'))
				{
					if (Input::file('profile_picture')->isValid())
					{
						$file = Input::file('profile_picture');

						$temp = explode(".", Input::file('profile_picture'));
						$newfilename = round(microtime(true)) . '.' . end($temp);
						//$file->move('uploads', Input::file('profile_picture')->getClientOriginalName());
						$file->move('uploads', $newfilename);
						//$TrainersEntry->profile_picture = Input::file('profile_picture')->getClientOriginalName();
						$TrainersEntry->profile_picture = $newfilename;
					}
				}else{
						$TrainersEntry->profile_picture = 'default-img-200x200.png';
				}

				$TrainersEntry->save();
				
				Session::flash('message', 'Successfully created projects!');
				return Redirect::to('trainers');
			}

		}else{
			Session::flash('message', 'Your email address is already registered in Nobleman!');

			return Redirect::to('trainers/create');

		}

		}//end
	}
	public function edit()
	{
		if(Auth::user()->role ==1 ) {
		$tid = Input::get('id'); 
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');
		if ($password == $cfm_password)
		{
			$rules = array(
				'name'     => 'required',
				'email'      => 'required'
			);
			$validator = Validator::make(Input::all(), $rules);
	
			if ($validator->fails()) {
				return Redirect::to('trainers/'.$tid)
					->withErrors($validator);
			} else {

				$get_user_id = TrainersEntry::where('id','=',$tid)->pluck('user_id');
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
						return Redirect::to('trainers/' . $tid);
					}

				}else{
					
					$UserEntry = UserEntry::find($get_user_id);
					if(Input::get('password') != ''){
					$UserEntry->password = Hash::make($password);
					}
					$UserEntry->save();
				}

					$TrainersEntry = TrainersEntry::find(Input::get('id'));
					$TrainersEntry->trainer_name = Input::get('name');
					$TrainersEntry->email = Input::get('email');
					$TrainersEntry->contact = Input::get('contact');
					$TrainersEntry->status = 1;
					date_default_timezone_set('Asia/Singapore');
					$date = date('Y-m-d h:i:s', time());
					$TrainersEntry->created_at = $date;
					$TrainersEntry->updated_at = $date;
					$TrainersEntry->updated_by = Auth::user()->id;
					$TrainersEntry->address       =  Input::get('address');
					$TrainersEntry->trainer_note  = Input::get('trainer_note');
					$TrainersEntry->date_of_birth = Input::get('date_of_birth');
					$TrainersEntry->joining_date  = Input::get('joining_date');
					$TrainersEntry->nric = Input::get('nric');
					
					if(Input::get('changeProfile')){					
						if (Input::hasFile('profile_picture'))
						{
							if (Input::file('profile_picture')->isValid())
							{
								$file = Input::file('profile_picture');

								$temp1 = explode(".", Input::file('profile_picture'));
								$newfilename1 = round(microtime(true)) . '.' . end($temp1);

								//$file->move('uploads', Input::file('profile_picture')->getClientOriginalName());
								//$TrainersEntry->profile_picture = Input::file('profile_picture')->getClientOriginalName();

								$file->move('uploads', $newfilename1);
								$TrainersEntry->profile_picture = $newfilename1;
							} 
						}else{
								$TrainersEntry->profile_picture = 'default-img-200x200.png';
						}		
					}					
								
					$TrainersEntry->save();
					Session::flash('message', 'Successfully edited!');
					return Redirect::to('trainers');
				
			}//end if
		}else{
			Session::flash('message', 'Your password did not match!');
			return Redirect::to('trainers/' . $tid);
		}

		}//end
	}
	public function delete_user()
	{
		if(Auth::user()->role ==1 ) {
		$UserProjectEntry = UserProjectEntry::find(Input::get('id'))->delete();
		return Redirect::to('projects/'.Input::get('project_id'));
		}//end
	}
	
	public function add_user()
	{
		if(Auth::user()->role ==1 ) {
		$SupervisorEntry = new UserProjectEntry;
		$SupervisorEntry->project_id = Input::get('project_id');
		$SupervisorEntry->user_id = Input::get('user_id');
		$SupervisorEntry->save();
		return Redirect::to('projects/'.Input::get('project_id'));
		}//end
	}


	function export()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Trainers_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Name' . ",\t".'Email' . ",\t".'Contact' .",\t";

			   $query = DB::select("SELECT trainer_name,email,contact FROM trainers");

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


}
?>