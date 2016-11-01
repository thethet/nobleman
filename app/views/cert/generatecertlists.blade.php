@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Generate Certificates <span class="text-bold">List</span> &nbsp; <a href="{{ URL::to('cert/generatecert') }}"><input class="btn btn-info" value="Generate New" type="button"></a>
                    <div class="mig-wrap" style="float:right;padding-right:30px;">
                        <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('cert/generatecertlists/export') }}">Export</a>
                    </div>
                </h3>       


            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Student Name</th>
                        <th>Certificate No.</th>
                        <th>Course</th>
                        <th>Issue Date</th>
                        <th>Receive Certification</th>
                        <th>Receive Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    @foreach($generatecert as $key => $c)
                        <tr>
                                <td>{{$no}}</td>
                                <td>{{ DB::table('cert') 
                                                ->leftJoin('students', 'cert.stdname', '=', 'students.id')
                                                ->where('cert.stdname','=',$c->stdname)
                                                ->pluck('name')}}</td>
                                <td>{{ DB::table('cert') 
                                                ->leftJoin('certid', 'cert.certid', '=', 'certid.id')
                                                ->where('cert.certid','=',$c->certid)
                                                ->pluck('serial')}}</td>
                                <td>{{ DB::table('cert') 
                                                ->leftJoin('courses', 'cert.course', '=', 'courses.id')
                                                ->where('cert.course','=',$c->course)
                                                ->pluck('course_name')}}</td>

                                <td>{{ $c->date }}</td>
                                <td>{{ $c->received_certificate == 0 ? 'no' : 'yes'}}</td>
                                <td>{{ $c->received_date }}</td>
                                <td>
                                    <a class="btn btn-warning" style="float:left;margin-right:3px;" href="{{ URL::to('cert/generatecertlists/download/'.$c->id) }}"><i class="fa fa-download"></i></a>
                                    {{ Form::open(array('url'=>'cert/generatecertlists','class'=>'formdel','id'=> $c -> id)) }}                                    
                                    {{ Form::hidden('id',$c->id) }}
                                        <button type="submit" class="btn btn-red"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}

                                    {{ Form::open(array('url'=>"cert/certificate-receive-status/$c->id",'method' => 'PATCH','class'=>'formdel','id'=> $c -> id)) }}                                    
                                        <button type="submit" class="btn btn-blue" style="margin-top: 5px;">receive status</button>
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
        <div class="panel panel-white">
            <!-- <div class="panel-body right padding">
                <a href="{{ URL::to('appointment/book') }}"><input type="button" class="btn btn-primary" value="Book A New Appointment"></a>
                <a href="{{ URL::to('appointment') }}"><input type="button" class="btn btn-warning" value="Back"></a>
            </div> -->
        </div>
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
        $(".btn-red").click(function(ev) {
            var that = this;
            if (no == 0)
            {
                var id = $(this).attr('id');
                Boxy.confirm("Are you sure?", function() { no = 1; $(that).click(); }, {title: 'Confirm'});
                return false;
            }
        });

    </script>
@stop