<?php

class DashboardController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	
	public function __construct()
	{
		$this->course_type_list = [['name' => 'Full Course','value' => 'full'],
									['name' => 'Individual Course', 'value' => 'individual']
								  ];

		View::share('course_type_list', $this->course_type_list);
	}

	public function index()
	{		
		if(Auth::user()->role ==1 ) {
		$date = date('Y-m', time());
		//$students = StudentEntry::where('created_at','like',$date.'%')->get();
		$students = 0;
		$sponsor = 0;
		$course = 0;
		$payment = 0;
		$this->layout->content =  View::make('dashboard.index')
									->with('students',$students)
									->with('sponsor',$students)
									->with('course',$course)
									->with('payment',$payment);
		}//end
	}

	public function newstdreport()
	{
		if(Auth::user()->role ==1 ) {
		$sponsor = 0;
		$course = 0;
		$payment = 0;
		$syear = Input::get('syear');
		$month = Input::get('month');
		$date = $syear . '-' . $month;
		$students_data = StudentEntry::where('created_at','like',$date.'%')->get();
		$students_count = count($students_data);
		$students = 1;
		$this->layout->content = View::make('dashboard.index')
								 ->with('students',$students)
								 ->with('sponsor',$sponsor)
								 ->with('course',$course)
								 ->with('syear',$syear)
								 ->with('month',$month)
								 ->with('students_count',$students_count)
								 ->with('payment',$payment);
		}//end
	}

	public function sponsorreport()
	{
		if(Auth::user()->role ==1 ) {
		$students = 0;
		$course = 0;
		$sponsor = 1;
		$payment = 0;
		$syear = Input::get('syear');
		$month = Input::get('month');
		$date = $syear . '-' . $month;
		$sponsor_data = StudentEntry::where('created_at','like',$date.'%')->where('sponsorship','=','Yes')->get();
		$sponsor_std_count = count($sponsor_data);		
		$this->layout->content = View::make('dashboard.index')
								 ->with('sponsor',$sponsor)
								 ->with('course',$course)
								 ->with('students',$students)
								 ->with('syear',$syear)
								 ->with('month',$month)
								 ->with('sponsor_std_count',$sponsor_std_count)
								 ->with('payment',$payment);
		}//end
	}

	public function coursereport()
	{
		if(Auth::user()->role ==1 ) {
		$students = 0;
		$course = 1;
		$sponsor = 0;
		$payment = 0;
		$syear = Input::get('syear');
		$month = Input::get('month');
		$date1 = $syear . '-' . $month;
		$this->layout->content = View::make('dashboard.index')
								 ->with('sponsor',$sponsor)
								 ->with('students',$students)
								 ->with('course',$course)
								 ->with('syear',$syear)
								 ->with('month',$month)
								 ->with('date1',$date1)
								 ->with('payment',$payment);
		}//end
	}


	public function paymentreport()
	{
		if(Auth::user()->role ==1 ) {
		$students = 0;
		$course = 0;
		$sponsor = 0;
		$payment = 1;
		$syear = Input::get('syear');
		$month = Input::get('month');
		$date1 = $syear . '-' . $month;

		$total_revenue = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date1.'%')
        				->sum('cost_of_course');


        $total_received = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date1.'%')
        				->where('students.status','=',1)
        				->sum('cost_of_course');

        $outstanding = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date1.'%')
        				->where('students.status','=',0)
        				->sum('cost_of_course');
		
		$this->layout->content = View::make('dashboard.index')
								 ->with('sponsor',$sponsor)
								 ->with('students',$students)
								 ->with('course',$course)
								 ->with('syear',$syear)
								 ->with('month',$month)
								 ->with('date1',$date1)
								 ->with('payment',$payment)
								 ->with('total_revenue',$total_revenue)
								 ->with('total_received',$total_received)
								 ->with('outstanding',$outstanding);
		}//end
	}

	
}// End Class
?>