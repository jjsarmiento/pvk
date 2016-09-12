@extends('layouts.usermain')

@section('title')
    {{$job->title}}
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

            .INVITE-BOOKMARK-WORKERS:hover {
                background-color: #cce6ff;
            }
        img.media-object.update-card-MDimentions {
            border: 1px solid #eee;
            display: table;
            margin:auto;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('#SHOWDETAILS').click(function(){
                $('#DETAILPANEL').slideToggle('fast');
            });

        });
    </script>
@stop


@section('content')
<section>
    <div class="container lato-text">
        <div class="col-md-8">
            <div class="row">
                @if($invitedWorkers->count() == 0)
                    <center><i>No invited workers yet</i></center>
                @else
                    @foreach($invitedWorkers as $w)
                    <div class="col-md-6" style=" padding-bottom: 1.5em;">
                        <div class="media block-update-card">
                            <a class="pull-left" href="#">
                                @if($w->profilePic != "")
                                    <img class="media-object update-card-MDimentions" src="{{$w->profilePic}}">
                                @else
                                    <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                @endif
                            </a>
                            <div class="media-body update-card-body">
                                <a href="/{{$w->username}}" style="font-weight: bolder;">
                                    @if(in_array($w->userid ,$CHECKED_OUT_USERS))
                                    {{$w->fullName }}
                                    @else
                                    {{substr_replace($w->firstName, str_repeat('*', strlen($w->firstName)-1), 1)}}
                                    &nbsp;
                                    {{substr_replace($w->lastName, str_repeat('*', strlen($w->lastName)-1), 1)}}
                                    @endif

                                </a>
                                <p>{{$w->regname.', ' }}{{ $w->cityname }}</p>
                                <a href="/SNDINVT:{{$w->userid}}:{{$job->id}}"><i class="fa fa-envelope"></i> View Invitation</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget-container stats-container" style="display:block !important;">
                <div class="col-lg-6 lato-text">
                    <a id="INVITEDSLINK" href="/ShowInvited:{{$job->id}}" style="text-decoration:none;">
                        <div class="number" style="color:#2980b9;">
                            <i class="fa fa-envelope-square"></i>
                            {{$invitedWorkers->count()}}
                        </div>
                        <div class="text" style="color:#2980b9;">
                            Invited
                        </div>
                    </a>
                </div>
                @if($BULK_INVITE)
                    <div class="col-lg-6 lato-text">
                        <a href="#" data-toggle="modal" data-target="#MULTI_INVITE_MODAL" style="text-decoration:none;">
                            <div class="number" style="color:#2980b9;">
                                <i class="fa fa-send"></i>
                            </div>
                            <div class="text" style="color:#2980b9;">
                                Invite Multiple Workers
                            </div>
                        </a>
                    </div>
                @endif
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <div class="widget-container padded" style="display: flex; min-height:1em; display:block !important; word-wrap: break-word;">
                    <!--
                    <button type="button" class="close" style="opacity: 100;" id="SHOWDETAILS">
                        <i class="fa fa-chevron-down" style=""></i>
                    </button>
                    -->
                    <h3 style="margin: 0;"><a href="/jobDetails={{$job->id}}">{{$job->title}}</a></h3>
                    <span style="color: #7F8C8D; font-size: 0.8em;">{{$job->created_at}}</span>
                    <!--
                    <br/>
                    <br/>
                    <div class="row" style="text-align: left; display: none;" id="DETAILPANEL">
                        <div class="col-md-12">
                            <div class="col-md-4">Duration</div>
                            <div class="col-md-8">
                                @if($job->hiring_type == 'LT6MOS')
                                    Less than 6 months
                                @else
                                    Greater than 6 months
                                @endif
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill Category
                            </div>
                            <div class="col-md-8">
                                {{ $job->categoryname }}
                            </div>
                            <br/><br/>
                            <div class="col-md-4">
                                Skill
                            </div>
                            <div class="col-md-8">
                                {{ $job->itemname }}
                            </div>
                            <br/><br/><br/>
                            <div class="col-md-4">
                                Location
                            </div>
                            <div class="col-md-8">
                                {{ $job->cityname }}, {{ $job->bgyname }}<br/>
                                {{ $job->regname }}
                            </div>
                            <br/><br/><br/>
                            <div class="col-md-4">Salary</div>
                            <div class="col-md-8">P{{ $job->salary }}</div>
                            <br/><br/><br/>
                        </div>
                        <div class="col-md-12">
                            {{ $job->description }}
                        </div>
                    </div>
                    -->
                </div>
            </div><br/>
        </div>
    </div>
</section>


<form method="POST" action="/SENDMULTIPLEINVITE">
<input type="hidden" value="{{$job->id}}" name="JOBID" />
<div class="modal modal-vcenter fade lato-text" id="MULTI_INVITE_MODAL" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" style="padding-top: 2em;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                @if($bookmarks->count() > 0)
                                    <center><h3 style="margin: 0; margin-bottom: 1em;">Bookmarked Workers</h3></center>
                                    @foreach($bookmarks as $bm)
                                        @if(in_array($bm->userID, $CHECKED_OUT_USERS))
                                            <div class="col-md-12 INVITE-BOOKMARK-WORKERS" style="padding: 0.4em;">
                                                <div class="col-md-2">
                                                    @if($bm->profilePic)
                                                        <img class="media-object update-card-MDimentions" width="50" height="50" src="{{$bm->profilePic}}">
                                                    @else
                                                        <img class="media-object update-card-MDimentions" width="50" height="50" src="/images/default_profile_pic.png">
                                                    @endif
                                                </div>
                                                <div class="col-md-5">
                                                    <a target="_tab" href="/{{$bm->username}}">{{$bm->fullName}}</a>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="checkbox" class="MULTI_INVITE_CHECKBOX" name="WORKERS[]" value="{{$bm->userID}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-12 INVITE-BOOKMARK-WORKERS" style="padding: 0.4em;">
                                                <div class="col-md-2">
                                                    @if($bm->profilePic)
                                                        <img class="media-object update-card-MDimentions" width="50" height="50" src="{{$bm->profilePic}}">
                                                    @else
                                                        <img class="media-object update-card-MDimentions" width="50" height="50" src="/images/default_profile_pic.png">
                                                    @endif
                                                </div>
                                                <div class="col-md-5">
                                                    <a href="/{{$bm->username}}">
                                                        {{substr_replace($bm->firstName, str_repeat('*', strlen($bm->firstName)-1), 1)}}
                                                        &nbsp;
                                                        {{substr_replace($bm->lastName, str_repeat('*', strlen($bm->lastName)-1), 1)}}
                                                    </a>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="checkbox" class="MULTI_INVITE_CHECKBOX" name="WORKERS[]" value="{{$bm->userID}}">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <center><i>No bookmarked users available for this job.</i></center>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Invitation Message</label>
                            <textarea name="INVITATIONMSG" required="required" class="form-control" placeholder="INVITATION MESSAGE" rows="10">Hi! We've seen your profile and we would like to invite you to apply for this job ({{$job->title}})</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if($bookmarks->count() == 0)
                    <button id="SND_INVITE_BTN" type="button" disabled class="btn btn-success">Send Invite</button>
                @else
                    <button id="SND_INVITE_BTN" type="submit" class="btn btn-success">Send Invite</button>
                @endif
            </div>
        </div>
    </div>
</div>
</form>
@stop