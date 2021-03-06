@extends('layouts.registration')

@section('head')
    Register as Employer (Company)
@stop

@section('head-contents')
    <style type="text/css">
        span#confirmpassId2 {
            top: -60px;
            left: 125px;
            content: "\2713";
            color: green;
        }
    </style>
    <script>
        function enableSubmit(){
            var val = document.getElementById('TOS');
            var sbmt = document.getElementById("submitForm");
            
            if (val.checked){
                sbmt.disabled = false;
            }
            else{
                sbmt.disabled = true;
            }
        }

        function passConfirm(){
            if(document.getElementById('passwordInput').value != '' && document.getElementById('passwordInput').value == document.getElementById('confirmpassId').value){
                document.getElementById('confirmedPass').className = 'form-group has-success has-feedback';
                document.getElementById('confirmpassId2').style.display = 'block';
                document.getElementById('tooltipPass').style.display = 'none';
            }else{
                document.getElementById('confirmedPass').className = 'form-group has-error has-feedback';
                document.getElementById('confirmpassId2').style.display = 'none';
                document.getElementById('tooltipPass').style.display = 'inline';
            }
        }

        function validateNumberOnly(){
            value = document.getElementById('businessNum').value;
            if(value.match(/[^0-9]/i))
                document.getElementById('businessNum').value = value.replace(/[^0-9]/g, '');

        }
/*
        function validateInput(this){
            if(this.value != ''){
                this.className .= ' has-success has-feedback';
            }else{
                this.className .= ' has-error has-feedback';
            }
        }
*/
        $(document).ready(function(){
            enableSubmit();
            $('#reset').click(function(event){
                document.getElementById('submitForm').disabled = true;
            });
            // validate password
            $("#confirmpassId").keyup(passConfirm);
            // prevent alpha input on businessNum
            $("#businessNum").keyup(validateNumberOnly);
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop

@section('content')
<section>
<div class="container">
    <div class="taskminator-form">
        <h3 style="text-align:center; color: #f9f9f9;">Employer Registration (Company)</h3>
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-container fluid-height clearfix" style="border-radius:8pt; background-color: rgba(255,255,255,.9);">
                    <div class="heading" style="padding: 40px 60px; border-top-left-radius:8pt; border-top-right-radius:8pt; font-size: 16pt;">
                        Company Information
                    </div>
                    <div class="widget-content padded" style="padding: 10px 60px 40px 60px;">
                        <div class="client-form-comp">
                            @if(Session::has('errorMsg'))
                                <font color="red"style="padding: 10px; border-radius: 4px; background: #f2f2f2;">{{ Session::get('errorMsg') }}</font><br><br>
                            @endif

                            @if( $vMsg != '')
                                <font color="green" style="padding: 10px; border-radius: 4px; background: #f2f2f2;">{{ $vMsg }}</font><br><br>
                            @else
                            @endif
                            {{ Form::open(array('url' => '/doRegisterComp', 'id' => 'registrationForm-comp')) }}
                                <div class="form-group">
                                    <label class="control-label">
                                        Company Name <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your company name"></a>
                                    </label>
                                    @if( $compName != "")
                                        {{ Form::text('companyName', $compName, array('data-name' => 'Company Name', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter company name', 'required' => 'true')) }}
                                    @else
                                        {{ Form::text('companyName', Input::old('companyName'), array('data-name' => 'Company Name', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter company name', 'required' => 'true')) }}
                                    @endif
                                </div><br/>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">
                                            Nature of Business <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your nature of business"></a>
                                        </label>
                                        {{ Form::text('businessNature', Input::old('businessNature'), array('data-name' => 'Business Nature', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter nature of business', 'required' => 'true')) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" style="margin-left: 2px;">
                                            Years in Operation <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please select your years in operation"></a>
                                        </label>
                                        {{ Form::select('experience', array('0-1 years' => '0-1 years', '2-3 years' => '2-3 years', '3-5 years' => '3-5 years', '5-10 years' => '5-10 years', 'more than 10 years' => 'more than 10 years'), Input::old('experience'), array('data-name' => 'Years in Operation', 'class' => 'inputItem form-control', 'required' => 'true', 'style' => 'max-width: 200px;')) }}
                                    </div>
                                </div><br/>

                                <div class="form-group">
                                    <label class="control-label">
                                        Business Description <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your business description"></a>
                                    </label>
                                    {{ Form::text('businessDescription', Input::old('businessDescription'), array('data-name' => 'Business Description', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter business description', 'required' => 'true')) }}
                                </div><br/>
                                
                                <div class="form-group">
                                    <label class="control-label">
                                        Business Address <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your business address"></a>
                                    </label>
                                    {{ Form::text('address', Input::old('address'), array('data-name' => 'Business Address', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter business address', 'required' => 'true')) }}
                                </div><br/>

                                <div class="form-group">
                                    <label class="control-label">
                                        Business Number <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your business number"></a>
                                    </label>
                                    {{ Form::text('businessNum', Input::old('businessNum'), array('data-name' => 'Business Number', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter business number', 'required' => 'true', 'id' => 'businessNum', 'style' => 'max-width: 500px;')) }}
                                </div><br><br>

                                <div class="form-group">
                                    <label class="control-label row" style="margin-left: 2px;">
                                        Key Contact Person <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input the full name of your Key Contact Person"></a>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-4" style="margin-bottom: 2px;">
                                        @if( $firstName != "" )
                                            {{ Form::text('firstName-keyperson', $firstName, array('data-name' => 'First Name', 'class' => 'inputItem form-control', 'placeholder' => 'First name', 'required' => 'true')) }}
                                        @else
                                            {{ Form::text('firstName-keyperson', Input::old('firstName-keyperson'), array('data-name' => 'First Name', 'class' => 'inputItem form-control', 'placeholder' => 'First name', 'required' => 'true')) }}
                                        @endif
                                        </div>
                                        <div class="col-md-3" style="margin-bottom: 2px;">
                                            {{ Form::text('midName-keyperson', Input::old('midName-keyperson'), array('data-name' => 'Middle Name', 'class' => 'inputItem form-control', 'placeholder' => 'Middle name', 'required' => 'true')) }}
                                        </div>
                                        <div class="col-md-5">
                                        @if( $lastName != "")
                                            {{ Form::text('lastName-keyperson', $lastName, array('data-name' => 'Last Name', 'class' => 'inputItem form-control', 'placeholder' => 'Last name', 'required' => 'true')) }}
                                        @else
                                            {{ Form::text('lastName-keyperson', Input::old('lastName-keyperson'), array('data-name' => 'Last Name', 'class' => 'inputItem form-control', 'placeholder' => 'Last name', 'required' => 'true')) }}
                                        @endif
                                        </div>
                                    </div>
                                </div><br/>

                                <div class="form-group">
                                    <label class="control-label">
                                        Position <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input the position of your Key Contact Person"></a>
                                    </label>
                                    {{ Form::text('position-keyperson', Input::old('position-keyperson'), array('data-name' => 'Point Person Position', 'class' => 'form-control inputItem', 'placeholder' => 'Please enter position', 'required' => 'true', 'style' => 'max-width: 500px;')) }}
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label">
                                        SEC / DTI Registration Number <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your SEC or Registration Number"></a>
                                    </label>
                                    {{ Form::text('regNum', Input::old('regNum'), array('data-name' => 'Registration Number', 'class' => 'form-control inputItem', 'placeholder' => 'Please enter registration number', 'required' => 'true', 'style' => 'max-width: 400px;')) }}
                                </div><br>

                                <div class="form-group">
                                    <label class="control-label">
                                        Email <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your working email address"></a>
                                    </label>
                                    @if( $txtEmail != "")
                                        {{ Form::text('email', $txtEmail, array('data-name' => 'Email Address', 'class' => 'form-control inputItem', 'placeholder' => 'Email address', 'required' => 'true', 'id' => 'email', 'style' => 'max-width: 400px;')) }}
                                    @else
                                        {{ Form::text('email', Input::old('email'), array('data-name' => 'Email Address', 'class' => 'form-control inputItem', 'placeholder' => 'Email address', 'required' => 'true', 'id' => 'email', 'style' => 'max-width: 400px;')) }}
                                    @endif
                                </div><br>

                                <hr/>
                                
                                <div class="form-group">
                                    <label class="control-label">
                                        Username <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your username"></a>
                                    </label>
                                    @if( $username != "")
                                        {{ Form::text('username', $username, array('data-name' => 'Username', 'class' => 'inputItem form-control', 'placeholder' => 'Username', 'required' => 'true', 'style' => 'max-width: 400px;')) }}
                                    @else
                                        {{ Form::text('username', Input::old('username'), array('data-name' => 'Username', 'class' => 'inputItem form-control', 'placeholder' => 'Username', 'required' => 'true', 'style' => 'max-width: 400px;')) }}
                                    @endif
                                </div><br/>
                                
                                <div class="form-group">
                                    <label class="control-label">
                                        Password <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please input your password"></a>
                                        <h6>(minimum of 8 characters)</h6>
                                    </label>
                                    @if( $primary_pass != "")
                                        {{ Form::input('password','password', $primary_pass, array('data-name' => 'Password', 'data-display' => 'strengthDisplay', 'id' => 'passwordInput', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter password', 'required' => 'true', 'style' => 'max-width: 400px;')) }}
                                    @else
                                        {{ Form::password('password', array('data-name' => 'Password', 'data-display' => 'strengthDisplay', 'id' => 'passwordInput', 'class' => 'inputItem form-control', 'placeholder' => 'Please enter password', 'required' => 'true', 'style' => 'max-width: 400px;')) }}
                                    @endif
                                    <h5 id="strengthDisplay"></h5>
                                </div><br/>

                                <div class="form-group" id="confirmedPass">
                                    <label class="control-label" for="confirmpassId">
                                        Confirm Password <a href="#" class="icon-question-sign" data-toggle="tooltip" title="Please re-input your password to confirm" id="tooltipPass"></a>
                                    </label>
                                    @if( $cPass != "")
                                        {{ Form::input('password','confirmpass', $cPass, array('data-name' => 'Confirm Password', 'id' => 'confirmpassId', 'class' => 'inputItem form-control', 'placeholder' => 'Re-type password', 'style' => 'max-width: 400px;', 'required' => 'true')) }}
                                    @else
                                        {{ Form::password('confirmpass', array('data-name' => 'Confirm Password', 'id' => 'confirmpassId', 'class' => 'inputItem form-control', 'placeholder' => 'Re-type password', 'style' => 'max-width: 400px;', 'required' => 'true')) }}
                                    @endif
                                    <span class="glyphicon glyphicon-ok form-control-feedback" style="display: none;" id="confirmpassId2"></span>
                                </div><br/>

                                <p>
                                    {{ HTML::image(URL::to('simplecaptcha'),'Captcha', array('class' => 'img-rounded')) }}<br><br>
                                    <label>CAPTCHA</label>
                                    {{ Form::text('captcha', '', array('data-name' => 'Captcha', 'class' => 'inputItem form-control', 'id' => 'captcha','placeholder' => 'Type code above', 'required' => 'true', 'style' => 'width: 130px;')) }}
                                </p>

                                <div class="row form-group" style="margin-left: 5px;">
                                    <input id="TOS" name="TOS" type="checkbox" value="1" onclick="enableSubmit()" style="display: -moz-box;">
                                    <label class="control-label" style="margin-left: 5px;">Accept Terms of Service and Privacy Policy</label>
                                </div>
                            
                                <button class="btn btn-primary" type="submit" id="submitForm" disabled>Register</button>
                                {{ Form::reset('Reset', array('class' => 'btn btn-default', 'id' => 'reset')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="text-center" style="color:#f9f9f9">
<br>
    2016 Proveek Incorporated<br>
     rights reserved.
</div>All
</div>
</section>
<!--div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Email</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 0;">
                    <span id="confirmMsg">Please confirm your email information before proceeding (This email will recieve necessary updates and notifications)</span>
                    <p id="emailConfirm" style="font-size: 1.5em; margin-top: 2em;"></p>
                </div>
            </div>
            <div class="modal-footer" style="margin: 0; padding: 0.8em;">
                <button data-dismiss="modal" class="btn btn-danger">Cancel</button>
                <button onclick="$('#registrationForm-comp').submit()" class="btn btn-primary" id="confirmBtn">Confirm</button>
            </div>
        </div>
    </div>
</div-- >
@stop