<?php

class ModuleDataAjaxController extends Controller{
	
	
	public function moduleDataAjax()
	{

		$course_id = Input::get('course_id');

		if ($course_id != 0) {
			
			$md_data = DB::table('courses')->where('id','=',$course_id)->get();

			foreach ($md_data as $key => $value) {
				$html = '<div class="form-group">
			                <label class="col-sm-2 control-label" for="form-field-13">
			                    Course Code
			                </label>
			                <div class="col-sm-9">
			                    <input type="text" readonly name="course_code" placeholder="" id="form-field-13" value="'.$value->course_code.'" class="form-control input-sm">
			                </div>
			            </div>';

			    $html .= '<div class="form-group">
			                <label class="col-sm-2 control-label" for="form-field-13">
			                    Total Course Fee 
			                </label>
			                <div class="col-sm-9">
			                    <input type="text" readonly name="course_feed" placeholder="" id="form-field-13" value="'.$value->cost_of_course.'" class="form-control input-sm">
			                </div>
			            </div>';

			    $html .= '<div class="form-group">
			                <label class="col-sm-2 control-label" for="form-field-13">
			                    Total No. of Lesson
			                </label>
			                <div class="col-sm-9">
			                    <input type="text" readonly name="total_no_lessons" placeholder="" id="form-field-13" value="'.$value->no_of_lesson.'" class="form-control input-sm">
			                </div>
			            </div>';

			    $html .= '<div class="form-group">
			                <label class="col-sm-2 control-label" for="form-field-13">
			                    Training Hours
			                </label>
			                <div class="col-sm-9">
			                    <input type="text" readonly name="total_training_hours" placeholder="" id="form-field-13" value="'.$value->no_hours_per_lesson.'" class="form-control input-sm">
			                </div>
			            </div>';

			    $html .= '<div class="form-group">
			                <label class="col-sm-2 control-label" for="form-field-13">
			                    Course Duration
			                </label>
			                <div class="col-sm-9">
			                    <input type="text" readonly name="course_duration" placeholder="" id="form-field-13" value="'.$value->duration_of_course.'" class="form-control input-sm">
			                </div>
			            </div>';

			}//end foreach

		}else{
			$html = '';
		}


		$data = array('html'=>$html);
	    echo json_encode($data);
	}


}//end class