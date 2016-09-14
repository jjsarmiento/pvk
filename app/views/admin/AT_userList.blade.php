@extends('layouts.usermain')

@section('title')
    Audit Trail
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop
 -->

 @section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container{
            background-color: rgba(245,245,245,0.3);
        }
        .breadcrumb, .panel-heading{
            background-color: rgba(245,245,245,0.7);
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
        }.block-update-card {
             padding: 0.8em;
           height: 100%;
           border: 1px #FFFFFF solid;
           /*width: 380px;*/
           float: left;
           /*margin-left: 10px;*/
           /*margin-top: 0;*/
           /*padding: 0;*/
           box-shadow: 1px 1px 8px #d8d8d8;
           background-color: #FFFFFF;
         }
         .block-update-card .h-status {
           width: 100%;
           height: 7px;
           background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
         }
         .block-update-card .v-status {
           width: 5px;
           height: 80px;
           float: left;
           margin-right: 5px;
           background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
         }
         .block-update-card .update-card-MDimentions {
           width: 80px;
           height: 80px;
         }
         .block-update-card .update-card-body {
           margin-top: 10px;
           margin-left: 5px;
         }
         .block-update-card .update-card-body h4 {
           color: #737373;
           font-weight: bold;
           /*font-size: 13px;*/
         }
         .block-update-card .update-card-body p {
           color: #737373;
           font-size: 12px;
         }
         .block-update-card .card-action-pellet {
           padding: 5px;
         }
         .block-update-card .card-action-pellet div {
           margin-right: 10px;
           font-size: 15px;
           cursor: pointer;
           color: #dddddd;
         }
         .block-update-card .card-action-pellet div:hover {
           color: #999999;
         }
         .block-update-card .card-bottom-status {
           color: #a9a9aa;
           font-weight: bold;
           font-size: 14px;
           border-top: #e0e0e0 1px solid;
           padding-top: 5px;
           margin: 0px;
         }
         .block-update-card .card-bottom-status:hover {
           background-color: #dd4b39;
           color: #FFFFFF;
           cursor: pointer;
         }

         /*
         Creating a block for social media buttons
         */
         .card-body-social {
           font-size: 30px;
           margin-top: 10px;
         }
         .card-body-social .git {
           color: black;
           cursor: pointer;
           margin-left: 10px;
         }
         .card-body-social .twitter {
           color: #19C4FF;
           cursor: pointer;
           margin-left: 10px;
         }
         .card-body-social .google-plus {
           color: #DD4B39;
           cursor: pointer;
           margin-left: 10px;
         }
         .card-body-social .facebook {
           color: #49649F;
           cursor: pointer;
           margin-left: 10px;
         }
         .card-body-social .linkedin {
           color: #007BB6;
           cursor: pointer;
           margin-left: 10px;
         }
    </style>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                Audit Trail
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Audit Trail
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="widget-container">
                    <div class="widget-content">
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
                                <!--
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>
                                -->
                            </div>
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <a class="accordion-toggle">
                                        Audit Trail
                                    </a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_workers" class="sidemenu">Workers</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_companies" class="sidemenu">Company</a><br>
                                <!--
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                                -->
                            </div>
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
                        <!--
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Client</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Client - Individuals</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Client - Companies</a><br>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Pending Users</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingTskmntr" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientIndi" class="sidemenu">Client - Individual</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientComp" class="sidemenu">Client - Companies</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Tasks</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/" class="sidemenu">Bidding</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListAuto" class="sidemenu">Automatic</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListDirect" class="sidemenu">Direct</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Audit Trail</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle" href="/categoryAndSkills">
                                Category & Skills</a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @foreach($users as $user)
                    <div class="media block-update-card" style="">
                        <a class="pull-left" href="/userAuditTrail_{{$user->id}}">
                            @if($user->profilePic != "")
                                <img class="media-object update-card-MDimentions" src="{{$user->profilePic}}">
                            @else
                                <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                            @endif
                        </a>
                        <div class="media-body update-card-body">
                            <a href="/userAuditTrail_{{$user->id}}" style="font-weight: bolder;">
                                {{ $user->fullName }} {{'@'.$user->username}}
                            </a>
                            <p>
                                <i class="fa fa-map-marker"></i> {{ $user->regname }}, {{ $user->cityname }}<br/>
                                Registered at {{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at)) }}
                            </p>
                        </div>
                    </div>
                @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </div>
</section>
@stop