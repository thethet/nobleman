@extends('layouts.main')


@section('content')
    {{ Form::open(array('url'=>'branch/'.$branch->id,'method'=>'PATCH','role'=>'form','class'=>'form-horizontal')) }}
        <div class="col-sm-6">
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
                    <h4 class="panel-title">Primary <span class="text-bold">Information</span></h4>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Branch Name
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="form-field-13" class="form-control input-sm" value="{{ $branch->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-13">
                            Branch Information
                        </label>
                        <div class="col-sm-9">
                            <textarea name="information" class="form-control">{{ $branch->information }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end: TEXT FIELDS PANEL -->
        </div>

        <div class="col-sm-12">
            <div class="panel panel-white">
                <div class="panel-body right padding">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <a href="{{ URL::to('branch') }}"><input type="button" class="btn btn-warning" value="Back"></a>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@stop

@section ('scripts')

    <script>
        jQuery(document).ready(function() {
            Main.init();
            SVExamples.init();
            FormElements.init();
        });
    </script>
@stop
