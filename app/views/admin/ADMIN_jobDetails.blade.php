@extends('layouts.usermain')

@section('title')
    Company Clients
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
        .accordion-toggle
        {
            text-decoration: none !important;
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
            h1.lato-text {
                margin-top: 40px;
            }
        }
        .widget-content.padded {
            color: white;
        }
        .well {
        background-color: #3e3e3e !important;
        border: 1px solid #5b5b5b !important;
        }
        /*-----------------*/
        .nmes{
            color: #ddd;
            transition: 0.3s;
        }
        a.nmes:hover{
            color: white;
        }
        @media(max-width: 991px){
            .mobInvApp{
                margin-top:20px;
            }
            .mobINV{
                margin-top: 0px !important;
            }
            .widget-container {
                min-height: auto;
            }
        }
        @media(max-width: 767px){
            .mobINV{
                margin-top:20px !important;
            }
        }
        .mobINV{
                margin-top:20px;
            }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('.DELETE_JOB_BTN').click(function(){
                if(confirm('Do you want to delete this job advertisement?')){
                    location.href = $(this).data('href');
                }
            })
        })
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop
 -->
@section('content')
<section>
    <div class="container lato-text">
        <div class="page-title">
            <h1 class="lato-text">
                Job Advertisements
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
                        Job Ads
                    </li>
                </ul>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="widget-container">
                    <div class="widget-content padded">
                        <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:white;">
                            {{ $job->title}}
                            @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR', 'SUPER_ADMIN'], Auth::user()->id))
                                <a href="#" data-href="/ADMIN_DELETEJOB={{$job->id}}" type="button" class="close DELETE_JOB_BTN" style="opacity: 100;">
                                    <i class="fa fa-trash" style="background-color: #C0392B; color: white; border: 1px solid #C0392B; padding: 0.3em; border-radius: 0.2em;"></i>
                                </a>
                            @endif
                        </h3>
                        <span class="text-right" style="padding:0;margin:0; color:#ccc;">
                            Created at {{ date('m/d/y', strtotime($job->created_at)) }} by <a style="color:#68c3ff;" href="/{{$job->username}}">{{$job->fullName}}</a>
                        </span>
                        <br/><br/>
                        <div class="row" style="text-align: left">
                            <div class="col-md-5">
                                <b style="font-size: 17px;">Job Description :</b><br>
                                {{ $job->description }}
                            </div>

                            <div class="col-md-7">
                                <div class="col-md-4"><b>Duration</b></div>
                                <div class="col-md-8">
                                    @if($job->hiring_type == 'LT6MOS')
                                        Less than 6 months
                                    @else
                                        Greater than 6 months
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <b>Skill Category</b>
                                </div>
                                <div class="col-md-8">
                                    {{ $job->categoryname }}
                                </div>

                                <div class="col-md-4">
                                    <b>Skill</b>
                                </div>
                                <div class="col-md-8">
                                    {{ $job->itemname }}
                                </div>

                                <div class="col-md-4">
                                    <b>Location</b>
                                </div>
                                <div class="col-md-8">
                                    {{ $job->cityname }}, {{ $job->bgyname }}<br/>
                                    {{ $job->regname }}
                                </div>

                                <div class="col-md-4">
                                    <b>Salary</b>
                                </div>
                                <div class="col-md-8">P{{ $job->salary }}</div>

                                <div class="col-md-12" style="margin-top:20px;">
                                    <label>Other Skills</label><br/>
                                    @foreach($custom_skills as $cs)
                                        <span class="badge" style="white-space: pre-wrap; text-align: left; line-height: 15px !important;">{{$cs->skill}}</span>
                                    @endforeach
                            </div>

                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12 well">
                                    <label>Requirements</label><br/>
                                    {{$job->requirements}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mobInvApp">
                <div class="widget-container">
                    <div class="widget-content padded">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <h4>List of Applicants</h4>
                            <ul>
                                @for($i=0; $i<5; $i++)
                                    <li style="margin-left:-15px;"><a class="nmes" href="#">Lorem Ipsum Sample Name</a><br></li>
                                @endfor
                            </ul>
                        </div>
                        <div class="mobINV col-md-12 col-sm-6 col-xs-12">
                            <h4>Invited Lists</h4>
                            <ul>
                                @for($i=0; $i<5; $i++)
                                    <li  style="margin-left:-15px;"><a class="nmes" href="#">Lorem Ipsum Sample Name</a><br></li>
                                @endfor
                            </ul>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@stop