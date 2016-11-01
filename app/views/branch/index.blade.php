@extends('layouts.main')

@section('styles')

@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">

            <div class="panel-heading">

                <h3 class="panel-title">Branch <span class="text-bold">List</span>
                    <a class="btn-s btn-primary" href="{{ URL::to('branch/create') }}"><i class="fa fa-plus white"></i></a>
                    <div class="mig-wrap" style="float:right;padding-right:30px;">
                        <a class="btn btn-green" style="float:left;margin-right:3px;" href="#" id="myBtn">Branch</a>
                    </div>
                </h3>

                <div class="panel-tools">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
                            <li>
                                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
                            </li>
                            <li>
                                <a class="panel-expand" href="#">
                                    <i class="fa fa-expand"></i> <span>Fullscreen</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                @if(Session::has('status'))
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('status') }}
                </div>
                @endIf
                <table class="display" id="sample_1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Branch Code</th>
                            <th>Branch Name</th>
                            <th>Branch Information</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    				@foreach ($branches as $key => $branch)
                        <tr>
                            	<td>{{ $branch->id }}</td>
                                <td>{{ $branch->code }}</td>
                            	<td>{{ $branch->name }}</td>
                                <td>
                                    {{ $branch->information }}
                                </td>
                                <td>
                                    <a href='{{ url("branch/$branch->id/edit") }}' class="btn btn-info" style="float:left;margin-right:3px;"><i class="fa fa-edit"></i></a>
                                    {{ Form::open(array('url'=>'branch/'.$branch->id,'method'=>'DELETE')) }}
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
    {{ HTML::script('http://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js') }}
    {{ HTML::style('http://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css') }}
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sample_1').dataTable()
        });
    </script>
@stop
