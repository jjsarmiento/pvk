@extends('layouts.usermain')

@section('title')
    Task Details | {{ $task->name}}
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important; 
        }

        .hrLine
        {
            background:none;
            border:0;
            border-bottom:1px solid #2980b9;
            min-width: 100%;
            height:1px;
        }
    </style>
@stop


@section('content')
<section>
    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/" style="cursor: pointer;"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                        </li>
                        <li>
                            <a href="/taskListBidding">Task List</a>
                        </li>
                        <li class="active">
                            Task Details : {{ $task->name }}
                        </li>
                    </ul>
                </div>
            </div>
            <h2>Task Details for {{ $task->name }}</h2>
            Created by : <a href="/viewUserProfile/{{ $client->id }}">{{ $client->fullName }}</a><br/>
            Date Created : {{ $task->created_at }}<br/>
            Description : {{ $task->description }}<br/>
            Hiring Type : {{ $task->hiringType }}<br/>
            Working Time: {{ $task->workTime }}<br/>
            Task Skill Category : {{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}<br/>
            Task Skill : {{ TaskItem::where('itemcode', $task->taskType)->pluck('itemname') }}<br/>
            Status : {{ $task->status }}<br/>
            @if($task->status == 'COMPLETE')
                Completed at : {{ $task->completed_at }}<br/>
                Completed by : {{ User::where('id', $task->completed_by)->pluck('fullName') }}<br/>
            @endif
            @if($taskminator)
                <hr/>
                <h4>Taskminator Details</h4>
                Hired : <a target="_tab" href="/viewUserProfile/{{ $taskminator->id }}">{{ $taskminator->fullName }}</a><br/>
                Date Hired : {{ $taskminator->created_at }}
            @endif
        </div>
    </div>
</section>
@stop