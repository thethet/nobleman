<?php

class LessonsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";
	protected $lesson_type;

	public function __construct()
    {
        $this->lesson_type =  [
								['name' => 'Normal Lesssons'],
								['name' => 'Special Lessons'],
								['name' => 'Special Workshops']
							  ];
        View::share('lesson_type', $this->lesson_type);
    }

	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$lessons = LessonsEntry::get();
		$this->layout->content =  View::make('lessons.lists')->with('lesson',$lessons);
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
		$modules = ModulesEntry::get();
		$this->layout->content =  View::make('lessons.create')
									->with('modules',$modules);
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
			'lesson_code' => 'required|unique:lessons,lesson_code',
			'lesson_name' => 'required',
			'module' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('lessons/create')
				->withErrors($validator);
		} else {
			$mid = Input::get('module');

			$lessons = LessonsEntry::where('module_id','=',$mid)->get();
			$lessons_count = count($lessons);

			$no_of_lesson = ModulesEntry::where('id','=',$mid)->pluck('no_of_lesson');

			if ($lessons_count >= $no_of_lesson) {
				$err = "This module's lesson is fulled!";
				return Redirect::to('lessons/create')
				->withErrors($err);

			}else{
				$LessonsEntry = new LessonsEntry;
				$LessonsEntry->id = Input::get('id');
				$LessonsEntry->lesson_code = Input::get('lesson_code');
				$LessonsEntry->lesson_name = Input::get('lesson_name');
				$LessonsEntry->lesson_type = Input::get('lesson_type');
				$LessonsEntry->module_id = Input::get('module');
				$LessonsEntry->module_name = ModulesEntry::where('id','=',Input::get('module'))->pluck('module_name');
				$LessonsEntry->status = 1;
				//date_default_timezone_set('Singapore');
				$date = date('Y-m-d h:i:s', time());
				$LessonsEntry->created_at = $date;
				$LessonsEntry->updated_at = $date;
				$LessonsEntry->updated_by = Auth::user()->id;
				$LessonsEntry->save();

				Session::flash('message', 'Successfully created lesson!');
				return Redirect::to('lessons');
			}

		}

		}//end
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::user()->role ==1 ) {
		$lesson = LessonsEntry::find($id);
		$countries = CountryEntry::get();
		$modules = ModulesEntry::get();

		return View::make('lessons.view')
			->with('countries',$countries)
			->with('modules',$modules)			
			->with('lesson', $lesson);
		}//end
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
			$rules = array(
				//'lesson_code' => 'required|unique:lessons,lesson_code',
				'lesson_code' => 'required:lessons,lesson_code',
				'lesson_name' => 'required',
				'module_name' => 'required',
			);
			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::to('lessons/' . $id)
					->withErrors($validator);
			} else {

				$LessonsEntry = LessonsEntry::find(Input::get('id'));
				$LessonsEntry->id = Input::get('id');
				$LessonsEntry->lesson_code = Input::get('lesson_code');
				$LessonsEntry->lesson_name = Input::get('lesson_name');
				$LessonsEntry->lesson_type = Input::get('lesson_type');
				$LessonsEntry->module_name = Input::get('module_name');
				$LessonsEntry->module_id = ModulesEntry::where('module_name','=',Input::get('module_name'))->pluck('id');
				$LessonsEntry->status = 1;
				// date_default_timezone_set('Singapore');
				$date = date('Y-m-d h:i:s', time());
				$LessonsEntry->created_at = $date;
				$LessonsEntry->updated_at = $date;
				$LessonsEntry->updated_by = Auth::user()->id;
				$LessonsEntry->save();

				Session::flash('message', 'Successfully created lesson!');
				return Redirect::to('lessons');
			}
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
	public function delete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		LessonsEntry::find($id)->delete();
		return Redirect::to('lessons');
		}//end
	}


	/* Download for each course */
	function download($id)
	{
		if (Auth::user()->role == 1) {
			$course = LessonsEntry::find($id);	

			$html = '<html><head><style>
					body{ font-family:helvetica;font-size:10px;color:#4d4c4b; } 
					table{ border-collapse:collapse;border: 1px solid #d7d6d5;}
					table, th, td { border: 1px solid #d7d6d5;padding:10px;}</style>
					</head><body>'
					.'<div>'
					.'<div style="padding-top:15px;text-align:center;">'
					.'<img src="img/noblemanlogo.png" />'
					.'<p style="font-size:15px;font-family:helvetica!important">Lesson Detail</p>'
					.'</div>'
					.'<table>'					
					.'<tbody>';	

			$html = $html .'<tr><td>Lesson Code : </td><td>'.$course['lesson_code'].'</td></tr>';
			$html = $html .'<tr><td>Lesson Name : </td><td>'.$course['lesson_name'].'</td></tr>';
			$html = $html .'<tr><td>Lesson Type : </td><td>'.$course['lesson_type'].'</td></tr>';
			$html = $html .'<tr><td>Module Name : </td><td>'.$course['module_name'].'</td></tr>';
			
			$html = $html .'</tbody>';
			$html = $html .'</table>';
			$html = $html .'</div>';
			PDF::load($html, 'A4', 'portrait')->download('lesson_PDF');
			return Redirect::to('lessons');

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

			    $lesson_code = $col[0];
			    $lesson_name = $col[1];
			    $lesson_type = $col[2];
			    $get_module = $col[3];

			    $module = trim($get_module);

			   
			    $LessonsEntry = new LessonsEntry;
				$LessonsEntry->lesson_code = $lesson_code;
				$LessonsEntry->lesson_name = $lesson_name;
				$LessonsEntry->lesson_type = $lesson_type;

				$get_moduleid = ModulesEntry::where('module_name', '=', $module)->pluck('id');
				$LessonsEntry->module_id = $get_moduleid;
				$LessonsEntry->module_name = $module;				

				$LessonsEntry->status = 1;
				$date = date('Y-m-d h:i:s', time());
				$LessonsEntry->created_at = $date;
				$LessonsEntry->updated_at = $date;
				$LessonsEntry->updated_by = Auth::user()->id;
				$LessonsEntry->save();

				}//end while
			 
			    fclose($handle);
			}//end if

			return Redirect::to('lessons');
		}//end
	}	


	function export()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Lessons_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Lesson Code' . ",\t".'Lesson Name' . ",\t".'Lesson Type' . ",\t".'Module Name'. ",\t";

			   $lesson_query = DB::select("SELECT lesson_code,lesson_name,lesson_type,module_name FROM lessons");

			   foreach( $lesson_query as $row )
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
