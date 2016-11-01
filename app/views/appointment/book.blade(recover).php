@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
        </div>
        {{ Form::open(array('url'=>'appointment/book','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
            @if ($errors->has())
                <div class="alert alert-danger deferr">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <div class="holiday alert alert-danger" style="display:none;">
            </div>

            <div class="emptysession alert alert-danger" style="display:none;">
            </div>

            <!-- start: TEXT FIELDS PANEL -->
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Make An<span class="text-bold"> Appointment</span></h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Module
                        </label>
                        <div class="col-sm-3">
                            <select name="module" id="module">
                                @foreach($studentmodule as $key => $studentmodules)
                                    @foreach (modulesentry::where('id','=',$studentmodules->module_id)->get() as $key => $modules)
                                        <option value="{{ $modules->id }}">{{ $modules->module_name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>

                   <!--  <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Lesson
                        </label>
                        <div class="col-sm-3">
                            <select name="lesson">
                                @foreach($studentmodule as $key => $studentmodules)
                                    @foreach (lessonsentry::where('module_id','=',$studentmodules->module_id)->get() as $key => $lessons)
                                        <option value="{{ $lessons->id }}">{{ $lessons->lesson_name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div> -->


                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Date
                        </label>
                        <div class="col-sm-3">
                            <input type="text" name="date" placeholder="Click here to pick a date" id="date" class="form-control input-sm">
                        </div>
                    </div>



                    <div class="form-group sessionwrap">
                        <label class="col-sm-2 control-label" for="form-field-13">
                           Session :
                        </label>
                        <div class="col-sm-9">
                            <select class="col-sm-4" name="session">
                                <option>Choose session</option>
                                <!-- <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option> -->
                            </select>

                        </div>
                    </div>
                    <span style="float:left"><i>Session A: 11am-1pm; Session B: 2-4pm; Session C: 7pm-9pm; Session D: 10am-12pm</i></span>
                </div>
                <!-- end: TEXT FIELDS PANEL -->
            </div>

            <div class="panel panel-white">
                <div class="panel-body right padding">
                    <input type="submit" class="btn btn-primary" value="Create">
                    <a href="{{ URL::to('appointment') }}"><input type="button" class="btn btn-warning" value="Back"></a>
                </div>
            </div>
        {{ Form::close() }}
        <!-- end: DYNAMIC TABLE PANEL -->
    </div>
@stop

@section ('scripts')
    {{ HTML::script('assets/plugins/select2/select2.min.js') }}
    {{ HTML::script('assets/js/table-data.js') }}
    {{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
<script>
jQuery(document).ready(function() {
    /*var date = new Date();
    date.setDate(date.getDate()+1);
    $('#date').datepicker({
        format: "yyyy-mm-dd",
        daysOfWeekDisabled: "0,1",
        startDate: date,
        todayHighlight: true,
        onSelect: function (dateText, inst) {
            alert("Working");
        }
    });*/

 var date = new Date();
 date.setDate(date.getDate()+1);
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
    var postData ={'dt': date_data, 'module_name': module_name};
    $.ajax({
        type: "POST",
        dataType: "json",
        url:'http://localhost/nobleman/appointmentajax',
        //url: url_link,
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
          }else{
            $(".holiday").css("display", "none");
          }

          if(data.session_data != 0){
            $(".emptysession").css("display", "block");
            $(".deferr").css("display", "none");
            $(".emptysession").html(data.session_data);
          }else{
            $(".emptysession").css("display", "none");
          }


          alert("success" + data.holiday);
        },
        error: function(data){
            alert("error");
        }
    });
  });




});
/*$('#date').live("click", function(){
    alert('sad');
});*/

//$("#date").change(function() {alert("Change detected!");});

/*$(document).ready(function(){
    $("#date1").click(function(){
        alert('Value changed!');

    //var url_link = "http://localhost/nobleman/app/views/appointment/test.php";
    var postData ={'id': '1'};
    $.ajax({
        type: "POST",
        dataType: "json",
        url:'http://localhost/nobleman/appointmentajax',
        //url: url_link,
        data: postData,
        cache: false,
        beforeSend: function(data){
            //alert("send");
        },
        success: function(data)
        {
          $(".sessionwrap").html(data.html);
          //alert("success" + data.html);
        },
        error: function(data){
            alert("error");
        }
    });



    });
});
*/

var no = 0;
$(".formdel").submit(function(ev) {
	if (no == 0)
	{
		var id = $(this).attr('id');
		Boxy.confirm("Are you sure?", function() { no = 1; $("#"+id).submit(); }, {title: 'Confirm'});
		return false;
	}
});
</script>
@stop
