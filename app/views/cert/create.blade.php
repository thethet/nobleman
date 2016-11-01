@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css")}}
@stop

@section('content')
{{ Form::open(array('url'=>'cert/create','method'=>'post','role'=>'form','class'=>'form-horizontal')) }}
<div class="col-sm-12">
    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif
    <!-- start: TEXT FIELDS PANEL -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h4 class="panel-title">New Certificate Template<span class="text-bold"></span></h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Certification Name
                </label>
                <div class="col-sm-9">
                    <input type="text" name="certname" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>         
           
            <div class="form-group">
                <label class="col-sm-2 control-label" for="form-field-13">
                    Certification Code
                </label>

                <div class="col-sm-9">
                    <input type="text" name="certid" placeholder="" id="form-field-13" class="form-control input-sm">
                </div>
            </div>  
        
        </div>
    <!-- end: TEXT FIELDS PANEL -->
 </div>

 
</div>
<div class="col-sm-12">

<div class="panel panel-white">
    <div class="panel-body right padding">
        <input type="submit" class="btn btn-primary" value="Create">
        <a href="{{ URL::to('/cert/certificates') }}"><input type="button" class="btn btn-warning" value="Back"></a>
    </div>
</div>
</div>
{{ Form::close() }}
@stop

@section ('scripts')
    {{ HTML::script('assets/plugins/select2/select2.min.js') }}
    {{ HTML::script('assets/js/table-data.js') }}
    {{ HTML::script('http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js') }}
    {{ HTML::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}

    <script>
        jQuery(document).ready(function() {
            TableData.init();

            var date = new Date();
            date.setDate(date.getDate()+1);
            $('#date').datepicker({
                format: "yyyy-mm-dd",
                //daysOfWeekDisabled: "0,1",
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
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });

    </script>
@stop