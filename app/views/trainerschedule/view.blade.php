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
{{ Form::open(array('url'=>'trainerschedule/'.$trainerschedule->id,'method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-6">
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
            <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Trainer
                </label>
                <div class="col-sm-9">
                    <select disabled class="col-sm-12" name="trainer">        
                        @foreach($trainers as $trainer)
                            <option @if($trainerschedule->trainer_id == $trainer['user_id']) selected @endif value="{{ $trainer['user_id'] }}">
                                {{ $trainer['trainer_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Course
                </label>
                <div class="col-sm-9">
                    <select disabled class="col-sm-12" name="module" id="module">        
                        @foreach($courses as $course)
                            <option @if($trainerschedule->course_id == $course['id']) selected @endif value="{{ $course['id'] }}">
                                {{ $course['course_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group" id="lessondatawrap" style="display:none;">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Lesson
                </label>
                <div class="col-sm-9">
                    <select disabled class="col-sm-12" name="lesson">        
                        @foreach($lessons as $lesson)
                            <option @if($trainerschedule->lesson_id == $lesson['id']) selected @endif value="{{ $lesson['id'] }}">
                                {{ $lesson['lesson_name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Date
                </label>
                <div class="col-sm-9">
                   <input type="text" name="date" value="{{$trainerschedule->date}}" id="date" class="form-control input-sm">
                </div>
            </div>

            <div class="sessionwrap">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="form-field-13">
                       Session :
                    </label>
                    <div class="col-sm-9">
                       
                        <div class="app-sel-box">
                           <h1>Choose a session:</h1>
                           <table>
                            <thead>
                                <tr>
                                    <th>Sessions</th>
                                    <th>Booking</th>
                                    <th>Vacancy</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tss_array[] = '';
                                foreach ($trainerschedule_session as $tss) {  
                                    $tss_array[] = $tss->session;
                                }//end foreach

                                $v_limit = 14;
                                foreach ($session as $row) {
                                    if ($row->session == 'A') {
                                        $session_time = '11am - 12pm';
                                        $vacancy_count = DB::table('appointment')->where('course_id','=',$trainerschedule->course_id)->where('date','=',$trainerschedule->date)->where('session','=','A')->count();
                                        if($vacancy_count == 14){           
                                            $vacancy = "Not available";
                                        }else{
                                            $vacancy = $v_limit - $vacancy_count . " left";
                                        }
                                    }

                                    if ($row->session == 'B') {
                                        $session_time = '2pm - 4pm';
                                        $vacancy_count = DB::table('appointment')->where('course_id','=',$trainerschedule->course_id)->where('date','=',$trainerschedule->date)->where('session','=','B')->count();
                                        if($vacancy_count == 14){           
                                            $vacancy = "Not available";
                                        }else{
                                            $vacancy = $v_limit - $vacancy_count . " left";
                                        }
                                    }

                                    if ($row->session == 'C') {
                                        $session_time = '7pm - 9pm';
                                        $vacancy_count = DB::table('appointment')->where('course_id','=',$trainerschedule->course_id)->where('date','=',$trainerschedule->date)->where('session','=','C')->count();
                                        if($vacancy_count == 14){           
                                            $vacancy = "Not available";
                                        }else{
                                            $vacancy = $v_limit - $vacancy_count . " left";
                                        }               
                                    }

                                    if ($row->session == 'D') {
                                        $session_time = '10am - 12pm';
                                        $vacancy_count = DB::table('appointment')->where('course_id','=',$trainerschedule->course_id)->where('date','=',$trainerschedule->date)->where('session','=','D')->count();
                                        if($vacancy_count == 14){           
                                            $vacancy = "Not available";
                                        }else{
                                            $vacancy = $v_limit - $vacancy_count . " left";
                                        }
                                    }
                                                       

                                echo '<tr>';
                                
                            
                                if (in_array($session_time, $tss_array, TRUE)){
                                    $checked = 'checked';
                                }else{
                                    $checked = '';
                                }                               

                                echo '<td><input type="checkbox" name="session[]" value="'.$session_time.'" class="chk" '.$checked.'>'.$session_time.'</td>';                             
                                echo '<td>'.$vacancy_count.'</td>';
                                echo '<td>'.$vacancy.'</td>';
                                echo '</tr>';
                                
 
                                }

                               ?>

                            </tbody>
                           </table>

                    </div>
                    </div>
                </div>
            </div><!-- .sessionwrap -->

        
	    
        </div>
        <!-- end: TEXT FIELDS PANEL -->
    </div>
    <!-- end: TEXT FIELDS PANEL -->
</div>
<div class="col-sm-6">
    <!-- start: TEXT FIELDS PANEL -->
    {{ Form::hidden('id',$trainerschedule->id) }}
    {{ Form::close() }}
 
  <div class="col-sm-12">
    
    <div class="panel panel-white">
    	<div class="panel-body right padding">
        	<input type="button" class="btn btn-info" value="Edit" id="edit">
        	<input disabled type="submit" class="btn btn-primary none" id="save" value="Save">
            <a href="{{ URL::to('trainerschedule') }}"><input type="button" class="btn btn-warning" value="Back"></a>
        </div>
    </div>
 </div>
</div>
<div class="clear"></div>


@stop

@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
    
    
    <script>
       
		jQuery("#edit").click(function(){
			$("#edit").hide();
			$("#save").show();
			$("body input").prop("disabled", false);
			$("body select").prop("disabled", false);            
		});

        /*************************************************/

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

        var l = window.location;
        var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        var url_link = base_url + "/trainerschedule/lessonsajaxedit";

        $.ajax({
            type: "POST",
            dataType: "json",
            //url:'http://localhost/nobleman/trainerschedule/lessonsajaxedit',
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

              // alert("success");    
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
        var url_link = base_url + "/trainerschedule/sessionajaxedit";

        $.ajax({
            type: "POST",
            dataType: "json",
            //url:'http://localhost/nobleman/trainerschedule/sessionajaxedit',
            url: url_link,
            data: postData,
            cache: false,
            beforeSend: function(data){
                //alert("send");
            },
            success: function(data)
            {
              $(".sessionwrap").html(data.html); 
              //$(".sessionwrap").html(data.session_data);     
              if(data.holiday != 0){
                $(".holiday").css("display", "block");
                $(".deferr").css("display", "none");
                $(".holiday").html(data.holiday);
                document.getElementById("dateholiday").value = "1";
              }else{
                $(".holiday").css("display", "none");
                document.getElementById("dateholiday").value = "0";
              }

              //alert(data.vacancy);

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
              //alert("success");
            },
            error: function(data){
                alert("error");
            }
        }); 
      });//End ajax


        });
    </script>
@stop