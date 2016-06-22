@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important; 
        }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#search_btn').click(function(){
                var acctStatus = $('#search_acctStatus').val(),
                    rating = $('#search_rating').val(),
                    hiring = $('#search_hiring').val(),
                    orderBy = $('#search_orderBy').val(),
                    keyword = $('#search_keyword').val();

                    if(keyword == ""){
                        keyword = "NONE";
                    }

                    location.href = "/searchWorker:"+acctStatus+":"+rating+":"+hiring+":"+orderBy+":"+keyword;
            });
//            $('#searchBtn').click(function(){
//                var searchBy = 0,
//                    searchWord = 0;
//                if($('#searchBy').val() != ''){
//                    searchBy = $('#searchBy').val()
//                }
//
//                if($('#searchWord').val() != ''){
//                    searchWord = $('#searchWord').val()
//                }
//
//                location.href = '/userListTaskminators=search='+searchBy+'='+searchWord;
//            });
//
//            $('#searchBy').change(function(){
//                if($(this).val() == '0'){
//                    $('#searchWord').prop('disabled', true);
//                }else{
//                    $('#searchWord').prop('disabled', false);
//                }
//            })
//
//            if($('#searchBy').val() == '0'){
//                $('#searchWord').prop('disabled', true);
//            }
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
        <!--<h2>Admin Dashboard</h2>
        <ul>
            <li><a href="/userListTaskminators">Taskminators</a></li>
            <li>
                Client
                <ul>
                    <li><a href="/userListClientIndi">Individuals</a></li>
                    <li><a href="/userListClientComp">Companies</a></li>
                </ul>
            </li>
            <li>
                Pending Users
                <ul>
                    <li><a href="/pendingTskmntr">Taskminators</a></li>
                    <li><a href="/pendingClientIndi">Client (Individual)</a></li>
                    <li><a href="/pendingClientComp">Client (Company)</a></li>
                </ul>
            </li>
        </ul>
        Tasks
        <ul>
            <li><a href="/taskListBidding">Bidding</a></li>
            <li><a href="/taskListAuto">Automatic</a></li>
            <li><a href="/taskListDirect">Direct</a></li>
        </ul>
        Audit Trail
        <ul>
            <li><a href="/AT_taskminator">Taskminator</a></li>
            <li><a href="/AT_clientindi">Client (Individual)</a></li>
            <li><a href="/AT_clientcomp">Client (Company)</a></li>
        </ul>
        <a href="/categoryAndSkills">Category & Skills</a><br/>
        <a href="/logout">Logout</a>-->
        <section style="margin-top:0;">
            <div class="container lato-text" style="">
                <div class="page-title">
                    <h1 class="lato-text">
                        User List : Taskminators
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
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
                                </div>
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Job Ads&nbsp;&nbsp;
                                        {{--<span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">--}}
                                            {{--<i class="fa fa-search"></i> Search--}}
                                        {{--</span>--}}
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>
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
                                        <a class="accordion-toggle">
                                        Category & Skills</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">Manage</a><br>
                                </div>
                                {{--<div class="panel-heading">--}}
                                    {{--<div class="panel-title">--}}
                                        {{--<a class="accordion-toggle">--}}
                                        {{--User Account List</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Taskminators</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Client - Individuals</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Client - Companies</a><br>--}}
                                {{--</div>--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<div class="panel-title">--}}
                                        {{--<a class="accordion-toggle">--}}
                                        {{--Pending Users</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingTskmntr" class="sidemenu">Taskminators</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientIndi" class="sidemenu">Client - Individual</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientComp" class="sidemenu">Client - Companies</a>--}}
                                {{--</div>--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<div class="panel-title">--}}
                                        {{--<a class="accordion-toggle">--}}
                                        {{--Tasks</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/" class="sidemenu">Bidding</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListAuto" class="sidemenu">Automatic</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListDirect" class="sidemenu">Direct</a>--}}
                                {{--</div>--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<div class="panel-title">--}}
                                        {{--<a class="accordion-toggle">--}}
                                        {{--Audit Trail</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="panel-body">--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Taskminators</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>--}}
                                {{--</div>--}}
                                {{--<div class="panel-heading">--}}
                                    {{--<div class="panel-title">--}}
                                        {{--<a class="accordion-toggle" href="/categoryAndSkills">--}}
                                        {{--Category & Skills</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="well selected-filters">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Status</label>
                                        <select class="form-control" id="search_acctStatus" name="search_acctStatus">
                                            <option value="LOWF">Lowest First</option>
                                            <option value="HIGHF">Highest First</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <select class="form-control" id="search_rating" name="search_rating">
                                            <option value="RLOWF">Lowest First</option>
                                            <option value="RHIGHF">Highest First</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hiring Status</label>
                                        <select class="form-control" id="search_hiring" name="search_hiring">
                                            <option value="H">Hired</option>
                                            <option value="NH">Not Hired</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Order by</label>
                                        <select class="form-control" id="search_orderBy" name="search_orderBy">
                                            <option value="DESC">Newest first</option>
                                            <option value="ASC">Oldest first</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Search Keywords (Name or Username)</label>
                                        <input type="text" class="form-control" placeholder="KEYWORD FOR NAME/USERNAME" id="search_keyword" name="search_keyword" />
                                    </div>
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary" id="search_btn">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="well selected-filters">
                            <div class="row">
                                <div class="col-md-2">
                                    <select id="search_orderBy" name="search_orderBy" class="form-control">
                                        <option value="DESC" <?php if(@$search_orderBy == 'DESC'){ echo('selected'); } ?>>Newest first</option>
                                        <option value="ASC" <?php if(@$search_orderBy == 'ASC'){ echo('selected'); } ?>>Oldest first</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="searchBy" name="searchBy" class="form-control">
                                        <option value="0">Display All</option>
                                        <option value="fullName" <?php if(@$searchBy == 'fullName'){ echo('selected'); } ?>>Name</option>
                                        <option value="username" <?php if(@$searchBy == 'username'){ echo('selected'); } ?>>Username</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input value="<?php if(@$searchWord){ echo($searchWord); } ?>" id="searchWord" type="text" name="searchWord" placeholder="search keyword" class="form-control"/>
                                </div>
                                <div class="col-md-2">
                                    <button id="searchBtn" type="submit" class="btn btn-block btn-primary" style="margin: 0">Search</button>
                                </div>
                            </div>
                        </div>
                        -->
                        @if($users->count() == 0)
                            <div class="well selected-filters" style="text-align: center">
                                <font style="color: red">No data available.</font>
                            </div>
                        @endif
                        @foreach($users as $user)
                            <div class="widget-container lato-text" style="min-height: 150px; padding-bottom: 5px;">
                                <div class="widget-content padded">
                                    <div>
                                        <h3><a class="lato-text" href="/viewUserProfile/{{ $user->id }}">{{ $user->fullName }} {{ '@'.$user->username }}</a></h3>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Username</span>
                                         : <span style="margin-left: 5px">{{ $user->username }}</span><br/>
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Status</span> :
                                        <span style="margin-left: 5px">{{ $user->status }}</span><br/>
                                        @if($user->status != 'PRE_ACTIVATED')
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Tasks Done</span> :
                                            <span style="margin-left: 5px">{{ Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')->where('task_has_taskminator.taskminator_id', $user->id)->where('tasks.status', 'CLOSED')->count() }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Current Task</span> :
                                            <span style="margin-left: 5px">{{ Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')->where('task_has_taskminator.taskminator_id', $user->id)->where('tasks.status', 'ONGOING')->count() }}</span>
                                        @else
                                            <span style="color: red;">Please check credentials of this user before fully activating their account.</span>
                                        @endif
                                        <br/><br/>
                        <!--                <hr style="margin: 0;"/>-->
                                        @if($user->status == 'PRE_ACTIVATED')
                                            <div class="row">
                                                <a href="/adminActivate/{{$user->id}}" class="btn btn-info">Fully Activate Account</a><br/>
                                                <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                            </div>
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
                            </div><br/>
                        @endforeach
                        <center>{{ $users->links() }}</center>
                    </div>
                </div>
            </div>
        </section>
@stop