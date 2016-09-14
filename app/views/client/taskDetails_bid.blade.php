@extends('layouts.usermain')

@section('title')
    Task Details
@stop

@section('head-content')
    <style>
        i{cursor:default !important;}
        body{background-color:#E9EAED;}
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
            margin-right: 1em;
            margin-bottom: 0em;
            /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
            /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
            /*box-shadow: 0 8px 6px -6px black;*/
        }
        .thumbnail img {
            display: inline;
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100%;
            width: auto;
            /*-webkit-transform: translate(-50%,-50%);*/
            /*-ms-transform: translate(-50%,-50%);*/
            transform: translate(-50%,-50%);
        }
        .thumbnail img.portrait {
            width: 100%;
            height: auto;
        }
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('.hire-btn').click(function(){
                if(confirm('Do you want to hire '+$(this).attr('data-tskmntr')+' for this task?')){
                    location.href = $(this).attr('data-href');
                }
            });

            $('.cancel-task-btn').click(function(){
                if(confirm("Are you sure you want to cancel this task?")){
                    location.href = $(this).attr('data-href');
                }
            });
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                {{ $task->name }}
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Task Details
                    </li>
                </ul>
            </div>
            @if(Session::has('errorMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {{ @Session::get('errorMsg') }}
                    </div>
                </div>
            @endif
            @if(Session::has('successMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ @Session::get('successMsg') }}
                    </div>
                </div>
            @endif
            <div class="col-sm-12">
                <div class="widget-container fluid-height padded">
                    <div class="row padded">
                        <div class="col-sm-6">
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Points</span>
                             : <span style="margin-left: 5px">{{ Auth::user()->points }}</span><br/>
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Description</span>
                             : <span style="margin-left: 5px">{{ $task->description }}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Category</span>
                             : <span style="margin-left: 5px">{{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Skill</span>
                             : <span style="margin-left: 5px">{{ TaskItem::join('taskcategory', 'taskcategory.categorycode', '=', 'taskitems.item_categorycode')->where('taskitems.itemcode', $task->taskType)->pluck('itemname') }}</span><br/>
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Salary</span>
                             : <span style="margin-left: 5px">{{ $task->salary }}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Deadline</span>
                             : <span style="margin-left: 5px">{{ $task->deadline }}</span><br/>
                        </div>
                        <div class="col-sm-6">
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date Created</span>
                             : <span style="margin-left: 5px">{{ $task->created_at }}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Location</span>
                             : <span style="margin-left: 5px">{{ City::where('citycode', $task->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $task->barangay)->pluck('bgyname') }}</span><br/>
                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Mode of Payment</span>
                             : <span style="margin-left: 5px">{{ $task->modeOfPayment }}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Hiring Type</span>
                             : <span style="margin-left: 5px">{{ $task->hiringType}}</span><br/>
                             <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Working Time</span>
                             : <span style="margin-left: 5px">
                                @if($task->workTime == 'FTIME')
                                    Full Time
                                @else
                                    Part Time
                                @endif
                            </span><br/>
                        </div>
                    </div>
                    @if($task->status != 'CANCELLED')
                    <div class="row padded" style="margin-top: 0">
                        <div class="col-sm-12">
                            @if($task->status == 'ONGOING')
                                @foreach(User::join('task_has_taskminator', 'users.id', '=', 'task_has_taskminator.taskminator_id')->where('task_has_taskminator.task_id', $task->id)->get() as $tskmntr)
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Hired Taskminator</span>
                                     : <span style="margin-left: 5px">{{ $tskmntr->fullName }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Proposed Rate</span>
                                     : <span style="margin-left: 5px">{{ $tskmntr->proposedRate }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Message</span>
                                     : <span style="margin-left: 5px">{{ $tskmntr->message}}</span><br/>
                                    <br/>
                                @endforeach

                                <a href="/completeTask/taskid:{{$task->id}}" class="btn btn-success">Complete Task</a><br/>
                            @elseif($task->status == 'COMPLETE')
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Completed at</span>
                                 : <span style="margin-left: 5px">{{ $task->completed_at }}</span><br/>
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Completed by</span>
                                 : <span style="margin-left: 5px">{{ User::where('id', $task->completed_by)->pluck('fullName') }}</span><br/>
                            @else
                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Bidders</span>
                                 : <span style="margin-left: 5px">{{ TaskHasBidder::where('task_id', $task->id)->count() }}</span><br/><br/>
                                @if(TaskHasTaskminator::where('task_id', $task->id)->count() == 0 && TaskHasBidder::where('task_id', $task->id)->count() == 0)
                                    <a href="/editTask/{{ $task->id }}" class="btn btn-primary">Edit Task Details</a>
                                    <a class="cancel-task-btn btn btn-danger" href="/deleteTask/{{ $task->id }}">Cancel Task</a><br/>
                                @endif
                                <hr/><div class="heading">
                                    <i class="glyphicon glyphicon-list"></i> Bidders List
                                </div>
                                @if(count($bidders))
                                    @foreach($bidders as $bid)
                                        @foreach(User::join('task_has_bidders', 'users.id', '=', 'task_has_bidders.taskminator_id')->where('task_has_bidders.task_id', $task->id)->where('users.id', $bid->taskminator_id)->select(['users.id','users.fullName','task_has_bidders.created_at','task_has_bidders.message','task_has_bidders.proposedRate'])->get() as $user)
                                        <div style="backgraound: #f5f5f5; margin-bottom: 0.4em; padding: 0.2em;">
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Name</span>
                                             : <span style="margin-left: 5px"><a target="_tab" href="/profile/{{$user->id}}">{{ $user->fullName }}</a></span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Proposed Rate</span>
                                             : <span style="margin-left: 5px">{{ $user->proposedRate }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Message</span>
                                             : <span style="margin-left: 5px">{{ $user->message }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Date of bid</span>
                                             : <span style="margin-left: 5px">{{ $user->created_at}}</span>
                                            <br/>
                                            <a data-tskmntr="{{ $user->fullName }}" data-taskName="{{$task->name}}" class="hire-btn btn btn-info" href="#" data-href="/hireTskmntr/{{$user->id}}/{{ $bid->task_id }}">Hire</a>
                                        </div>
                                        @endforeach
                                    @endforeach
                                @else
                                    <div class="well selected-filters" style="text-align: center">
                                        <font style="color: red">No bidders yet</font>
                                    </div>
                                @endif
                            @endif
                            <!--<a class="cancel-task-btn" href="#" data-href="/deleteTask/{{ $task->id }}">Cancel Task</a>-->
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@stop