@extends('layouts.usermain')

@section('title')
    Automatic Search for Taskminators
@stop

@section('head-content')
    <style>
        body{background-color:#E9EAED;}
        h5 {
            margin: 0;
        }
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
            margin-left: 20px;
            margin-top: 15px;
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
        }x
    </style>

@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop


@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Automatic Search
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Autosearch
                    </li>
                </ul>
            </div>
            <div class="col-sm-4">
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <form method="POST" action="/tskmntr/doTaskSearch" id="searchForm">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapseOne">
                                            <div class="caret pull-right"></div>
                                            Task Details</a>
                                        </div>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseOne">
                                        <div class="panel-body">
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Name</span>
                                             : 
                                            <span style="margin-left: 5px"><a target="_tab" href="/taskDetails/{{$task->id}}">{{ $task->name }}</a></span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Description</span>
                                             : 
                                            <span style="margin-left: 5px">{{ $task->description }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Skill Category</span>
                                             : 
                                            <span style="margin-left: 5px">{{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Skill</span>
                                             : 
                                            <span style="margin-left: 5px">{{ TaskItem::where('itemcode', $task->taskType)->pluck('itemname') }}</span><br/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="heading">
                    <i class="glyphicon glyphicon-user"></i> Users with the Same Skills
                </div>
                @foreach($users as $user)
                    <div class="widget-container fluid-height padded">
                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Name</span>
                         : <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;"><a target="_tab" href="/profile/{{$user->id}}">{{ $user->fullName }}</a></span><br/>
                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Address</span>
                         : <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">{{ $user->address }}</span><br/>
                    @if(TaskminatorHasOffer::where('taskminator_id', $user->id)->where('task_id', $task->id)->count() > 0)
                        <span style="color: green;"> This task has been already offered to this taskminator. Click <a target="_tab" href="/taskDetails/{{$task->id}}">here</a> for more details. </span>
                    @else
                        <a href="/automaticOffer/{{$task->id}}={{$user->id}}" class="btn btn-primary">Offer {{ $user->fullName }} for this task.</a>
                    @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@stop