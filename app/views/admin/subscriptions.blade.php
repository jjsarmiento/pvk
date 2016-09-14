@extends('layouts.usermain')

@section('title')
    PROVEEK SYSTEM SETTINGS - SUBSCTIPTIONS
@stop

@section('user-name')
@stop

 @section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
        /* Added by Jups */
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: auto;
            min-height: 100%;
        }
        h1.lato-text{
            color: white;
        }
        .widget-container{
            background-color: rgba(245,245,245,0.3);
        }
        .breadcrumb, .panel-heading{
            background-color: rgba(245,245,245,0.7);
        }
        .breadcrumb>li{
            color: white !important;
        }
        a.sidemenu {
            color: white;
        }
        a.sidemenu:hover {
            transition: 0.3s;
            color: #d9d9d9;
            text-decoration: none;
        }
        .widget-container.padded {
            color: white;
        }
        @media(max-width: 767px){
            ul.breadcrumb {
                margin-top: 50px;
            }            
        }
        /*-----------------*/
    </style>
    <script>
        $(document).ready(function() {
            $('.DELETE_DOC_BTN').click(function(){
                if(confirm('Do you really want to delete this document type? ALL DOCUMENT IN RELATION WILL ALSO BE DELETED')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="">
                        <a href="/SYSTEMSETTINGS">System Settings</a>
                    </li>
                    <li class="active">
                        {{$sub->subscription_label}} Subscription
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="/UPDATESUBSCRIPTION">
                <input type="hidden" value="{{$sub->id}}" name="subID" />
                <div class="col-md-6">
                    <div class="widget-container padded">
                        <div class="widget-content">
                            <div class="form-group">
                                <label>Subscription Code</label>
                                <input required="required" type="text" value="{{$sub->subscription_code}}" name="subscription_code" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Subscription Label</label>
                                <input required="required" type="text" value="{{$sub->subscription_label}}" name="subscription_label" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Subscription Duration (Days)</label>
                                <input required="required" type="text" value="{{$sub->subscription_duration}}" name="subscription_duration" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Subscription Price</label>
                                <input required="required" type="text" value="{{$sub->subscription_price}}" name="subscription_price" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Worker Bookmark Limit per week</label>
                                <input required="required" type="text" value="{{$sub->worker_bookmark_limit}}" name="worker_bookmark_limit" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Invitation Limit per week</label>
                                <input required="required" type="text" value="{{$sub->invite_limit}}" name="invite_limit" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="widget-container padded">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Browser Workers </label><br/>
                                        <label class="radio-inline"><input required="required" <?php if($sub->worker_browse){echo 'checked';} ?> type="radio" name="worker_browse" value="1">Enable</label>
                                        <label class="radio-inline"><input required="required" <?php if(!$sub->worker_browse){echo 'checked';} ?> type="radio" name="worker_browse" value="0">Disable</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bulk Invite </label><br/>
                                        <label class="radio-inline"><input required="required" <?php if($sub->bulk_invite){echo 'checked';} ?> type="radio" name="bulk_invite" value="1">Enable</label>
                                        <label class="radio-inline"><input required="required" <?php if(!$sub->bulk_invite){echo 'checked';} ?> type="radio" name="bulk_invite" value="0">Disable</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Job Ad Limit per week</label>
                                <input required="required" type="text" value="{{$sub->job_ad_limit_week}}" name="job_ad_limit_week" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Job Ad Limit per month</label>
                                <input required="required" type="text" value="{{$sub->job_ad_limit_month}}" name="job_ad_limit_month" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Quantity of Featured Job Ads</label>
                                <input required="required" type="text" value="{{$sub->featured_job_ads}}" name="featured_job_ads" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>SMS Notification</label><br/>
                                <label class="radio-inline"><input required="required" <?php if($sub->sms_notif){echo 'checked';} ?> type="radio" name="sms_notif" value="1">Enable</label>
                                <label class="radio-inline"><input required="required" <?php if(!$sub->sms_notif){echo 'checked';} ?> type="radio" name="sms_notif" value="0">Disable</label>
                            </div>
                            <div class="form-group">
                                <label>Free Worker Resumes</label>
                                <input required="required" type="text" value="{{$sub->free_resume}}" name="free_resume" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop