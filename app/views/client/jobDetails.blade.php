@extends('layouts.usermain')

@section('title')
    {{$job->title}}
@stop

@section('head-content')
    <style type="text/css">
        .badge {
            background-color: #1ABC9C;
            width: auto;
            max-width: 10em;
            overflow:hidden;
            white-space:nowrap;
            text-overflow:ellipsis;
        }
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
            @media(max-width: 991px) {
                .mobAppINv{
                    margin-top:10px;
                }
            }
    </style>
    <script>
        $(document).ready(function(){
            $('#DELETE_AD').click(function() {
                if(confirm('Do you want to delete this Job Ad?')){
                    location.href = $(this).data('href');
                }
            })
        });
    </script>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-8">
            <div class="widget-container padded" style="display: flex; min-height:125px; display:block !important;">
                <a href="#" data-href="/deleteJob={{$job->id}}" id="DELETE_AD" type="button" class="close" style="opacity: 0.5;">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="/editJob={{$job->id}}" type="button" class="close" style="opacity: 0.5;  margin-right: 0.4em;">
                    <i class="fa fa-edit"></i>
                </a>
                <h3 style="margin: 0;">{{$job->title}}</h3>
                <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                <br/>
                <br/>
                <div class="row" style="text-align: left">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <label>Work Duration : </label>
                            @if($job->hiring_type == 'LT6MOS')
                                Less than 6 months
                            @else
                                Greater than 6 months
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label>Work Location : </label>{{ $job->regname }}, {{$job->provname}}, {{ $job->cityname }}
                        </div>
                        @if($job->salary != 0)
                            <div class="col-md-12">
                                <label>Salary : </label>
                                P{{ $job->salary }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <label>Skill Category : </label>{{ $job->categoryname }}<br/>
                            <label>Skills Needed : </label>{{$job->itemname}}<br/>
                            @foreach($custom_skills as $cs)
                                {{$cs->skill}} <br/>
                            @endforeach
                        </div>
                        <br>
                    </div>
                    @if($job->AverageProcessingTime || $job->Industry || $job->CompanySize || $job->WorkingHours || $job->DressCode)
                        <div class="col-md-6" style="text-align: justify;">
                            <h4 style="margin-top:0px;">Company Snaphots</h4>
                            <div class="col-md-12">
                                @if($job->AverageProcessingTime)
                                    <label>Average Processing Time: </label>
                                    {{$job->AverageProcessingTime}}<br/>
                                @endif

                                @if($job->Industry)
                                    <label>Industry: </label>
                                    {{$job->Industry}}<br/>
                                @endif

                                @if($job->CompanySize)
                                    <label>Company Size: </label>
                                    {{$job->CompanySize}}<br/>
                                @endif

                                @if($job->WorkingHours)
                                    <label>Working Hours: </label>
                                    {{$job->WorkingHours}}<br/>
                                @endif

                                @if($job->DressCode)
                                    <label>Dress Code: </label>
                                    {{$job->DressCode}}
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12" style="word-wrap: break-word; text-align: justify;">
                        <h4>Description</h4>
                        <div class="col-md-12">
                            {{ nl2br($job->description) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-12" style="margin-top:20px;">
                            <div class="col-md-12 well" style="text-align: justify;">
                                <label>Requirements</label><br/>
                                {{ nl2br($job->requirements) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="recommendedWorkers">
                    <div class="row">
                        <div class="col-lg-4"><hr class="hrLine"></div>
                        <div class="col-lg-4" style="padding-top: 10px; text-align: center"><p style="font-size:10pt;">Recommended Workers</p></div>
                        <div class="col-lg-4"><hr class="hrLine"></div>
                    </div>
                    <div class="row">
                        @if($workers->count() != 0)
                            @foreach($workers as $w)
                                <div class="col-md-4 padded" style="">
                                    <div class="media block-update-card" style="height: 15em;">
                                        <a class="pull-left" href="/{{$w->username}}">
                                            @if($w->profilePic != "")
                                                <img class="media-object update-card-MDimentions" src="{{$w->profilePic}}">
                                            @else
                                                <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                            @endif
                                        </a>
                                        <div class="media-body update-card-body">
                                            {{--CONDITION FOR NAME DISPLAY--}}
                                            @if(in_array($w->id, $CHECKED_OUT_USERS))
                                                <a href="/{{$w->username}}" style="font-weight: bolder;">
                                                    {{ $w->fullName }}
                                                </a>
                                            @else
                                                <a href="/{{$w->username}}" style="font-weight: bolder;">
                                                    {{substr_replace($w->firstName, str_repeat('*', strlen($w->firstName)-1), 1)}}
                                                    &nbsp;
                                                    {{substr_replace($w->lastName, str_repeat('*', strlen($w->lastName)-1), 1)}}
                                                </a>
                                            @endif
                                            <p>{{ $w->regname }}, {{ $w->cityname }}</p>
                                        </div>
                                        <br/>
                                        <br/>
                                        @if(in_array($w->id, $INVITEDS))
                                            <a data-sample="{{$w->inviteID}}" href="/SNDINVT:{{$w->id}}:{{$job->id}}" class="btn btn-block btn-xs btn-success" style="border-radius: 0.3em;"><i class="fa fa-envelope"></i> Invite Sent</a>
                                        @else
                                            <a data-sample="{{$w->inviteID}}" href="/SNDINVT:{{$w->id}}:{{$job->id}}" class="btn btn-block btn-xs btn-primary" style="border-radius: 0.3em;"><i class="fa fa-envelope"></i> Send Invite</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-4 padded text-center"><br/>
                                <a href="/WRKRSRCH:{{$job->id}}:{{$job->categorycode}}:{{$job->itemcode}}:NONE">
                                    <i class="fa fa-search" style="font-size: 3em;"></i><br/>
                                    Look for more workers..
                                </a>
                            </div>
                        @else
                            <div class="padded" style="font-size: 1.5em;">
                            <center><i class="fa fa-info"></i> <i>No Workers match the skills required.</i></center>
                            </div>
                        @endif
                    </div>
                </div>

                <div style="clear:both;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-container stats-container mobAppINv" style="display:block !important;">
                <div class="col-lg-6 col-xs-6 lato-text">
                    <a id="APPLICANTSLINK" href="#" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-users"></i>
                            {{ $applications->count() }}
                        </div>
                        <div class="text" style="color:#2980b9;">
                            Applicants
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 col-xs-6 lato-text">
                    <a id="INVITEDSLINK" href="/ShowInvited:{{$job->id}}" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-envelope-square"></i>
                            {{$invited->count()}}
                        </div>
                        <div class="text" style="color:#2980b9;">
                            Invited
                        </div>
                    </a>
                </div>
            </div><br/>

            <div id="HIRED_WORKERS" style="margin-bottom: 1em;">
                @if($hiredWorkers->count() != 0)
                    <div class="padded text-center">Hired Workers</div>
                    @foreach($hiredWorkers as $w)
                        <div class="media block-update-card">
                            <a class="pull-left" href="/{{$w->username}}" target="_tab">
                                @if($w->profilePic != "")
                                    <img class="media-object update-card-MDimentions" src="{{$w->profilePic}}">
                                @else
                                    <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                @endif
                            </a>
                            <div class="media-body update-card-body">
                                <a href="/{{$w->username}}" target="_tab">
                                    <h4 class="media-heading">{{ $w->fullName }}</h4>
                                </a>
                                <p>{{ $w->regname }}, {{ $w->cityname }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div id="APPLICANTS">
                @if($applications->count() != 0)
                    <div class="padded text-center">Applicants</div>
                    @foreach($applications as $a)
                        <div class="media block-update-card">
                            <a class="pull-left" href="/{{$a->username}}" target="_tab">
                                @if($a->profilePic != "")
                                    <img class="media-object update-card-MDimentions" src="{{$a->profilePic}}">
                                @else
                                    <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                @endif
                            </a>
                            <div class="media-body update-card-body">
                                <a href="/VWPRFL:{{$a->jobapp_id}}/{{$a->username}}" target="_tab">
                                    @if(in_array($a->id, $CHECKED_OUT_USERS))
                                        <h4 class="media-heading">{{ $a->fullName }}</h4>
                                    @else
                                        <h4 class="media-heading">
                                            {{substr_replace($a->firstName, str_repeat('*', strlen($a->firstName)-1), 1)}}
                                            &nbsp;
                                            {{substr_replace($a->lastName, str_repeat('*', strlen($a->lastName)-1), 1)}}
                                        </h4>
                                    @endif
                                </a>
                                <p>{{ $a->regname }}, {{ $a->cityname }}</p>
                            </div>
                            <br/>
                            <br/>
                            @if(!in_array($a->id, $CHECKED_OUT_USERS))
                                <a href="/VWPRFL:{{$a->jobapp_id}}/doCheckout={{$a->id}}" class="btn btn-xs btn-danger btn-block" style="border-radius: 0.3em;">CHECKOUT</a>
                                <!--
                                @if(in_array($a->id, $INCART))
                                    <a href="#" data-target="#CARTMODAL" data-toggle="modal" class="SHWCRT btn btn-xs btn-danger btn-block" style="border-radius: 0.3em;">Added to Cart</a>
                                @else
                                    <a href="/addToCart={{$a->id}}" class="btn btn-warning btn-xs btn-block" style="border-radius: 0.3em;"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</a>
                                @endif
                                -->
                            @else
                                <a href="/VWPRFL:{{$a->jobapp_id}}/hireWorker={{$a->id}}={{$job->id}}" class="btn btn-xs btn-success btn-block">Hire Worker</a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="padded text-center"><i>No applicants yet.</i></div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop