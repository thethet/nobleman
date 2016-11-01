@extends('layouts.main')

@section('styles')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    {{ HTML::style("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css") }}
    {{ HTML::style("assets/plugins/select2/select2.css") }}
    {{ HTML::style("assets/plugins/datepicker/css/datepicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css") }}
    {{ HTML::style("assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css") }}
    {{ HTML::style("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.css") }}
@stop

@section('content')
    <div class="col-md-12">
        <!-- start: DYNAMIC TABLE PANEL -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h3 class="panel-title">Announcement <span class="text-bold">List</span><!-- <a class="btn-s btn-primary" href="{{ URL::to('announcement/create') }}"><i class="fa fa-plus white"></i></a> --></h3>
            </div>
            <div class="panel-body">
                <!--<div class="form-group">
                    <label class="col-sm-1 control-label" for="form-field-13">
                        Date
                    </label>
                    <div class="col-sm-2">
                        <input type="text" name="date" placeholder="     Click here to pick a date" id="datepicker1" class="form-control input-sm">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="col-sm-1 control-label" for="form-field-13">
                        Session :
                    </label>
                    <div class="col-sm-2">
                        <select class="col-sm-4" name="hour">
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </div><input type="submit" class="btn btn-primary" value="Search">
                </div> -->
                <table class="display" id="sample_1">
                    <thead>
                    <tr>
                        <th>Announcement Title</th>
                        <th>Announcement Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0 ?>
                    @foreach($announcement as $key=> $announcements)
                        <tr>
                            {{ Form::open(array('url'=>'announcement','method'=>'post','id'=>$announcements -> id)) }}
                            <td>{{$announcements->announcement_title}}</td>
                            <td>{{$announcements->announcement_date}}</td>
                            <td>
                                {{ Form::open(array('url'=>'announcement','class'=>'formdel','id'=> $announcements -> id)) }}
                                <button type="button" class="btn btn-default btn-lg" id="myBtn{{$i}}">View</button>
                            </td>
                            {{ form::close()}}
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
                                  <h4 style="color:black;"> {{$announcements->announcement_title}}</h4>
                                </div>
                                <div class="modal-body">
                                  <h5>{{$announcements->announcement_date}}</h5>
                                  <h5>{{$announcements->announcement_content}}</h5>
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
    {{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/autosize/jquery.autosize.min.js") }}
    {{ HTML::script("assets/plugins/select2/select2.min.js") }}
    {{ HTML::script("assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js") }}
    {{ HTML::script("assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js") }}
    {{ HTML::script("assets/plugins/jquery-maskmoney/jquery.maskMoney.js") }}
    {{ HTML::script("assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpicker/js/commits.js") }}
    {{ HTML::script("assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js") }}
    {{ HTML::script("assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") }}
    {{ HTML::script("assets/plugins/jQuery-Tags-Input/jquery.tagsinput.js") }}
    {{ HTML::script("assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js") }}
    {{ HTML::script("assets/plugins/ckeditor/ckeditor.js") }}
    {{ HTML::script("assets/plugins/ckeditor/adapters/jquery.js") }}
    {{ HTML::script("assets/js/form-elements.js") }}


    <script>

        $(document).ready(function(){
            $('#sample_1').dataTable()
        });
        $("#education").change(function(){
            if ($("#education").val() == "Other")
            {
                $("#otherinput").show();
            }
        });
        jQuery("#edit").click(function(){
            $("#edit").hide();
            $("#save").show();
            $("body input").prop("disabled", false);
            $("body textarea").prop("disabled", false);
            $("body select").prop("disabled", false);
        });
    </script>
@stop
