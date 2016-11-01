@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Template <span class="text-bold">List</span>  &nbsp; <a href="{{ URL::to('cert/create') }}"><input class="btn btn-info" value="Add New" type="button"></a></h3>



            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Certificate Name</th>
                        <th>Certificate Code</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    @foreach($certificate as $key => $c)
                        <tr>
                                <td>{{$no}}</td>
                                <td>{{$c->name}}</td>
                                <td>{{$c->serial}}</td>
                                <td>{{$c->created_by}}</td>
                                <td>
                                    {{ Form::open(array('url'=>'cert/certificates','class'=>'formdel','id'=> $c -> id)) }}
                                    <a class="btn btn-info" href="{{ URL::to('cert/certificates/'.$c->id) }}">
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    {{ Form::hidden('id',$c->id) }}
                                        <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                </td>
                        </tr>
                        <?php $no++; ?>
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