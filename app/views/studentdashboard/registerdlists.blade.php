@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Registerd Courses <span class="text-bold">List</span> 

            </h3>

            <div style="float:right;"><label style="margin-right:10px;font-size:13px;">Add More Course</label><a class="btn-s btn-primary" href="{{ URL::to('addmorecourse') }}"><i class="fa fa-plus white"></i></a></div>
          
        </div>
        <div class="panel-body">
            <table class="display" id="sample_1">
                <thead>
                    <tr>                        
                        <th>Course Name </th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
				@foreach ($reglists as $key => $value)
                    <tr>                        	
                        <td>{{CoursesEntry::where('id','=',$value -> course_id)->pluck('course_name');}}</td>
                        <td>{{$value -> date_of_registration}}</td>
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