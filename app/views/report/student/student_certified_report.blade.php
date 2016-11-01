@extends('layouts.main')

@section('styles')
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/css/custom-style.css") }}
@stop

@section('content')
    <div class="col-md-12">    
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">

            <div class="panel-heading">
                <h3 class="panel-title">Student Certified Report

                    <div class="mig-wrap" style="float:right;padding-right:30px;">
                        <a class="btn btn-primary" style="float:left;margin-right:3px;" href="{{ URL::to('reports/certified-students/export') }}">Export</a>
                    </div>

                </h3>            
            </div>

            <div class="panel-body">
                <div id="reportView">
                    <table class="table table-striped table-bordered table-hover table-full-width" id="report">

                        <thead>
                            <tr>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Student Email</th>
                                <th>Contact</th>
                                <th>Nric</th>
                                <th>Certified Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certifiedStudents as $key=> $student)
                                <tr>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->course_name }} </td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->mobile_contact }}</td>
                                    <td>{{ $student->nric }}</td>
                                    <td>{{ $student->certified_date }}</td>
                                </tr>   
                            @endforeach
                        </tbody>

                    </table>
                </div>
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
    <script type="text/javascript">
        jQuery('#report').DataTable( {
            responsive: true,
            "order": [[ 6, "desc" ]],            
        });
    </script>
@stop

