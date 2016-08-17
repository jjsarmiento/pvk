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
            padding: 5px 10px;      
            text-transform: uppercase; 
            font-size: 12px;
            margin:auto; display:table; margin-top:5px;
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
        img.media-object.update-card-MDimentions {
            border: 1px solid #eee;
            display: table;
            margin:auto;
        }
        .workers{
            text-align: center;
        }
        a img:hover, a.user:hover {
            transition: 0.3s;
            opacity: 0.7;
            text-decoration: none;
        }
        </style>
    <script>
        $(document).ready(function() {

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
                                <div class="col-md-12 padded">
                                    <i class="fa fa-diamond" style="color: #2980B9;"></i>&nbsp;
                                    <span id="USR_POINTS">{{ Auth::user()->points }}</span>
                                </div>
                                <!--
                                <div class="col-md-4 padded">
                                    <i class="fa fa-users" style="color: #2980B9;"></i>&nbsp;
                                    {{ Auth::user()->accountType }}
                                </div>
                                <div class="col-md-4 padded">
                                    <i class="fa fa-briefcase" style="color: #2980B9;"></i>&nbsp;
                                    {{ Auth::user()->accountType }}
                                </div>
                                -->
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
                        <a class="btn btn-primary btn-block" id="SRCHBTN_SKILL" href="/SRCHWRKRSKLL=006=006001=ALL=ALL=ALL=DESC"><i class="fa fa-search"></i> Search for workers</a>
                    </div>
                @endif

                <!-- STATUS -->
                <div style="background-color: white; padding: 1em; margin-top: 2em;">
                    <div class="widget-container weather" style="min-height: 1em; box-shadow:none;">
                        <div class="widget-content">
                            <div class="padded text-center" style="min-height:30px; text-align:left; color:#2980b9; font-size:18pt;">
                                <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbspYour Status : <a href="/cprofileProgress"><b>{{ Auth::user()->total_profile_progress }}%</b></a> | {{$subscription_msg}}
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
                                <!-- @if(Auth::user()->total_profile_progress < 50) -->
                                    <p style="color: #000000; margin-top: 5px;">
                                        <i style="color: red" class="fa fa-warning"></i> <b>You can start applying for jobs when you complete your profile above 50%.</b><br><br>
                                        <a class="clickHere" href="/editProfile"> Click here to edit your profile </a>
                                    </p>
                                <!-- @endif -->
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
                    @if(Session::has('errorMsg'))
                        <div class="widget-container padded" style="font-weight: bold; text-align: center; min-height: 1em;">
                            <i class="fa fa-warning" style="color: #E74C3C;"></i> {{Session::get('errorMsg')}}
                        </div>
                        <br/>
                    @endif
                    @if(Session::has('successMsg'))
                        <div class="widget-container padded" style="font-weight: bold; text-align: center; min-height: 1em;">
                            <i class="fa fa-check-circle" style="color: #2ECC71;"></i> {{Session::get('successMsg')}}
                        </div>
                        <br/>
                    @endif
                    <div class="widget-container" style="min-height:30px;">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:20pt; margin-bottom: -10px;">
                                <i class="fa fa-search" aria-hidden="true"></i> Recommended workers
                            </div>
                            @foreach($workers as $w)
                                <div class="col-md-4">
                                    <div class="workers">
                                        <a href="" style="padding: 5px;">
                                            <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png" width="80" height="80">
                                        </a>
                                        <span>
                                        <b>
                                            @if(!in_array($w->id, $CHECKEDOUT_WORKERS))
                                                {{substr_replace($w->firstName, str_repeat('*', strlen($w->firstName)-1), 1)}}
                                                &nbsp;
                                                {{substr_replace($w->lastName, str_repeat('*', strlen($w->lastName)-1), 1)}}
                                            @else
                                                {{ $w->fullName }}
                                            @endif
                                        </b><br/> <a href="/{{$w->username}}" class="user">{{ '@'.$w->username }}</a></span><br>
                                        {{--<span>Address Lorem ipsum sit dolor amet</span><br>--}}
                                        <span><b>Profile Rating: {{$w->total_profile_progress}}%</b></span><br>
                                        {{--<span><b>Last Login: </b> 2 Days ago</span>--}}
                                    </div>
                                    <a href="/{{$w->username}}" class="viewSal">VIEW FULL PROFILE</a>
                                </div>
                            @endforeach
                            <!--
                            @for($i=0; $i<=2; $i++)
                                <div class="col-md-4">
                                    <div class="workers">
                                        <a href="" style="padding: 5px;">
                                            <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png" width="80" height="80">
                                        </a>
                                        <span><b>J*** D********</b> <a href="#" class="user">@username</a></span><br>
                                        <span>Address Lorem ipsum sit dolor amet</span><br>
                                        <span><b>Profile Rating: </b> 23%</span><br>
                                        <span><b>Last Login: </b> 2 Days ago</span>
                                    </div>
                                    <a href="" class="viewSal">VIEW FULL PROFILE</a>
                                </div>
                            @endfor
                            -->
                            <div style="clear:both; padding-bottom:20px;"></div>
                        </div>
                    </div>
                </div>
                <br/>
            </div>

            <div class="col-lg-8" style="margin-top: 2em;">
                <div class="col-lg-12 no-padding">
                    <div class="widget-container col-md-6" style="">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp General Information
                            </div>
                            <div class="panel-body">
                                <span><b>Business Description: </b>{{Auth::user()->businessDescription}}</span><br>
                                <span><b>Business Nature:</b> {{Auth::user()->businessNature}}</span><br>
                                <span><b>Business Permit:</b> {{Auth::user()->businessPermit}}</span><br>
                                <span><b>Business Address:</b> {{Auth::user()->address}}</span><br>
                                <span><b>Years in Operation:</b> {{Auth::user()->years_in_operation}}</span><br>
                                <span><b>Company Size:</b> {{Auth::user()->number_of_branches}}</span><br>
                                {{--<span><b>Description:</b> Client Company Description</span><br>--}}
                            </div>                             
                        </div>
                    </div>
                    <div class="widget-container col-md-6" style="box-shadow:none;">
                        <div class="widget-content">
                            <div class="panel-body" style="color:#2980b9; font-size:14pt;">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Account Information
                            </div>
                            <div class="panel-body">
                                <span><b>Date Created: </b>{{Auth::user()->created_at}}</span><br>
                                <span><b>Account Status: </b>{{Auth::user()->status}}</span>
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