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
        @media(max-width: 767px){
            ul.breadcrumb {
                margin-top: 50px;
            }            
        }
        @media (max-width: 320px){
            .text {
                font-size: 13px;
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
                    <li class="active">
                        System Settings
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="doSYSTEMSETTINGS">
                            <form method="POST" action="doSYSTEMSETTINGS">
                                <div class="widget-container" style="min-height: 1em;">
                                    <div class="widget-content padded">
                                        <div class="row">
                                            @foreach($SYS_SETTINGS as $sys)
                                                @if($sys->type == "SYSSETTINGS_POINTSPERAD")
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Job Ad creation cost (POINTS)</label>
                                                            <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_POINTSPERAD" id="SYSSETTINGS_POINTSPERAD" type="text" class="form-control" placeholder="POINTS" />
                                                        </div>
                                                    </div>
                                                @elseif($sys->type == 'SYSSETTINGS_REPOST_POINTSPERAD')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Repost Expired Job Ad creation cost (POINTS)</label>
                                                            <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_REPOST_POINTSPERAD" id="SYSSETTINGS_REPOST_POINTSPERAD" type="text" class="form-control" placeholder="POINTS" />
                                                        </div>
                                                    </div>
                                                @elseif($sys->type == "SYSSETTINGS_JOBADDURATION")
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Duration of Job Ad after creation (HOURS)</label>
                                                            <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_JOBADDURATION" id="SYSSETTINGS_JOBADDURATION" type="text" class="form-control" placeholder="Job ad duration" />
                                                        </div>
                                                    </div>
                                                @elseif($sys->type == "SYSSETTINGS_CHECKOUTPRICE")
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Checkout Price of Workers (POINTS)</label>
                                                            <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_CHECKOUTPRICE" id="SYSSETTINGS_CHECKOUTPRICE" type="text" class="form-control" placeholder="Job ad duration" />
                                                        </div>
                                                    </div>
                                                @elseif($sys->type == 'SYSSETTINGS_FREE_SUB_ON_REG')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Free package upon registration (Employers)</label>
                                                            <select class="form-control" name="SYSSETTINGS_FREE_SUB_ON_REG">
                                                                <option value="0">None</option>
                                                                @foreach($subs as $s)
                                                                    <option <?php if($sys->value == $s->id){echo 'selected';} ?> value="{{$s->id}}">{{$s->subscription_label}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @elseif($sys->type == 'SYSSETTINGS_FDBACK_INIT')
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Days before initializing feedback</label>
                                                            <input value="{{$sys->value}}" required="required" name="SYSSETTINGS_FDBACK_INIT" id="SYSSETTINGS_FDBACK_INIT" type="text" class="form-control" placeholder="Feedback delay (days)" />
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-danger" style="border-radius: 0.3em;">Save</button>
                                </div>
                            </form>
                </form>
            </div>
            <br>
            <div class="col-md-4">
                <div class="widget-container stats-container" style="display:block !important; margin: 0px 0px 20px;">
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/WORKERDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Worker Doc Types
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="INVITEDSLINK" href="/COMPANYDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Company Doc Types
                            </div>
                        </a>
                    </div>
                </div>

                <div class="widget-container stats-container" style="display:block !important; margin: 0px 0px 20px;">
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/TOS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-gavel"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Terms of Service
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6 lato-text">
                        <a id="APPLICANTSLINK" href="/POLICY" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-eye"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Policy
                            </div>
                        </a>
                    </div>
                </div>

                <div class="widget-container" style="min-height: 1em;">
                    <div class="widget-content padded">
                        <h3>Subscriptions<a class="btn btn-success" href="/CREATE_SUBSCRIPTION">CREATE SUBSCRIPTION</a></h3>
                        @if($subscriptions->count() > 0)
                            <table class="table table-condensed table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Label</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptions as $s)
                                        <tr>
                                            <td><a href="/subscriptions:{{$s->id}}">{{$s->subscription_code}}</a></td>
                                            <td><a href="/subscriptions:{{$s->id}}">{{$s->subscription_label}}</a></td>
                                            <td>
                                                <a href="#" data-message="Are you sure you want to delete the {{$s->subscription_code}} subsctiption?" class="a-validate" data-href="/deleteSubscription:{{$s->id}}"><i class="fa fa-trash" title="Delete Subscription"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <center>N/A</center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop