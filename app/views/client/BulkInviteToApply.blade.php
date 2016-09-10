@extends('layouts.usermain')

@section('title')
    Bulk Invite | Proveek
@stop

@section('head-content')
<style type="text/css">
    body{background-color:#E9EAED;}
    hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
    a{text-decoration: none !important;}
</style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#btn_send').click(function(){
                if($('.multi_jobs:checked').length > 0){
                    $('#INVITEMULTIJOB_message').val($('#invite_message').val());
                    $('#FORM_BULK_INVITE').submit();
                }else{
                    alert('Please pick a job for the invite to be sent');
                }
            });
        });
    </script>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section class="lato-text">
    <div class="container">
        <div class="page-title">
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="widget-container fluid-height padded">
                    <div class="widget-content">
                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                            <a href="/{{$worker->username}}">
                                @if(in_array($worker->userID, $CHECKED_OUT_USERS))
                                    {{$worker->firstName }} {{$worker->lastName}}
                                @else
                                    {{substr_replace($worker->firstName, str_repeat('*', strlen($worker->firstName)-1), 1)}}
                                    &nbsp;
                                    {{substr_replace($worker->lastName, str_repeat('*', strlen($worker->lastName)-1), 1)}}
                                @endif
                            </a>
                        </h3>
                        <br/>
                        <textarea class="form-control" id="invite_message">Hi! We would like for you to apply for the job!</textarea>
                        <br/>
                        <button class="btn btn-success" id="btn_send">Send Invite</button>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">

                </div>
                @if($all_jobs->count() > 0)
                    <form method="POST" action="/INVITEMULTIJOB" id="FORM_BULK_INVITE">
                        <input type="hidden" name="workerID" value="{{$worker->id}}" />
                        <input type="hidden" name="INVITEMULTIJOB_message" id="INVITEMULTIJOB_message" />
                        @foreach($all_jobs as $j)
                            <div class="col-md-4">
                                <div class="widget-container fluid-height padded">
                                    <div class="widget-content">
                                        <h4><input type="checkbox" class="multi_jobs" name="INVITEMULTIJOB_jobID[]" value="{{$j->id}}"/> &nbsp; {{$j->title}}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </form>
                @else
                    <center><i>No jobs available</i></center>
                @endif
            </div>
        </div>
    </div>
</section>
@stop