@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}

<style type="text/css">
  .bgtdfir {
      background-color: #323223 !important;
      color: #fff;
  }
  input[type='checkbox']{
    margin: 10px;
  }

  /***********************/
 input[type=radio],
input[type=checkbox] {
  display: none;
}
.checkbox label:before {
  content: "";
  display: inline-block;

  width: 16px;
  height: 16px;

  margin-right: 10px;
  position: absolute;
  left: 0;
  bottom: 1px;
  background-color: #aaa;
  box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
}

.radio label:before {
  border-radius: 8px;
}
.checkbox label {
  margin-bottom: 10px;
}
.checkbox label:before {
    border-radius: 3px;
}

input[type=radio]:checked + label:before {
    content: "\2022";
    color: #f3f3f3;
    font-size: 30px;
    text-align: center;
    line-height: 18px;
}

input[type=checkbox]:checked + label:before {
  content: "\2713";
  text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
  font-size: 15px;
  color: #f3f3f3;
  text-align: center;
    line-height: 15px;
}
</style>
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Sessions</h3>                

        </div>
        <div class="panel-body">
        @if(Session::has('message'))
            <div class="alert-box success">
                {{ Session::get('message') }}
            </div>
        @endif
        
            <table class="display" id="sample_1">
                <thead>
                    <tr>
                      <td class="center bgthfir"></td>
                      <td class="center bgthfir" colspan="8"><h1>Sessions</h1></td>
                    </tr>
                    <tr>
                       <th class="center bgthfir"></th>
                       <th class="center bgthfir">Mon</th>
                       <th class="center bgthfir">Tue</th>
                       <th class="center bgthfir">Wed</th>
                       <th class="center bgthfir">Thurs</th>
                       <th class="center bgthfir">Fri</th>
                       <th class="center bgthfir">Sat</th>
                       <th class="center bgthfir">Sun</th>
                       <th class="center bgthfir">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @foreach($courses as $c)
                       <tr> 
                       {{ Form::open(array('url'=>'sessions/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}                      
                          <td class="right bgtdfir" style="font-size:14px;width: 140px;">{{$c->course_name}}</td>
                          <td>
                            <?php
                            $Mon = DB::table('lesson_sessions')->where('day','=','Mon')->where('course_id','=',$c->id)->get();
                            $count1 = DB::table('lesson_sessions')->where('day','=','Mon')->where('course_id','=',$c->id)->count();
                            if ($count1 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Mon';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            
                            @foreach($Mon as $mon)   
                            <div class="checkbox">                        
                             <input type="checkbox" id="{{$c->id . $mon->session}}1" name="Sec{{$mon->session}}[]" value="{{$mon->day}}" @if($mon->status == 1) checked @endif /> 
                              <label for="{{$c->id . $mon->session}}1"></label>                           
                            @if($mon->session == 'A') 11am – 1pm 
                            @elseif($mon->session == 'B') 2pm – 4pm
                            @elseif($mon->session == 'C') 7pm – 9pm
                            @elseif($mon->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                            @endforeach

                            
                          </td>

                          <td>
                          <?php
                            $Tue = DB::table('lesson_sessions')->where('day','=','Tue')->where('course_id','=',$c->id)->get();
                            $count2 = DB::table('lesson_sessions')->where('day','=','Tue')->where('course_id','=',$c->id)->count();
                            if ($count2 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Tue';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Tue as $tue)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $tue->session}}2" name="Sec{{$tue->session}}[]" value="{{$tue->day}}" @if($tue->status == 1) checked @endif /> 
                            <label for="{{$c->id . $tue->session}}2"></label>
                            @if($tue->session == 'A') 11am – 1pm 
                            @elseif($tue->session == 'B') 2pm – 4pm
                            @elseif($tue->session == 'C') 7pm – 9pm
                            @elseif($tue->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>
                          <?php
                            $Wed = DB::table('lesson_sessions')->where('day','=','Wed')->where('course_id','=',$c->id)->get();
                            $count3 = DB::table('lesson_sessions')->where('day','=','Wed')->where('course_id','=',$c->id)->count();
                            if ($count3 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Wed';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Wed as $wed)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $wed->session}}3" name="Sec{{$wed->session}}[]" value="{{$wed->day}}" @if($wed->status == 1) checked @endif /> 
                            <label for="{{$c->id . $wed->session}}3"></label>
                            @if($wed->session == 'A') 11am – 1pm 
                            @elseif($wed->session == 'B') 2pm – 4pm
                            @elseif($wed->session == 'C') 7pm – 9pm
                            @elseif($wed->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>
                          <?php
                            $Thur = DB::table('lesson_sessions')->where('day','=','Thur')->where('course_id','=',$c->id)->get();
                            $count4 = DB::table('lesson_sessions')->where('day','=','Thur')->where('course_id','=',$c->id)->count();
                            if ($count4 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Thur';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Thur as $thur)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $thur->session}}4" name="Sec{{$thur->session}}[]" value="{{$thur->day}}" @if($thur->status == 1) checked @endif /> 
                            <label for="{{$c->id . $thur->session}}4"></label>
                            @if($thur->session == 'A') 11am – 1pm 
                            @elseif($thur->session == 'B') 2pm – 4pm
                            @elseif($thur->session == 'C') 7pm – 9pm
                            @elseif($thur->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>
                          <?php
                            $Fri = DB::table('lesson_sessions')->where('day','=','Fri')->where('course_id','=',$c->id)->get();
                            $count5 = DB::table('lesson_sessions')->where('day','=','Fri')->where('course_id','=',$c->id)->count();
                            if ($count5 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Fri';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Fri as $fri)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $fri->session}}5" name="Sec{{$fri->session}}[]" value="{{$fri->day}}" @if($fri->status == 1) checked @endif /> 
                            <label for="{{$c->id . $fri->session}}5"></label>
                            @if($fri->session == 'A') 11am – 1pm 
                            @elseif($fri->session == 'B') 2pm – 4pm
                            @elseif($fri->session == 'C') 7pm – 9pm
                            @elseif($fri->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>
                          <?php
                            $Sat = DB::table('lesson_sessions')->where('day','=','Sat')->where('course_id','=',$c->id)->get();
                            $count6 = DB::table('lesson_sessions')->where('day','=','Sat')->where('course_id','=',$c->id)->count();
                            if ($count6 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Sat';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Sat as $sat)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $sat->session}}6" name="Sec{{$sat->session}}[]" value="{{$sat->day}}" @if($sat->status == 1) checked @endif /> 
                            <label for="{{$c->id . $sat->session}}6"></label>
                            @if($sat->session == 'A') 11am – 1pm 
                            @elseif($sat->session == 'B') 2pm – 4pm
                            @elseif($sat->session == 'C') 7pm – 9pm
                            @elseif($sat->session == 'D') 10am - 12pm
                            @endif
                            <br />
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>
                          <?php
                            $Sun = DB::table('lesson_sessions')->where('day','=','Sun')->where('course_id','=',$c->id)->get();
                            $count7 = DB::table('lesson_sessions')->where('day','=','Sun')->where('course_id','=',$c->id)->count();
                            if ($count7 == 0) {                             
                                $class_arr = array('A','B','C','D');
                                for($i=0;$i<count($class_arr);$i++){
                                  $SessionsEntry = new SessionsEntry;
                                  $SessionsEntry->day = 'Sun';
                                  $SessionsEntry->session = $class_arr[$i];                                  
                                  $SessionsEntry->course_id = $c->id;
                                  $SessionsEntry->save();
                                }
                            }
                            ?>
                            @foreach($Sun as $sun)
                            <div class="checkbox">
                            <input type="checkbox" id="{{$c->id . $sun->session}}7" name="Sec{{$sun->session}}[]" value="{{$sun->day}}" @if($sun->status == 1) checked @endif /> 
                            <label for="{{$c->id . $sun->session}}7"></label>
                            @if($sun->session == 'A') 11am – 1pm 
                            @elseif($sun->session == 'B') 2pm – 4pm
                            @elseif($sun->session == 'C') 7pm – 9pm
                            @elseif($sun->session == 'D') 10am - 12pm
                            @endif
                            <br /> 
                            </div><!-- .checkbox -->
                          @endforeach
                          </td>

                          <td>                          
                          {{ Form::hidden('course_id',$c->id) }}
                              <!--  <button type="submit" class="btn btn-blue">Update</button>  -->
                              <input type="submit" name="submit" class="btn btn-primary" value="Update">                         
                          </td>

                          {{ Form::close() }}

                       </tr>
                    @endforeach
                       
                   </tbody>
            </table>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->
</div>

@stop

@section ('scripts')
{{ HTML::script('assets/plugins/select2/select2.min.js') }}
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js') }}
{{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}

<script>
    jQuery('#sample_1').DataTable( {
        responsive: true
    } );
var no = 0;
$(".formdel").submit(function(ev) {
  if (no == 0)
  {
    var id = $(this).attr('id');
    Boxy.confirm("Are you sure?", function() { no = 1; $("#"+id).submit(); }, {title: 'Confirm'});
    return false;
  }
});

$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
}); 

</script>
@stop