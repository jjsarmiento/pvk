@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: auto;
            min-height: 100%;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container, div#PANELBODY{
            background-color: rgba(245,245,245,0.3) !important;
        }
        div#PANELBODY {
            color:white;
        }
        .breadcrumb, .panel-heading, .panel-footer{
            background-color: rgba(245,245,245,0.7) !important;
        }
        .breadcrumb>li{
            color: white !important;
        }
        a.sidemenu {
            color: white;
        }
        a.sidemenu:hover {
            transition: 0.3s;
            color: #d9d9d9;
            text-decoration: none;
        }
        /*-----------------*/
        .accordion-toggle
        {
            text-decoration: none !important; 
        }

        .chat {
            width: 400px;
        }

        .bubble {
            padding: 1em;
            border-bottom: solid 1px #ecf0f1;
        }

        .bubble-user{
            text-align: right;
            border-bottom: solid 1px #ecf0f1;
            padding: 1em;
        }

        .timestamp {
            font-size: 0.7em;
            color: #2980b9;
            font-weight: bold;
        }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#ADMIN_sendMsgContent').keyup(function(){
                if($(this).val().length < 1 || $('#PANELHEAD').text().length < 1){
                    $('#ADMIN_sendMsgBtn').attr('disabled', true);
                }else{
                    $('#ADMIN_sendMsgBtn').attr('disabled', false);
                }
            });

            $('#ADMIN_sendMsgBtn').click(function(){
                $('#ADMIN_sendMsgContent').attr('readonly', true);
                $.ajax({
                    type    :   'POST',
                    url     :   $('#ADMINCHATFORM').attr('action'),
                    data    :   $('#ADMINCHATFORM').serialize(),
                    success :   function(data){
                        var msg = '<div class="bubble-user">'+data['msg']+'<br/><span class="timestamp">'+data['tstamp']+'</span></div>';
                        $('#PANELBODY').append(msg);
                        $('#PANELBODY').scrollTop($('#PANELBODY').height());
                    }
                })
                $('#ADMIN_sendMsgContent').val('').attr('readonly', false);
                $('#ADMIN_sendMsgBtn').attr('disabled', true);
            });
        
            function REFRESHEVENTHANDLER(){
                $('.DIVCHAT').click(function(){
                    $('#PANELBODY').empty();
                    var username = $(this).find('.USERNAME').text(),
                        fullname = $(this).find('.FULLNAME').text(),
                        userid = $(this).data('userid');

                    $('#USERID').val(userid);

                    $('#PANELHEAD').empty().append('Chat with '+fullname);
                    $.ajax({
                        type    :   'GET',
                        url     :   '/getCHAT='+userid,
                        data    :   $('#chatSearchForm').serialize(),
                        success :   function(data){
                            if(data == 'NOCHATHISTORY'){
                                $('#PANELBODY').empty().append('<div style="padding: 0.4em; font-size: 1.5em; text-align: center; background-color: #2980b9; color: #ffffff;">SEND A MESSAGE AND START CHATTING</div>')
                            }else{
                                $('#PANELBODY').empty();

                                $.each(data, function(key, value){
                                    var msg = "";
                                    if(value['sender_id'] == $('#SENDERID').val()){
                                        msg = '<div class="bubble-user">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                                    }else{
                                        msg = '<div class="bubble">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                                    }
                                    $('#PANELBODY').append(msg).scrollTop($('#PANELBODY').height());
                                });

                                GETMSG(userid, $('#SENDERID').val());
                            }
                        }
                    });
                });
            }

            REFRESHEVENTHANDLER();
            $('.DIVCHAT').on('click', 'div.DIVCHAT', function(){
                alert('haha');
            });

            function triggerSearch(){
                $('#LOADICON').show();
                $('#chatSearch').attr('readonly', 'true');
                $('#FAILMSG').hide();
                $.ajax({
                    type    :   'POST',
                    url     :   '/adminSearchChatUser',
                    data    :   $('#chatSearchForm').serialize(),
                    success :   function(data){
                        $('#chatUSERLIST').empty();
                        $.each(data, function(key,value){
                            $('#chatUSERLIST').append('<div data-userid="'+value['id']+'" class="DIVCHAT" style="cursor: pointer; border-bottom: solid 1px #bdc3c7; padding: 0.9em; background-color: white;"><b class="FULLNAME">'+value['fullName']+'</b><br/><span style="font-size: 0.8em" class="USERNAME">'+value['username']+'</span></div>');
                        });
                        REFRESHEVENTHANDLER();
                    }
                });

                $('#chatSearch').removeAttr('readonly');
                $('#LOADICON').hide();
            }

            function GETMSG(userid, senderid){
                setInterval(function(){
                    $.ajax({
                        type    :   'GET',
                        url     :   '/ADMINGETNEWMSG='+userid+'='+senderid,
                        success :   function(data){
                            if(data){
                                $.each(data, function(key, value){
                                    var msg = '<div class="bubble">'+value['content']+'<br/><span class="timestamp">'+value['created_at']+'</span></div>';
                                    $('#PANELBODY').append(msg).scrollTop($('#PANELBODY').height());
                                });

                            }
                        }
                    })
                }, 500);
            }

            $('#chatSearchBTN').click(function(){triggerSearch()})
            $('#chatSearch').keyup(function(e){if(e.keyCode == 13){triggerSearch()}})
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
        <section style="margin-top:0;">
            <div class="container lato-text" style="">
                <div class="page-title">
                    <h1 class="lato-text">
                        Administrator | Messages
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fa fa-home"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="widget-container">
                            <div class="widget-content">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        User Account List</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/admin" class="sidemenu">Pending Users</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Worker</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/UsrAccntLstCMPNY" class="sidemenu">Company</a><br>
                                    <!--
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
                                    -->
                                </div>
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                            Job Ads&nbsp;&nbsp;
                                            <span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">
                                                <i class="fa fa-search"></i> Search
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/showJobAds" class="sidemenu">All Job Ads</a><br>
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>--}}
                                </div>
                                <!--
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Audit Trail</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_workers" class="sidemenu">Workers</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_companies" class="sidemenu">Company</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                                </div>
                                -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Category & Skills</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">System Skills</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/customSkills" class="sidemenu">Custom Skills</a><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-header"><span id="PANELHEAD" style="font-size: 1.4em;"></span></div>
                                <div class="panel-body" id="PANELBODY" style="word-wrap: break-word; height: 32em; overflow-y: auto; padding: 0; background-color: #ffffff;">
                                    {{--<div class="bubble-user">--}}
                                        {{--Hi! How can i help you?--}}
                                        {{--<br/>--}}
                                        {{--<span class="timestamp">March 20, 2013</span>--}}
                                    {{--</div>--}}
                                    {{--<div class="bubble">--}}
                                        {{--Hi! i have a problem <with class="."></with>--}}
                                        {{--<br/>--}}
                                        {{--<span class="timestamp">March 20, 2013</span>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="panel-footer">
                                    <div class="input-group">
                                        <form method="POST" action="/ADMINSENDMESSAGE" id="ADMINCHATFORM">
                                            <input type="text" class="form-control" name="ADMIN_sendMsgContent" id="ADMIN_sendMsgContent" placeholder="ENTER YOUR MESSAGE"/>
                                            <input type="text" style="display: none;"/>
                                            <input type="hidden" name="USERID" value="" id="USERID" />
                                            <input type="hidden" name="SENDERID" value="{{ Auth::user()->id }}" id="SENDERID" />
                                        </form>
                                        <span class="input-group-btn">
                                            <button disabled type="button" id="ADMIN_sendMsgBtn" class="btn btn-primary"> Send </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group" style="margin-bottom: 0.8em;">
                                    <form method="POST" action="/" id="chatSearchForm">
                                        <input id="x" name="x" type="text" placeholder="Search for users" style="display: none;" />
                                        <input id="chatSearch" name="chatSearch" type="text" class="form-control" placeholder="Search for name/username">
                                    </form>
                                    <span class="input-group-btn">
                                        <button id="chatSearchBTN" name="chatSearchBTN" class="btn btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                                    </span>
                                </div>
                                <div style="max-height: 36em; overflow-x: hidden; overflow-y: auto;" id="chatUSERLIST">
                                    <span id="LOADICON" style="display: none;">
                                        <center> <i class="fa  fa-circle-o-notch fa-spin"></i> &nbsp; Searching for user..</center>
                                    </span>
                                    <span id="FAILMSG" style="display: none;">
                                        <center> <i>No users found</i></center>
                                    </span>
                                    @foreach($msgs as $m)
                                        <div data-userid="{{$m->id}}" class="DIVCHAT" style="cursor: pointer; border-bottom: solid 1px #bdc3c7; padding: 0.9em; background-color: white;">
                                            <span class="badge" style="background-color: #E74C3C;">NEW</span>
                                            <b class="FULLNAME">{{$m->fullName}}</b><br>
                                            <span style="font-size: 0.8em" class="USERNAME">{{$m->username}}</span>
                                        </div>
                                    @endforeach
                                    <!--
                                    <div style="border-bottom: solid 1px #bdc3c7; padding: 0.9em; background-color: white;">
                                        <b>Jan Sarmiento</b>
                                        <br/>
                                        <span style="font-size: 0.8em">Username</span>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@stop

{{--<html>--}}
    {{--<head></head>--}}
    {{--<body>--}}
        {{--<h1>Notifications</h1>--}}
        {{--@foreach($notifications as $notif)--}}
            {{--<div style="border: 2px solid black; padding: 0.4em; margin-bottom: 0.4em; cursor: pointer;" onclick="location.href='{{$notif->notif_url}}'">--}}
                {{--{{ $notif->content }}<br/>--}}
                {{--<span style="color: #7F8C8D; font-size: 0.8em">{{ $notif->created_at }}</span>--}}
            {{--</div>--}}
        {{--@endforeach--}}
        {{--{{ $notifications->links() }}--}}
    {{--</body>--}}
{{--</html>--}}