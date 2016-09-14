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
            <div class="col-md-8 col-md-offset-2" style="margin-top: 7em;">
                <div class="widget-container fluid-height padded">

                    <div style="margin:auto; display:table; margin-bottom:20px;">
                        <img style="width:250px;" src="../frontend/img/proveek-logo-300.png">
                    </div>

                    <div class="widget-content">
                        <form method="POST" action="/regEmployer" id="EMPLOYER_REG_FORM">
                            <input type="hidden" name="PRE_RELEASE_FLAG" value="1" />
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" required="required" class="form-control" name="compName" placeholder="Night's Watch" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" required="required" class="form-control" name="fName" placeholder="Jon" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" required="required" class="form-control" name="lName" placeholder="Snow" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" required="required" class="form-control" name="uName" placeholder="Night's Watch" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" required="required" class="form-control" name="txtEmail" placeholder="Night's Watch" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" required="required" class="form-control" name="primary_pass" placeholder="Night's Watch" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" required="required" class="form-control" name="cPass" placeholder="Night's Watch" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" required="required" class="form-control" name="mobileNum" placeholder="09xxxxxxxxx" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p style="text-align: justify;">
                                    <i class="fa fa-info-circle" style="color: #3498DB;"></i>
                                    By clicking Sign Up, I confirm that I have read and understand this agreemant, and I accept and agree to all of its <a href="#" data-target="#TERMSMODAL" data-toggle="modal">Terms</a> and <a href="#" data-target="#PRIPOLMODAL" data-toggle="modal">Privacy Policy</a>. I enter into this agreement voluntarily, with full knowledge of its effect.
                                    </p>
                                    <button id="SUBMITBUTTON" class="btn btn-success btn-block btn-lg" type="submit">Sign Up</button>
                                    <button id="FAUXSUBMITBUTTON" class="btn btn-success btn-lg btn-block" style="display: none;" disabled><i class="fa fa-circle-o-notch fa-spin"></i> Please Wait</button>
                                </div>
                            </div>
                        </form>
                    </div>
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