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
            $('.cancel-task-btn').click(function(){
                if(confirm("Are you sure you want to cancel this task?")){
                    location.href = $(this).attr('data-href');
                }
            });
        });
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
                    <div class="alert alert-error">
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
                            @if($hired->count() == 0 && TaskHasBidder::where('task_id', $task->id)->count() == 0 && TaskminatorHasOffer::where('task_id', $task->id)->count() == 0)
                                <a href="/editTask/{{ $task->id }}" class="btn btn-info">Edit Task Details</a>
                            @endif
                            <a class="cancel-task-btn btn btn-danger" href="#" data-href="/deleteTask/{{ $task->id }}">Cancel Task</a>

                            @if($hired->count() == 0)
                                @if($task->hiringType == 'DIRECT')
                                    <a href="/tskmntrSearch" class="btn btn-primary">Look for a Taskminator</a>
                                @else
                                    <a href="/automaticSearch/{{$task->id}}" class="btn btn-primary">Look for a Taskminator</a>
                                @endif
                            @endif
                        </div>
                        <div class="col-sm-12">
                            @if($offers->count() > 0 && $hired->count() == 0 && $task->status != 'COMPLETE')
                                <hr/><div class="heading">
                                    <i class="glyphicon glyphicon-wrench"></i> Taskminators Offered
                                </div>
                                @foreach($offers as $tskmntrs)
                                    @foreach(User::where('id', $tskmntrs->taskminator_id)->get() as $user)
                                        <div>
                                            <a target="_tab" href="/profile/{{ $user->id }}">{{ $user->fullName }}</a><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City/Barangay</span>
                                             : <span style="margin-left: 5px">{{ City::where('citycode', $user->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Address</span>
                                             : <span style="margin-left: 5px">{{ $user->address }}</span><br/>
                                            <hr/>
                                            <h4 style="margin: 0;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Contact Information</h4>
                                            @foreach(Contact::where('user_id', $user->id)->get() as $con)
                                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">{{ $con->ctype }}</span>
                                                 : <span style="margin-left: 5px">{{ $con->content }}</span><br/>
                                            @endforeach<br>
                                            <a href="/retractOffer/{{ $task->id }}/{{$user->id}}" class="btn btn-danger">Retract Offer</a>
                                        </div><br/>
                                    @endforeach
                                @endforeach
                            @elseif($hired->count() > 0 && $task->status != 'COMPLETE')
                                <hr/><div class="heading">
                                    <i class="glyphicon glyphicon-wrench"></i> Hired Taskminator
                                </div>
                                @foreach($hired as $tskmntrs)
                                    @foreach(User::where('id', $tskmntrs->taskminator_id)->get() as $user)
                                        <div>
                                            <a target="_tab" href="/profile/{{ $user->id }}">{{ $user->fullName }}</a><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City/Barangay</span>
                                             : <span style="margin-left: 5px">{{ City::where('citycode', $user->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Address</span>
                                             : <span style="margin-left: 5px">{{ $user->address }}</span><br/>
                                            <hr/>
                                            <h4 style="margin: 0; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Contact Information</h4>
                                            @foreach(Contact::where('user_id', $user->id)->get() as $con)
                                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">{{ $con->ctype }}</span>
                                                 : <span style="margin-left: 5px">{{ $con->content }}</span><br/>
                                            @endforeach
                                            <a href="/completeTask/taskid:{{$task->id}}" class="btn btn-success">Complete Task</a>
                                        </div><br/>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@stop