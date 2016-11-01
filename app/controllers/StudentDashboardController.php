<?php

class StudentDashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";

	public function index()
	{
		if(Auth::user()->role == 3 ) {	
		$id = Auth::user()->id;	

		$std_id = StudentEntry::where('user_id','=',$id)->pluck('id');

		$appointments = AppointmentEntry::where('student_id','=',$std_id)->get();

		$this->layout->content =  View::make('studentdashboard.dashboard')
									->with('appointments',$appointments)
									->with('std_id',$std_id);



									
		}//end
	}



}//End Class