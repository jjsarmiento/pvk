@extends('layouts.usermain')

@section('title')
    PROVEEK SYSTEM SETTINGS
@stop

@section('user-name')
@stop

 @section('head-content')
    <style type="text/css">
        body{
            background-color:#E9EAED;
        }
        section{
            background: url("../frontend/img/slideshow/10admin.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            height: auto;
            min-height: 100%;
        }
        @media (max-width: 767px){
            .breadcrumb {
                margin-top:50px;
            }
        }
    </style>
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
                    <li class="active">
                        Add Subscription for {{$user->fullName}}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="widget-container fluid-height padded">
                    <div class="widget-content">
                        <h3>{{$user->fullName}}</h3>
                        @if($sub)
                            Current subscription : {{$sub->subscription_label}}<br/>
                                Subscription Start date : {{$sub->expires_at}}<br/>
                            Subscription Expiration date : {{$sub->created_at}}<br/>
                            @if($sub->expired)
                                <span class="badge" style="background-color: red">EXPIRED</span><br/>
                            @endif

                            <br/>
                            <a href="#" data-message="Are you sure you want to remove subscription for {{$user->fullName}}" data-href="/RMVSBSCRPTN={{$sub->user_sub_id}}" class="a-validate btn btn-danger">Remove Subscription</a>
                        @else
                            User is not subscribed to any subscription
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="widget-container fluid-height padded">
                    <div class="widget-content">
                        <div class="row">
                            <form method="POST" action="doAddSubscription">
                                <input type="hidden" name="user_id" value="{{$user->id}}" />
                                @foreach($sys_subs as $s)
                                    <div class="col-md-12">
                                        <h4>
                                            <input required="required" type="radio" class="" name="subs" value="{{$s->id}}" title="{{$s->subscription_label}}" />
                                            {{$s->subscription_label}}
                                        </h4>
                                    </div>
                                @endforeach
                                @if(!$sub)
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Apply Subscription</button>
                                    </div>
                                @else
                                    <div class="col-md-12" style="font-weight: bold;">
                                        <i class="fa fa-info-circle" style="color: #E67E22; font-size: 1.3em;"></i>
                                        User has existing subscription<br/>
                                        Remove current subscription to apply a new one<br/>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop