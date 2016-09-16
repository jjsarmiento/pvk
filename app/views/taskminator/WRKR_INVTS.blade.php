@extends('layouts.usermain')

@section('title')
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
        }

        /*.hrLine*/
        /*{*/
            /*background:none;*/
            /*border:0;*/
            /*border-bottom:1px solid #2980b9;*/
            /*min-width: 100%;*/
            /*height:1px;*/
        /*}*/

        .applicant-container {
            min-height: 1em;
            border-bottom:
            #ECF0F1 1px solid;
            /*transition: 0.3s;*/
        }

        .applicant-container:hover {
            background-color: #F0FFFF;
        }

        .block-update-card {
                padding: 0.8em;
              height: 100%;
              border: 1px #FFFFFF solid;
              /*width: 380px;*/
              float: left;
              /*margin-left: 10px;*/
              /*margin-top: 0;*/
              /*padding: 0;*/
              box-shadow: 1px 1px 8px #d8d8d8;
              background-color: #FFFFFF;
            }
            .block-update-card .h-status {
              width: 100%;
              height: 7px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .v-status {
              width: 5px;
              height: 80px;
              float: left;
              margin-right: 5px;
              background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
            }
            .block-update-card .update-card-MDimentions {
              width: 80px;
              height: 80px;
            }
            .block-update-card .update-card-body {
              margin-top: 10px;
              margin-left: 5px;
            }
            .block-update-card .update-card-body h4 {
              color: #737373;
              font-weight: bold;
              /*font-size: 13px;*/
            }
            .block-update-card .update-card-body p {
              color: #737373;
              font-size: 12px;
            }
            .block-update-card .card-action-pellet {
              padding: 5px;
            }
            .block-update-card .card-action-pellet div {
              margin-right: 10px;
              font-size: 15px;
              cursor: pointer;
              color: #dddddd;
            }
            .block-update-card .card-action-pellet div:hover {
              color: #999999;
            }
            .block-update-card .card-bottom-status {
              color: #a9a9aa;
              font-weight: bold;
              font-size: 14px;
              border-top: #e0e0e0 1px solid;
              padding-top: 5px;
              margin: 0px;
            }
            .block-update-card .card-bottom-status:hover {
              background-color: #dd4b39;
              color: #FFFFFF;
              cursor: pointer;
            }

            /*
            Creating a block for social media buttons
            */
            .card-body-social {
              font-size: 30px;
              margin-top: 10px;
            }
            .card-body-social .git {
              color: black;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .twitter {
              color: #19C4FF;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .google-plus {
              color: #DD4B39;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .facebook {
              color: #49649F;
              cursor: pointer;
              margin-left: 10px;
            }
            .card-body-social .linkedin {
              color: #007BB6;
              cursor: pointer;
              margin-left: 10px;
            }
        .breadcrumb, .panel-heading, .heading{
            background-color: rgba(245,245,245,0.7) !important;
        }
        .breadcrumb>li{
            color: !important;
        }

    </style>
@stop

@section('content')
<section>
    <div class="container lato-text">

        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                </li>
                <li class="lato-text">
                    Invites
                </li>
            </ul>
        </div>

        <div class="col-md-3">
            <div class="widget-container stats-container" style="display:block !important;">
                <div class="col-lg-12 lato-text">
                    <div class="number" style="color:#2980b9;">
                        <i class="fa fa-globe"></i>
                        {{ $jobs->count() }}
                    </div>
                    <div class="text" style="color:#2980b9;">
                        Invites
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @if($jobs->count() != 0)
                @foreach($jobs as $job)
                    <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style=" word-wrap: break-word; padding-left:1em; padding-right:10px; min-height: 1em; max-height: 10">
                        <div style="display:flex;padding-bottom:5px;">
                            <div style="flex:11;">
                                <a href="/jbdtls={{$job->job_id}}" style="text-decoration:none;">
                                    <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                        {{ $job->title}}
                                    </h3>

                                    <div class="row" style="color:#95A5A6;">
                                        <div class="col-md-4">
                                            <span style="padding:0;margin:0;">
                                                <i class="fa fa-briefcase"></i>
                                                @if($job->hiring_type == 'LT6MOS')
                                                    Less than 6 months
                                                @else
                                                    Greater than 6 months
                                                @endif
                                            </span><br>
                                            <span class="text-right" style="padding:0;margin:0;">
                                                @if($job->expired)
                                                    <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                                @else
                                                    <i class="fa fa-clock-o"></i> Expires at {{ date('m/d/y', strtotime($job->expires_at)) }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="col-md-8">
                                            <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                            @if($job->salary)
                                                <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            @else
              <div class="widget-container stats-container padded">
                <center><i>
                    No Jobs posted yet.<br/>
                    <!-- Click <a href="/createJob">here</a> to create jobs! -->
                </i></center>
              </div>
            @endif
        </div>
    </div>
</section>
@stop