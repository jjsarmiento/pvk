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
                        <a href="/"><i class="fa fa-home"></i></a>
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
            <div class="col-md-4">
                <div class="widget-container stats-container" style="display:block !important;">
                    <div class="col-lg-6 lato-text">
                        <a id="APPLICANTSLINK" href="/WORKERDOCUMENTS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-file"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Worker Doc Types
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-6 lato-text">
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
                <br/>

                <div class="widget-container stats-container" style="display:block !important;">
                    <div class="col-lg-6 lato-text">
                        <a id="APPLICANTSLINK" href="/TOS" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-gavel"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Terms of Service
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 lato-text">
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
                <br/>

                <div class="widget-container" style="min-height: 1em;">
                    <div class="widget-content padded">
                        <h3>Subscriptions</h3>
                        @foreach($subscriptions as $s)
                            <a href="/subscriptions:{{$s->id}}">{{$s->subscription_label}}</a><Br/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop