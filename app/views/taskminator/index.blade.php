@extends('layouts.usermain')

@section('title')
    Proveek | Dashboard
@stop

@section('head-content')
<style>
    #progressbar {
        background-color: #f6f6f6;
        border-radius: 13px; /* (height of inner div) / 2 + padding */
        padding: 3px;
        border:1px solid #2980b9;
        display:flex;
    }
        
    #progressbar > #prog-meter-req {
        background-color: #2980b9;
        animation-name: reqProgress;
        animation-duration: 3s;
        height: 20px;
        border-radius: 10px;
        max-width: 100%;
        width:{{ Auth::user()->total_profile_progress }}%;
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    /*
    #progressbar > #prog-meter-opt {
        background-color: orange;
        animation-name: optProgress;
        animation-duration: 3s;
        height: 20px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        max-width: 30%;
        width:{{ $PROFILE_PROG['OPTIONAL_PROGRESS'] }}%;
    }
    */

    @keyframes reqProgress {
    from {width:0%;}
    to {width:{{Auth::user()->total_profile_progress}}%;}

    }

    {{--@keyframes optProgress {--}}
    {{--from {width:0%;}--}}
    {{--to {width:{{ $PROFILE_PROG['OPTIONAL_PROGRESS'] }}%;}--}}
    {{--}--}}


    body{background-color:#E9EAED;}
    .accordion-toggle
    {
        text-decoration: none !important; 
    }

    h5 {
        margin: 0;
    }


    .link-btn
    {
        border:1px solid #2980b9;
        border-radius: 4px;
        background-color: white;
        color: #2980b9 !important;
    }

    .link-btn:hover
    {
        background-color:#2980b9;
        color:white !important;
    }
    .hrLine
    {
        background:#ccc;
        max-width:100%;
        border:none;
        height:1px;
        max-height:1px;
    }
    a.clickHere {
        background: transparent;
        border: 2px solid #2980b9;
        color: #2980b9;
        border-radius: 5px;
        padding: 5px 15px;
        font-size: 15px !important;
        text-transform: uppercase;
    }
    a.clickHere:hover {
        background-color: #2980b9;
        border: 2px solid #226ea0;
        transition : 0.3s;
        color:white;
        text-decoration: none;
    }
    a.viewSal{
        background-color: #2980b9;
        border: 2px solid #226ea0;
        transition: 0.3s;
        color: white; 
        padding: 5px;      
        text-transform: uppercase; 
        font-size: 14px;
    }
    a.viewSal:hover{
        background: transparent;
        color: #2980b9;
        text-decoration: none;
    }
    .btn.btn-xs.btn-default.pull-right {
        color: #2980b9;
        border: 1px solid #2980b9;
        border-radius: 3px;
    }  
    .btn.btn-xs.btn-default.pull-right:hover {
        color: white;
    }   
    .thumbnail {
        border: 0px solid #ddd !important;
        margin-bottom: 0;
        padding:15px;
        width: 120px;
        height: 120px;
        margin:auto;
    }
    .thumbnail img {
        border-radius: 60px;
        border: 1px solid #ddd;
    }
    @media (max-width: 768px) {
        .padded {
            padding: 0px 15px 15px;
        }
        .col-lg-6.lato-text.col-xs-12.id2 {
            margin-top: 2px !important;
            background: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

    }
    @media (max-width: 320px) {
        a.clickHere {
            font-size: 12px !important;
        }
        .padded {
            font-size: 19pt !important;
        }
    }
    li {
        font-size: 17px;
        line-height: 1.7em;
    }
    p.content{
        margin-bottom: 10px !important;
    }
    img.portrait.dp{
        width: 90px;
        height: 90px;
    }
</style>

<script>
    $(document).ready(function(){
        CHAINLOCATION($('#reg-task'), $('#edt_prov'));
        CHAINLOCATION($('#reg-task'), $('#city-task'));
        CHAINLOCATION($('#city-task'), $('#barangay-task'));

        // DELETE DOCUMENT LISTENER
        $('.ANCHOR_DELETE_DOC').click(function() {
            if(confirm('Do you really want to delete '+$(this).data('docname'))){
                location.href = $(this).data('href');
            }
        })
    });
</script>
@stop


@section('content')
<section>
    <div class="container main-content lato-text">
        <!-- Statistics -->
        <div class="row">
<!-- PROFILE PIC / INFO  -->
            <div class="col-lg-4"> 
                <div class="widget-container" style="display:flex; min-height:120px; display:block !important;">
                    <div class="col-md-4" style="">
                        <div class="thumbnail">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait dp"/></a><br>
                            @else
                                <a href="/editProfile"><img src="/images/default_profile_pic.png" class="portrait dp"/></a><br>
                            @endif
                        </div>                            
                    </div>
                    <div class="col-md-8 padded">
                        <div class="heading" style="height:auto; padding: 5px 0 5px 0;">
                            <a href="/editProfile" style="font-weight:bold; font-size:14pt; line-height: 1em;">{{ Auth::user()->fullName }}</a><br>
                        </div>
                        <!-- <span><b>Employment Status:</b> Not Hired</span><br> -->
                        <span><b>Last Login:</b> {{@$LAST_LOGIN}}</span>
                    </div>
                    <!-- <div class="col-lg-12" style="padding-left:24px;">
                        <a href="/editProfile">Edit Profile</a>
                    </div> -->
                </div>
                <br/>
                <div class="widget-container fluid-height">
                    @if(Auth::user()->total_profile_progress >= 50)
                        <a href="/jobSearch:NO_KW_INPT:ALL:ALL:ALL:ALL:ALL:DESC" class="btn btn-primary btn-block" style="border-radius: 0.3em;">
                            <i class="fa fa-search"></i> Click here to search for jobs
                        </a>
                    @else
                        <button disabled="true" class="lato-text btn btn-default btn-trans" style="text-transform: none; border:1px solid #2980b9; width:100%; border-radius: 4px;" type="button">Please complete atleast 50% of profile</button>
                    @endif
                </div>

                <br>
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <div class="padded" style="color:#2980b9; font-size:20pt;">
                                            <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : <a href="/wprofileProgress" style="font-weight: bold">{{ Auth::user()->total_profile_progress }}%</a>

                                            <div class="padded text-center" style="padding:10px 0 0; color:#2980b9; font-size:18pt;">
                                                <div id="progressbar">
                                                    <div id="prog-meter-req"></div>
                                                    <div id="prog-meter-opt"></div>
                                                </div>
                                                <div style="text-align:left; font-size:12pt; display:flex;">
                                                    <div style="width:20%;">0%</div>
                                                    <div style="width:20%;">20%</div>
                                                    <div style="width:20%; text-align:center;">50%</div>
                                                    <div style="width:20%; text-align:right;">80%</div>
                                                    <div style="width:20%; text-align:right;">100%</div>
                                                </div>
                                                <span style="font-size:10pt;"></span>
                                            </div>
                                            <p style="color: #000000; margin-top: 5px;">
                                                @if(Auth::user()->total_profile_progress < 50)
                                                    <i style="color: red" class="fa fa-warning"></i> <b>You can start applying for jobs when you complete your profile above 50%.</b><br><br>
                                                @endif
                                                <a class="clickHere" href="/editProfile"> Click here to edit your profile </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--GEN INFO-->

                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body">
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Personal Information <button onclick="location.href='/editPersonalInfo'" class="btn btn-xs btn-default pull-right border: 1px solid #2980b9;" style="padding: 2px 10px 2px 10px; text-transform: none; border: 1px solid #2980b9;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                        </div>     
                                        <div class="panel-body">
                                            <span><b>Address:</b> {{$user_complete_address}} {{Auth::user()->address}}</span><br>
                                            <span><b>Birthdate:</b> {{Auth::user()->birthdate}}</span><br>
                                            <span><b>Gender:</b> {{Auth::user()->gender}}</span><br>
                                            <span><b>Marital Status:</b> {{Auth::user()->marital_status}}</span><br>
                                            <!-- <span><b>Age:</b> {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::parse(Auth::user()->birthdate)) }} y/o</span><br> -->
                                            <span><b>Account Status:</b> {{Auth::user()->status}}</span><br>
                                            <span><b>Account Created:</b> {{date('m/d/y', strtotime(Auth::user()->created_at))}}</span><br>
                                        </div>  
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editContactInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                                        </div>     
                                        <div class="panel-body">
                                            @foreach(Contact::where('user_id', Auth::user()->id)->get() as $con)
                                                <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">
                                                    @if($con->ctype == "mobileNum") Mobile No.
                                                    @elseif($con->ctype == "businessNum") Business No.
                                                    @else {{ $con->ctype }} @endif
                                                </span>
                                                : <span style="margin-left: 5px">{{ $con->content }}</span>
                                                @if($con->ctype == "mobileNum")
                                                    @if(Contact::where('user_id',  Auth::user()->id)->pluck('pincode')!='verified')
                                                        {{--<button class="btn btn-xs btn-primary" onclick="location.href='/doVerifyMobileNumber'" style="padding: 2px 10px 2px 10px; margin: 5px; text-transform: none;">Verify</button>--}}
                                                    @else
                                                        {{--<span class="btn btn-xs btn-default" style=" margin: 5px;">Verified</span>--}}
                                                    @endif
                                                @endif
                                                <br/>
                                            @endforeach
                                            <!--
                                             <span><b>Email:</b> <a href="mailto:taskminator0@taskminator.com" target="_top">taskminator0@taskminator.com</a></span><br>
                                             <span><b>Facebook:</b> <a href="//facebook.com/januarystays" target="_blank">facebook.com/januarystays</a></span><br>
                                             <span><b>Linkedin:</b> <a href="//linkedin.com/sample" target="_blank">linkedin.com/sample</a></span><br>
                                             <span><b>Mobile:</b> 639276274641</span><br>
                                             -->
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CERT -->
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel">
                                <div class="panel filter-categories">
                                    <div class="panel-body" style="word-wrap: break-word; text-align: justify;">
                                        <div class="heading" style="font-size:14pt; color:#2980b9">
                                            <i class="fa fa-certificate" style="font-size:14pt; color:#2980b9"></i>&nbsp Certification <a href="/certifications" class="btn btn-xs btn-default pull-right" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                                        </div> 
                                        <div class="panel-body">
                                            @if($certs->count() > 0)
                                                @foreach($certs as $c)
                                                    <span><b>Title of Training/Certificate: </b>{{ $c->title }}</span><br>
                                                    <span><b>Date Taken: </b>{{ $c->date }}</span><br>
                                                    <span><b>Organizer/Company: </b>{{ $c->organizer_company }}</span><br>
                                                    <!-- <a href="/editCertification:{{$c->id}}" class="btn btn-success btn-xs">EDIT</a> -->
                                                    <hr/>
                                                @endforeach
                                                {{$certs->links()}}
                                            @else
                                                <center>N/A</center>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->total_profile_progress)
                    <div class="widget-container fluid-height">
                        <div class="widget-content">
                            <div class="panel-group" id="accordion">
                                <div class="panel">
                                    <div class="panel filter-categories">
                                        <div class="panel-body">
                                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                                <i class="fa fa-edit" style="font-size:14pt; color:#2980b9"></i>&nbsp Profile Progress
                                            </div>
                                            <div class="panel-body">
                                                @foreach($prof_prog as $r)
                                                    <a href="{{$r['url']}}">{{$r['content']}}</a><br/>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- ENF PROFILE PIC / INFO -->
            <!-- MAIN CONTENT STATISTICS / AVAILABLE JOBS -->
            <div class="col-lg-8">
                @if(Session::has('errorMsg'))
                    <div class="col-lg-12 no-padding" style="margin-bottom: 1em;">
                        <div class="widget-container padded" style="min-height: 1em;">
                            <div class="widget-content">
                                    <center><h4> <i class="fa fa-warning" style="color: red;"></i> {{ Session::get('errorMsg') }}</h4></center>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- END OF PROFILE  COMPLETENESS METER -->
                <div class="col-lg-12 no-padding">
                    <div class="widget-container stats-container" style="display:block !important;">
                        <div class="col-lg-6 lato-text col-xs-12 id1">
                            {{--<a href="/tskmntr_taskBids" style="text-decoration:none;">--}}
                            <a href="/WRKR_APPLCTNS" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-gavel"></i>
                                    {{ $applicationsCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Applications
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 lato-text col-xs-12 id2">
                            {{--<a href="/tskmntr_taskOffers" style="text-decoration:none;">--}}
                            <a href="/WRKR_INVTS" style="text-decoration:none;">
                                <div class="number" style="color:#2980b9;">
                                    <i class="fa fa-globe"></i>
                                    {{ $invitesCount }}
                                </div>
                                <div class="text" style="color:#2980b9;">
                                    Invites
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                        @if(Auth::user()->total_profile_progress >= 50)
                            @if($jobs->count() != 0)
                                <div class="col-lg-12 padded" style="padding-top: 25px;">
                                    <div class="col-lg-5"><hr class="hrLine"></div>
                                    <div class="col-lg-2" style="margin-top:10px;"><p style="font-size:10pt;">Available Jobs</p></div>
                                    <div class="col-lg-5"><hr class="hrLine"></div>
                                </div>
                                <br><br><br><br>
                                @foreach($jobs as $job)
                                    <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style="word-wrap: break-word; padding-left:10px; padding-right:10px; min-height: 50px;">
                                        <div style="display:flex;padding-bottom:5px">
                                            <span style="padding:0;margin:0; flex:1">
                                                <img src="{{ $job->profilePic }}" class="thumbnail" style="margin:0; width:64px; height:64px;" >
                                            </span>
                                            <div style="flex:11; padding-left: 5px;">
                                            <a href="/jbdtls={{$job->job_id}}" style="text-decoration:none;">
                                                <h3 class="lato-text" style="font-weight: bold; margin:0 !important; color:#2980b9">
                                                    {{ $job->title}} by {{ $job->fullName }}
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
                                                        <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <center><i>No jobs available.</i></center>
                            @endif
                        @endif
                        </div>
                    </div>
                </div>
                -->
            </div>

            <!--PREFERED JOB -->
            @if(Auth::user()->total_profile_progress >= 50)
                <div class="col-lg-8" style="padding-top: 19px;">
                    <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:20pt;">
                                <i class="fa fa-search" aria-hidden="true"></i> Recommended Jobs
                            </div>
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12 no-padding">
                                    @if($jobs->count() > 0)
                                        @foreach($jobs as $job)
                                            <div class="col-md-4 padded">
                                                <b class="title">{{$job->title}}</b>
                                                <p class="content">
                                                    <span style="padding:0;margin:0;">
                                                        <i class="fa fa-user"></i> {{$job->fullName}}
                                                    </span><br/>
                                                    <span style="padding:0;margin:0;">
                                                        <i class="fa fa-briefcase"></i>
                                                        @if($job->hiring_type == 'LT6MOS')
                                                            Less than 6 months
                                                        @else
                                                            Greater than 6 months
                                                        @endif
                                                    </span><br>
                                                    <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                                    @if($job->salary)
                                                        <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                                    @endif
                                                </p>
                                                <a href="/jbdtls={{$job->job_id}}" class="viewSal">View full details</a>
                                            </div>
                                        @endforeach
                                    @else
                                        <center><i>No jobs applicable to your skills!</i></center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Education -->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="widget-content">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                            <i class="fa fa-graduation-cap" style="font-size:14pt; color:#2980b9"></i> Educational Background
                            <a class="btn btn-xs btn-default pull-right" href="/editEducationalBackground" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                        </div>                        
                        <div class="panel-body" style="padding: 0 15px 15px;">
                            <div class="col-md-12">

                                @if($edu->count() > 0)
                                    @foreach($edu as $e)
                                        <div class="col-md-4" style="word-wrap: break-word;">
                                            <span><b>{{$e->level}}</b></span>
                                            <ul>
                                                <li style="font-size: 15px;"><b>School Name: </b>{{$e->school_name}}</li>
                                                @if($e->level == 'COLLEGE' || $e->level == 'VOCATIONAL')
                                                    <li style="font-size: 15px;"><b>Course/Major: </b>{{$e->course_major}}</li>
                                                @endif
                                                <li style="font-size: 15px;"><b>School Year: </b>{{$e->school_year}}</li>
                                                <li style="font-size: 15px;"><b>Awards: </b>{{$e->awards}}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @else
                                    <center>N/A</center>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Experiences/ SKILLS -->
            <div class="col-lg-8" style="padding-top: 19px;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="col-md-6">  
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-lightbulb-o" style="font-size:14pt; color:#2980b9"></i>&nbsp Experience
                                <a class="btn btn-xs btn-default pull-right" href="/editExperience" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                            </div>                        
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12">
                                    @if($exp->count() > 0)
                                        @foreach($exp as $e)
                                            <ul>
                                                <li style="font-size: 15px;"><b>Position: </b>{{$e->position}}</li>
                                                <li style="font-size: 15px;"><b>Company Name: </b>{{$e->company_name}}</li>
                                                <li style="font-size: 15px;"><b>Location: </b> {{$e->location}}</li>
                                                <li style="font-size: 15px;"><b>Time Period: </b> {{$e->time_period}}</li>
                                                <li style="font-size: 15px;"><b>Roles and Responsibilities: </b>{{$e->roles_and_resp}}</li>
                                            </ul>
                                            <hr>
                                        @endforeach
                                    @else
                                        <center>N/A</center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-star" style="font-size:14pt; color:#2980b9"></i>&nbsp Skills <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editSkillInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>                        
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12">
                                    <span>
                                        @if($customSkills->count() > 0)
                                            @foreach(User::getSkills(Auth::user()->id) as $skill)
                                                <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                                            @endforeach
                                            @foreach($customSkills as $cs)
                                                <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $cs->skill }}</span>
                                            @endforeach
                                        @else
                                            <center>N/A</center>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div> 
                    </div> 
                    <div style="clear:both;"></div>             

                </div>
            </div>

            <!-- Additional Info-->
            <div class="col-lg-8" style="padding-top: 19px; float:right;">
                <div class="widget-container" style="min-height:30px; border:1px solid #e6e6e6">
                    <div class="widget-content">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                            <i class="fa fa-file" style="font-size:14pt; color:#2980b9;"></i>&nbsp Supporting Documents
                            <a class="btn btn-xs btn-default pull-right" href="/editDocuments" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                        </div>                        
                        <div class="panel-body" style="padding: 0 15px 15px;">
                            <div class="col-md-12">
                                @if($user_docs->count() == 0)
                                    <center><i><label>No supporting documents uploaded</label></i></center>
                                @else
                                    <table class="table table-hover">
                                        <thead>
                                            <th width="50%">File</th>
                                            <th width="35%">Document Type</th>
                                            <th>Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach($user_docs as $ud)
                                                <tr>
                                                    <td><a target="_tab" href="{{$ud->path}}">{{$ud->label}}</a></td>
                                                    <td>{{$ud->sys_doc_label}}</td>
                                                    <td style="text-align: right; font-size: 1.3em;">
                                                        <a data-docname="{{$ud->label}}" title="Delete {{$ud->label}}" href="#" class="ANCHOR_DELETE_DOC" data-href="/DELETE_DOC_{{$ud->id}}" style="padding-right: 0.8em;"><i class="fa fa-trash"></i></a>
                                                        <a title="Download {{$ud->label}}" download href="{{$ud->path}}" style="padding-right: 0.8em;"><i class="fa fa-download"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$user_docs->links()}}
                                @endif
                                {{--@for($i=0; $i<=3; $i++)--}}
                                    {{--<div class="col-md-3">--}}
                                        {{--<img style="width:100%;" src="../images/sample_doc.jpg">--}}
                                        {{--<p style="text-align:center;">Sample Docx</p>--}}
                                    {{--</div>--}}
                                {{--@endfor--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- END MAIN CONTENT -->
        </div>
    </div>
</section>

<!-- FOOTER -->
    <section id="footer" class="divFooterDark" style="padding-top:40px; padding-bottom:60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-8 text-center">
                        <div class="col-lg-4">
                            <div class="col-lg-12 text-left div_footer">
                                <h2>Proveek</h2>
                                <ul style="padding-left:0">
                                    <li><a href="#page-top" class="page-scroll">Home</a></li>
                                    <li><a href="/about">About Us</a></li>
                                    <li>{{ HTML::link('/howitworks', 'How It Works')}}</li>
                                    <li>  {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}</li>
                                    <!-- //<li>{{ HTML::link('/pricing', 'Pricing')}}</li>// -->
                                    <li><a href="/faq">FAQ</a></li>
                                    <li>    {{ HTML::link('/login', 'Sign In')}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 text-left feedback_footer">
                            <form method="POST" action="/ContactUs">
                                <h2>Contact Us</h2>
                                <p>We love to hear from you. Please drop us a message.</p>
                                <div class="col-lg-12" style="padding:0;">
                                    <input type="text" name="ContactUs_name" placeholder="Name" required="required">
                                </div>
                                <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                    @if(Session::has('errorMsg'))
                                        <p><i class="fa fa-warning" style="color:#E74C3C"></i> {{Session::get('errorMsg')}}</p>
                                    @endif
                                    <input type="email" name="ContactUs_email" placeholder="Email" required="required">
                                </div>
                                <div class="col-lg-12" style="padding:15px 0 0 0 ;">
                                    <input type="text" name="ContactUs_msg" placeholder="Message" required="required">
                                </div>
                                <div class="col-lg-12 text-right" style="padding:15px 0 0 0 ;">
                                    <button type="submit" class="btn btn-primary btn-md" style="width: 120px;border-radius: 4px;">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                         <div class="col-lg-12 text-center div_footer">
                            <h2>Find Us On</h2>
                            <hr class="primary">
                            <p>
                                Stay connected to keep up with the latest news, promos and updates.
                            </p>
                            <div class="div_footer">
                                <a href="https://www.facebook.com/proveek" target="_blank"><i class="fa fa-facebook-square fa-3x wow bounceIn" data-wow-delay=".2s"></i></a>
                                <a href="https://twitter.com/Proveek" target="_blank"><i class="fa fa-twitter-square fa-3x wow bounceIn" data-wow-delay=".3s"></i></a>
                                <!-- <a href="#"><i class="fa fa-instagram fa-3x wow bounceIn" data-wow-delay=".4s"></i></a>
                                <a href="https://plus.google.com/108796854139900682022/posts"><i class="fa fa-google-plus-square fa-3x wow bounceIn" data-wow-delay=".5s"></i></a> -->
                                <a href="#" target="_blank"><i class="fa fa-envelope-square fa-3x wow bounceIn" data-wow-delay=".6s"></i></a>
                            </div>
                            <p>2015  <i class="fa fa-copyright"></i>  Proveek Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END OF FOOTER -->
@stop

@section('body-scripts')
<script>
    $(document).ready(function(){
        $('#uploadProfilePicForm').submit(function(){
            $('#uploadBtn').empty().append('Uploading..');

        });
    })
</script>
@stop