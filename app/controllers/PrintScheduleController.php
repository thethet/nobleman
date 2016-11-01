<?php

class PrintScheduleController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	

	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$haveDate = 0;
		$date = date('Y-m', time());
		$students = StudentEntry::where('created_at','like',$date.'%')->get();

		$appointments = AppointmentEntry::orderBy('date', 'desc')->where('attend','=',0)->get();

		$this->layout->content =  View::make('print.index')
									->with('haveDate',$haveDate)
									->with('students',$students)
									->with('appointments',$appointments);
									
		}//end								
	
	}


	public function show()
	{
		
		if(Auth::user()->role ==1 ) {
		//$haveDate = 1;
		$getdate = Input::get('prdate');

		if ($getdate == '') {
			$date = date('Y-m', time());
			$students = StudentEntry::where('created_at','like',$date.'%')->get();
			$getdate_appointments = AppointmentEntry::orderBy('date', 'desc')->where('attend','=',0)->get();
		}else{
			$students = StudentEntry::where('created_at','like',$getdate.'%')->get();
			$getdate_appointments = AppointmentEntry::where('date','=',$getdate)->orderBy('date', 'desc')->where('attend','=',0)->get();
		}

		


		$this->layout->content =  View::make('print.result')
									->with('haveDate',$getdate)
									->with('students',$students)
									//->with('getdate',$getdate)
									->with('getdate_appointments',$getdate_appointments);
		}//end
	
	}


	public function download()
	{		
		if(Auth::user()->role ==1 ) {
		$getprdate = Input::get('getprdate');
		$getprdate_set = trim($getprdate);
		//$appointment = AppointmentEntry::orderBy('date', 'desc')->where('attend','=',0)->get();
		

		// if ($getdate) {
		// 	$appointment = AppointmentEntry::where('date','=',$getdate)->orderBy('date', 'desc')->where('attend','=',0)->get();
		// }else{
		// 	$appointment = AppointmentEntry::orderBy('date', 'desc')->get();
		// }

		if ($getprdate_set == '') {
			$date = date('Y-m', time());
			$appointment = AppointmentEntry::orderBy('date', 'desc')->where('attend','=',0)->get();
		}else{
			$appointment = AppointmentEntry::where('date','=',$getprdate_set)->orderBy('date', 'desc')->where('attend','=',0)->get();
		}



		//$appointment = AppointmentEntry::where('date','=',$getprdate_set)->orderBy('date', 'desc')->where('attend','=',0)->get();

		$sname = 0;
		$html=	'<html><head><style>body{ font-family:helvetica }</style></head><body>'
				.'<div>'
				.'<div style="padding-top:180px;text-align:center;">'
				.'<p style="font-size:15px;font-family:helvetica!important">PRINT SCHEDULE</p>'
				.'</div>'
				.'<table border=1 style="border-collapse:collapse;">'
				.'<thead>'
				.'<tr>'
				.'<th>Name</th><th>Course Name</th><th>Session</th><th>Date</th>'
				.'</tr>'
				.'</thead>'
				.'<tbody>';

		foreach ($appointment as $key => $appointment) {
					
		$html = $html .'<tr>';
		$html = $html .'<td>'.studententry::where('id','=',$appointment->student_id)->pluck('name').'</td>';
		$html = $html .'<td>'.coursesentry::where('id','=',$appointment->course_id)->pluck('course_name').'</td>';
		$html = $html .'<td>'.$appointment->session .'</td>';
		$html = $html .'<td>'.$appointment->date .'</td>';		
		$html = $html .'</tr>';
		}	

		$html = $html .'</tbody>';
		$html = $html .'</table>';
		$html = $html .'</div>';
		PDF::load($html, 'A4', 'portrait')->download();
		return Redirect::to('print');						
		}//end
	}



public function downloadall()
	{
		if(Auth::user()->role ==1 ) {
		$appointment = AppointmentEntry::orderBy('date', 'desc')->where('attend','=',0)->get();

		$html=	'<html><head><style>body{ font-family:helvetica }</style></head><body>'
				.'<div>'
				.'<div style="padding-top:180px;text-align:center;">'
				.'<p style="font-size:15px;font-family:helvetica!important">PRINT SCHEDULE</p>'
				.'</div>'
				.'<table border=1 style="border-collapse:collapse;">'
				.'<thead>'
				.'<tr>'
				.'<th>Name</th><th>Course Name</th><th>Session</th><th>Date</th>'
				.'</tr>'
				.'</thead>'
				.'<tbody>';

		foreach ($appointment as $key => $appointment) {
					
		$html = $html .'<tr>';
		$html = $html .'<td>'.studententry::where('id','=',$appointment->student_id)->pluck('name').'</td>';
		$html = $html .'<td>'.coursesentry::where('id','=',$appointment->course_id)->pluck('course_name').'</td>';
		$html = $html .'<td>'.$appointment->session .'</td>';
		$html = $html .'<td>'.$appointment->date .'</td>';
		
		$html = $html .'</tr>';
		}	

		$html = $html .'</tbody>';
		$html = $html .'</table>';
		$html = $html .'</div>';

		PDF::load($html, 'A4', 'portrait')->download();
		return Redirect::to('print');	
							
		}//end
	}

	
}// End Class
?>