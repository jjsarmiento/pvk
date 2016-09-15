@extends('layouts.usermain')

@section('title')
    {{ $pageName }}
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

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
<!--     {{ HTML::script('js/jquery-1.11.0.min.js') }} -->
    <script>
        $(document).ready(function(){
        });
    </script>
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                {{ $pageName }}
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
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
                                Inquiries</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/inquiry-messages" class="sidemenu">Messages</a><br>
                        </div>                         
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
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                @if($tasks->count() == 0)
                    <div class="well selected-filters" style="text-align: center">
                        <font style="color: red">No data available.</font>
                    </div>
                @else
                    @foreach($tasks as $task)
                        <div class="widget-container" style="min-height: 150px; padding-bottom: 5px;">
                            <div class="widget-content padded">
                                <div>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Name</span>
                                     : <span style="margin-left: 5px"><a target="_tab" href="/admin/taskDetails/{{$task->id}}">{{ $task->name }}</a></span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">By</span>
                                     : <span style="margin-left: 5px"><a target="_tab" href="/viewUserProfile/{{User::where('id', $task->id)->pluck('id')}}">{{ User::where('id', $task->id)->pluck('fullName') }}</a></span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Work Time</span>
                                     : <span style="margin-left: 5px">{{ $task->workTime }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Created at</span>
                                     : <span style="margin-left: 5px">{{ $task->created_at }}</span><br/>
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Status</span>
                                     : <span style="margin-left: 5px">{{ $task->status }}</span>
                                </div>
                            </div>
                        </div><br/>
                    @endforeach
                    <center>{{ $tasks->links() }}</center>
                @endif

            </div>
        </div>
    </div>
</section>

{{--MODAL START--}}
{{--MODAL END--}}

@stop