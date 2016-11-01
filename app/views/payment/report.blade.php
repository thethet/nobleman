@extends('layouts.main')

@section('styles')
{{ HTML::script('assets/js/jquery.min.js') }}
{{ HTML::style("assets/plugins/select2/select2.css") }}
{{ HTML::style("assets/css/custom-style.css") }}
@stop

@section('content')
<div class="col-md-12">
    

    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Payment received for month </h3>            
        </div>
        <div class="panel-body dashboard">

        <div class="form-group ptxt">
            <div class="col-sm-2">
                <h3>Period</h3>
            </div>
            {{ Form::open(array('url'=>'payment/report','method'=>'post')) }}
            <div class="col-sm-2" style="padding:0px;">
                <input type="text" name="p1_date" placeholder="From" id="p1_date" class="form-control input-sm">
            </div>
            <div class="col-sm-2" style="padding:0px;">
                <input type="text" name="p2_date" placeholder="To" id="p2_date" class="form-control input-sm">
            </div>
            <button type="submit" class="btn btn-red" style="float:left;">Report</button>
            {{ Form::close() }}
            <div class="mig-wrap" style="float:left;padding-left:15px;">
                {{ Form::open(array('url'=>'payment/reportexport','method'=>'post','role'=>'form')) }}
                {{ Form::hidden('p1_date',$date1) }}
                {{ Form::hidden('p2_date',$date2) }}
                <button type="submit" class="btn btn-primary" style="float:left;margin-right:3px;">Export</button>
                {{ Form::close() }}
            </div>
            
        </div>

        <div class="form-group ptxt">
            <div class="col-sm-2">
                <h3>Total Revenue</h3>
            </div>
             <div class="col-sm-3">
               {{$total_revenue}} S$
            </div>
        </div>

        <div class="form-group ptxt">
            <div class="col-sm-2">
                <h3>Total Received</h3>
            </div>
             <div class="col-sm-3">
               {{$total_received}} S$
            </div>
        </div>

          <div class="form-group ptxt">
            <div class="col-sm-2">
                <h3>Outstanding</h3>
            </div>
             <div class="col-sm-3">
               {{$outstanding}} S$
            </div>
        </div>

        {{$date1}}
        {{$date2}}
        

        <table class="display" id="sample_2">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Payment Amount</th>
                        <th>Payment Mode</th>
                        <th>Payment Status</th>
                        <th>Payment Confirmation</th>
                        <th>Date of Regstration</th>
                        <th>Payment Note</th>
                        <th>Transaction Code</th>
                        <th>Date of Payment</th>
                    </tr>
                </thead>

                <tbody> 
                <?php $i=0 ?>
                @foreach($students as $key=> $students)                   
                    <tr>
                        <td>{{$students->name}}</td>
                        <td>{{ DB::table('courses')->where('id','=',$students->course_id)->pluck('course_name')}}</td>
                        <td>{{ DB::table('courses')->where('id','=',$students->course_id)->pluck('cost_of_course')}} S$</td>
                        <td>{{$students->payment_mode}}</td>
                        <td>
                        @if($students->sm_payment_status == 0)
                        NO
                        @else
                        YES
                        @endif
                        </td>
                        <td>
                            {{ Form::open(array('url'=>'payment/changestatus/'.$students->id,'method'=>'put','role'=>'form','class'=>'form-horizontal')) }}
                            @if ($students->sm_payment_status == 1)
                                <button type="button" class="label label-info" id="myBtn{{$i}}"> Paid</button>
                            @else
                               <button type="button" class="label label-default" id="myBtn{{$i}}"> Unpaid</button>
                            @endif
                            {{ Form::close() }}
                        </td>
                        <td>{{$students->created_at}}</td>
                        <td>{{$students->payment_note}}</td>
                        <td>{{$students->transaction_code}}</td>
                        <td>
                        @if($students->sm_payment_status == 0)
                        -
                        @else
                        {{$students->date_of_payment}}
                        @endif
                        </td>
                    </tr>
                    <script>
                            $(document).ready(function(){
                                $("#myBtn<?php echo $i ?>").click(function(){
                                    $("#myModal<?php echo $i ?>").modal();
                                });
                            }); 
                        </script>
                        <div class="modal fade" id="myModal{{$i}}" role="dialog">
                            <div class="modal-dialog">

                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 style="color:black;">Payment</h4>
                                </div>
                                <div class="modal-body">
                                {{ Form::open(array('url'=>'payment/changestatus/'.$students->id,'method'=>'put','role'=>'form','class'=>'form-horizontal')) }}
                                    
                                    <div class="row" style="margin-bottom:15px;">
                                        <label class="col-sm-3 control-label" for="form-field-13">
                                            Transaction Code
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="transaction_code" placeholder="" id="form-field-13" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-bottom:15px;">
                                        <label class="col-sm-3 control-label" for="form-field-13">
                                            Payment Note
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="payment_note" placeholder="" id="form-field-13" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 control-label" for="form-field-13">
                                            Date of Payment
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date_of_payment_pc" placeholder="yyyy-mm-dd" id="date_of_payment_pc" class="form-control input-sm">
                                        </div>
                                    </div>

                                    <div class="row" style="text-align:right;padding:15px;">
                                        <input type="submit" class="btn btn-primary" id="save" value="Save">
                                    </div>
                                    <input type="hidden" name="mid" value="{{DB::table('courses')->where('id','=',$students->course_id)->pluck('id')}}">
                                    {{ Form::close() }}
                                </div>
                              </div>
                            </div>
                          </div> 
                          <?php $i++ ?>
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
{{ HTML::script('assets/js/table-data.js') }}
{{ HTML::script('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
{{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js') }}
{{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}


<script>

    jQuery(document).ready(function() {
        $('#sample_1').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );


        $('#sample_2').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );

        $('#sample_3').DataTable( {
            responsive: true,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                );

                                column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                            } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );


    } );



jQuery(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate()+1);
    $('#p1_date').datepicker({
        format: "yyyy-mm-dd",
        // daysOfWeekDisabled: "0,1",
        //startDate: date,
        todayHighlight: true
    });
});

jQuery(document).ready(function() {
    var date = new Date();
    date.setDate(date.getDate()+1);
    $('#p2_date').datepicker({
        format: "yyyy-mm-dd",
        // daysOfWeekDisabled: "0,1",
        //startDate: date,
        todayHighlight: true
    });
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