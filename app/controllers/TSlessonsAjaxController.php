<?php

class TSlessonsAjaxController extends Controller{
	

	/* Ajax for lessons by module */
	public function lessonsajax()
	{
		$dt = Input::get('dt');
		$module_name = Input::get('module_name');
		$module_id = Input::get('module_id');

		if ($module_id != 0) {

			if ($dt != '') {
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
						$session = DB::table('lesson_sessions')->where('day','=',$day)->where('course_id','=',$module_id)->where('status','=',1)->get();
						$session_count = DB::table('lesson_sessions')->where('day','=',$day)->where('course_id','=',$module_id)->where('status','=',1)->count();
						if($session_count == 0){
							$session_data = 'There is no session on this day! ';
							$vacancy = '';
							$html_ses = '';

						}else{
							$html_ses = '<div class="form-group">';
							$html_ses .= '<label class="col-sm-2 control-label" for="form-field-13">
					                           Session :
					                        </label>';
					        $html_ses .= '<div class="col-sm-9">';
							//$html_ses .= '<select name="session" class="col-sm-4">';
							$html_ses .= '<div class="app-sel-box">';
							$html_ses .= '<h1>Choose a session:</h1>';
							$html_ses .= '<table>';
							$html_ses .= '<thead>';
							$html_ses .= '<tr>';
							$html_ses .= '<th>Sessions</th>';
							$html_ses .= '<th>Booking</th>';
							$html_ses .= '<th>Vacancy</th>';
							$html_ses .= '</tr>';
							$html_ses .= '</thead>';
							$html_ses .= '<tbody>';

							/*$vacancy_count = "SELECT count(*) FROM `appointment` WHERE moudule_id='".$module_id."' AND date='".$dt."' ";
							if($vacancy_count == 14){			
								$vacancy = "full";
							}else{
								$vacancy = $vacancy_count . " left";
							}*/

							$v_limit = 14;

							foreach ($session as $row) {

								if ($row->session == 'A') {
									$session_time = '11am - 12pm';
									$vacancy_count = DB::table('appointment')->where('course_id','=',$module_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
									if($vacancy_count == 14){			
										$vacancy = "Not available";
									}else{
										$vacancy = $v_limit - $vacancy_count . " left";
									}
								}

								if ($row->session == 'B') {
									$session_time = '2pm - 4pm';
									$vacancy_count = DB::table('appointment')->where('course_id','=',$module_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
									if($vacancy_count == 14){			
										$vacancy = "Not available";
									}else{
										$vacancy = $v_limit - $vacancy_count . " left";
									}
								}

								if ($row->session == 'C') {
									$session_time = '7pm - 9pm';
									$vacancy_count = DB::table('appointment')->where('course_id','=',$module_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
									if($vacancy_count == 14){			
										$vacancy = "Not available";
									}else{
										$vacancy = $v_limit - $vacancy_count . " left";
									}				
								}

								if ($row->session == 'D') {
									$session_time = '10am - 12pm';
									$vacancy_count = DB::table('appointment')->where('course_id','=',$module_id)->where('date','=',$dt)->where('session','=',$session_time)->where('booking_status','=','book')->count();
									if($vacancy_count == 14){			
										$vacancy = "Not available";
									}else{
										$vacancy = $v_limit - $vacancy_count . " left";
									}
								}
								
								$html_ses .= '<tr>';
								$html_ses .= '<td><input type="checkbox" name="session" value="'.$session_time.'" class="chk">'.$session_time.'</td>';
								$html_ses .= '<td>'.$vacancy_count.'</td>';
								$html_ses .= '<td>'.$vacancy.'</td>';
								$html_ses .= '</tr>';

							}//end foreach

							$html_ses .= '</tbody>';
							$html_ses .= '</table>';	

							//$html_ses .= '</select>';
							$html_ses .= '</div>';		

							
							$html_ses .= '</div>';
							$html_ses .= '</div>';


							/*$html_ses .= '<div class="form-group">
					                    <label class="col-sm-2 control-label" for="form-field-13">
					                       Booking :
					                    </label>
					                    <div class="col-sm-9">                        
					                        <label style="padding-top:8px;">'.$vacancy_count.'</label>
					                    </div>
					                </div>';*/

							$session_data = 0;
						}

			}else{
				
				 $html_ses = 0;
				 $holiday = 0;
				 $session_data = 0;
				 $vacancy = 0;


			}//End if for date

		/*$lessons = DB::table('lessons')->where('module_id','=',$module_id)->get();

		$html = '<label class="col-sm-2 control-label" for="form-field-13">	
		      		Lesson
	             </label>';
		$html .= '<div class="col-sm-9">';
	    $html .= '<select class="col-sm-12" name="lesson">';

	    foreach ($lessons as $lesson) {
	    	$html .= '<option value="'.$lesson->id.'">'.$lesson->lesson_name.'</option>';
	    }
	    
	    $html .= '</select>';
	    $html .= '</div>';*/

	    $data = array('html'=>$html, 'html_ses'=>$html_ses, 'holiday'=>$holiday, 'session_data'=>$session_data, 'vacancy' =>$vacancy);
	    //$data = array('html'=>$html, 'html_ses'=>$html_ses);
		echo json_encode($data);
	    
	    }else{
			$module = 0;		
			$data = array('module'=>$module);
			echo json_encode($data);
		}

	}



}//end class