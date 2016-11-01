<?php

class HolidaysController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $layout = "layouts.main";

	public function __construct()
	{
		
	}

	public function index()
	{
		if(Auth::user()->role ==1 ) {
		$holidays = HolidaysEntry::get();
		$this->layout->content = View::make('holidays.lists')->with('holidays',$holidays);
		}//end
	}


	public function create()
	{
		if(Auth::user()->role ==1 ) {
		$this->layout->content =  View::make('holidays.create');
		}//end
	}

	public function store()
	{
		if(Auth::user()->role ==1 ) {
		$rules = array(
				'hf_date' => 'required', 
				'holiday_name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('holiday/create')
				->withErrors($validator);
		} else {
			$HolidaysEntry = new HolidaysEntry;
			$HolidaysEntry->hf_date = Input::get('hf_date');
			$HolidaysEntry->ht_date = Input::get('ht_date');			
			$HolidaysEntry->h_name = Input::get('holiday_name');
			$HolidaysEntry->save();
			
			Session::flash('message', 'Successfully created holiday!');
			return Redirect::to('holidays');

		}

		}//end
	}


	public function view($id)
	{
		if(Auth::user()->role ==1 ) {
		$holiday = HolidaysEntry::find($id);
		return View::make('holidays.view')->with('holiday', $holiday);
		}//end
	}
	

	public function edit($id)
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');

		$rules = array(
				'hf_date' => 'required', 
				'holiday_name' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {		
			return Redirect::to('holiday/' . $id)
					->withErrors($validator);

		} else {
			$HolidaysEntry = HolidaysEntry::find(Input::get('id'));
			$HolidaysEntry->h_name = Input::get('holiday_name');
			$HolidaysEntry->hf_date = Input::get('hf_date');
			$HolidaysEntry->ht_date = Input::get('ht_date');
			$HolidaysEntry->save();

			Session::flash('message', 'Successfully updated!');
			return Redirect::to('holidays');
		}
		}//end
	}


	public function delete()
	{
		if(Auth::user()->role ==1 ) {
		$id = Input::get('id');
		HolidaysEntry::find($id)->delete();
		return Redirect::to('holidays');
		}//end
	}




}//end class
