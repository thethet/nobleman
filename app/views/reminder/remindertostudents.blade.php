@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Reminder To <span class="text-bold">Students</span></h3>

            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                    <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Date</th>
                        <th>Students Count</th>                       
                        <th>Action</th>                      
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointment as $key => $value)
                        <tr>                           
                            <td>{{CoursesEntry::where('id','=',$value->course_id)->pluck('course_name');}}</td>
                            <td>{{$value->date}}</td>
                            <td>{{AppointmentEntry::where('attend','=','N/A')->where('booking_status','=','book')->where('date','=',$next2day)->groupBy('course_id')->count()}}</td>
                            <td>
                               {{ Form::open(array('url'=>'remindertostudents/sendemail','method'=>'post')) }}
                               {{ Form::hidden('mid',$value->course_id) }}
                                @if($value->reminder_email_status == 1)                               
                               <button type="submit" name="attend" class="btn btn-info" value="1" disabled>Already Sent</button>
                               @else
                               <button type="submit" name="attend" class="btn btn-danger" value="1">Send Now</button>
                               @endif
                               {{ Form::close() }} 
                            </td>                  
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- .panel-body -->
        </div><!-- .panel-white -->
       
    </div><!-- /span12 -->

@stop

@section ('scripts')
    {{ HTML::script('assets/plugins/select2/select2.min.js') }}
    {{ HTML::script('assets/js/table-data.js') }}

    <script>
        jQuery(document).ready(function() {
            TableData.init();
        });
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