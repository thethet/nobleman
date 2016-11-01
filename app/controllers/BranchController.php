<?php

class BranchController extends \BaseController {

	public function __construct()
	{
		$this->rules = [
			'name'	=>	'required|min:2|regex:"^(?=.*[#]).+$" '
		];
		$this->messages = [
		    'name.regex' => 'The :attribute field is invalid. Example Format is Singapore #2',
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$branches = Branch::all();
		return View::make('branch.index',compact('branches'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('branch.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		$validator = Validator::make(Input::all(), $this->rules,$this->messages);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		
		// When user enter Singapore #1 , branch code will transform to #S01
		$branch_number = explode('#',Input::get('name'))[1];
		$first_name = substr(Input::get('name'),0,1);
		$data['code'] = $first_name.'0'.$branch_number;
				

		$validator = Validator::make($data,[
			'code' 	=> 'unique:branches'
		],[
			'code.unique'=>	'Your branch is already exists.'	
		]);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}


		Branch::create($data);
		return Redirect::to('/branch')->with('status','Successfully created');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$branch = Branch::findOrFail($id);
		return View::make('branch.edit')->with('branch',$branch);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::all();
		$branch = Branch::findOrFail($id);
		$validator = Validator::make(Input::all(), $this->rules,$this->messages);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}
		
		// When user enter Singapore #1 , branch code will transform to #S01
		$branch_number = explode('#',Input::get('name'))[1];
		$first_name = substr(Input::get('name'),0,1);
		$data['code'] = $first_name.'0'.$branch_number;
 
		// $validator = Validator::make($data,[
		// 	'code' 	=> 'unique:branches,id,'.$branch->id
		// ],[
		// 	'code.unique'=>	'Your branch is already exists.'	
		// ]);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}

		$branch->update($data);
		return Redirect::to('/branch')->with('status','Successfully created');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$branch = Branch::findOrFail($id);
		$branch->delete();
		return Redirect::back()->with('status','Successfully deleted');
	}

}
