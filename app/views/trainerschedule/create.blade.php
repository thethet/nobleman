@extends('layouts.main')

@section('styles')
	
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}    
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }}
    {{ HTML::style("assets/css/custom-style.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

@stop

@section('content')

{{ Form::open(array('url'=>'trainerschedule/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
	<div class="col-sm-12">
		@if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif

        @if (Session::has('holidaymessage'))
            <div class="alert alert-danger">{{ Session::get('holidaymessage') }}</div>
        @endif

        @if (Session::has('duplicatemessage'))
            <div class="alert alert-danger">{{ Session::get('duplicatemessage') }}</div>
        @endif
        
        @if (Session::has('sessionmessage'))
            <div class="alert alert-danger">{{ Session::get('sessionmessage') }}</div>
        @endif

        <div class="holiday alert alert-danger" style="display:none;"></div>
        	<input type="hidden" id="dateholiday" name="dateholiday" />
        

        <div class="emptysession alert alert-danger" style="display:none;">            
        </div>

        <div class="nomodule alert alert-danger" style="display:none;">            
        </div>

        <div class="nodate alert alert-danger" style="display:none;">            
        </div>

        <!-- start: TEXT FIELDS PANEL -->
	    <div class="panel panel-white">
	        <div class="panel-heading">
	            <h4 class="panel-title">Create New<span class="text-bold"> Schedule</span></h4>
	        </div>
	        <div class="panel-body">

	        	<div class="form-group">
	                <label class="col-sm-2 control-label" for="form-field-13">
	                    Trainer
	                </label>
	                <div class="col-sm-9">
	                    <select class="col-sm-4" name="trainer">        
	                        @foreach($trainers as $trainer)
	                            <option value="{{ $trainer['user_id'] }}">{{ $trainer['trainer_name'] }}</option>
	                        @endforeach
	                    </select>
	                </div>
	            </div>

	            <div class="form-group">
	                <label class="col-sm-2 control-label" for="form-field-13">
	                    Course
	                </label>
	                <div class="col-sm-9">
	                    <select class="col-sm-4" name="module" id="module">  
	                    <option value=0>Choose Course</option>      
	                        @foreach($courses as $course)
	                            <option value="{{ $course['id'] }}">{{ $course['course_name'] }}</option>
	                        @endforeach
	                    </select>
	                </div>
	            </div>

	            <div class="form-group" id="lessondatawrap" style="display:none;">
	                <label class="col-sm-2 control-label" for="form-field-13">
	                    Lesson
	                </label>
	                <div class="col-sm-9">
	                    <select class="col-sm-4" name="lesson">        
	                        <option></option>
	                    </select>
	                </div>
	            </div>

	            <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                        Date
                    </label>
                    <div class="col-sm-3">
                        <input type="text" name="date" placeholder="Click here to pick a date" id="date" class="form-control input-sm">
                    </div>
                </div>

                <div class="sessionwrap">
	                <div class="form-group">
	                    <label class="col-sm-2 control-label" for="form-field-13">
	                       Session :
	                    </label>
	                    <div class="col-sm-9">
	                        <select class="col-sm-4" name="session">
	                            <option value=0>Choose Session</option>                            
	                        </select>
	                    </div>
	                </div>
            	</div>


			</div><!-- .panel-body -->
		</div><!-- .panel-white -->
		<!-- end: TEXT FIELDS PANEL -->
	</div>

	<div class="col-sm-12">
	<div class="panel panel-white">
	    <div class="panel-body right padding">
	        <input type="submit" class="btn btn-primary" value="Create">
	        <a href="{{ URL::to('trainerschedule') }}"><input type="button" class="btn btn-warning" value="Back"></a>
	    </div>
	</div>
	</div>
	
{{ Form::close() }}

@stop


@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}

<script>
jQuery(document).ready(function() {
	 
	 /*$(document).on('click', '.chk', function(){
      // in the handler, 'this' refers to the box clicked on
      var $box = $(this);
      if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
    });*/

	/********************************************************/

	$('#module000').on("change", function() {
		
	    var module_name = $("#module option:selected").text();
	    var m = document.getElementById("module");
	    var module_id = m.options[m.selectedIndex].value;
	    var date_data = document.getElementById("date").value;

	   /* var postData ={'module_id': module_id, 'date': date};  */
	    var postData ={'dt': date_data, 'module_name': module_name, 'module_id': module_id}; 

	    //var url_link = location.protocol + "//" + location.host;
	    var l = window.location;
		var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[0];
	    var url_link = base_url + "/trainerschedule/lessonsajax";

	    $.ajax({
	        type: "POST",
	        dataType: "json",
	        //url:'http://localhost/nobleman/trainerschedule/lessonsajax',
	        url: url_link,
	        data: postData,
	        cache: false,
	        beforeSend: function(data){
	            //alert("send");
	        },
	        success: function(data)
	        {
	          $("#lessondatawrap").html(data.html);          

	          if(data.html_ses == 0){
	          	/*$(".nodate").css("display", "block");
	          	$(".nodate").html('Please choose the date!');*/
	          }else{
	          	$(".sessionwrap").html(data.html_ses);   
	          }

	          if (data.module == 0) {
	          	$(".nomodule").css("display", "block");
	          	$(".nomodule").html('Please choose the module!');
	          	$(".emptysession").css("display", "none");
	          	$(".holiday").css("display", "none");
	          }else{
	          	$(".nomodule").css("display", "none");
		          	if(data.holiday != 0){
			            $(".holiday").css("display", "block");
			            $(".deferr").css("display", "none");
			            $(".holiday").html(data.holiday);
			            document.getElementById("dateholiday").value = "1";

			        }else{
			            $(".holiday").css("display", "none");
			            document.getElementById("dateholiday").value = "0";
			        }

		            if(data.session_data != 0){
			            $(".emptysession").css("display", "block");
			            $(".deferr").css("display", "none");
			            $(".emptysession").html(data.session_data);
			            $(".sessionwrap").html(''); 
			        }else{
			            $(".emptysession").css("display", "none");
			        }	            
	          }

	           //alert("success");    
	        },
	        error: function(data){
	            alert("error");
	        }
	    }); //End ajax
	});

	/********************************************************/

	var date = new Date();
	 date.setDate(date.
	    getDate()+1);
	 $("#date").datepicker({
	    format: "yyyy-mm-dd",
	    //daysOfWeekDisabled: "0,1",
	    startDate: date,
	    todayHighlight: true,
	    onSelect: function(dateText) {
	    //alert("onSelect");
	    }
	  }).on("change", function() {
	    //alert("change!");
	    var date_data = document.getElementById("date").value;
	    //var module_name = document.getElementById("module").text();
	    var module_name = $("#module option:selected").text();
	    var m = document.getElementById("module");
	    var module_id = m.options[m.selectedIndex].value;

	    var postData ={'dt': date_data, 'module_name': module_name, 'module_id': module_id}; 

	    var l = window.location;
		var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
	    var url_link = base_url + "/trainerschedule/sessionajax";

	    $.ajax({
	        type: "POST",
	        dataType: "json",
	        //url:'http://localhost/nobleman/trainerschedule/sessionajax',
	        url: url_link,
	        data: postData,
	        cache: false,
	        beforeSend: function(data){
	            //alert("send");
	        },
	        success: function(data)
	        {
	          $(".sessionwrap").html(data.html);   
	          if(data.holiday != 0){
	            $(".holiday").css("display", "block");
	            $(".deferr").css("display", "none");
	            $(".holiday").html(data.holiday);

	            document.getElementById("dateholiday").value = "1";
	          }else{
	            $(".holiday").css("display", "none");
	            document.getElementById("dateholiday").value = "0";
	          }

	          if(data.session_data != 0){
	            $(".emptysession").css("display", "block");
	            $(".deferr").css("display", "none");
	            $(".emptysession").html(data.session_data);
	          }else{
	            $(".emptysession").css("display", "none");
	          }

	          if (data.module == 0) {
	          	$(".nomodule").css("display", "block");
	          	$(".nomodule").html('Please choose the module!');
	          	$(".emptysession").css("display", "none");
	          	$(".holiday").css("display", "none");
	          }else{
	          	$(".nomodule").css("display", "none");
	          }

	          $('.datepicker').hide();
	         
	        },
	        error: function(data){	        	
	            alert("error");
	        }
	    }); 
	  });//End ajax



});
</script>
@stop