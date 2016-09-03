@extends('layouts.usermain')

@section('title')
    @if($CLIENTFLAG && $roles == 'TASKMINATOR')
        @if($PURCHASED == 0)
            {{substr_replace($users->firstName, str_repeat('*', strlen($users->firstName)-1), 1)}}
            &nbsp;
            {{substr_replace($users->lastName, str_repeat('*', strlen($users->lastName)-1), 1)}} | Profile Page
        @else
            {{ $users->fullName }} | Profile Page
        @endif
    @else
        {{ $users->fullName }} | Profile Page
    @endif
@stop
<style type="text/css">
    .btn.btn-warning{
        padding: 10px 30px;
    }
    @media(max-width: 320px){
        .btn.btn-warning{
            width: 100%;
        }
    }
    span.skills {
        background-color: #2980b9;
        padding: 10px 18px;
        margin: 5px;
        color: white;
        font-size: 18px;
        line-height: 3em;
    }
    @media (max-width: 767px){
        .col-md-6 {
            margin-bottom: 20px;
        }
        .skills{
            width: 100% !Important;
            display: block;
        }
    }
</style>
@section('content')
    <!-- HEADER SEARCH SECTION -->
    <header style="min-height:70%;">
        <div class="vegas.overlay" style="width:100%; height:100%; background-color:rgba(0,0,0,.7);">
            <div class="header-content">
                <div class="header-content-inner wow fadeIn text-center" data-wow-delay="0s" > <!--style="background-color:rgba(0,0,0,.5); padding-top: 35px; padding-bottom:15px; border-radius: 8px;" -->
                    @if($users->profilePic)
                        <img class="userProfile" src="{{$users->profilePic}}" />
                    @else
                        <img class="userProfile" src="/images/default_profile_pic.png" />
                    @endif
                    <!-- <img class="userProfile" src="frontend/img/team/01.png"/> -->
                    <h2 class="lato-text">
                        @if($roles == 'TASKMINATOR')
                            @if($CLIENTFLAG)
                                @if($PURCHASED == 0)
                                    {{substr_replace($users->firstName, str_repeat('*', strlen($users->firstName)-1), 1)}}
                                    &nbsp;
                                    {{substr_replace($users->lastName, str_repeat('*', strlen($users->lastName)-1), 1)}}
                                @else
                                    {{ $users->fullName }}
                                @endif
                            @else
                                {{ $users->fullName }}
                            @endif
                        @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                            {{ $users->companyName }}
                        @else
                            {{ $users->fullName }}
                        @endif
                    </h2>
<!--                     <p style="margin:auto;" class="btn btn-primary lato-text">
                        @if ( $roles == 'TASKMINATOR')
                            {{ $users->skills }}
                        @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                            {{ $users->businessNature }}
                        @elseif ( $roles == 'ADMIN')
                             Administrator
                        @endif
                    </p> -->
                    <br/>

                    <!-- Jups -->
<!--                     <div class="lato-text">
                        <div class="centered">
                            <span style="font-size:18px;"><em>" To be successful in my field, Proin porta nibh non dui ullamcorper pretium. Ut nunc augue, aliquet vitae luctus sit amet, molestie vitae ante. "</em></span>
                        </div>
                    </div> -->
                    <br/>
                    @if($roles == 'TASKMINATOR' && $CLIENTFLAG)
                        <div class="col-md-12">

                            <div class="col-md-4 col-md-offset-2 padded">
                                <a data-toggle="modal" data-target="#INVITEMULTIJOB" class="btn-block btn btn-warning" href="#"><i class="fa fa-envelope-o" style="color: #2ECC71;"></i> Invite to apply</a>
                            </div>

                            @if($PURCHASED == 0 && BaseController::IS_AN_APPLICANT_FOR_COMPANY($users->id, Auth::user()->id))
                                <div class="col-md-4 padded">
                                    <a href="/doCheckout={{$users->id}}" class="btn btn-block btn-warning" style="background-color: #E74C3C;">Checkout</a>
                                    <!-- OLD CART PROCEDURE
                                    @if($USERINCART > 0)
                                        <a href="#" class="btn btn-warning SHWCRT" data-target="#CARTMODAL" data-toggle="modal" style="background-color: #E74C3C;"><i  class="fa fa-cart-plus"></i>&nbsp;&nbsp;Added to cart</a>
                                        <a href="/checkouts" class="btn btn-warning SHWCRT" style="background-color: #E74C3C;"><i  class="fa fa-cart-plus"></i>&nbsp;&nbsp;Added to cart</a>
                                        <a href="#" class="SHWCRT btn btn-danger"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Added to Cart</a>
                                    @else
                                        <a href="/addToCart={{$users->id}}" class="btn btn-warning"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</a>
                                    @endif
                                    <a data-toggle="modal" data-target="#INVITEMULTIJOB" class="btn btn-warning" href="#"><i class="fa fa-envelope-o" style="color: #2ECC71;"></i> Checkout </a>
                                    -->
                                </div>
                            @endif

                            <div class="col-md-4 padded">
                                @if($roles == 'TASKMINATOR')
                                    @if($CLIENTFLAG)
                                        @if(User::IS_BOOKMARKED(Auth::user()->id, $users->id))
                                            <a class="btn btn-block btn-warning" href="/REMOVE_BOOKMARK:{{BookmarkUser::where('worker_id', $users->id)->where('company_id', Auth::user()->id)->pluck('id')}}"><i class="BOOKMARK_USER fa fa-bookmark" style="color: #2ECC71;"></i> Worker is  bookmarked</a>
                                        @else
                                            <a class="btn btn-block btn-warning" href="/ADD_BOOKMARK:{{$users->id}}"><i class="BOOKMARK_USER fa fa-bookmark-o" style="color: #2ECC71;"></i> Bookmark this worker</a>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- <div class="text-center div_header">
                    <a href="#next" class="page-scroll">
                        <i class="fa fa-3x fa-angle-down"></i>
                    </a>
                    </div> -->
                </div>
            </div>
        </div>
    </header>
    <!-- END OF -->

<!-- DESCRIPTION -->
    <section id="next" style="border-bottom:1px solid #222; padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 20px;">
                    <div class="col-md-6">
                        <!-- GEN INFO -->
                        <div class="lato-text">
                            <i class="fa fa-3x fa-info-circle text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Information</span></i>
                            <hr class="hrLine">
                            <div class="content">
                                <span><b>Address: </b>{{$users->address}}, {{$users->regname}}, {{$users->cityname}} {{$users->bgyname}}</span><br>
                                <span><b>Gender: </b>{{{$users->gender}}}</span><br>
                                <span><b>Birthdate: </b>{{$users->birthdate}} ({{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::parse($users->birthdate)) }} years old)</span><br>
                                @if($users->marital_status)
                                    <span><b>Martial Status: </b>{{$users->marital_status}}</span><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="lato-text">
                            <i class="fa fa-3x fa-phone text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Contact Info</span></i>
                            <hr class="hrLine">
                            @if($CLIENTFLAG && $roles == 'TASKMINATOR')
                                @if($PURCHASED > 0)
                                    <!-- CONTACT INFO -->
                                    <div class="ConInfo" style="text-transform: capitalize;">
                                        @foreach(Contact::where('user_id', $users->id)->get() as $con)
                                            <span><b>
                                                @if($con->ctype == "mobileNum")
                                                    Mobile #
                                                @elseif($con->ctype == "businessNum")
                                                    Business #
                                                @elseif($con->ctype == 'email')
                                                    Email
                                                @else
                                                    {{ $con->ctype }}
                                                @endif
                                            </b></span>
                                             :
                                            <span style="margin-left: 5px">{{ $con->content }}</span>
                                            <br/>
                                        @endforeach
                                        <!--
                                        <span><b>Mobile #: </b>{{$mobile}}</span><br>
                                        <span><b>Email: </b><a href="mailto:fakeemail@gmail.com">fakeemail@gmail.com</a></span><br>
                                        <span><b>FB: </b><a href="facebook.com" target="_Blank">Facebook.com</a></span><br>
                                        <span><b>Twitter: </b><a href="twitter.com" target="_Blank">Twitter.com</a></span><br>
                                        <span><b>Linkedin: </b><a href="linkedin.com" target="_Blank">Linkedin.com</a></span>
                                        -->
                                    </div>
                                @else
                                    <span style="color:red; font-size:15px;">
                                        <em><b>Note:</b> Contact Information will only be available after you check-out the Worker's Profile</em>
                                    </span>
                                @endif
                            @else
                                <!-- CONTACT INFO -->
                                <div class="ConInfo" style="text-transform: capitalize;">
                                    <span><b>Mobile #: </b>{{$mobile}}</span><br>
                                    <span><b>Email: </b><a href="mailto:fakeemail@gmail.com">fakeemail@gmail.com</a></span><br>
                                    <span><b>FB: </b><a href="facebook.com" target="_Blank">Facebook.com</a></span><br>
                                    <span><b>Twitter: </b><a href="twitter.com" target="_Blank">Twitter.com</a></span><br>
                                    <span><b>Linkedin: </b><a href="linkedin.com" target="_Blank">Linkedin.com</a></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--=========================-->
                <div class="col-md-12" style="padding-bottom: 20px;">
                    <div class="col-md-6">
                        <!-- SKILL INFO -->
                        <div class="lato-text">
                            <i class="fa fa-3x fa-star text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Skill & Competencies</span></i>
                            <hr class="hrLine">
                            <div class="content">
                                @foreach(User::getSkills($users->id) as $skill)
                                    <span class="skills" style="text-align:center;">{{ $skill->itemname }}</span>
                                @endforeach
                                @foreach(User::GET_CUSTOM_SKILLS($users->id) as $skill)
                                    <span class="skills" style="text-align:center;">{{ $skill->skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- EDUCATIONAL BACKGROUND -->
                        <div class="lato-text">
                            <i class="fa fa-3x fa-book text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Educational Background</span></i>
                            <hr class="hrLine">
                            <div class="content">
                                @if($PURCHASED > 0)
                                    @if($edu->count() > 0)
                                        @foreach($edu as $e)
                                            <div class="col-md-4" style="word-wrap: break-word;">
                                                <span><b>{{$e->level}}</b></span>
                                                <ul>
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
                                        <center>N/A</center>
                                    @endif
                                @else
                                    <center><i class="fa fa-info-circle"></i> Checkout Worker's profile first.</center>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--=========================-->
                <div class="col-md-12" style="padding-bottom: 20px;">
                    <div class="col-md-6">
                        <!-- RELEVANT EXP INFO -->
                        <div class="lato-text">
                            <i class="fa fa-3x fa-lightbulb-o text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Relevant Experiences</span></i>
                            <hr class="hrLine">
                            <div class="content">
                                @if($PURCHASED > 0)
                                    @if($RELEVANT_EXP->count() > 0)
                                        @foreach($RELEVANT_EXP as $e)
                                            <ul>
                                                <li>Company : {{$e->position}}</li>
                                                <li>Position : {{$e->company_name}}</li>
                                                <li>Location : {{$e->location}}</li>
                                                <li>Time Period : {{$e->time_period}}</li>
                                                <li>Roles and Responsibility : {{$e->roles_and_resp}}</li>
                                            </ul>
                                            <hr/>
                                        @endforeach
                                    @else
                                        <center>N/A</center>
                                    @endif
                                @else
                                    <center><i class="fa fa-info-circle"></i> Checkout Worker's profile first.</center>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Supporting Documents -->
                        <div class="lato-text">
                            <i class="fa fa-3x fa-file text-primary">
                            <span class="section-heading lato-text" style="font-size: 30px; color:#333;">Supporting Documents</span></i>
                            <hr class="hrLine">
                            <div class="content">
                                @if($PURCHASED > 0)
                                    @if(count($DOCS) > 0)
                                        @foreach($full_docs as $d)
                                            <a download href="{{$d->path}}"><span><i class="fa fa-check-circle" style="color: #1ABC9C; font-size: 1.3em;"></i> {{$d->label}}</span>&nbsp;&nbsp;</a><br/>
                                        @endforeach
                                    @else
                                        <center>N/A</center>
                                    @endif
                                @else
                                    @if(count($DOCS) > 0)
                                        @foreach($DOCS as $d)
                                            <span><i class="fa fa-check-circle" style="color: #1ABC9C; font-size: 1.3em;"></i> {{$d}}</span>&nbsp;&nbsp;<br/>
                                        @endforeach
                                    @else
                                        <span style="color:red; font-size:15px;">
                                            <em><b>Note:</b> Supporting Documents will only be available for viewing and download after you check-out the Worker's Profile</em>
                                        </span>
                                    @endif
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!--             <div class="row">
                @if($roles == 'TASKMINATOR' || $roles == 'ADMIN')
                    <div class="col-lg-8 text-center">
                        <i class="fa fa-3x fa-info-circle text-primary"></i>
                        <h2 class="section-heading">Information</h2>
                        <hr class="hrLine">
                        <div class="col-lg-12 lato-text" style="font-size:14pt; text-align: left;">
                            <div style="padding-left: 30px;" style="display:table;">
                                @if($CLIENTFLAG && $roles == 'TASKMINATOR')
                                    @if($PURCHASED > 0)
                                        <div style="display:table-row;">
                                            <span style="display:table-cell;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell;">{{ $users->firstName }}</span>
                                        </div>
                                        <div style="display:table-row;">
                                            <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell">{{ $users->midName }}</span>
                                        </div>
                                        <div style="display:table-row;">
                                            <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                            <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                            <span style="display:table-cell">{{ $users->lastName }}</span>
                                        </div>
                                    @endif
                                @else
                                    <div style="display:table-row;">
                                        <span style="display:table-cell;text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">First Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell;">{{ $users->firstName }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Middle Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell">{{ $users->midName }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Last Name</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                        <span style="display:table-cell">{{ $users->lastName }}</span>
                                    </div>
                                @endif

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Region</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Region::where('regcode', $users->region)->pluck('regname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Province</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Province::where('provcode', $users->province)->pluck('provname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">City / Municipality</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ City::where('citycode', $users->city)->pluck('cityname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Barangay</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;">:</span>
                                    <span style="display:table-cell">{{ Barangay::where('bgycode', $users->barangay)->pluck('bgyname') }}</span>
                                </div>

                                <div style="display:table-row;">
                                    <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Gender</span>
                                    <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                    <span style="display:table-cell">{{ $users->gender }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ( $roles == 'CLIENT_INDI' || $roles == 'CLIENT_CMP')
                        <div class="col-lg-8 text-center lato-text" style="word-wrap: break-word;">
                            <i class="fa fa-3x fa-info-circle text-primary" aria-hidden="true"></i>
                            <h2 class="section-heading">About Us</h2>
                            <hr class="hrLine">
                            <p style="font-size: 14pt;">
                                {{ $users->businessDescription}}
                            </p>
                        </div>
                    @endif

                <div class="col-lg-4 text-center lato-text">
                    <i class="fa fa-3x fa-phone text-primary"></i>
                    <h2 class="section-heading">Contact Info</h2>
                    <hr class="hrLine">
                    @if($CLIENTFLAG && $roles == 'TASKMINATOR')
                        @if($CLIENT_PROGRESSFLAG)
                            @if(BaseController::IS_AN_APPLICANT_FOR_COMPANY($users->id, Auth::user()->id))
                                @if($USERINCART > 0)
                                    <a href="#" data-target="#CARTMODAL" data-toggle="modal" class="SHWCRT btn btn-lg btn-danger btn-block" style="border-radius: 0.3em;">Added to Cart</a>
                                @elseif($PURCHASED > 0)
                                    <div class="list-group" style="text-align:left;">
                                        <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; {{ $mobile  }}</p>
                                        <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                                        <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                                        <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                                    </div>
                                    @if($jobapps->count() > 0)
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Job</th>
                                                    <th>Applied at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($jobapps as $jobs)
                                                    <tr>
                                                        <td><a target="_tab" href="/jobDetails={{$jobs->id}}">{{$jobs->title}}</a></td>
                                                        <td>{{$jobs->applied_at}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                    @if($HAS_INVITES->count() > 0)
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Job</th>
                                                    <th>Invited at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($HAS_INVITES as $jobs)
                                                    <tr>
                                                        <td><a target="_tab" href="/SNDINVT:{{$users->id}}:{{$jobs->id}}">{{$jobs->title}}</a></td>
                                                        <td>{{$jobs->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                    <a href="#" data-toggle="modal" data-target="#INVITEMULTIJOB" style="border-radius: 0.3em" class="btn-block btn-lg btn btn-primary"><i class="fa fa-envelope"></i> SEND INVITE</a>
                                @else
                                    <a href="/addToCart={{$users->id}}" class="btn btn-warning btn-lg btn-block" style="border-radius: 0.3em;"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</a>
                                @endif
                            @else
                                @if($HAS_INVITES->count() > 0)
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Job</th>
                                                <th>Invited at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($HAS_INVITES as $jobs)
                                                <tr>
                                                    <td><a target="_tab" href="/SNDINVT:{{$users->id}}:{{$jobs->id}}">{{$jobs->title}}</a></td>
                                                    <td>{{$jobs->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#INVITEMULTIJOB" style="border-radius: 0.3em" class="btn-block btn-lg btn btn-primary"><i class="fa fa-envelope"></i> SEND INVITE</a>
                            @endif
                        @endif
                    @else
                        <div class="list-group" style="text-align:left;">
                            <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; {{ $mobile  }}</p>
                            <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                            <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                            <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="col-lg-12 text-center">
                            <i class="fa fa-3x fa-briefcase text-primary" aria-hidden="true"></i>
                            <h2 class="section-heading">Documents</h2>
                            <hr class="hrLine">
                            <div class="col-12-lg lato-text" style="text-align: left;">
                                @foreach($DOCS as $d)
                                    <h4><i class="fa fa-check-circle" style="color: #2ECC71;"></i> {{$d}}</h4>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($roles == 'TASKMINATOR')
                        <div class="col-md-6">
                            <div class="col-lg-12 text-center">
                                <i class="fa fa-3x fa-star text-primary" aria-hidden="true"></i>
                                <h2 class="section-heading">Skills</h2>
                                <hr class="hrLine">
                                <div class="col-12-lg lato-text" style="text-align: left;">
                                    @foreach(User::getSkills($users->id) as $skill)
                                        <span style="border:2px solid white; padding:8px; background-color: #2980b9; display:inline-block; color: #f9f9f9; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                                    @endforeach
                                    @foreach(User::GET_CUSTOM_SKILLS($users->id) as $skill)
                                        <span style="border:2px solid white; padding:8px; background-color: #2980b9; display:inline-block; color: #f9f9f9; border-radius: 0.2em; font-size: 12pt;">{{ $skill->skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
 -->
<!-- ABOUT US DIV -->
<!--                 <div class="col-lg-12 text-center">
                    <i class="fa fa-3x fa-info-circle text-primary"></i>
                    <h2 class="section-heading">About Us</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div> -->

<!-- OFFERED JOBS -->
<!--                 <div class="col-lg-6 text-center">
                    <i class="fa fa-3x fa-flag text-primary"></i>
                    <h2 class="section-heading">Offered Jobs</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div> -->

<!-- CONTACT -->
                <!-- <div class="col-lg-6 text-center">
                    <i class="fa fa-3x fa-phone text-primary"></i>
                    <h2 class="section-heading">Contact Info</h2>
                    <hr style="border:none; max-height:1px; background:none; border-bottom:1px solid #2980b9">
                    <div class="list-group" style="text-align:left;">
                        <p class="list-group-item"><i class="fa fa-phone fa-fw"></i>&nbsp; +(63) 949-554-8249</p>
                        <a class="list-group-item" href="#"><i class="fa fa-facebook-square fa-fw"></i>&nbsp; Facebook</a>
                        <a class="list-group-item" href="#"><i class="fa fa-twitter-square fa-fw"></i>&nbsp; Twitter</a>
                        <a class="list-group-item" href="#"><i class="fa fa-instagram fa-fw"></i>&nbsp; Instagram</a>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
<!-- END OF -->
<!-- All scripts and plugin should be placed here so the page can load -->

@stop

@section('body-scripts')
<!-- FOR HEADER SLIDER -->
    <script>
        $('header').vegas({
          overlay: true,
          preload: true,
          preloadImage: true,
          transition: 'fade', 
          transitionDuration: 4000,
          delay: 10000,
          animation: 'random',
          shuffle: true,
          timer:false,
          animationDuration: 20000,
          slides: [
            { src: 'frontend/img/slideshow/10.jpg' }
            //{ src: 'frontend/img/slideshow/03.jpg' },
            //{ src: 'frontend/img/slideshow/05.jpg' },
            //{ src: 'frontend/img/slideshow/07.jpg' },
            //{ src: 'frontend/img/slideshow/02.jpg' },
            //{ src: 'frontend/img/slideshow/04.jpg' },
            //{ src: 'frontend/img/slideshow/06.jpg' }
          ]
        });
    </script>
    {{ HTML::script('frontend/js/creative.js') }}
<!-- END OF HEADER SLIDER -->
@stop