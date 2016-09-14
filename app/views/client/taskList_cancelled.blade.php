@extends('layouts.usermain')

@section('title')
    List of tasks
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
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
                Cancelled Task List
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Task List
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pull-right">
                <div class="widget-container small">
                    <div class="widget-content">
                        <div class="panel" style="  background: rgb(249, 249, 180); border-bottom: solid rgb(234, 234, 145) 1px; margin-bottom: 0">
                            <div class="panel-body">
                                <h3 style="text-align: center; margin-bottom: 0px;margin-top:0px;">Points Left: {{ Auth::user()->points }}</h3>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body" style="font-size:12pt;">
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/createTask" class="sidemenu">Create Tasks</a><br/>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/tasks" class="sidemenu">Ongoing Tasks</a><br/>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/cancelledTasks" class="sidemenu">Cancelled Tasks</a><br/>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/accomplishedTasks" class="sidemenu">Accomplished Tasks</a><br/>
                                <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/tskmntrSearch" class="sidemenu">Search for Taskminators</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::has('errorMsg'))
                <div class="col-md-9">
                    <div class="alert alert-danger">
                        {{ @Session::has('errorMsg') }}
                    </div>
                </div>
            @endif
            @if(Session::has('successMsg'))
                <div class="col-md-9">
                    <div class="alert alert-success">
                        {{ @Session::has('successMsg') }}
                    </div>
                </div>
            @endif
            @if($tasks->count() == 0)
                <div class="col-md-9">
                    <div class="alert alert-danger">You have no cancelled tasks</div>
                </div>
            @endif
            @foreach($tasks as $task)
            <div class="col-md-9">
                <div class="widget-container weather">
                    <div class="widget-content padded">
                        <div class="heading">
                            <h4 style="margin-bottom: 0; margin-top: 0.3em;"><i class="glyphicon glyphicon-unchecked"></i> <a href="/taskDetails/{{ $task->id }}" class="taskname">{{ $task->name }}</a></h4>
                        </div>
                        <div class="widget-content clearfix" style="padding: 0px 40px;">
                            <span style="font-size: 1.1em"><strong style="text-transform: uppercase">Description :</strong> &nbsp;&nbsp;{{ $task->description }}</span><br/>
                            <span style="font-size: 1.1em"><strong style="text-transform: uppercase">Category :</strong> &nbsp;&nbsp;{{ TaskCategory::where('categorycode', $task->taskCategory)->pluck('categoryname') }}</span><br/>
                            <span style="font-size: 1.1em"><strong style="text-transform: uppercase">Hiring Type :</strong> &nbsp;&nbsp;{{ $task->hiringType }}</span><br/>
                            <span style="font-size: 1.1em"><strong style="text-transform: uppercase">Cancelled at :</strong> &nbsp;&nbsp;{{ $task->cancelled_at }}</span><br/>
                        </div>
                    </div>
                </div><br/>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop