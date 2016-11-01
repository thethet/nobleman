@extends('layouts.main')

@section('styles')
{{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
<div class="col-md-12">
    <!-- start: DYNAMIC TABLE PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h3 class="panel-title">Certificate <span class="text-bold">List</span></h3>
        </div>
        <div class="panel-body">

            <a href="{{ URL::to('/cert/create') }}">Create New Certificate</a><br />

            <a href="{{ URL::to('/cert/cert1') }}" >Certificate 1 </a><br>
            <a href="{{ URL::to('/cert/cert2') }}" >Certificate 2 </a><br>
            <a href="{{ URL::to('/cert/cert3') }}" >Certificate 3 </a><br>
            <a href="{{ URL::to('/cert/cert4') }}" >Certificate 4 </a>
        </div>
    </div>
    <!-- end: DYNAMIC TABLE PANEL -->

</div>

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
