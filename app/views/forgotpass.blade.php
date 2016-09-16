<html>
    <head>
        <title>Proveek Beta - Registration</title>
        {{ HTML::style('frontend/css/bootstrap.min.css') }}
        {{ HTML::style('frontend/css/custom.css') }}
        {{ HTML::script('frontend/js/jquery.js') }}
        {{ HTML::script('frontend/js/bootstrap.min.js') }}
        {{ HTML::style('frontend/font-awesome/css/font-awesome.min.css') }}
        <style>
            body {
                background-color: #E9EAED;
                font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            }
        </style>
        <script>
            $(document).ready(function(){
                $('#EMPLOYER_REG_FORM').submit(function(e){
                    $('#SUBMITBUTTON').prop('disabled', true).hide();
                    $('#FAUXSUBMITBUTTON').show();
                    e.preventDefault();
                    $.ajax({
                        type    :   'POST',
                        url     :   '/CHKRGWRKR',
                        data    :   $(this).serialize(),
                        success :   function(data){
                            if(data.length == 0){
                                $('#EMPLOYER_REG_FORM').unbind().submit();
                            }else{
                                $('#MODAL_LIST_ERRORS').empty();
                                $.each(data, function(key, value){
                                    $('#MODAL_LIST_ERRORS').append('<b>'+value+'</b><br/>');
                                });
                                $('#MODAL_ERROR').modal().show();
                                $('#FAUXSUBMITBUTTON').hide();
                                $('#SUBMITBUTTON').prop('disabled', false).show();
                            }
                        }
                    });
                });
            });
        </script>
    </head>

    <style type="text/css">
    </style>

    <body>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 7em;">
                <div class="widget-container fluid-height padded">

                    <div style="margin:auto; display:table; margin-bottom:20px;">
                        <img style="width:250px;" src="../frontend/img/proveek-logo-300.png">
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="widget-content">
                            <span style="color: red;">{{ @Session::get('errorMsg') }}</span><br/>
                            FORGOT PASSWORD : Type in your new password<br>
                            <br/>
                            <form method="POST" action="/confirmReset">
                                <input class="form-control" type="hidden" value="{{$user->username}}" name="username" />
                                <input class="form-control" type="hidden" value="{{$user->id}}" name="userId" />
                                <input class="form-control" type="password" name="password" placeholder="New password"><br/>
                                <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm new password"><br/>
                                <button class="btn btn-success btn-block btn-lg" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div class="panel-footer">
                    <center><i class="fa fa-copyright"></i> Proveek Beta - 2016</center>
                </div>
            </div>
        </div>

        <div class="modal modal-vcenter fade lato-text" id="MODAL_ERROR" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center" style="padding-bottom:0">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <center><i class="fa fa-warning fa-4x" style="color: #E74C3C"></i></center>
                        <div id="MODAL_LIST_ERRORS" style="text-align: center;">
                            {{--ERRORS GO HERE--}}
                        </div>
                    </div>
                    <div class="modal-footer text-center" style="text-align:center; padding-bottom:20px;">
                    </div>
                </div>
            </div>
        </div>
    </body>

@extends('modals')
@section('modal-content')
@stop
</html>