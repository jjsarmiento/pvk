@extends('layouts.usermain')

@section('title')
    Individual Clients
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
        @media(max-width: 767px){
          h1.lato-text {
              margin-top: 40px;
          }
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
        @media screen and (max-width: 767px) {
          .tg {
            width: auto !important; 
          }
          .tg col {
            width: auto !important;
          }
          .tg-wrap {
            overflow-x: auto;-webkit-overflow-scrolling: touch;
          }
        
}        /*-----------------*/
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
    </style>
@stop


@section('body-scripts')
    <script>
        $(document).ready(function(){
            CHAINLOCATION($('#cmpSearch_Region'), $('#cmpSearch_City'));
            CHAINLOCATION($('#cmpSearch_Region'), $('#cmpSearch_Province'));
            CHAINLOCATION($('#cmpSearch_Province'), $('#cmpSearch_City'));

            $('#searchBtn').click(function(){
                var searchWord = ($('#searchWord').val() == '') ? false : $('#searchWord').val(),
                    acctStatus = ($('#acct_status').val() == '') ? false : $('#acct_status').val(),
                    accountType = ($('#acctType').val() == '') ? false :$('#acctType').val(),
                    orderBy = $('#adminCMP_orderBy').val(),
                    searchBy = $('#adminCMP_SrchBy').val(),
                    region = ($('#cmpSearch_Region').val() == 'ALL') ? false : $('#cmpSearch_Region').val(),
                    city = ($('#cmpSearch_City').val() == 'ALL') ? false : $('#cmpSearch_City').val(),
                    province = ($('#cmpSearch_Province').val() == 'ALL') ? false : $('#cmpSearch_Province').val();

                location.href = '/userListClientIndi=search='+searchWord+'='+acctStatus+'='+accountType+'='+orderBy+'='+searchBy+'='+region+'='+city+'='+province;
            });

            $('.ACT_DEAC').click(function(){
                if(confirm($(this).data('msg'))){
                    location.href = $(this).data('href');
                }
            });
        });
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
                User List : Company
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"><span class="homeTitle">Home</span></i></a>
                    </li>
                    <li class="active">
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
                        <!--
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                    User Account List</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListTaskminators" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientIndi" class="sidemenu">Client - Individuals</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/userListClientComp" class="sidemenu">Client - Companies</a><br>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Pending Users</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingTskmntr" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientIndi" class="sidemenu">Client - Individual</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/pendingClientComp" class="sidemenu">Client - Companies/a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Tasks</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/" class="sidemenu">Bidding</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListAuto" class="sidemenu">Automatic</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/taskListDirect" class="sidemenu">Direct</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle">
                                Audit Trail</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_taskminator" class="sidemenu">Taskminators</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientindi" class="sidemenu">Client (Individual)</a><br>
                            <i class="glyphicon glyphicon-chevron-right"></i> &nbsp; <a href="/AT_clientcomp" class="sidemenu">Client (Company)</a>
                        </div>
                        <div class="panel-heading">
                            <div class="panel-title">
                                <a class="accordion-toggle" href="/categoryAndSkills">
                                Category & Skills</a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="well selected-filters">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="adminCMP_SrchBy" id="adminCMP_SrchBy">
                                    <option <?php if(@$adminCMP_SrchBy == 'username'){echo 'selected';} ?> value="username">Search by Username</option>
                                    <option <?php if(@$adminCMP_SrchBy == 'fullName'){echo 'selected';} ?> value="fullName">Search by Name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input id="searchWord" value="{{@$keyword}}" type="text" name="searchWord" placeholder="search keyword name/username" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button id="searchBtn" type="submit" class="btn btn-block btn-primary" style="margin: 0">Search</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="acctType" id="acctType">
                                    <option value="">All Account Type</option>
                                    @foreach($subs as $s)
                                        <option <?php if(@$adminCMP_accountType == $s->subscription_code){echo 'selected';} ?> value="{{$s->subscription_code}}">{{$s->subscription_label}}</option>
                                    @endforeach
                                    <!--
                                    <option <?php if(@$adminCMP_accountType == 'FREE'){echo 'selected';} ?> value="FREE">Free</option>
                                    <option <?php if(@$adminCMP_accountType == 'BASIC'){echo 'selected';} ?> value="BASIC">Basic</option>
                                    <option <?php if(@$adminCMP_accountType == 'PREMIUM'){echo 'selected';} ?> value="PREMIUM">Premium</option>
                                    <option <?php if(@$adminCMP_accountType == 'MASS_HIRING'){echo 'selected';} ?> value="MASS_HIRING">Mass Hiring</option>
                                    -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="adminCMP_orderBy" id="adminCMP_orderBy">
                                    <option <?php if(@$orderBy == 'ASC'){echo 'selected';} ?>  value="ASC">Oldest to Newest</option>
                                    <option <?php if(@$orderBy == 'DESC'){echo 'selected';} ?> value="DESC">Newest to Oldest</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="acct_status" id="acct_status">
                                    <option value="">All Account Status</option>
                                    <option <?php if(@$acct_status == 'DEACTIVATED'){echo 'selected';} ?> value="DEACTIVATED">Deactivated</option>
                                    <option <?php if(@$acct_status == 'ACTIVATED'){echo 'selected';} ?> value="ACTIVATED">Activated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="cmpSearch_Region" id="cmpSearch_Region">
                                    <option value="ALL">All regions</option>
                                    @foreach($regions as $r)
                                        <option <?php if(@$cmpSearch_Region == $r->regcode){ echo 'selected'; } ?> value="{{$r->regcode}}">{{$r->regname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="cmpSearch_Province" id="cmpSearch_Province" data-loctype="REGION_TO_PROVINCE" data-loctypeother="PROVINCE_TO_CITY">
                                    <option value="ALL">All provinces</option>
                                    @foreach($provinces as $p)
                                        <option <?php if(@$cmpSearch_Province == $p->provcode){ echo 'selected'; } ?> value="{{$p->provcode}}">{{$p->provname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="cmpSearch_City" id="cmpSearch_City" data-loctype="REGION_TO_CITY">
                                    <option value="ALL">All cities</option>
                                    @foreach($cities as $c)
                                        <option <?php if(@$cmpSearch_City == $c->citycode){ echo 'selected'; } ?> value="{{$c->citycode}}">{{$c->cityname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @if($users->count() == 0)
                    <div class="well selected-filters" style="text-align: center">
                        <font style="color: red">No data available.</font>
                    </div>
                @else
                    <div class="tg-wrap">
                        <table class="tg table table-hover" style="background:white;">
                            <thead>
                                <th class="tg-yw4l">Name @Username</th>
                                <th class="tg-yw4l">Date of Registration</th>
                                <th class="tg-yw4l">Account Status</th>
                                <th class="tg-yw4l">Action</th>
                                <th class="tg-yw4l">Audit Trail</th>
                            </thead>
                            @foreach($users as $user)
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="/viewUserProfile/{{$user->id}}" style="font-weight: bolder;">
                                            {{ $user->fullName }} {{'@'.$user->username}}
                                        </a>
                                    </td>
                                    <td>{{ date('D, M j, Y \a\t g:ia', strtotime($user->created_at)) }}</td>
                                    <td><b>{{$user->status}}</b></td>
                                    <td>
                                        @if($user->status == 'ACTIVATED')
                                            <a style="border-radius: 0.3em;" data-msg="Confirm account DEACTIVATION of {{$user->fullName}}" class="btn-block ACT_DEAC btn btn-danger btn-xs" data-href="/adminDeactivate/{{$user->id}}">DEACTIVATE</a>
                                        @elseif($user->status == 'DEACTIVATED' || $user->status == 'SELF_DEACTIVATED')
                                            <a style="border-radius: 0.3em;" data-msg="Confirm account ACTIVATION of {{$user->fullName}}" class="btn-block ACT_DEAC btn btn-success btn-xs" data-href="/adminActivate/{{$user->id}}">ACTIVATE</a>
                                        @else
                                            <a style="border-radius: 0.3em;" data-msg="Confirm account DEACTIVATION of {{$user->fullName}}" class="btn-block ACT_DEAC btn btn-danger btn-xs" data-href="/adminDeactivate/{{$user->id}}">DEACTIVATE</a>
                                            <a style="border-radius: 0.3em;" data-msg="Confirm account ACTIVATION of {{$user->fullName}}" class="btn-block ACT_DEAC btn btn-success btn-xs" data-href="/adminActivate/{{$user->id}}">ACTIVATE</a>
                                        @endif
                                        <a href="/points={{$user->id}}" class="btn btn-warning btn-xs btn-block" style="border-radius: 0.3em;">POINTS</a>
                                        <a href="/addSubscription={{$user->id}}" class="btn btn-primary btn-xs btn-block" style="border-radius: 0.3em;">Subscription</a>
                                    </td>
                                    <td style="text-align: center;"><a style="font-size:1.3em" href="/auditTrail={{$user->id}}"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <center>{{ $users->links() }}</center>
                @endif
            </div>
        </div>
    </div>
</section>
@stop


