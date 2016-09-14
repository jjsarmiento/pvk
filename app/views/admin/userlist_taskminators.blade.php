@extends('layouts.usermain')

@section('head')
    Taskminator Search Result
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                User List: Taskminators
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
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
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="well selected-filters">
                    <form method="POST" action="/userListTaskminators=search">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="searchBy" class="form-control">
                                    <option value="0">Display All</option>
                                    <option value="fullName" <?php if(@$searchBy == 'fullName'){ echo('selected'); } ?>>Name</option>
                                    <option value="username" <?php if(@$searchBy == 'username'){ echo('selected'); } ?>>Username</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="searchWord" placeholder="search keyword" class="form-control"/>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-block btn-primary" style="margin: 0">Search</button>
                            </div>
                        </div>
                    </form>
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
                                <h3><a href="/viewUserProfile/{{ $user->id }}">{{ $user->fullName }}</a></h3>
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Username</span>
                                 : <span style="margin-left: 5px">{{ $user->username }}</span><br/>
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Status</span>
                                 : <span style="margin-left: 5px">{{ $user->status }}</span><br/>
                                @if($user->status != 'PRE_ACTIVATED')
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Tasks Done</span>
                                     : <span style="margin-left: 5px">{{ Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')->where('task_has_taskminator.taskminator_id', $user->id)->where('tasks.status', 'CLOSED')->count() }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Current Task</span>
                                     : <span style="margin-left: 5px">{{ Task::join('task_has_taskminator', 'tasks.id', '=', 'task_has_taskminator.task_id')->where('task_has_taskminator.taskminator_id', $user->id)->where('tasks.status', 'ONGOING')->count() }}</span>
                                @else
                                    <span style="color: red; margin-right: 5px;">Please check credentials of this user before fully activating their account.</span>
                                @endif
                                <br/><br/>
                <!--                <hr style="margin: 0;"/>-->
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
            </div>
        </div>
    </div>
</section>
@stop