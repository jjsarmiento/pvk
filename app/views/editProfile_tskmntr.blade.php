@extends('layouts.usermain')

@section('title')
    Edit your profile
@stop

@section('head-content')
    <style>
        i{cursor:default !important;}
        body{background-color:#E9EAED;}
        .thumbnail {
            border: 1px solid #BDC3C7;
            border-radius: 0.3em;
            cursor: pointer;
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            /*float: left;*/
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
            width: 150px;
            height: 150px;
        }
        .form-control {
            padding:5px !important;
        }
        .btn {
            border-radius:3px;
            transition: 0.3s;
        }
        button.btn.btn-xs.btn-default.pull-right {
            border: 1px solid;
        }          
        .btn-default {
            border-color: #ededed;
            color: #fff;
            background-color: #2980b9;
        }
        .btn-default:hover{
            color: #2980b9;
            background-color:#fff;
            border-color: none !important;
        }
        a.btn.btn-danger.btn-xs:hover {
            color: #c9302c;
            background-color: transparent;          
        }
        .thumbnail{
            border-radius: 360px;
            width: 150px;
            height: 150px;
            margin: auto;     
        }
        button.btn.btn-success:hover{
            background: transparent;
            color: #5cb85c;
        }
        hr{max-width:100%; max-height:1px;border:none;border-bottom:1px solid #ccc; padding:0;}
        @media (max-width: 768px) {
            .col-md-9.bord{
                border: none !important;
            }
            .row.padded.bord{
                border-bottom: 1px solid #cdcdcd;
            }
        }
    </style>
@stop

@section('user-name')
    {{ Auth::user()->firstName }}
@stop

@section('content')
<section style="padding-top:50px;">
    <div class="container lato-text">
        <div class="page-title" style="border-radius:3px;">
            <h1 class="lato-text">
                Edit Profile
            </h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="active">
                        Edit Profile
                    </li>
                </ul>
            </div>
            @if(Session::has('errorMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {{ @Session::get('errorMsg') }}
                    </div>
                </div>
            @endif
            @if(Session::has('successMsg'))
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        {{ @Session::get('successMsg') }}
                    </div>
                </div>
            @endif
        </div>
        <div clsss="row">
            <div class="col-md-12" style="background-color:white; border-radius:3px;">
                <div class="col-md-3 container lato-text padded">
                    <div class="row padded" style="border-bottom: 1px solid #cdcdcd;">
                        @if(Auth::user()->profilePic == null)
                            <div class="thumbnail">
                                @if(Auth::user()->profilePic)
                                    <img src="{{ Auth::user()->profilePic }}" class="portrait"/><br>
                                @else
                                    <img src="/images/default_profile_pic.png"/><br>
                                @endif
                            </div>
                            <h3 class="lato-text" style="margin-top:0px;">{{ $user->fullName }}</h3>
                            <div class="heading" style="margin-bottom: 15px;">
                                <i class="icon-signal"></i>Please upload a profile picture
                            </div>
                            <div class="widget-content" style="width: 236px;">
                                {{ Form::open(array('url' => '/uploadProfilePic', 'id' => 'uploadProfilePicForm', 'files' => 'true')) }}
                                    <input type="file" name="profilePic" accept="image/*" class="form-control" /><br/>
                                    <button type="submit" class="btn btn-success" style="border: 1px solid #5cb85c;">Upload</button>
                                {{ Form::close() }}
                            </div>
                        @else
                            <div class="widget-content padded">
                                <div class="thumbnail">
                                    <a href="/editProfile"><img src="{{ Auth::user()->profilePic }}" class="portrait"/></a>
                                </div>
                                <div class="heading">
                                    <i class="glyphicon glyphicon-user"></i>{{ Auth::user()->fullName }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row padded bord" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="heading" style="font-size:13pt; color:#2980b9; padding-bottom: 3px;">
                            <i class="glyphicon glyphicon-phone-alt" style="font-size:14pt; color:#2980b9"></i>&nbsp Contact Information <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editContactInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                        </div>       
                        @foreach(Contact::where('user_id', $user->id)->get() as $con)
                            <span style="text-transform: capitalize; font-weight:600; margin-right: 5px;">
                                @if($con->ctype == "mobileNum") Mobile No.
                                @elseif($con->ctype == "businessNum") Business No.
                                @else {{ $con->ctype }} @endif
                            </span>
                             :
                            <span style="margin-left: 5px">{{ $con->content }}</span>
                            @if($con->ctype == "mobileNum")
                                @if(Contact::where('user_id',  Auth::user()->id)->pluck('pincode')!='verified')
                                    {{--<button class="btn btn-xs btn-primary" onclick="location.href='/doVerifyMobileNumber'" style="padding: 2px 10px 2px 10px; margin: 5px; text-transform: none;">Verify</button>--}}
                                @else
                                    {{--<span class="btn btn-xs btn-default" style=" margin: 5px;">Verified</span>--}}
                                @endif
                            @endif
                            <br/>
                        @endforeach
                    </div>

                    <div class="row padded bord">
                        <div class="heading" style="font-size:14pt; color:#2980b9">
                           <i class="fa fa-certificate" style="font-size:14pt; color:#2980b9"></i>&nbsp Certification <button class="btn btn-xs btn-default pull-right" onclick="#" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                        </div>  
                        <span>N/A</span>
                    </div>
 
                </div>

                <div class="col-md-9 bord" style="border-left: 1px solid #cdcdcd;">
                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-sm-6 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Personal Information <button onclick="location.href='/editPersonalInfo'" class="btn btn-xs btn-default pull-right border: 1px solid #2980b9;" style="padding: 2px 10px 2px 10px; text-transform: none; border: 1px solid #2980b9;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div>   
                            <div class="col-md-12" style="padding-left: 27px;">
                                <span><b>Name: </b>{{ $user->fullName }}</span><br>
                                <span><b>Birthdate: </b> {{Auth::user()->birthdate}}</span><br>
                                <span><b>Age: </b> {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::parse(Auth::user()->birthdate)) }} y/o</span><br>
                                <span><b>Gender: </b>{{ Auth::user()->gender }}</span><br>
                                <span><b>Marital Status: </b> {{ Auth::user()->marital_status }}</span><br>
                                <span ><b>Address: </b>{{Auth::user()->address}}{{ Region::where('regcode', $user->region)->pluck('regname') }} {{ Province::where('provcode', $user->province)->pluck('provname') }} {{ Barangay::where('bgycode', $user->barangay)->pluck('bgyname') }} {{ City::where('citycode', $user->city)->pluck('cityname') }}</span><br>
                                <span><b>Account Created: </b>{{Auth::user()->created_at}}</span>
                            </div>     
                        </div>
                        <div class="col-sm-6 padded">
                            <div class="col-md-12 well" style="margin-bottom:0;">
                                <div class="heading" style="font-size:14pt; color:#2980b9">
                                    <i class="glyphicon glyphicon-map-marker" style="font-size:14pt; color:#2980b9"></i>&nbsp Account Information
                                </div>
                                <div style="padding-left: 30px;" style="display:table">
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Username</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                        <span style="display:table-cell">{{ Auth::user()->username }}</span>
                                    </div>
                                    <div style="display:table-row;">
                                        <span style="display:table-cell; text-transform: capitalize; color: rgb(72, 157, 179); margin-right: 5px;">Password</span>
                                        <span style="display:table-cell; padding-right:10px; padding-left:10px;"> : </span>
                                        <span style="display:table-cell">******</span>
                                    </div>
                                    <br/>
                                    <a href="#" data-target="#CHNGPSS-MODAL" data-toggle="modal" class="btn btn-primary btn-xs" style="border-radius: 4px; border:1px solid #2980b9">Change password</a><br/>
                                    <a href="#" data-target="#DEACTIVATE-MODAL" data-toggle="modal" class="btn btn-danger btn-xs" style="border-radius: 4px; border: 1px solid #d9534f; ">Deactivate Account</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-graduation-cap" style="font-size:14pt; color:#2980b9"></i> Educational Background
                                <a class="btn btn-xs btn-default pull-right" href="/editPersonalInfo" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                            </div> 
                            <div style="padding-left:27px;">
                                <!-- <span>
                                    {{Auth::user()->educationalBackground}}
                                </span> -->
                                <div class="col-md-4">
                                    <span><b>College/Vocational: </b></span>
                                    <ul>
                                        <li><b>School Name: </b>Lorem ipsum</li>
                                        <li><b>Course: </b>BSIT</li>
                                        <li><b>School Year: </b>2001/2015</li>
                                        <li><b>Awards: </b>N/A</li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <span><b>High School: </b></span>
                                    <ul>
                                        <li><b>School Name: </b>Lorem ipsum</li>
                                        <li><b>School Year: </b>1996/2001</li>
                                        <li><b>Awards: </b>N/A</li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <span><b>Elementary: </b></span>
                                    <ul>
                                        <li><b>School Name: </b>Lorem ipsum</li>
                                        <li><b>School Year: </b>1990/1996</li>
                                        <li><b>Awards: </b>N/A</li>
                                    </ul>
                                </div>
                            </div>      
                        </div>

                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                               <i class="fa fa-lightbulb-o" style="font-size:14pt; color:#2980b9"></i>&nbsp Experience
                               <a class="btn btn-xs btn-default pull-right" href="/editPersonalInfo" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                            </div>
                            <!-- @if(Auth::user()->experience)
                                {{Auth::user()->experience}}
                            @else
                                N/A
                            @endif -->
                            @for($i=0; $i<3; $i++)
                                <ul>
                                    <li><b>Position: </b><b style="font-size:18px;">Lorem Ipsum</b></li>
                                    <li><b>Company Name: </b><b style="font-size:15px;">Company Sample name</b></li>
                                    <li><b>Location: </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ullamcorper fringilla tellus in mattis. Quisque nec nisi lacus. Fusce ac sem sem. Nam tristique congue egestas.</li>
                                    <li><b>Time Period: </b>2015 - Present</li>
                                    <li><b>Roles and Responsibilities: </b>Sit dolor amet</li>
                                </ul>
                                @if($i < 2)
                                <hr>
                                @endif
                            @endfor
                        </div>

                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">

                    </div>

                    <div class="row" style="border-bottom: 1px solid #cdcdcd;">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="glyphicon glyphicon-star" style="font-size:14pt; color:#2980b9"></i>&nbsp Skills <button class="btn btn-xs btn-default pull-right" onclick="location.href='/editSkillInfo'" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</button>
                            </div> 
                            <div style="padding-left:27px;">
                                @foreach(User::getSkills(Auth::user()->id) as $skill)
                                    <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $skill->itemname }}</span>
                                @endforeach
                                @foreach($customSkills as $cs)
                                    <span style="border:2px solid white; padding:8px; background-color: #BDC3C7; display:inline-block; color: white; border-radius: 0.2em; font-size: 12pt;">{{ $cs->skill }}</span>
                                @endforeach
                            </div>      
                        </div>
                    </div>

                    <div class="row" style="">
                        <div class="col-md-12 padded">
                            <div class="heading" style="font-size:14pt; color:#2980b9">
                                <i class="fa fa-file" style="font-size:14pt; color:#2980b9"></i>&nbsp Supporting Documents
                                <a class="btn btn-xs btn-default pull-right" href="/editDocuments" style="padding: 2px 10px 2px 10px; text-transform: none;"><i class="fa fa-pencil-square-o"></i>&nbsp Edit</a>
                            </div> 
                            <div style="padding-left:27px;">
                                @if($docs->count() > 0)
                                    @foreach($docs as $d)
                                        <i class="fa fa-check-circle" style="color: #2ECC71;"></i>&nbsp;<span style="color: rgb(72, 157, 179);">{{$d->sys_doc_label}}</span><br/>
                                    @endforeach
                                @else
                                    <span>N/A</span>
                                @endif
                            </div>      
                        </div>
                    </div>                    

                </div>
            </div>
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
                                    <li><a href="/about">About</a></li>
                                    <li>{{ HTML::link('/howitworks', 'How It Works')}}</li>
                                    <li>  {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}</li>
                                    <li>  {{ HTML::link('/pricing', 'Pricing')}}</li>
                                    <li><a href="/faq">FAQ</a></li>
                                    <li>    {{ HTML::link('/login', 'Login / Sign Up')}}</li>
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



{{ Form::close() }}
@stop

@section('body-scripts')
    <script>
        $(document).ready(function(){
            $('#profilePicDiv').hover(function(){
                $('#picNotice').fadeToggle('fast');
            })
        })
    </script>
@stop