<?php
use Carbon\Carbon;
class PaymentController extends BaseController {
/**
* Display a listing of the resource.
*
* @return Response
*/
	protected $layout = "layouts.main";	
	

	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$date = date('Y-m', time());
		//$students = DB::table('student_course') ->leftJoin('students', 'student_course.student_id', '=', 'students.id')->where('created_at','like',$date.'%')->get(); 

		$students = DB::table('student_course') ->leftJoin('students', 'student_course.student_id', '=', 'students.id')->where('created_at','like',$date.'%')->get(['students.name','student_course.course_id','student_course.payment_mode','student_course.sm_payment_status','students.id','students.created_at','student_course.payment_note','student_course.transaction_code','student_course.date_of_payment']);

        $total_revenue = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date.'%')
        				->sum('cost_of_course');


        $total_received = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date.'%')
        				->where('students.status','=',1)
        				->sum('cost_of_course');

        $outstanding = DB::table('student_course') 
        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
        				->where('students.created_at','like',$date.'%')
        				->where('students.status','=',0)
        				->sum('cost_of_course');

		$this->layout->content =  View::make('payment.index')
									->with('students',$students)
									->with('total_revenue',$total_revenue)
									->with('total_received',$total_received)
									->with('outstanding',$outstanding);

		}//end
									
	}


	public function report()
	{
		
		if(Auth::user()->role ==1 ) {
		//$date = date('Y-m', time());

		$p1_date = Input::get('p1_date');
		$p2_date = Input::get('p2_date');

		if ($p1_date == '' AND $p2_date != '') {
			$students = DB::table('student_course')
					->leftJoin('students', 'student_course.student_id', '=', 'students.id')	
					->where('students.created_at','LIKE',$p2_date.'%')
					->get(['students.name','student_course.course_id','student_course.payment_mode','student_course.sm_payment_status','students.id','students.created_at','student_course.payment_note','student_course.transaction_code','student_course.date_of_payment']);

			
			$total_revenue = DB::table('student_course') 
							->leftJoin('students', 'student_course.student_id', '=', 'students.id')
							->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
							->where('students.created_at', 'LIKE', $p2_date.'%')
							->sum('cost_of_course');


	        $total_received = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->where('students.created_at', 'LIKE', $p2_date.'%')
	        				->where('students.status','=',1)
	        				->sum('cost_of_course');

	        $outstanding = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->where('students.created_at', 'LIKE', $p2_date.'%')
	        				->where('students.status','=',0)
	        				->sum('cost_of_course');
		}else if($p1_date != '' AND $p2_date == ''){
			$students = DB::table('student_course')
					->leftJoin('students', 'student_course.student_id', '=', 'students.id')	
					->where('students.created_at', 'like', $p1_date.'%')
					->get();


			$total_revenue = DB::table('student_course') 
							->leftJoin('students', 'student_course.student_id', '=', 'students.id')
							->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
							->where('students.created_at', 'LIKE', $p1_date.'%')
							->sum('cost_of_course');


	        $total_received = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->where('students.created_at', 'LIKE', $p1_date.'%')
	        				->where('students.status','=',1)
	        				->sum('cost_of_course');

	        $outstanding = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->where('students.created_at', 'LIKE', $p1_date.'%')
	        				->where('students.status','=',0)
	        				->sum('cost_of_course');
		}else{
			$students = DB::table('student_course')
					->leftJoin('students', 'student_course.student_id', '=', 'students.id')	
					->whereBetween('created_at', [new Carbon($p1_date), new Carbon($p2_date)])
					->get();


			$total_revenue = DB::table('student_course') 
							->leftJoin('students', 'student_course.student_id', '=', 'students.id')
							->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
							->whereBetween('students.created_at', [new Carbon($p1_date), new Carbon($p2_date)])
							->sum('cost_of_course');


	        $total_received = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->whereBetween('students.created_at', [new Carbon($p1_date), new Carbon($p2_date)])
	        				->where('students.status','=',1)
	        				->sum('cost_of_course');

	        $outstanding = DB::table('student_course') 
	        				->leftJoin('students', 'student_course.student_id', '=', 'students.id')
	        				->leftJoin('courses', 'student_course.course_id', '=', 'courses.id')
	        				->whereBetween('students.created_at', [new Carbon($p1_date), new Carbon($p2_date)])
	        				->where('students.status','=',0)
	        				->sum('cost_of_course');
		}//end if


		$this->layout->content =  View::make('payment.report')
									->with('students',$students)
									->with('total_revenue',$total_revenue)
									->with('total_received',$total_received)
									->with('outstanding',$outstanding)
									->with('date1',$p1_date)
									->with('date2',$p2_date);
		
		}//end

	}


	public function changestatus($id)
	{
		if(Auth::user()->role ==1 ) {

			$payment_status = StudentCourseEntry::where('student_id','=',$id)->where('course_id','=',Input::get('mid'))->pluck('sm_payment_status');


			if ($payment_status == 0){
				$payment_status1 = 1;
			}
			else
			{
				$payment_status1 = 0;
			}

			$payment_note = Input::get('payment_note');
			$date_of_payment = Input::get('date_of_payment_pc');

			$transaction_code = Input::get('transaction_code');

			
			StudentCourseEntry::where('student_id','=',$id)->where('course_id','=',Input::get('mid'))->update( 
                       array( 
                             "sm_payment_status" => $payment_status1, "payment_note" => $payment_note, "date_of_payment" => $date_of_payment, "transaction_code" => $transaction_code
                             )
                       );

			return Redirect::to('payment');

		}//end

	}


	function export()
	{
		
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Payment_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $date = date('Y-m', time());


			   $header='Student Name' . ",\t".'Course' . ",\t".'Payment Amount' . ",\t".'Payment Mode' .",\t".'Payment Status'.",\t".'Payment Confirmation' .",\t". 'Date of Regstration'. ",\t" . 'Payment Note'. ",\t" . 'Transaction Code' . ",\t" . 'Date of Payment' . ",\t";


			   $payment_query = DB::select("SELECT st.name,m.course_name,m.cost_of_course,sm.payment_mode,case sm.sm_payment_status when '0' then 'NO' when '1' then 'YES' end as sm_payment_status,case sm.sm_payment_status when '0' then 'Unpaid' when '1' then 'Paid' end as sm_payment_confirm,st.created_at,sm.payment_note,sm.transaction_code,sm.date_of_payment FROM students AS st LEFT JOIN student_course AS sm ON st.id=sm.student_id LEFT JOIN courses AS m ON sm.course_id=m.id WHERE st.created_at LIKE '".$date."%' ");



			   foreach( $payment_query as $row )
				{
				    $line = '';
				    foreach( $row as $value )
				    {                                            
				        if ( ( !isset( $value ) ) || ( $value == "" ) )
				        {
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
				
				ob_end_clean();
				
			
	   			$csv_data= "$header\n$data";
				
				print $csv_data;
				exit;



		}//end
	}

	function reportexport()
	{
		if (Auth::user()->role == 1) {
			   header('Content-Encoding: UTF-8');
			   header("Content-type: application/vnd.ms-excel;charset=charset=UTF-8;");
			   header("Content-Disposition: attachment; filename=Payment_Export_Data".date('d-m-Y_his').".csv");
			   header("Pragma: no-cache"); 
			   header("Expires: 0");

			   $data ='';
			   $line = '';
			   $header='';

			   $header='Student Name' . ",\t".'Course' . ",\t".'Payment Amount' . ",\t".'Payment Mode' .",\t".'Payment Status'.",\t".'Payment Confirmation' .",\t". 'Date of Regstration'. ",\t" . 'Payment Note'. ",\t" . 'Transaction Code' . ",\t" . 'Date of Payment' . ",\t";

			   $date = date('Y-m', time());

			   $p1_date = Input::get('p1_date');
			   $p2_date = Input::get('p2_date');

			   if ($p1_date == '' AND $p2_date != '') {
			   	    $payment_query = DB::select("SELECT st.name,m.course_name,m.cost_of_course,sm.payment_mode,case sm.sm_payment_status when '0' then 'NO' when '1' then 'YES' end as sm_payment_status,case sm.sm_payment_status when '0' then 'Unpaid' when '1' then 'Paid' end as sm_payment_confirm,st.created_at,sm.payment_note,sm.transaction_code,sm.date_of_payment FROM students AS st LEFT JOIN student_course AS sm ON st.id=sm.student_id LEFT JOIN courses AS m ON sm.course_id=m.id WHERE st.created_at LIKE '".$p2_date."%' ");

			   }else if($p1_date != '' AND $p2_date == ''){
			   		$payment_query = DB::select("SELECT st.name,m.course_name,m.cost_of_course,sm.payment_mode,case sm.sm_payment_status when '0' then 'NO' when '1' then 'YES' end as sm_payment_status,case sm.sm_payment_status when '0' then 'Unpaid' when '1' then 'Paid' end as sm_payment_confirm,st.created_at,sm.payment_note,sm.transaction_code,sm.date_of_payment FROM students AS st LEFT JOIN student_course AS sm ON st.id=sm.student_id LEFT JOIN courses AS m ON sm.course_id=m.id WHERE st.created_at LIKE '".$p1_date."%' ");
			   }else{
			   		$payment_query = DB::select("SELECT st.name,m.course_name,m.cost_of_course,sm.payment_mode,case sm.sm_payment_status when '0' then 'NO' when '1' then 'YES' end as sm_payment_status,case sm.sm_payment_status when '0' then 'Unpaid' when '1' then 'Paid' end as sm_payment_confirm,st.created_at,sm.payment_note,sm.transaction_code,sm.date_of_payment FROM students AS st LEFT JOIN student_course AS sm ON st.id=sm.student_id LEFT JOIN courses AS m ON sm.course_id=m.id WHERE st.created_at BETWEEN '$p1_date' AND '$p2_date' ");
			   }

			
			   foreach( $payment_query as $row )
				{
				    $line = '';
				    foreach( $row as $value )
				    {                                            
				        if ( ( !isset( $value ) ) || ( $value == "" ) )
				        {
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

				
				ob_end_clean();
				
			
	   			$csv_data= "$header\n$data";
				
				print $csv_data;
				exit;



		}//end
	}

}// End Class
?>