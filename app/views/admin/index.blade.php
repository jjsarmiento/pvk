@extends('layouts.usermain')

@section('title')
    Welcome to your dashboard!!
@stop

@section('head-content')
    <style type="text/css">
        body{background-color:#E9EAED;}
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
        @media(max-width: 767px){
          h1.lato-text {
              margin-top: 40px;
          }
        }
        /*-----------------*/
        .accordion-toggle
        {
            text-decoration: none !important; 
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
            @media screen and (max-width: 767px) {
                .tg {
                    width: auto !important; 
                }
                .tg col {
                    width: auto !important;
                }
                .tg-wrap {
                    overflow-x: auto !important;
                    -webkit-overflow-scrolling: touch !important;
                }
                p.hiddenNote {
                    color: #9c9c9c;
                    text-align: center;
                }
            }
            @media (max-width: 479px){
                p.hiddenNote{
                    display: block !important;
                }
            }
    </style>
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#search_btn').click(function(){
                var acctStatus = $('#search_acctStatus').val(),
                    rating = $('#search_rating').val(),
                    hiring = $('#search_hiring').val(),
                    orderBy = $('#search_orderBy').val(),
                    keyword = ($('#search_keyword').val() == '') ? 'NONE' : $('#search_keyword').val(),
                    checkout = $('#search_checkoutStatus').val();


                    location.href = "/searchWorker:"+acctStatus+":"+rating+":"+hiring+":"+orderBy+":"+keyword+":"+checkout;
            });

            $('.ACT_DEAC').click(function(){
                if(confirm($(this).data('msg'))){
                    location.href = $(this).data('href');
                }
            })
        });
    </script>
@stop

<!-- @section('user-name')
    {{ Auth::user()->fullName }}
@stop -->

@section('content')
        <section style="margin-top:0;">
            <div class="container lato-text" style="">
                <div class="page-title">
                    <h1 class="lato-text">
                        User List : Workers
                    </h1>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="breadcrumb">
                            <li>
                                <a href="/"><i class="fa fa-home"></i></a>
                            </li>
                            <li>
                                User List
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="widget-container">
                            <div class="widget-content">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        User Account List</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/admin" class="sidemenu">Pending Users</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Worker</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/UsrAccntLstCMPNY" class="sidemenu">Company</a><br>
                                    <!--
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Employer - Individuals</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Employer - Companies</a><br>
                                    -->
                                </div>
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                            Job Ads&nbsp;&nbsp;
                                            <span id="searchAdBtn" data-target="#adSearchModal" data-toggle="modal" style="font-size:0.8em; background-color: #2980b9; border-radius: 0.8em; padding: 0.2em; padding-left: 0.5em; padding-right: 0.5em; color: #ffffff; cursor: pointer">
                                                <i class="fa fa-search"></i> Search
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/showJobAds" class="sidemenu">All Job Ads</a><br>
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=INDIVIDUAL" class="sidemenu">Individual</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=FEATURED" class="sidemenu">Featured</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=HIRING" class="sidemenu">Mass Hiring</a><br>--}}
                                    {{--<i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/jobAds=REFERRAL" class="sidemenu">Referral</a><br>--}}
                                </div>
                                <!--
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Audit Trail</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_workers" class="sidemenu">Workers</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_companies" class="sidemenu">Company</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Workers</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                                </div>
                                -->
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a class="accordion-toggle">
                                        Category & Skills</a>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/skills" class="sidemenu">System Skills</a><br>
                                    <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/customSkills" class="sidemenu">Custom Skills</a><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="well selected-filters">
                            <h3 style="margin: 0; cursor: pointer;" onclick="$('#SEARCH_PARAMETERS').slideToggle('fast');">Search for Workers <i class="fa fa-search"></i></h3>
                            {{--<div id="SEARCH_PARAMETERS" class="row" style="display: none;">--}}
                            <div id="SEARCH_PARAMETERS" class="row" style="">
                                <br/>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Status</label>
                                        <select class="form-control" id="search_acctStatus" name="search_acctStatus">
                                            <option value="ALL">Display All</option>
                                            <option <?php if(@$acctStatus == "ACTIVATED"){ echo('selected'); } ?> value="ACTIVATED">Activated</option>
                                            <option <?php if(@$acctStatus == "DEACTIVATED"){ echo('selected'); } ?> value="DEACTIVATED">Deactivated</option>
                                        </select>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <select class="form-control" id="search_rating" name="search_rating">
                                            <option value="ASC" <?php if(@$rating == "ASC"){ echo('selected'); } ?>>Lowest First</option>
                                            <option value="DESC" <?php if(@$rating == "DESC"){ echo('selected'); } ?>>Highest First</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hiring Status</label>
                                        <select class="form-control" id="search_hiring" name="search_hiring">
                                            <option value="H">Hired</option>
                                            <option value="NH">Not Hired</option>
                                        </select>
                                    </div>
                                    -->
                                    <div class="form-group">
                                        <label>Order by</label>
                                        <select class="form-control" id="search_orderBy" name="search_orderBy">
                                            <option value="DESC" <?php if(@$orderBy == "DESC"){ echo('selected'); } ?>>Oldest first</option>
                                            <option value="ASC" <?php if(@$orderBy == "ASC"){ echo('selected'); } ?>>Newest first</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Search Keywords (Name or Username)</label>
                                        <input type="text" class="form-control" value="{{@$keyword}}" placeholder="KEYWORD FOR NAME/USERNAME" id="search_keyword" name="search_keyword" />
                                    </div>
                                    <div class="form-group">
                                        <label>Checkout Status</label>
                                        <select class="form-control" id="search_checkoutStatus" name="search_checkoutStatus">
                                            <option value="ALL">Display All</option>
                                            <option value="1">Checked Out</option>
                                            <option value="0">Not Checked Out</option>
                                        </select>
                                    </div>
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary" id="search_btn">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($users->count() == 0)
                            <div class="well selected-filters" style="text-align: center">
                                <font style="color: red">No data available.</font>
                            </div>
                        @else
                        <p class="hiddenNote" style="display:none;">You can swipe the table</p>
                        <div class="tg-wrap">
                            <table class="tg table table-hover table-striped"  style="background-color: white;">
                                <thead>
                                    <th class="tg-yw4l">Name @Username</th>
                                    <th class="tg-yw4l">Date of Registration</th>
                                    <th class="tg-yw4l">Account Status</th>
                                    <th class="tg-yw4l">Action</th>
                                    <th class="tg-yw4l">Audit Trail</th>
                                <thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <a href="viewUserProfile/{{$user->id}}" style="font-weight: bolder;">
                                                    {{ $user->fullName }} {{'@'.$user->username}}
                                                </a>
                                            </td>
                                            <td>{{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at)) }}</td>
                                            <td><b>{{$user->status}}</b></td>
                                            <td>
                                                @if($user->status == 'ACTIVATED')
                                                    <a style="border-radius: 0.3em;" data-msg="Confirm account DEACTIVATION of {{$user->fullName}}" class="ACT_DEAC btn-block btn btn-danger btn-xs" data-href="/adminDeactivate/{{$user->id}}">DEACTIVATE</a>
                                                @else
                                                    <a style="border-radius: 0.3em;" data-msg="Confirm account ACTIVATION of {{$user->fullName}}" class="ACT_DEAC btn-block btn btn-success btn-xs" data-href="/adminActivate/{{$user->id}}">ACTIVATE</a>
                                                @endif
                                            </td>
                                            <td style="text-align: center;"><a style="font-size:1.3em" href="/auditTrail={{$user->id}}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                            <!--
                            @foreach($users as $user)
                                <div class="media block-update-card" style="">
                                    <a class="pull-left" href="/viewUserProfile/{{$user->id}}">
                                        @if($user->profilePic != "")
                                            <img class="media-object update-card-MDimentions" src="{{$user->profilePic}}">
                                        @else
                                            <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                        @endif
                                    </a>
                                    <div class="media-body update-card-body">
                                        <a href="viewUserProfile/{{$user->id}}" style="font-weight: bolder;">
                                            {{ $user->fullName }} {{'@'.$user->username}}
                                        </a>
                                        <p>
                                            {{--<i class="fa fa-map-marker"></i> {{ $user->regname }}, {{ $user->cityname }}<br/>--}}
                                            Registered at {{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at)) }}<br/>
                                            <a href="/auditTrail={{$user->id}}" class="btn btn-success btn-xs" style="border-radius: 0.3em; background-color: #9B59B6;">View Audit Trail</a>
                                            @if($user->status == 'ACTIVATED')
                                                <a style="border-radius: 0.3em;" data-msg="Confirm account DEACTIVATION of {{$user->fullName}}" class="ACT_DEAC btn btn-danger btn-xs" data-href="/adminDeactivate/{{$user->id}}">DEACTIVATE</a>
                                            @else
                                                <a style="border-radius: 0.3em;" data-msg="Confirm account ACTIVATION of {{$user->fullName}}" class="ACT_DEAC btn btn-success btn-xs" data-href="/adminActivate/{{$user->id}}">ACTIVATE</a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            -->
                            <center>{{ $users->links() }}</center>
                        @endif
                    </div>
                </div>
            </div>
        </section>
@stop