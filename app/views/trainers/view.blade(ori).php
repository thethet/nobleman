@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/plugins/datepicker/css/datepicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }}
@stop

@section('content')
{{ Form::open(array('url'=>'users/'.$user->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-6">

    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Salutation
                    </label>
                    <div class="col-sm-9">
                        <select disabled id="form-field-select-1" name="salutation" class="form-control input-sm">
                        	<option @if ($user->salutation == "Mr.") selected @endif value="Mr.">Mr.</option>
                        	<option @if ($user->salutation == "Mrs.") selected @endif value="Mrs.">Mrs.</option>
                        	<option @if ($user->salutation == "Miss.") selected @endif value="Miss">Miss</option>
                        	<option @if ($user->salutation == "Dr.") selected @endif value="Dr.">Dr.</option>
                        	<option @if ($user->salutation == "Ms.") selected @endif value="Ms.">Ms.</option>
                        	<option @if ($user->salutation == "Prof.") selected @endif value="Prof.">Prof.</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        First Name*
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="first_name" value="{{ $user->first_name }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Last Name
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="last_name" value="{{ $user->last_name }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Gender* 
                    </label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input disabled type="radio" @if ($user->gender == "Female") checked @endif class="grey contributor-gender" value="Female" name="gender">
                            Female
                        </label>
                        <label class="radio-inline">
                            <input disabled type="radio" @if ($user->gender == "Male") checked @endif class="grey contributor-gender" value="Male" name="gender">
                            Male
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Marital Status
                    </label>
               		<div class="col-sm-9">		
                    	<select disabled name="marital_status" class="form-control input-sm search-select">
                        	<option value="Single" @if ($user->marital_status == "Single") selected @endif>Single</option>
                        	<option value="Married" @if ($user->marital_status == "Married") selected @endif>Married</option>
                        	<option value="Widowed" @if ($user->marital_status == "Widowed") selected @endif>Widowed</option>
                        </select>		
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="contact" value="{{ $user->contact }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Address
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="address" value="{{ $user->address }}"  placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Position
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="position" value="{{ $user->position }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Payroll
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="payroll" value="{{ $user->payroll }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Date of Birth
                    </label>
               		<div class="col-sm-9">
						<input disabled type="text" name="dob" value="{{ date('d-m-Y',strtotime($user->dob)) }}" data-date-format="dd-mm-yyyy" data-date-viewmode="years" class="form-control date-picker">				
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Country of Birth
                    </label>
               		<div class="col-sm-9">
                    	<select disabled name="country" class="form-control input-sm search-select">
                            @foreach ($countries as $key=>$value)
                                <option @if($value->country_name == $user->country) selected @endif value="{{ $value->country_name }}">{{ $value->country_name }}</option>    
                            @endforeach
                        </select>					
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Nationality
                    </label>
               		<div class="col-sm-9">
                    	<select disabled name="nationality" value="{{ $user->nationality }}" class="form-control input-sm search-select">
                            @foreach ($countries as $key=>$value)
                                <option @if($value->nationality == $user->nationality) selected @endif value="{{ $user->nationality }}">{{ $user->nationality }}</option>    
                            @endforeach
                        </select>			
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Race
                    </label>
               		<div class="col-sm-9">		
                    	<select disabled name="race" class="form-control input-sm search-select">
                        	<option @if($user->race == "Chinese") selected @endif value="Chinese">Chinese</option>
                        	<option @if($user->race == "Indian") selected @endif  value="Indian">Indian</option>
                        	<option @if($user->race == "Malay") selected @endif  value="Malay">Malay</option>
                        	<option @if($user->race == "Eurasian") selected @endif  value="Eurasian">Eurasian</option>
                        	<option @if($user->race == "Other") selected @endif  value="Other">Other</option>
                        </select>		
                    </div>
                </div>
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Log-in <span class="text-bold">Credentials</span></h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        ID*
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" name="show_id" value="{{ $user->show_id }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Email
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="email" name="email" value="{{ $user->email }}" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       	Password
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="password" name="password" placeholder="*****************" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Confirm Password
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="password" name="confirm_password"  placeholder="*****************" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Role
                    </label>
                    <div class="col-sm-9">
                    	<select disabled name="role" class="form-control input-sm">
                            @foreach ($user_roles as $key=>$value)
                                <option @if ($user->role == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
<div class="col-sm-12">
    
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">Next-to-kin <span class="text-bold">Details</span></h4>
            <div class="panel-tools">
                <div class="dropdown">
                    <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                        <i class="fa fa-cog"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                        <li>
                            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                        </li>
                        <li>
                            <a class="panel-expand" href="#">
                                <i class="fa fa-expand"></i> <span>Fullscreen</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-xs btn-link panel-close" href="#">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="panel-body">
               
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Name
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" value="{{ $user->next_to_kin }}" name="next_to_kin" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Relationship
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" value="{{ $user->next_to_kin_relationship }}" name="next_to_kin_relationship" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Contact
                    </label>
                    <div class="col-sm-9">
                        <input disabled type="text" value="{{ $user->next_to_kin_contact }}" name="next_to_kin_contact" placeholder="" id="form-field-13" class="form-control input-sm">
                    </div>
                </div>
                
        </div>
    </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>
 
  <div class="col-sm-12">
    
    <div class="panel panel-white">
    	<div class="panel-body right padding">
        	<input type="button" class="btn btn-info" value="Edit" id="edit">
        	<input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
            <a href="{{ URL::to('users') }}"><input type="button" class="btn btn-warning" value="Back"></a>
        </div>
    </div>
 </div>
</div>
<div class="clear"></div>
{{ Form::hidden('id',$user->id) }}
{{ Form::close() }}
<div class="col-sm-6">
    
    <div class="panel panel-white">
    	<div class="panel-body ">
        	<table class="table table-bordered table-striped">
            	<thead>
                	<tr>
                    	<td>Assigned Supervisors</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                	@if (count($supervisors) > 0)
                        @foreach ($supervisors as $key=>$value)
                                <tr>
                                    <td>
                                        <?php 
                                            $UserEntry = UserEntry::find($value->supervisor_id);
                                            echo $UserEntry->first_name." ".$UserEntry->last_name;
                                        ?>
                                    </td>
                                    <td>
                                        {{ Form::open(array('action'=>'UsersController@delete_supervisor')) }}
                                            {{ Form::hidden('id',$value->id) }}
                                            {{ Form::hidden('user_id',$user->id) }}
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                        @endforeach
                    @else
                    	<tr>
                        	<td colspan="2"><i>No Supervisors at the moment</i></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        	
			@if (Auth::user()->supervisor == 2)
        	{{ Form::open(array('url'=>'/supervisors','method'=>'post')) }}
        	<div class="form-group">
                <div class="col-sm-10">
                    <select multiple name="supervisor_id" class="form-control input-sm search-select">
                    	@foreach ($users as $key=>$value)
                        	@if ($value->id != $user->id)
	                        	<option value="{{ $value->id }}" @if ($user->supervisor == $value->id) selected @endif>{{ $value->first_name." ".$value->last_name }}</option>
                       		@endif
                        @endforeach
                    </select>
                    {{ Form::hidden('user_id',$user->id) }}
                </div>
                <div class="form-group col-sm-2">
                    <input type="submit" class="btn btn-primary" value="Add">
                </div>
            </div>
            {{ Form::close() }}
            @endif
        </div>
    </div>
 </div>
 <div class="col-sm-6">
    
    <div class="panel panel-white">
    	<div class="panel-body ">
        	<table class="table table-bordered table-striped">
            	<thead>
                	<tr>
                    	<td>Assigned Suboordinates</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                	@if (count($suboordinates) > 0)
                        @foreach ($suboordinates as $key=>$value)
                                <tr>
                                    <td>
                                        <?php 
                                            $UserEntry = UserEntry::find($value->user_id);
                                            echo $UserEntry->first_name." ".$UserEntry->last_name;
                                        ?>
                                    </td>
                                    <td>
                                        {{ Form::open(array('action'=>'UsersController@delete_suboordinate')) }}
                                            {{ Form::hidden('id',$value->id) }}
                   							 {{ Form::hidden('user_id',$user->id) }}
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                        @endforeach
                    @else
                    	<tr>
                        	<td colspan="2"><i>No Suboordinates at the moment</i></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            
			@if (Auth::user()->supervisor == 2)
        	{{ Form::open(array('action'=>'UsersController@add_suboordinate')) }}
        	<div class="form-group">
                <div class="col-sm-10">
                    <select multiple name="suboordinate_id" class="form-control input-sm search-select">
                    	@foreach ($users as $key=>$value)
                        	@if ($value->id != $user->id)
	                        	<option value="{{ $value->id }}" @if ($user->supervisor == $value->id) selected @endif>{{ $value->first_name." ".$value->last_name }}</option>
                       		@endif
                        @endforeach
                    </select>
                    {{ Form::hidden('user_id',$user->id) }}
                </div>
                 <div class="form-group col-sm-2">
                    <input type="submit" class="btn btn-primary" value="Add">
                </div>
            </div>
            {{ Form::close() }}
            @endif
        </div>
    </div>
 </div>
@stop

@section ('scripts')
	{{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/autosize/jquery.autosize.min.js") }}
    {{ HTML::script("assets/plugins/select2/select2.min.js") }}
    {{ HTML::script("assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js") }}
    {{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/jquery-maskmoney/jquery.maskMoney.js") }}
    {{ HTML::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/commits.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js") }}
    {{ HTML::script("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") }}
    {{ HTML::script("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js") }}
    {{ HTML::script("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js") }}
    {{ HTML::script("assets/plugins/ckeditor/ckeditor.js") }}
    {{ HTML::script("assets/plugins/ckeditor/adapters/jquery.js") }}
    {{ HTML::script("assets/js/form-elements.js") }}
    
    
    <script>
        jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
			
        });
		jQuery("#edit").click(function(){
			$("#edit").hide();
			$("#save").show();
			$("body input").prop("disabled", false);
			$("body select").prop("disabled", false);
		});
    </script>
@stop