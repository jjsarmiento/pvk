@extends('login')

@section('head')
    Proveek | Choose Account Type
@stop

@section('head-contents')
<script>
    $(document).ready(function(){
        $('.clientTypeTrigger').click(function(){
            $('#userType').hide();
            $('#clientTypes').fadeIn();
        });
    })
</script>
@stop

@section('content')
<div class="account-type-btns" id="userType" style="margin-top: 25%">
    <br/>
    <h3>Select account type</h3>
    <button type="button" class="client-btn btn btn-lg btn-primary btn-block clientTypeTrigger" style="display: none;"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Employer</button>
    <button type="button" class="taskminator-btn btn btn-lg btn-warning btn-block" onclick="location.href='/regTaskminator'"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Worker</button>
</div>

<div class="account-type-btns" id="clientTypes" style="margin-top: 25%; display: none;">
    <br/>
    <h3>Select Employer type</h3>
    <button type="button" class="client-btn btn btn-lg btn-danger btn-block" onclick="location.href='/regClientIndi'"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp;Individual</button>
    <button type="button" class="taskminator-btn btn btn-lg btn-warning btn-block" onclick="location.href='/regClientComp'"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Company</button>
</div>

<!--INDIVIDUAL CLIENT REGISTRATION FORM-->


<!--COMPANY CLIENT REGISTRATION FORM-->
@stop