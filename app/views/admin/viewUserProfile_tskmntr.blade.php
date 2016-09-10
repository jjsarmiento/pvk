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
                        <a href="/" style="cursor: pointer;"><i class="fa fa-home"></i></a>
                    </li>
                    <li>
                        <a href="/userListTaskminators">User List</a>
                    </li>
                    <li class="active">
                        {{ $user->firstName }} {{ $user->lastName }}'s Profile
                    </li>
                </ul>
            </div>
            <div class="col-sm-12">
                <div class="widget-container fluid-height">
                    <div class="widget-content">
                        <div class="col-sm-12" style="text-align: center; align-content: center; align-items: center;">
                                <br/>
                                @if($user->profilePic)
                                    <img src="{{$user->profilePic}}" width="90%" style="border-radius: 0.6em; box-shadow: 0 0 10px 1px #7F8C8D;" />
                                @else
                                    <img src="/images/default_profile_pic.png" width="90%" style="border-radius: 0.6em; box-shadow: 0 0 10px 1px #7F8C8D;" />
                                @endif
                                <h3 style="margin-top: 1em; color:white; font-weight:bold;" class="lato-text">{{ $user->firstName }} {{ $user->midName }} {{ $user->lastName }}</h3>
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
                            @endif
                            <br><br>
                        </div>
                        <div class="col-sm-12 mob">
                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-info-sign"></i>Personal Information
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Address</span>
                                     : <span style="margin-left: 5px">
                                        {{ Region::where('regcode', $user->region)->pluck('regname') }},
                                        {{ Province::where('provcode', $user->province)->pluck('provname') }},
                                        {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }},
                                        {{ City::where('citycode', $user->city)->pluck('cityname') }},
                                        {{$user->address}}
                                        </span>
                                     <br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Birthdate</span>
                                     : <span style="margin-left: 5px">{{$user->birthdate}}</span><br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Gender</span>
                                     : <span style="margin-left: 5px">{{$user->gender}}</span><br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Marital Status</span>
                                     : <span style="margin-left: 5px">
                                        @if($user->marital_status)
                                        {{$user->marital_status}}
                                        @else
                                            <i>N/A</i>
                                        @endif
                                     </span><br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Status</span>
                                     : <span style="margin-left: 5px">{{$user->status}}</span><br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Account Created at</span>
                                     : <span style="margin-left: 5px">{{$user->created_at}}</span><br/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-phone"></i>Contact Details
                                </div>
                                <div style="padding: 0 12px; color:#dddddd;">
                                    @foreach(Contact::where('user_id', $user->id)->get() as $conts)
                                        <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">{{ $conts->ctype }}</span>
                                         : <span style="margin-left: 5px">{{ $conts->content }}</span><br/>
                                    @endforeach
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <hr class="hrLine" />


                            <div class="col-md-7" style="color:#dddddd;">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="fa fa-graduation-cap" style="margin-right: 10px;"></i>Educational Background
                                </div>
                                @if($edu->count() > 0)
                                    @foreach($edu as $e)
                                        <div class="col-md-4" style="padding: 0 12px; color:#dddddd;">
                                            <span><b>{{$e->level}}: </b></span>
                                            <ul style="padding-left: 20px;">
                                                <li><b>School Name: </b>{{$e->school_name}}</li>
                                                @if($e->level == 'COLLEGE' || $e->level == 'VOCATIONAL')
                                                    <li><b>Course/Major: </b>{{$e->course_major}}</li>
                                                @endif
                                                <li><b>School Year: </b>{{$e->school_year}}</li>
                                                <li><b>Awards: </b>{{$e->awards}}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @else
                                    <center><i>No data available.</i></center>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-wrench"></i>Skills
                                </div>
                                <div style="padding: 0 12px;">
                                    @foreach($skills as $skill)
                                        <span class="" style="padding:8px; background: rgba(3, 127, 180, 0.5); border: 1px solid; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt; margin:5px;">{{ TaskItem::where('itemcode', $skill->taskitem_code)->pluck('itemname') }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <hr class="hrLine" />

                            <div class="col-md-12" style=" color:#dddddd;">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="fa fa-lightbulb-o" style="margin-right: 10px;"></i>Experience
                                </div>
                                @if($exp->count() > 0)
                                    @foreach($exp as $e)
                                        <div class="col-md-4" style="padding: 0 12px;">
                                            <ul>
                                                <li><b>Position: </b><b style="font-size:18px;">{{$e->position}}</b></li>
                                                <li><b>Company Name: </b><b style="font-size:15px;">{{$e->company_name}}</b></li>
                                                <li><b>Location: </b> {{$e->location}}</li>
                                                <li><b>Time Period: </b> {{$e->time_period}}</li>
                                                <li><b>Roles and Responsibilities: </b>{{$e->roles_and_resp}}</li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @else
                                    <center><i>No data available.</i></center>
                                @endif
                                <!--
                                @for($i=0; $i<3; $i++)
                                    <div class="col-md-4" style="padding: 0 12px; color:#dddddd;">
                                        <ul>
                                            <li><b>Position: </b><b style="font-size:18px;">Lorem Ipsum</b></li>
                                            <li><b>Company Name: </b><b style="font-size:15px;">Company Sample name</b></li>
                                            <li><b>Location: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper fringilla tellus in mattis. Quisque nec nisi lacus. Fusce ac sem sem. Nam tristique congue egestas.</li>
                                            <li><b>Time Period: </b>2015 - Present</li>
                                            <li><b>Roles and Responsibilities: </b>Sit dolor amet</li>
                                        </ul>
                                    </div>
                                @endfor
                                -->


                            </div>
                            <div style="clear:both;"></div>
                            <hr class="hrLine" />

                            <!-- <div class="col-md-12">
                                <div class="heading" style="font-size:14pt;">
                                    <i class="glyphicon glyphicon-star"></i>Ratings
                                </div>
                                <div style="padding: 0 12px;">
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Number of ratings</span>
                                     : <span style="margin-left: 5px">{{ $ratings }}</span><br/>
                                    <span style="text-transform: capitalize; color: white; margin-right: 5px; font-weight:600;">Total Ratings</span>
                                     : <span style="margin-left: 5px">{{ $starRatings }} stars</span><br/><br/>
                                    <a href="/viewRatings={{$user->id}}" class="btn btn-primary">View Ratings</a>
                                </div>
                            </div> 
                            <hr class="hrLine" />-->

                            <div class="col-md-6" style="color:white;">
                                <div class="heading">
                                    <i class="glyphicon glyphicon-folder-open"></i>Supporting Documents
                                </div>
                                <div style="padding: 0 35px;">
                                    @if($docs->count() == 0)
                                        <i>No data available.</i><br><br>
                                    @else
                                        @foreach($docs as $doc)
                                            <a style="top: 2px; color: #ffffff;" href="{{$doc->path}}" title="Download {{$doc->label}}"><i class="glyphicon glyphicon-download"></i></a>
                                            &nbsp;&nbsp;
                                            <a target="_tab" style="color: #ffffff;" href="{{ $doc->path }}">{{ $doc->label }}</a><br><br>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6" style="color:white;">
                                <div class="heading">
                                    <i class="fa fa-certificate" style="margin-right: 10px;"></i>Certification
                                </div>
                                <div style="padding: 0 35px;">
                                    @if($certs->count() > 0)
                                        @foreach($certs as $c)
                                            <span><b>Title of Training/Certificate: </b>{{ $c->title }}</span><br>
                                            <span><b>Date Taken: </b>{{ $c->date }}</span><br>
                                            <span><b>Organizer/Company: </b>{{ $c->organizer_company }}</span><br>
                                            <hr/>
                                        @endforeach
                                    @else
                                        <center><i>No data available.</i></center>
                                    @endif
                                </div>
                            </div>

                            <hr class="hrLine" style="padding-top:70px; margin-top: 70px" />
<!--                             <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="heading">
                                        <i class="glyphicon glyphicon-folder-open"></i>Misc. Documents
                                    </div>
                                    <div style="padding: 0 35px;">
                                        @if($miscDocs->count() == 0)
                                            <i>No data available.</i><br/>
                                        @else
                                            @foreach($miscDocs as $misc)
                                                <i class="glyphicon glyphicon-download" style="top: 2px;"></i> &nbsp;&nbsp;<a href="{{ $misc->path }}">{{ $misc->name }}</a><br/>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="heading">
                                        <i class="glyphicon glyphicon-folder-open"></i>Misc. Photos
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
                            </div> -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--
            <span style="color: green; font-weight: bold">{{ @Session::get('successMsg') }}</span>
            <span style="color: red; font-weight: bold">{{ @Session::get('errorMsg') }}</span>
            @if($user->status == 'PRE_ACTIVATED')
            <a href="/adminActivate/{{$user->id}}">Fully Activate Account</a><br/>
            <a href="/adminDeactivate/{{$user->id}}">Deactivate Account</a><br/>
            @elseif($user->status == 'ACTIVATED')
            <a href="/adminDeactivate/{{$user->id}}">Deactivate Account</a><br/>
            @elseif($user->status == 'DEACTIVATED')
            <a href="/adminActivate/{{$user->id}}">Activate Account</a><br/>
            @elseif($user->status == 'SELF_DEACTIVATED')
            <a href="/adminActivate/{{$user->id}}">Activate Account</a><br/>
            @elseif($user->status == 'ADMIN_DEACTIVATED')
            <a href="/adminActivate/{{$user->id}}">Activate Account</a><br/>
            @endif
            <h3>{{ $user->firstName }} {{ $user->midName }} {{ $user->lastName }}</h3>
            <div style="border: 1px solid #333333; padding: 0.4em;">
                Address : {{$user->address}}<br/>
                Birthdate : {{$user->birthdate}}<br/>
                City : {{$user->city}}<br/>
                Barangay : {{$user->barangay}}<br/>
                Gender : {{$user->gender}}<br/>
                Status : {{$user->status}}<br/>
                Account Created at : {{$user->created_at}}<br/>
                <hr/>
                Contact Details :<br/>
                @foreach(Contact::where('user_id', $user->id)->get() as $conts)
                    {{ $conts->ctype }} : {{ $conts->content }}<br/>
                @endforeach
                <hr/>
                Skills :<br/>
                @foreach($skills as $skill)
                    {{ TaskItem::where('itemcode', $skill->taskitem_code)->pluck('itemname') }}<br/>
                @endforeach
                <hr/>
                Number of ratings : {{ $ratings }}<br/>
                Total Ratings : {{ $starRatings }} stars<br/>
                <a href="/viewRatings={{$user->id}}">View Ratings</a>
            </div>
            Documents (Click to download) :<br/>
            @if($docs->count() == 0)
                <i>No data available.</i><br/>
            @else
                @foreach($docs as $doc)
                <a href="{{ $doc->path }}">{{ $doc->docname }}</a><br/>
                @endforeach
            @endif
            <hr/>
            Key Skill Certification :<br/>
            @if($keyskills->count() == 0)
                <i>No data available.</i><br/>
            @else
                @foreach($keyskills as $ks)
                <a href="{{ $ks->path }}"><img src="{{ $ks->path }}" title="{{ $ks->imgname }}" width="100em;" style="border: 1px solid #333333; border-radius: 0.3em"/></a>
                @endforeach
            @endif
            <hr/>
            Misc. Documents : <br/>
            @if($miscDocs->count() == 0)
                <i>No data available.</i><br/>
            @else
                @foreach($miscDocs as $misc)
                    <a href="{{ $misc->path }}">{{ $misc->name }}</a><br/>
                @endforeach
            @endif
            <hr/>
            Misc. Photos : <br/>
            @if($photos->count() == 0)
                <i>No data available.</i><br/>
            @else
                @foreach($miscDocs as $misc)
                    <a href="{{ $misc->path }}">{{ $misc->name }}</a><br/>
                @endforeach
            @endif
            <hr/>
        -->
    </div>
</section>
@stop