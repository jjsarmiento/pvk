@extends('layouts.usermain')

@section('title')
    Direct Task Summary
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
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
        }
        .hrLine
        {
            min-width:100%;
            background: none !important;
            border:none;
            border-bottom:1px solid #2980b9;
        }
    </style>

@stop


@section('content')
<section style="padding-top:56px;">
    <div class="container">
        <div class="page-title">
            <h1 class="lato-text">
                Direct Task Summary
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Direct Task Summary
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="widget-container weather" style="min-height: 200px; padding-bottom:20px;">
                    <div class="widget-content padded">
                        <div class="heading">
                            <i class="glyphicon glyphicon-info-sign"></i>Taskminator Info
                        </div>
                        <div style="padding:0 16px;">
                            Name : {{ $tskmntr->fullName }}<br/>
                            Address : {{ $tskmntr->address }}<br/>
                            Barangay/City : {{ Barangay::where('bgycode', $tskmntr->barangay)->pluck('bgyname') }}, {{ City::where('citycode', $tskmntr->city)->pluck('cityname') }}<br/>
                            <hr class="hrLine"/>
                            <h4 style="margin: 0;">Contact Details</h4>
                            @foreach(Contact::where('user_id', $tskmntr->id)->get() as $contact)
                                @if($contact->ctype == 'email')
                                    Email : {{ $contact->content }}<br/>
                                @elseif($contact->ctype == 'facebook')
                                    Facebook : <a href="{{ $contact->content }}">{{ $contact->content }}</a><br/>
                                @elseif($contact->ctype == 'linkedin')
                                    LinkedIn : {{ $contact->content }}<br/>
                                @elseif($contact->ctype == 'mobileNum')
                                    Mobile # : {{ $contact->content }}<br/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title">
            <h1 class="lato-text" style="font-size:18pt">
                Select a task for {{ $tskmntr->fullName }} (Direct Hiring Tasks)
            </h1>
        </div>
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-lg-12">
                <br/>
                    <div class="widget-container weather" style="min-height: 200px; padding-bottom:20px;">
                        <div class="widget-content padded">
                            <div class="heading">
                                <i class="glyphicon glyphicon-unchecked checktask"></i>{{ $task->name}}
                            </div>
                            <div style="padding: 0 20px;">
                                <span style="color: grey; font-size: 1em">Description : {{ $task->description }}</span><br/>
                                <span style="color: grey; font-size: 1em">Category : {{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
                                <span style="color: grey; font-size: 1em">Skill : {{ TaskItem::join('taskcategory', 'taskcategory.categorycode', '=', 'taskitems.item_categorycode')->where('taskitems.itemcode', $task->taskType)->pluck('itemname') }}</span><br/>
                                <span style="color: grey; font-size: 1em">Salary : {{ $task->salary }}</span><br/>
                                <span style="color: grey; font-size: 1em">Deadline : {{ $task->deadline }}</span><br/>
                                <span style="color: grey; font-size: 1em">Created@ : {{ $task->created_at }}</span><br/>
                                <span style="color: grey; font-size: 1em">Location : {{ City::where('citycode', $task->city)->pluck('cityname') }}, {{ Barangay::where('bgycode', $task->barangay)->pluck('bgyname') }}</span><br/>
                                <span style="color: grey; font-size: 1em">Mode of payment : {{ $task->modeOfPayment }}</span><br/>
                                <span style="color: grey; font-size: 1em">Hiring Type : {{ $task->hiringType}}</span><br/>
                                <span style="color: grey; font-size: 1em">
                                    Working Time :
                                    @if($task->workTime == 'FTIME')
                                        Full Time
                                    @else
                                        Part Time
                                    @endif
                                </span><br/>
                                @if(TaskminatorHasOffer::where('task_id', $task->id)->where('taskminator_id', $tskmntr->id)->count() == 1)
                                    <span style="color: green">You have already offered this taskminator for this task. Click <a target="_tab" href="/taskDetails/{{$task->id}}">here</a> to view details.</span>
                                @else
                                    <a href="/doDirectHire_{{ $tskmntr->id }}.{{ $task->id }}">Offer {{ $tskmntr->fullName }} for this task.</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- <h5>Points left : {{ Auth::user()->points }}</h5>
        <h5>Account Type : {{ Auth::user()->accountType }}</h5>
        <a href="/">Home</a><br/> -->
    </div>
</section>
@stop