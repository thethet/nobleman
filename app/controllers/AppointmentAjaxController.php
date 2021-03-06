<?php

class AppointmentAjaxController extends Controller{
	
	public function index(){
		//echo "success";
	}

	public function sessionajax()
	{
		$dt = Input::get('dt');
		$course_name = Input::get('course_name');
		$course_id = Input::get('course_id');

		/*$timestamp = strtotime($dt);
		$day = date('D', $timestamp);*/

		//check holiday
		//$holiday_count = DB::table('holidays')->where('hf_date','=',$dt)->count();
		$holiday_count = DB::table('holidays')
						->whereRaw('hf_date <= "'.$dt.'"')
						->whereRaw('ht_date >= "'.$dt.'"')
						->count();

		if ($holiday_count != 0) {
			$holiday = 'School is closed for this day!';
		}else{
			$holiday = 0;
		}

		$day = date("D", strtotime($dt));
		if($day == 'Thu'){
			$day = 'Thur';
		}
		$session = DB::table('lesson_sessions')->where('day','=',$day)->where('course_id','=',$course_id)->where('status','=',1)->get();
		$session_count = DB::table('lesson_sessions')->where('day','=',$day)->where('course_id','=',$course_id)->where('status','=',1)->count();
		if($session_count == 0){
			$session_data = 'There is no session on this day! ';
			$vacancy = '';
			$html = '';

		}else{

		$html = '<label class="col-sm-2 control-label" for="form-field-13">
                           Session :
                        </label>';
        $html .= '<div class="col-sm-9">';
		//$html .= '<select name="session" class="col-sm-4">';
		$html .= '<div class="app-sel-box">';
		$html .= '<h1>Choose a session:</h1>';
		$html .= '<table>';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th>Sessions</th>';
		$html .= '<th>Vacancy</th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';

		/*$vacancy_count = "SELECT count(*) FROM `appointment` WHERE course_id='".$course_id."' AND date='".$dt."' ";
		if($vacancy_count == 14){			
			$vacancy = "full";
		}else{
			$vacancy = $vacancy_count . " left";
		}*/

		$v_limit = 14;

		foreach ($session as $row) {

			if ($row->session == 'A') {
				$session_time = '11am - 12pm';
				$vacancy_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
				if($vacancy_count == 14){			
					$vacancy = "Not available";
				}else{
					$vacancy = $v_limit - $vacancy_count . " left";
				}
			}

			if ($row->session == 'B') {
				$session_time = '2pm - 4pm';
				$vacancy_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
				if($vacancy_count == 14){			
					$vacancy = "Not available";
				}else{
					$vacancy = $v_limit - $vacancy_count . " left";
				}
			}

			if ($row->session == 'C') {
				$session_time = '7pm - 9pm';
				$vacancy_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
				if($vacancy_count == 14){			
					$vacancy = "Not available";
				}else{
					$vacancy = $v_limit - $vacancy_count . " left";
				}				
			}

			if ($row->session == 'D') {
				$session_time = '10am - 12pm';
				$vacancy_count = DB::table('appointment')->where('course_id','=',$course_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
				if($vacancy_count == 14){			
					$vacancy = "Not available";
				}else{
					$vacancy = $v_limit - $vacancy_count . " left";
				}
			}
			
			$html .= '<tr>';
			$html .= '<td><input type="checkbox" name="session" value="'.$session_time.'" class="chk">'.$session_time.'</td>';
			$html .= '<td>'.$vacancy.'</td>';
			$html .= '</tr>';

		}

		$html .= '</tbody>';
		$html .= '</table>';	

		//$html .= '</select>';
		$html .= '</div>';


		if ($day == 'Mon') {
			$html .= '<p></p>';
		}

		if ($day == 'Tue' || $day == 'Thur') {
			$html .= '<p>- For Tuesday and Thursday,there will be 3 lessons,including night lesson.</p>';
		}

		if ($day == 'Wed' || $day == 'Fri') {
			$html .= '<p>- For Wednesday and Friday, there are only morning and afternoon classes.</p>';
		}

		if ($day == 'Sat') {
			$html .= '<p>- For Saturday, there is only morning lesson.</p>';
		}

		if ($day == 'Sun') {
			$html .= '<p></p>';
		}
		
		$html .= '</div>';

		$session_data = 0;


		}//end


		$data = array('html'=>$html,  'holiday'=>$holiday, 'session_data'=>$session_data, 'vacancy' =>$vacancy);
	    echo json_encode($data);

	}




}//end class