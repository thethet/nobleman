<?php

class TrainersScheduleController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function index()
	{
		if(Auth::user()->role == 1 ) {
			$trainerschedule = TrainerScheduleEntry::get();
			$this->layout->content =  View::make('trainerschedule.lists')
									  ->with('trainerschedule',$trainerschedule);
									 
		}
	}


	public function create()
	{
		if(Auth::user()->role == 1 ) {
			$trainers = TrainersEntry::get();
			$courses = CoursesEntry::get();
			$this->layout->content =  View::make('trainerschedule.create')
									  ->with('trainers',$trainers)
									  ->with('courses',$courses);
		}//end
	}


	public function store()
	{
		if (Auth::user()->role == 1) {	

			$rules = array(
				'module' => 'required|not_in:0',
				'date' => 'required'
				//'session' => 'required|not_in:0',
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('trainerschedule/create')
					->withErrors($validator);
			}else {

				$dateholiday = Input::get('dateholiday');

				if ($dateholiday == 1) {
					Session::flash('holidaymessage', 'School is closed for this day!');
					return Redirect::to('trainerschedule/create');
				}else{

					$count = TrainerScheduleEntry::where('trainer_id','=',Input::get('trainer'))->where('course_id','=',Input::get('module'))->where('date','=',Input::get('date'))->where('session','=',Input::get('session'))->count();
					if ($count == 0) {

						$trainerschedule = new TrainerScheduleEntry;
						$trainerschedule->trainer_id = Input::get('trainer');
						$trainerschedule->course_id = Input::get('module');
						$trainerschedule->lesson_id = Input::get('lesson');
						$trainerschedule->date = Input::get('date');
						$trainerschedule->save();

						$lastid = DB::getPdo()->lastInsertId();
						
						if(!empty(Input::get('session'))) {
						    foreach(Input::get('session') as $session) {
						    	$trainerschedulesession = new TrainerScheduleSessionEntry;
								$trainerschedulesession->trainer_schedule_id = $lastid;		
								$trainerschedulesession->session = $session;
								$trainerschedulesession->save();
						    }//end foreach
						}else{
							Session::flash('sessionmessage', 'Please check at least one session!');
							return Redirect::to('trainerschedule/create');
						}
						
						Session::flash('message', 'Successfully created!');				
						return Redirect::to('trainerschedule');
					}else{
						Session::flash('duplicatemessage', 'You already created for this schedule!');
						return Redirect::to('trainerschedule/create');
					}

					
				}
				
			}

		}//end
	}

	public function show($id)
	{
		if(Auth::user()->role == 1 ) {
		$trainerschedule = TrainerScheduleEntry::find($id);	
		$trainerschedule_session =  TrainerScheduleSessionEntry::where('trainer_schedule_id','=',$id)->get();

		$trainers =  TrainersEntry::get();
		$courses =  CoursesEntry::get();

		$module_id = TrainerScheduleEntry::where('id','=',$id)->pluck('course_id');			
		$lessons = LessonsEntry::where('module_id','=',$module_id)->get();

		$dt = TrainerScheduleEntry::where('id','=',$id)->pluck('date');	
		$day = date("D", strtotime($dt));
		if($day == 'Thu'){
			$day = 'Thur';
		}	
		$module_name =  CoursesEntry::where('id','=',$module_id)->pluck('course_name');
		$session = SessionsEntry::where('day','=',$day)->where('course_id','=',$module_id)->where('status','=',1)->get();

		return View::make('trainerschedule.view')
		             ->with('trainerschedule',$trainerschedule)
		             ->with('trainers',$trainers)
		             ->with('courses',$courses)
		             ->with('lessons',$lessons)
		             ->with('session',$session)
		             ->with('trainerschedule_session',$trainerschedule_session);


		}//end
	}


	public function edit()
	{
		if(Auth::user()->role ==1 ) {
			$rules = array(
				'module' => 'required|not_in:0',
				'date' => 'required'
				//'session' => 'required',
			);
			
			$validator = Validator::make(Input::all(), $rules);
			$id = Input::get('id');

			if ($validator->fails()) {
				return Redirect::to('trainerschedule/' . $id)
					->withErrors($validator);
			}else {
				$dateholiday = Input::get('dateholiday');

				if ($dateholiday == 1) {
					Session::flash('holidaymessage', 'School is closed for this day!');					
					return Redirect::to('trainerschedule/' . $id);					
				}else{

					$count = TrainerScheduleEntry::where('trainer_id','=',Input::get('trainer'))->where('course_id','=',Input::get('module'))->where('date','=',Input::get('date'))->where('session','=',Input::get('session'))->where('date','!=',Input::get('id'))->where('lesson_id','=',Input::get('lesson'))->count();

					if ($count == 0) {

						$trainerschedule = TrainerScheduleEntry::find(Input::get('id'));
						$trainerschedule->trainer_id = Input::get('trainer');
						$trainerschedule->course_id = Input::get('module');
						$trainerschedule->lesson_id = Input::get('lesson');
						$trainerschedule->date = Input::get('date');
						$trainerschedule->save();

						TrainerScheduleSessionEntry::where('trainer_schedule_id','=',$id)->delete();

						if(!empty(Input::get('session'))) {
							foreach(Input::get('session') as $session) {
								$trainerschedulesession = new TrainerScheduleSessionEntry;
								$trainerschedulesession->trainer_schedule_id = Input::get('id');		
								$trainerschedulesession->session = $session;
								$trainerschedulesession->save();
							}//end foreach
						}else{
							Session::flash('sessionmessage', 'Please check at least one session!');
							return Redirect::to('trainerschedule/' . $id);	
						}

						Session::flash('message', 'Successfully created!');				
						return Redirect::to('trainerschedule');
					}else{
						Session::flash('duplicatemessage', 'You already created for this schedule!');			
						return Redirect::to('trainerschedule/' . $id);	
					}
					
				}
			}

		}//end

	}


	public function delete()
	{
		if(Auth::user()->role == 1) {
			$id = Input::get('id');
			TrainerScheduleEntry::find($id)->delete();
			TrainerScheduleSessionEntry::where('trainer_schedule_id','=',$id)->delete();
			return Redirect::to('trainerschedule');
		}//end
	}


	public function datefilter()
	{
		if (Auth::user()->role == 1) {
			$today_date = date('Y-m-d', time());

			$fromdate = Input::get('fromdate');
			$todate = Input::get('todate');
			
			$q = TrainerScheduleEntry::query();

			if ($fromdate == ''&&$todate=='') {
				$date = date('Y-m-d', time());				
			}else{
				//$q->whereBetween('date',[$fromdate,$todate]);
				$q->where('date','<=',$fromdate)->orwhere('date','>=',$todate);
			}

			$gettrainerschedules = $q->orderBy('date', 'desc')->get();			
		
			$this->layout->content =  View::make('trainerschedule.filter')
										->with('trainerschedule',$gettrainerschedules)
										->with('from_date',$fromdate)
										->with('to_date',$todate);
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

			    $trainer_name = $col[0];
			    $course_name = $col[1];
			    $lesson_name = $col[2];
			    $date = $col[3];
			    $session = $col[4];			  

			    $trainer_schedule = new TrainerScheduleEntry;

			    $get_trainerid = TrainersEntry::where('trainer_name', '=', trim($trainer_name))->pluck('user_id');
			    $get_moduleid = CoursesEntry::where('course_name', '=', trim($course_name))->pluck('id');
			    //$get_moduleid = CoursesEntry::where('lesson_name', '=', trim($module_name))->pluck('id');


				$CoursesEntry->course_type = $module_categories;
				$CoursesEntry->course_code = $module_code;
				$CoursesEntry->course_name = $module_name;
				$CoursesEntry->cost_of_course = $cost_of_module;
				$CoursesEntry->duration_of_course = $duration_of_module;
				$CoursesEntry->no_of_lesson = $no_of_lesson;
				$CoursesEntry->no_hours_per_lesson = $no_hours_per_lesson;
				$CoursesEntry->status = 1;
				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$CoursesEntry->created_at = $date;
				$CoursesEntry->updated_at = $date;
				$CoursesEntry->updated_by = Auth::user()->id;
				$CoursesEntry->save();

				}//end while
			 
			    fclose($handle);
			}//end if

			return Redirect::to('courses');
		}//end
	}	


	function export()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=TrainerSchedules_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Trainer' . ",\t".'Course Name' . ",\t".'Date' .",\t".'Session' . ",\t";

			   //$trainerschedule_query = DB::select("SELECT t.trainer_name,m.course_name,ts.date,ts.session FROM trainer_schedule AS ts LEFT JOIN trainers AS t ON ts.trainer_id=t.user_id LEFT JOIN courses AS m ON ts.course_id=m.id LEFT JOIN lessons AS ls ON ts.lesson_id=ls.id");


			   $trainerschedule_query = DB::select("SELECT t.trainer_name,m.course_name,ts.date,ts.session FROM trainer_schedule AS ts LEFT JOIN trainers AS t ON ts.trainer_id=t.user_id LEFT JOIN courses AS m ON ts.course_id=m.id");


			   foreach( $trainerschedule_query as $row )
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
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=TrainerSchedules_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Trainer' . ",\t".'Course Name' . ",\t".'Date' .",\t".'Session' . ",\t";

			    $getfromdate = Input::get('getfromdate');
				$getfromdate_set = trim($getfromdate);
				$gettodate = Input::get('gettodate');
				$gettodate_set = trim($gettodate);


				if ($getfromdate_set == '' && $gettodate_set == '') {
					$trainerschedule_query = DB::select("SELECT t.trainer_name,m.course_name,ts.date,tss.session FROM trainer_schedule AS ts LEFT JOIN trainers AS t ON ts.trainer_id=t.user_id LEFT JOIN courses AS m ON ts.course_id=m.id LEFT JOIN trainer_schedule_session AS tss ON ts.id=tss.trainer_schedule_id");
				}else{
					$trainerschedule_query = DB::select("SELECT t.trainer_name,m.course_name,ts.date,tss.session FROM trainer_schedule AS ts LEFT JOIN trainers AS t ON ts.trainer_id=t.user_id LEFT JOIN courses AS m ON ts.course_id=m.id LEFT JOIN trainer_schedule_session AS tss ON ts.id=tss.trainer_schedule_id WHERE ts.date >= '".$getfromdate_set."' AND ts.date >= '".$gettodate_set."' ");
				}			   


			   foreach( $trainerschedule_query as $row )
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

?>