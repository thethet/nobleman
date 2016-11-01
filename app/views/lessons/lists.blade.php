@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Lessons <span class="text-bold">List</span> <a class="btn-s btn-primary" href="{{ URL::to('lessons/create') }}"><i class="fa fa-plus white"></i></a>

            <div class="mig-wrap" style="float:right;padding-right:30px;">
                <a class="btn btn-green" style="float:left;margin-right:3px;" href="#" id="myBtn">Import</a>
                <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('lessons/export') }}">Export</a>
            </div>

            </h3>

            <!-- /* Choosing the file for import to database */ -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 style="color:black;">Choose file to import</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(array('url'=>'lessons/import','method'=>'post','role'=>'form','files'=>'true')) }}
                <div class="form-group">
                  <input type="file" name="importfile" class="form-control input-sm">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-green">Import</button>
                </div>
                {{ Form::close() }}
                </div>
              </div>
            </div>
            </div> 
            <!-- /* End */ -->

        </div>
        <div class="panel-body">
            <table class="display" id="sample_1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lesson Code</th>
                        <th>Lesson Name</th>
                        <th>Lesson Type</th>
                        <th id="coursename">Module Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lesson as $key => $lessons)
                        <tr>
                            <td>{{$lessons->id}}</td>
                            <td>{{$lessons->lesson_code}}</td>
                            <td>{{$lessons->lesson_name}}</td>
                            <td>{{$lessons->lesson_type}}</td>
                            <td>{{$lessons->module_name}}</td>
                            <td>
                                @if ($lessons->status == 1)
                                    <span class="label label-info"> Active</span>
                                @else
                                    <span class="label label-default"> Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-warning" style="float:left;margin-right:3px;" href="{{ URL::to('lessons/download/'.$lessons->id) }}"><i class="fa fa-download"></i></a>
                                {{ Form::open(array('url'=>'lessons','class'=>'formdel','id'=> $lessons -> id)) }}
                                <a class="btn btn-info" href="{{ URL::to('lessons/'.$lessons->id) }}">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                {{ Form::hidden('id',$lessons->id) }}
                                    <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                {{ Form::close() }}
                            </td>
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
{{ HTML::script('assets/js/table-data.js') }}
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