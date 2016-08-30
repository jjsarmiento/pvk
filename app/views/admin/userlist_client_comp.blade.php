@extends('layouts.usermain')

@section('title')
    Company Clients
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important; 
        }
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
        @media(max-width: 767px){
          h1.lato-text {
              margin-top: 40px;
          }
        }
        /*-----------------*/
    </style>
@stop

@section('body-scripts')
<script>
    $(document).ready(function(){
        $('#searchBtn').click(function(){
            var searchBy = 0,
                searchWord = 0;
            if($('#searchBy').val() != ''){
                searchBy = $('#searchBy').val()
            }

            if($('#searchWord').val() != ''){
                searchWord = $('#searchWord').val()
            }

            location.href = '/userListClientComp=search='+searchBy+'='+searchWord;
        });

        $('#searchBy').change(function(){
            if($(this).val() == '0'){
                $('#searchWord').prop('disabled', true);
            }else{
                $('#searchWord').prop('disabled', false);
            }
        })

        if($('#searchBy').val() == '0'){
            $('#searchWord').prop('disabled', true);
        }
    });
</script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop
 -->
@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                User List : Client (Company)
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        User List
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
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
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
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Audit Trail</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Category & Skills</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">Manage</a><br>
                        </div>
                        <!--
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                    User Account List</a>
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
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientIndi" class="sidemenu">Client - Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientComp" class="sidemenu">Client - Company)</a>
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
                <div class="well selected-filters">
    <!--                <form method="POST" action="/userListClientComp=search">-->
                        <div class="row">
                            <div class="col-md-3">
                                <select name="searchBy" class="form-control" id="searchBy">
                                    <option value="0">Display All</option>
                                    <option value="fullName" <?php if(@$searchBy == 'fullName'){ echo('selected'); } ?>>Name</option>
                                    <option value="username" <?php if(@$searchBy == 'username'){ echo('selected'); } ?>>Username</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input value="<?php if(@$searchWord){ echo($searchWord); } ?>" type="text" name="searchWord" id="searchWord" placeholder="search keyword" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <button id="searchBtn" type="submit" class="btn btn-block btn-primary" style="margin: 0">Search</button>
                            </div>
                        </div>
    <!--                </form>-->
                </div>
                @if($users->count() == 0)
                    <div class="well selected-filters" style="text-align: center">
                        <font style="color: red">No data available.</font>
                    </div>
                @endif
                @foreach($users as $user)
                    <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                        <div class="widget-content padded">
                            <div>
                                <h3 class="lato-text"><a href="/viewUserProfile/{{ $user->id }}">{{ $user->fullName }}</a></h3>
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Username</span>
                                 : <span style="margin-left: 5px">{{ $user->username }}</span><br/>
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Status</span>
                                 : <span style="margin-left: 5px">{{ $user->status }}</span><br/>
                                @if($user->status != 'PRE_ACTIVATED')
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Open Tasks</span>
                                     : <span style="margin-left: 5px">{{ Task::where('user_id', $user->id)->where('status', 'OPEN')->count() }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Ongoing Tasks</span>
                                     : <span style="margin-left: 5px">{{ Task::where('user_id', $user->id)->where('status', 'ONGOING')->count() }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Accomplished Tasks</span>
                                     : <span style="margin-left: 5px">{{ Task::where('user_id', $user->id)->where('status', 'CLOSED')->count() }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Cancelled Tasks</span>
                                     : <span style="margin-left: 5px">{{ Task::where('user_id', $user->id)->where('status', 'CANCELLED')->count() }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Total Tasks Posted</span>
                                     : <span style="margin-left: 5px">{{ Task::where('user_id', $user->id)->count() }}</span><br/><br/>
                                @else
                                <span style="color: red; margin-right: 5px;">Please check credentials of this user before fully activating their account.</span>
                                @endif
                                @if($user->status == 'PRE_ACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-info">Fully Activate Account</a>
                                    <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                @elseif($user->status == 'ACTIVATED')
                                    <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                @elseif($user->status == 'DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @elseif($user->status == 'SELF_DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @elseif($user->status == 'ADMIN_DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                <center>{{ $users->links() }}</center>
            </div>
        </div>
    </div>
</section>
@stop