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

        @keyframes reqProgress {
        from {width:0%;}
        to {width:{{ Auth::user()->total_profile_progress }}%;}
        }

        body{background-color:#E9EAED;}
        h5 {
            margin: 0;
        }
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
            margin-left: 20px;
            margin-top: 15px;
            margin-right: 1em;
            margin-bottom: 0em;
            /*-moz-box-shadow:    3px 3px 5px 6px #ccc;*/
            /*-webkit-box-shadow: 3px 3px 5px 6px #ccc;*/
            /*box-shadow: 0 8px 6px -6px black;*/
        }
        .thumbnail img {
            display: inline;
            position: absolute;
            left: 50%;
            top: 50%;
            height: 100%;
            width: auto;
            /*-webkit-transform: translate(-50%,-50%);*/
            /*-ms-transform: translate(-50%,-50%);*/
            transform: translate(-50%,-50%);
        }
        .thumbnail img.portrait {
            width: 100%;
            height: auto;
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
            border: 2px solid;
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
        @media (max-width: 768px){
            .job-post{
                margin-top: 2em;
            }
            .widget-container {
                min-height: 100% !important;
            }
        }  
        @media (max-width: 320px) {
            a.clickHere {
                font-size: 12px !important;
            }
        }        
        </style>
    <script>
        $(document).ready(function() {
            $('#SRCHBTN_SKILL').click(function(){
                var CTGRY = "N",
                    SKLL = "N";

                if($('#taskitems').val() != ''){
                    SKLL = $('#taskitems').val()
                }

                if($('#taskcategory').val() != ''){
                    CTGRY = $('#taskcategory').val()
                }

                location.href="/SRCHWRKRSKLL="+CTGRY+'='+SKLL;
            })


            $('#taskcategory').change(function(){
                $('#taskitems').empty();
                $.ajax({
                    type    :   'GET',
                    url     :   '/SKILLCATCHAIN='+$('#taskcategory').val(),
//                    data    :   $('#doEditSkillInfo').serialize(),
                    success :   function(data){
                        $.each(data, function(key, value){
                            $('#taskitems').append('<option value="'+ value['itemcode'] +'">'+value['itemname']+'</option>');
                        });
                    },error :   function(){
                        alert('ERR500 : Please check network connectivity');
                    }
                })
            });

            $('.remove-skill').click(function(){
                if(confirm('Do you really want to remove this skill?')){
                    location.href = $(this).attr('data-href');
                }
            });

            $('#CREATE_JOB').click(function(){
                if(parseFloat($('#SYSSETTINGS_POINTSPERAD').val()) < parseFloat($('#USR_POINTS').text())){
                    location.href = $(this).data('href');
                }else{
                    alert("You don't have enough points to create a job ad");
                }
            })
        })
    </script>
@stop

@section('user-name')
    {{ Auth::user()->companyName }}
@stop

@section('content')
<section>
    <div class="container lato-text">
        <div class="row">
        <!-- PROFILE PIC / INFO  -->
            <div class="col-lg-4"> 
                <div class="widget-container" style="display: flex; min-height:125px; display:block !important;">
                    <div class="col-md-12" style="padding:15px">
                        <div class="thumbnails" style="margin:auto; display:table;">
                            @if(Auth::user()->profilePic)
                                <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait padded" style="width: 250px;"/></a>
                            @else
                                <a href="/editProfile"><img src="/images/yourlogohere.jpg" class="portrait padded" style="width: 250px;"/></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 padded" style="margin-top: -25px;">
                        <div class="heading" style="text-align:center;">
                            <a href="/editProfile" style="font-weight:bold; font-size:14pt;">{{ Auth::user()->companyName }}</a><br>
                        </div>
                        <div class="col-md-6">
                            <span><b>Nature of Employer :</b> Company</span><br>
                        </div>
                        <div class="col-md-6">
                            <span><b>Last Login :</b> 08/03/16</span> 
                        </div>             
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                        @if(Auth::user()->status == 'PRE_ACTIVATED')
                            <b><i class="fa fa-warning" style="color: red;"></i>
                            Your profile is being reviewed by our staff.<br/>
                            After your profile has been activated, you can start posting job ads or look for workers!<br/>
                            This could take 24 hours or less.</b>
                        @else
                            @if(Auth::user()->total_profile_progress >= 50)
                                <!--
                                OLD TASK/JOB MODULE LINKS
                                <a style="border-radius: 0.3em;" href="/createTask" class="btn btn-success btn-block btn-lg">Create Task</a>
                                <a style="border-radius: 0.3em;" href="/tasks" class="btn btn-primary btn-block">Tasks</a>
                                <a style="border-radius: 0.3em;" href="/tskmntrSearch" class="btn btn-primary btn-block">Search for Taskminators</a>
                                -->

                                <a style="border-radius: 0.3em;" href="#" data-href="/createJob" id="CREATE_JOB" class="btn btn-success btn-block btn-lg">Create Job</a>
                                <a style="border-radius: 0.3em;" href="/jobs" class="btn btn-primary btn-block">Job</a>
                            @endif
                            <div class="row" style="font-size: 1.2em; font-weight: bolder; text-align: center;">
                                <div class="col-md-6 padded">
                                    <i class="fa fa-diamond" style="color: #2980B9;"></i>&nbsp;
                                    <span id="USR_POINTS">{{ Auth::user()->points }}</span>
                                </div>
                                <div class="col-md-6 padded">
                                    <i class="fa fa-user" style="color: #2980B9;"></i>&nbsp;
                                    {{ Auth::user()->accountType }}
                                </div>
                            </div>
                        @endif
                </div>

                @if(Auth::user()->total_profile_progress >= 50 && Auth::user()->status == 'ACTIVATED')
                    <div style="background-color: white; padding: 1em; margin-top: 2em;">
                        <div class="form-group">
                            <select name="taskcategory" id="taskcategory" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->categorycode }}">{{ $category->categoryname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="taskitems" id="taskitems" class="form-control">
                                @foreach($categorySkills as $skill)
                                    <option value="{{ $skill->itemcode }}">{{ $skill->itemname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block" id="SRCHBTN_SKILL"><i class="fa fa-search"></i> Search for workers</button>
                    </div>
                @endif

                <!-- STATUS -->
                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                    <div class="widget-container weather" style="min-height: 1em; box-shadow:none;">
                        <div class="widget-content">
                            <div class="padded text-center" style="min-height:30px; text-align:left; color:#2980b9; font-size:18pt;">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : {{ Auth::user()->total_profile_progress }}% | {{$subscription_msg}}
                                <div class="widget-content">
                                    <div class="padded text-center" style="font-size:18pt; padding: 10px 0 0;">
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
                                        {{--<span style="font-size:10pt;">Please complete your profile to be able to apply for jobs.</span>--}}
                                    </div>
                                </div>                                
                                @if(Auth::user()->total_profile_progress < 50)
                                    <p style="color: #000000; margin-top: 5px;">
                                        <i style="color: red" class="fa fa-warning"></i> <b>You can start applying for jobs when you complete your profile above 50%.</b><br><br>
                                        <a class="clickHere" href="/editProfile"> Click here to edit your profile </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

<!-- CONTACT INFo -->
                <div class="col-lg-12 no-padding">
                    <div class="widget-container" style="min-height:30px; margin-top:2em;">
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information
                            </div>     
                            <div class="panel-body">
                                <span><b>Business Number: </b>000-123-452</span><br>
                                <span><b>Business Email: </b><a herf="mailto:sample@mail.com">sample@mail.com</a></span>
                            </div>                             
                        </div>
                        <div class="widget-content">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-user" style="font-size:14pt; color:#2980b9"></i>&nbsp Key Contact Person
                            </div>     
                            <div class="panel-body">
                                <span><b>Name: </b>Lorem Ipsum</span><br>
                                <span><b>Position: </b>Human Resource</span><br>
                                <span><b>Contact Number: </b>000-222-333</span><br>
                                <span><b>Email: </b><a herf="mailto:sample@mail.com">sample@mail.com</a></span>
                            </div>                             
                        </div>
                    </div>
                </div>

            </div>
<!-- ENF PROFILE PIC / INFO / SIDEBAR-->

            <div class="col-lg-8 job-post">
                <div class="col-lg-12 no-padding">
                    <div class="widget-container" style="min-height:30px;">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:20pt;">
                                <i class="fa fa-search" aria-hidden="true"></i> Job Posts
                            </div>
                            <div class="panel-body" style="padding: 0 15px 15px;">
                                <div class="col-md-12 no-padding">
                                    @for($i=0; $i<6; $i++)
                                        <div class="col-md-4 padded">
                                            <b class="title">Praesent volutpat dapibus mauris nec blandit.</b>
                                            <p class="content">Vivamus metus nulla, tempor vel varius fermentum, molestie nec enim. Suspendisse eu ultricies lorem. </p>
                                            <a href="#" class="viewSal">View full details</a>
                                        </div>
                                    @endfor
                                </div>

                                <!-- NOTE: IF Job post greater than 6 display this-->
                                @if($i > 6)
                                <div class="col-md-12 padded" style="margin-top: 2em; text-align:center;">
                                    <a href="#" class="clickHere" style="padding: 5px 100px;">SEE MORE</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <!-- NEW JOBS MODULE -- START : Authored by Jan Sarmiento -->
                <!-- @if($jobs->count() == 0)
                    <br/>
                    <center><i>No jobs posted yet</i></center>
                @else
                    @foreach($jobs as $job)
                        <div class="widget-container fluid-height padded wow fadeInUp" data-wow-duration=".3s" data-wow-offset="0" data-wow-delay="0" style=" word-wrap: break-word; padding-left:1em; padding-right:10px; min-height: 1em; max-height: 10">
                            <div style="display:flex;padding-bottom:5px;">
                                <div style="flex:11;">
                                    <a href="/jobDetails={{$job->job_id}}" style="text-decoration:none;">
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
                                                <span class="text-right" style="padding:0;margin:0;"><b>P</b>{{$job->salary}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @endif -->
                <!-- NEW JOBS MODULE -- END : Authored by Jan Sarmiento -->
            </div>

            <div class="col-lg-8" style="margin-top: 2em;">
                <div class="col-lg-12 no-padding">
                    <div class="widget-container col-md-6" style="">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp General Information
                            </div>
                            <div class="panel-body">
                                <span><b>Business Description: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</span><br>
                                <span><b>Business Nature:</b> Ipsum Sit dolor</span><br>
                                <span><b>Business Permit:</b> Client Company DTI/SEC</span><br>
                                <span><b>Business Address:</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</span><br>
                                <span><b>Years in Operation:</b> 5</span><br>
                                <span><b>Company Size:</b> 50</span><br>
                                <span><b>Description:</b> Client Company Description</span><br>
                            </div>                             
                        </div>
                    </div>
                    <div class="widget-container col-md-6" style="box-shadow:none;">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Account Information
                            </div>
                            <div class="panel-body">
                                <span><b>Date Created: </b>01/01/02</span><br>
                                <span><b>Account Status: </b>Activated</span>
                            </div>                             
                        </div>

                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="fa fa-file-text-o" style="font-size:14pt; color:#2980b9"></i>&nbsp Licensed
                            </div>
                            <div class="panel-body">
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</span>
                            </div>                             
                        </div>
                    </div>
                </div>            
            </div> 

            <div class="col-lg-8 job-post" style="margin-top: 2em;">
                <div class="col-lg-12 no-padding">
                    <div class="widget-container" style="min-height:30px;">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="fa fa-sticky-note" aria-hidden="true"></i> Other notes
                            </div>
                            <div class="panel-body">
                                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam aliquet viverra libero, tempor pretium diam placerat non. Sed eget sollicitudin sem. Maecenas sagittis mattis lacus eget commodo. Suspendisse quis risus ac neque luctus dapibus non sit amet ligula. Sed imperdiet sapien orci, at dignissim ipsum aliquet id. Quisque porttitor neque elit, vitae volutpat ante pretium non. Aliquam quam risus, varius sit amet ante quis, eleifend blandit purus. Donec condimentum neque sed nunc lobortis congue at vulputate enim. Integer eu nulla commodo, sollicitudin nulla non, convallis metus. Vivamus accumsan orci eget ex suscipit consequat. Vivamus nec nibh urna. Vivamus elementum id libero nec dignissim.</span>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</section>
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