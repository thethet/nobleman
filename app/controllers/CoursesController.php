<?php

class CoursesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	//protected $module_categories;

	public function __construct()
	{
		// $this->module_categories = [['name' => 'Floral Courses'],
		// 							['name' => 'Professional'],
		// 							['name' => 'Floral Management'],
		// 							['name' => 'Art Related'],
		// 							['name' => 'Workshops']
		// 						   ];

		/*$this->module_categories = CoursesEntry::get();

		View::share('module_categories', $this->module_categories);*/
	}


	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$courses = CoursesEntry::get();
		$this->layout->content =  View::make('courses.lists')->with('courses',$courses);
		}//end
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user()->role ==1 ) {
		$this->layout->content =  View::make('courses.create');
		}//end
	}

	public function delete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		CoursesEntry::find($id)->delete();
		return Redirect::to('courses');
		}//end
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::user()->role ==1 ) {
		$rules = array(
			'course_code' => 'required|unique:courses,course_code',
			'course_name' => 'required',
			'cost_of_course' => 'required',
			'duration_of_course' => 'required',
			'no_of_lesson' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);


		if ($validator->fails()) {
			return Redirect::to('courses/create')
				->withErrors($validator);
		} else {
			$CoursesEntry = new CoursesEntry;
			$CoursesEntry->id = Input::get('id');
			$CoursesEntry->course_type = Input::get('course_type');
			$CoursesEntry->course_code = Input::get('course_code');
			$CoursesEntry->course_name = Input::get('course_name');
			$CoursesEntry->cost_of_course = Input::get('cost_of_course');
			$CoursesEntry->duration_of_course = Input::get('duration_of_course');
			$CoursesEntry->no_of_lesson = Input::get('no_of_lesson');
			$CoursesEntry->no_hours_per_lesson = Input::get('no_hours_per_lesson');
			$CoursesEntry->status = 1;
			//date_default_timezone_set('Singapore');
			date_default_timezone_set('Asia/Singapore');
			$date = date('Y-m-d h:i:s', time());
			$CoursesEntry->created_at = $date;
			$CoursesEntry->updated_at = $date;
			$CoursesEntry->updated_by = Auth::user()->id;
			$CoursesEntry->save();

			$lastid = DB::getPdo()->lastInsertId();

			$CertIDEntry = new CertIDEntry;
			$CertIDEntry->course_id = $lastid;
			$CertIDEntry->name = Input::get('certname');
			$CertIDEntry->serial = Input::get('certid');			
			date_default_timezone_set('Asia/Singapore');
			$date = date('Y-m-d h:i:s', time());
			$CertIDEntry->created_at = $date;
			$CertIDEntry->created_by = Auth::user()->show_id;
			$CertIDEntry->save();

			Session::flash('message', 'Successfully created course!');
			return Redirect::to('courses');
		}

		}//end
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		$password = Input::get('password');
		$cfm_password =Input::get('confirm_password');
		if ($password == $cfm_password) {
			$rules = array(
				'course_code' => 'required:courses,course_code',
				'course_name' => 'required',
				'cost_of_course' => 'required',
				'duration_of_course' => 'required',
				'no_of_lesson' => 'required',
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('courses/' . $id)
					->withErrors($validator);
			} else {
				$CoursesEntry = CoursesEntry::find(Input::get('id'));
				$CoursesEntry->id = Input::get('id');
				$CoursesEntry->course_type = Input::get('course_type');
				$CoursesEntry->course_code = Input::get('course_code');
				$CoursesEntry->course_name = Input::get('course_name');
				$CoursesEntry->cost_of_course = Input::get('cost_of_course');
				$CoursesEntry->duration_of_course = Input::get('duration_of_course');
				$CoursesEntry->no_of_lesson = Input::get('no_of_lesson');
				$CoursesEntry->no_hours_per_lesson = Input::get('no_hours_per_lesson');
				$CoursesEntry->status = 1;
				date_default_timezone_set('Asia/Singapore');
				$date = date('Y-m-d h:i:s', time());
				$CoursesEntry->created_at = $date;
				$CoursesEntry->updated_at = $date;
				$CoursesEntry->updated_by = Auth::user()->id;
				$CoursesEntry->save();

				CertIDEntry::where('course_id', '=', $id)->update(array('name' => Input::get('certname'), 'serial' => Input::get('certid')));

				Session::flash('message', 'Successfully created course!');
				return Redirect::to('courses');
			}
		}

		}//end

	}
	public function view($id)
	{
		if(Auth::user()->role ==1 ) {
		$courses = CoursesEntry::find($id);
		$countries = CountryEntry::get();

		$certificate = CertIDEntry::where('course_id','=',$id)->first();

		return View::make('courses.view')
			->with('countries',$countries)
			->with('courses', $courses)
			->with('certificate', $certificate);
		}//end
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


	/* Download for each course */
	function download($id)
	{
		if (Auth::user()->role == 1) {
			$course = CoursesEntry::find($id);	

			$html = '<html><head><style>
					body{ font-family:helvetica;font-size:10px;color:#4d4c4b; } 
					table{ border-collapse:collapse;border: 1px solid #d7d6d5;}
					table, th, td { border: 1px solid #d7d6d5;padding:10px;}</style>
					</head><body>'
					.'<div>'
					.'<div style="padding-top:15px;text-align:center;">'
					.'<img src="img/noblemanlogo.png" />'
					.'<p style="font-size:15px;font-family:helvetica!important">Course Detail</p>'
					.'</div>'
					.'<table>'					
					.'<tbody>';	

			$html = $html .'<tr><td>Course Type : </td><td>'.$course['course_type'].'</td></tr>';
			$html = $html .'<tr><td>Course Code : </td><td>'.$course['course_code'].'</td></tr>';
			$html = $html .'<tr><td>Course Name : </td><td>'.$course['course_name'].'</td></tr>';
			$html = $html .'<tr><td>Cost of Course ($SGD) : </td><td>'.$course['cost_of_course'].'</td></tr>';
			$html = $html .'<tr><td>Duration of Course (Hours) : </td><td>'.$course['duration_of_course'].'</td></tr>';
			$html = $html .'<tr><td>No. of Lesson : </td><td>'.$course['no_of_lesson'].'</td></tr>';
			$html = $html .'<tr><td>No. of Hours Per Lesson : </td><td>'.$course['no_hours_per_lesson'].'</td></tr>';
			
			$html = $html .'</tbody>';
			$html = $html .'</table>';
			$html = $html .'</div>';
			PDF::load($html, 'A4', 'portrait')->download('course_PDF');
			return Redirect::to('courses');

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

			    $course_type = $col[0];
			    $course_code = $col[1];
			    $course_name = $col[2];
			    $cost_of_course = $col[3];
			    $duration_of_course = $col[4];
			    $no_of_lesson = $col[5];
			    $no_hours_per_lesson = $col[6];

			    $CoursesEntry = new CoursesEntry;
				$CoursesEntry->course_type = $course_type;
				$CoursesEntry->course_code = $course_code;
				$CoursesEntry->course_name = $course_name;
				$CoursesEntry->cost_of_course = $cost_of_course;
				$CoursesEntry->duration_of_course = $duration_of_course;
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
			   header("Content-Disposition: attachment; filename=Courses_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Course Type' . ",\t".'Course Code' . ",\t".'Course Name' . ",\t".'Cost of Course ($SGD)' .",\t".'Duration of Course (Hours)' . ",\t".'No. of Lesson' . ",\t".'No. of Hours Per Lesson' . ",\t";

			   $course_query = DB::select("SELECT course_type,course_code,course_name,cost_of_course,duration_of_course,no_of_lesson,no_hours_per_lesson FROM courses");

			   foreach( $course_query as $row )
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
