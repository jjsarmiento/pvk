@extends('layouts.usermain')

@section('title')
    {{ $user->fullName }}
@stop

<!-- @section('user-name')
    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
@stop
 -->

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

        .heading {
            background: rgba(3, 127, 180, 0.5) !important;
            border-radius: 5px;
            margin-bottom: 10px !important;
            color: white !important;
            height: 55px !important;
        }
        .col-sm-12 > img{
            width: 260px;
        }
        span b, li b {
            color:white;
        }
        @media (max-width: 360px) {
            .col-sm-12.mob{
                padding: 0px;
            }
            .breadcrumb {
                margin-top: 50px;
            }
        }
        /*-----------------*/
    </style>
@stop

@section('content')
<section  class="lato-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/" style="cursor: pointer;"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        {{ $user->companyName }}'s Profile
                    </li>
                </ul>
            </div>

            <div class="col-sm-12">
                <div class="widget-container fluid-height">
                    <div class="widget-content" style="padding-bottom: 30px">
                        <div class="col-sm-12" style="text-align: center; align-content: center; align-items: center;">
                            <br/>
                            @if($user->profilePic)
                                <img src="{{$user->profilePic}}" width="90%" style="border-radius: 0.6em; box-shadow: 0 0 10px 1px #7F8C8D;" />
                            @else
                                <img src="/images/default_profile_pic.png" width="90%" style="border-radius: 0.6em; box-shadow: 0 0 10px 1px #7F8C8D;" />
                            @endif
                            <h3 style="margin-top: 1em; color:white; font-weight:bold;" class="lato-text">{{ $user->companyName }}</h3>
                            <br/>

                            @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR', 'SUPER_ADMINISTRATOR'], Auth::user()->id))
                                @if($user->status == 'PRE_ACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Fully Activate Account</a><br/>
                                    <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                @elseif($user->status == 'ACTIVATED')
                                    <a href="/adminDeactivate/{{$user->id}}" class="btn btn-danger">Deactivate Account</a><br/>
                                @elseif($user->status == 'DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @elseif($user->status == 'SELF_DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @elseif($user->status == 'ADMIN_DEACTIVATED')
                                    <a href="/adminActivate/{{$user->id}}" class="btn btn-success">Activate Account</a><br/>
                                @endif
                                <br/>
                            @endif

                            <a href="/allJobAds_user/{{$user->id}}" class="btn btn-primary">View all Job Ads for this user</a>
                            {{--<a href="/viewUsersTasks/{{$user->id}}" class="btn btn-primary">View all tasks for this user</a>--}}
                            <br>
                            <div class="col-md-12" style="color: white; padding: 15px 15px 30px;">
                                <i class="fa fa-diamond"></i>&nbsp;
                                <!-- <span id="USR_POINTS">{{ Auth::user()->points }}</span> -->
                                <span id="USR_POINTS">0</span>
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-12 mob">
                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-info-sign"></i>General Information
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    <span><b>Business Description: </b>{{$user->businessDescription}}</span><br>
                                    <span><b>Business Nature:</b> {{$user->businessNature}}</span><br>
                                    <span><b>Business Permit:</b> {{$user->businessPermit}}</span><br>
                                    <span><b>Business Address:</b> {{ $address }} - {{ $user->address }} </span><br>
                                    <span><b>Years in Operation:</b> {{$user->years_in_operation}}</span><br>
                                    <span><b>Number of Branches:</b> {{$user->number_of_branches}}</span><br>
                                    {{--<span><b>Description:</b> Client Company Description</span><br>--}}
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-map-marker"></i>Account Information
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    <span><b>Date Created: </b>{{Auth::user()->created_at}}</span><br>
                                    <span><b>Account Status: </b>{{Auth::user()->status}}</span>
                                </div>
                                <br>
                                <div class="heading" style="font-size:14pt;">
                                    <i class="fa fa-file-text-o" style="margin-right: 10px;"></i>License
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    @if($lisc->count() > 0)
                                        @foreach($lisc as $l)
                                            <span><i class="fa fa-check-circle" style="color: #2ECC71;"></i>&nbsp;{{$l->label}}</span><br/>
                                        @endforeach
                                    @else
                                        <center>N/A</center>
                                    @endif
                                    {{--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</span>--}}
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <hr class="hrLine" />


                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-phone"></i>Contact Details
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    @foreach(Contact::where('user_id', $user->id)->get() as $conts)
                                        <span style="text-transform: capitalize; color: white; margin-right: 5px;"><b>{{ $conts->ctype }}</b></span>
                                         : {{ $conts->content }}<br/>
                                    @endforeach
                                </div>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-phone"></i>Key Person
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    <span><b>Name: </b></span> {{(@$cperson->name) ? $cperson->name : 'N/A' }}<br>
                                    <span><b>Position: </b></span> {{ (@$cperson->position) ? $cperson->position : 'N/A' }}<br>
                                    <span><b>Contact #: </b></span> {{ (@$cperson->contact_number) ? $cperson->contact_number : 'N/A' }}<br>
                                    <span><b>Email: </b> {{ (@$cperson->email) ? $cperson->email : 'N/A' }}</span>
                                </div>
                            </div>

                            <div style="clear:both;"></div>
                            <hr class="hrLine" />


                            <div class="col-md-6" style="color: #ffffff">
                                <div class="heading">
                                    <i class="glyphicon glyphicon-folder-open"></i>Supporting Documents
                                </div>
                                <div style="padding: 0 35px;">
                                    @if($docs->count() == 0)
                                        <i>No data available.</i><br/>
                                    @else
                                        @foreach($docs as $doc)
                                            <i class="glyphicon glyphicon-download" style="top: 2px;"></i> &nbsp;&nbsp;<a style="color: #ffffff" href="/{{ $doc->path }}">{{ $doc->label }}</a><br/>
                                        @endforeach
                                    @endif
                                </div>
                                <br>
                            </div>
                            <!--
                            <div class="col-md-6" style="color:white;">
                                <div class="heading">
                                    <i class="glyphicon glyphicon-folder-open"></i>Photos
                                </div>
                                <div style="padding: 0 35px;">
                                    @if($photos->count() == 0)
                                        <i>No data available.</i><br/>
                                    @else
                                        @foreach($miscDocs as $misc)
                                            <i class="glyphicon glyphicon-download" style="top: 2px;"></i> &nbsp;&nbsp;<a href="{{ $misc->path }}">{{ $misc->name }}</a><br/>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>


@stop