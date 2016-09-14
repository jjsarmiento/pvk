@extends('layouts.usermain')

@section('title')
Bid for {{ $task->name }}
@stop

@section('head-content')
    {{ HTML::style('stylesheets/datepicker-new.css') }}
    <style type="text/css">
        body{background-color:#E9EAED;}
        .hrLine
        {
            background:#ccc;
            max-width:100%;
            border:none;
            height:1px;
            max-height:1px;
        }
    </style>
@stop

@section('body-scripts')
    <script src="/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('.init-datepicker').datepicker({
                format : 'yyyy-mm-dd'
            });
        })
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
@stop -->

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">

        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Bid for task
                    </li>
                </ul>
            </div>
            <span style="color: red; font-weight: bold">{{ @Session::get('errorMsg') }}</span>
            <span style="color: green; font-weight: bold">{{ @Session::get('successMsg') }}</span>
            <div class="col-md-12" style="background-color: white; padding: 1em;">
                Task title : {{ $task->name }}<br/>
                Task Description : {{ $task->description }}<br/>
                Deadline : {{ $task->deadline }}<br/>
                Date Created : {{ $task->created_at }}<br/>
                Mode of payment : {{ $task->modeOfPayment }}<br/>
                Work Time : {{ $task->workTime }}<br/>
                @foreach(User::where('id', $task->user_id)->get() as $user)

                    @if(UserHasRole::where('user_id', $user->id)->pluck('role_id') == 3)
                        by <a target="_tab" href="/{{ $user->username }}">{{ $user->fullName }}</a>
                    @else
                        by <a target="_tab" href="/{{ $user->username }}">{{ $user->companyName }}</a>
                    @endif
                @endforeach
                <br/>
                <hr class="hrLine" />
                <div class="col-md-12 row">
                    <form method="POST" action="/initBid">
                        <input type="hidden" value="{{ $task_id }}" name="taskId"/>
                        <input type="hidden" value="{{ Auth::user()->id }}" name="taskminatorId"/>
                        <input type="hidden" value="{{ $hiringType }}" name="hiringType"/>

                        <div class="row form-group">
                            <label class="control-label col-md-2">Proposed Rate</label>
                            <div class="col-md-10">
                                <input type="text" name="proposedRate" id="proposedRate" class="form-control" placeholder="Proposed rate" required="required"/>
                            </div>
                        </div>
                        <br/>

                        @if($hiringType == 'PART')
                        <div class="row form-group">
                            <label class="control-label col-md-2">Proposed Date/Duration</label>
                            <div class="col-md-10">
                                <input type="text" name="proposedDuration" class="form-control init-datepicker" id="proposedDuration" readonly="readonly" placeholder="Proposed date/duration"/>
                            </div>
                        </div>
                        <br/>
                        @endif

                        <div class="row form-group">
                            <label class="control-label col-md-2">Message (Maximum of 255 characters)</label>
                            <div class="col-md-10">
                                <textarea maxlength="255" class="form-control" rows="7" placeholder="Message to the client (Required)" name="message" id="message" required="required"></textarea>
                            </div>
                        </div>
                        <br/>
                        <button type="submit" class="pull-right btn btn-primary">Bid for task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

<!--<html>-->
<!--    <head></head>-->
<!--    <body>-->
<!--        <a href="/">Home</a><br/>-->
<!--        <a href="/tskmntr/taskSearch">Search for task</a><br/><br/>-->
<!--        -->
<!--        <span style="color: red; font-weight: bold">{{ @Session::get('errorMsg') }}</span>-->
<!--        <span style="color: green; font-weight: bold">{{ @Session::get('successMsg') }}</span>-->
<!--        <div style="border: 1px solid #333333; padding: 0.4em">-->
<!--            Task title : {{ $task->name }}<br/>-->
<!--            Task Description : {{ $task->description }}<br/>-->
<!--            Deadline : {{ $task->deadline }}<br/>-->
<!--            Date Created : {{ $task->created_at }}<br/>-->
<!--            Mode of payment : {{ $task->modeOfPayment }}<br/>-->
<!--            Work Time : {{ $task->workTime }}<br/>-->
<!--            @foreach(User::where('id', $task->user_id)->get() as $user)-->
<!--                @if(UserHasRole::where('user_id', $user->id)->pluck('role_id') == 3)-->
<!--                    by <span style="color: red; font-size: 1em; font-weight: bold;">{{ $user->firstName }} {{ $user->lastName }}</span>-->
<!--                @else-->
<!--                    by <a target="_tab" href="/profile/{{ $user->id }}">{{ $user->companyName }}</a>-->
<!--                @endif-->
<!--            @endforeach-->
<!--        </div>-->
<!---->
<!--        <br/>-->
<!--        <form method="POST" action="/initBid">-->
<!--            <input type="hidden" value="{{ $task_id }}" name="taskId"/>-->
<!--            <input type="hidden" value="{{ Auth::user()->id }}" name="taskminatorId"/>-->
<!--            <input type="hidden" value="{{ $hiringType }}" name="hiringType"/>-->
<!--            Proposed rate :-->
<!--            <input type="text" name="proposedRate" id="proposedRate" placeholder="Proposed rate" required="required"/><br/>-->
<!--            @if($hiringType == 'PART')-->
<!--            Proposed Date/Duration-->
<!--            <input type="text" name="proposedDuration" id="proposedDuration" placeholder="Proposed date/duration"/><br/>-->
<!--            @endif-->
<!--            Message : <br/>-->
<!--            <textarea placeholder="Message to the client (Required)" name="message" id="message" required="required"></textarea><br/>-->
<!--            <button type="submit">Bid for task</button>-->
<!--        </form>-->
<!--    </body>-->
<!--</html>-->