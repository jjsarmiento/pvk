<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Home</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    {{--<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>--}}
    {{--<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>--}}
    {{--{{ HTML::style('https://fonts.googleapis.com/css?family=Lato:300') }}--}}
    {{ HTML::style('frontend/css/Lato.css') }}
    {{ HTML::style('frontend/css/Open_Sans.css') }}
    {{ HTML::style('frontend/css/Merriweather.css') }}
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/lightslider.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <script src="js/jquery-1.11.0.min.js"></script>
    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <!--
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        -->
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">
    <style type="text/css">
        .lato-text { font-family: 'Lato', sans-serif}
        /*section{padding:0px 0px;}*/
        .signUpDiv
        {
            background-color: rgba(255,255,255,1);
            border:1px solid #ccc;
            border-radius: 4px; 
            padding-top: 25px; 
            padding-bottom:25px;
        }
        a.viewSal {
            background-color: #2980b9;
            border: 2px solid #226ea0;
            transition: 0.3s;
            color: white;
            padding: 5px 10px;
            text-transform: uppercase;
            font-size: 12px;
            display: table;
            margin-top: 5px;
        }
        a.viewSal:hover {
            background: transparent;
            color: #2980b9;
            text-decoration: none;
        }
        .scrolls{
            overflow-y:scroll; 
            height: 360px;
            border-radius:5px;
        }
        /* Let's get this party started */
        ::-webkit-scrollbar {
            width: 12px;
        }
         
        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            -webkit-border-radius: 10px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-top-left-radius: 5px;;
            border-bottom-left-radius: 5px;
            background: rgba(41,128,185,0.9);
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
        }
        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(41,128,185,0.9); 
        }
        @media (max-width: 320px){
            .col-lg-12.lato-text.g-recaptcha {
                margin-left: -35px;
            }
        }
        @media (max-width: 767px) {
            section.bg-primary {
                display: none;
            }      
        }
        @media (max-height: 720px) {
            .header-content {
                min-height: 100% !important;
                margin-top: 40px !important;
            }
        }
        @media (max-height: 600px){
            .header-content {
                min-height: 100% !important;
                margin-top: 45px !important;
            }
        }
    </style>
    <script src='https://www.google.com/recaptcha/api.js?hl=en?fallback=true'></script>
    <script>
        $(document).ready(function(){
            $('#minimalRegForm_Company').submit(function(e){
                $('#SUBMITBUTTON').prop('disabled', true).hide();
                $('#FAUXSUBMITBUTTON').show();

                if(grecaptcha.getResponse().length == 0){
                    alert("Please check the ReCaptcha First!");
                    e.preventDefault();
                    $('#FAUXSUBMITBUTTON').hide();
                    $('#SUBMITBUTTON').prop('disabled', false).show();
                }else{
                    e.preventDefault();
                    $.ajax({
                        type    :   'POST',
                        url     :   '/CHKRGWRKR',
                        data    :   $(this).serialize(),
                        success :   function(data){
                            if(data.length == 0){
                                $('#minimalRegForm_Company').unbind().submit();
                            }else{
                                $('#MODAL_LIST_ERRORS').empty();
                                $.each(data, function(key, value){
                                    $('#MODAL_LIST_ERRORS').append('<b>'+value+'</b><br/>');
                                });
                                $('#MODAL_ERROR').modal().show();
                                $('#FAUXSUBMITBUTTON').hide();
                                $('#SUBMITBUTTON').prop('disabled', false).show();
                            }
                        }
                    });
                }
            });
        });
    </script>
</head>

<body id="page-top">
    <div class="toTop">
        <a class="page-scroll text-primary" href="#page-top" style="text-decoration:none; outline:none;">
            <i class="fa fa-chevron-circle-up"></i>   Back to top
        </a>
    </div>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand page-scroll logoImg" href="/" style="padding:0; margin:0;"></a>
               
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {{ HTML::link('/', 'Worker')}}
                    </li>

                    <li class="active">
                        {{ HTML::link('/employer', 'Employer')}}
                    </li>

                    <li>
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>

                    <li>
                     <!--   <a class="" href="WhyProveek.html">Why Choose Proveek</a> -->
                         {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}

                    </li>
                    <!-- <li>
                         <a class="" href="Pricing.html">Pricing</a>
                        {{ HTML::link('/pricing', 'Pricing')}}
                    </li> -->
                    <li>
                        {{ HTML::link('/faq', 'FAQ')}}
                    </li>

                    <li>
                        <!--<a class="" href="#">Login / Sign Up</span></a> -->
                        {{ HTML::link('/login', 'Sign In')}}
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!--<div class="collapse navbar-collapse" style="background-color:rgba(255,255,255,.30); height: 25px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="page-scroll" href="#about" style="padding-top: 0;padding-bottom: 0">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services" style="padding-top: 0;padding-bottom: 0">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact" style="padding-top: 0;padding-bottom: 0">Contact</span></a>
                    </li>
                </ul>
            </div>-->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- HEADER SEARCH SECTION -->
    <header style="max-height: auto !important;">
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5);">
        <div class="header-content">
            <div class="header-content-inner lato-text">
                <div class="row">
                    <div class="col-lg-7 text-left">
                        <h2>Sign Up</h2>
                        <h3 class="lato-text">Post jobs and find suitable workers!</h3>
                        <br>
                        {{ Form::open(array('url' => '/regEmployer', 'id' => 'minimalRegForm_Company')) }}
                            <div class="col-lg-8 signUpDiv" style="">
                                <div class="col-lg-12" style="">
                                    {{ Form::label('lbl_companyName', 'Company name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('compName', null, ['class' => 'form-control', 'placeholder' => "Night's Watch", 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('firstName', 'First name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('fName', null, ['class' => 'form-control', 'placeholder' => 'Jon', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lastName', 'Last name', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('lName', null, ['class' => 'form-control', 'placeholder' => 'Snow', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>

                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('lbl_username', 'Username', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('uName', null, ['min' => '5', 'class' => 'form-control', 'placeholder' => 'markopotato', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_email', 'Email', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::text('txtEmail', null, ['class' => 'form-control', 'placeholder' => 'youremail@example.com', 'style' => 'border:none;', 'required' => 'True']) }}
                                </div>

                                <div class="col-lg-6" style="border-right:1px solid #ccc;">
                                    {{ Form::label('lbl_password', 'Passowrd', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::password('primary_pass' , array('style' => 'border:none;', 'class' => 'form-control', 'placeholder' => '•••••••', 'required' => 'True')) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_cPassword', 'Confirm Password', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    {{ Form::password('cPass' , array('style' => 'border:none;', 'class' => 'form-control', 'placeholder' => '•••••••', 'required' => 'True')) }}
                                </div>
                                <div class="col-lg-6">
                                    {{ Form::label('lbl_mobileNum', 'Mobile Number', ['style' => 'color:#333; text-transform: uppercase']) }}
                                    <input type="text" class="form-control" placeholder="09xxxxxxxxx" name="mobileNum" style="border: none;" required="required" />
                                </div>
                                <div class="col-lg-12 lato-text g-recaptcha" style="padding-top:10px;" data-sitekey="6LfpJyITAAAAAPxa-KWsJlqMNHL6qVK6nngZktlY"></div>
                                <div class="col-lg-12 lato-text">
                                    <p style="padding:0;margin:0;font-size:10pt; color:#0f0f0f">By clicking Sign Up, you agree to our <a href="#" data-target="#TERMSMODAL" data-toggle="modal">Terms</a> and that you have read our <a href="#" data-target="#PRIPOLMODAL" data-toggle="modal">Privacy Policy</a>.</p>
                                </div>
                                <div class="col-lg-12 text-center" style="padding-top:5px;">
                                    {{ Form::submit('Sign up for free', array('class' => 'btn btn-primary', 'style' =>'border-radius:4px; width:100%;', 'id' => 'SUBMITBUTTON')) }}
                                    <button id="FAUXSUBMITBUTTON" class="btn btn-primary btn-block" style="display: none; border-radius: 0.3em;" disabled><i class="fa fa-circle-o-notch fa-spin"></i> LOADING DATA</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- <div class="col-lg-5">
                        <h2 class="lato-text">Latest Jobs</h2>
                        <hr/>
                        <div class="text-left">
                          
                        </div>
                    </div> -->
                    <div class="col-lg-5" style="text-align: left;">
                        <h2 class="lato-text" style="text-align: center;">List of Newly Signup Workers</h2>
                        <hr style="margin-bottom:40px;">
                        <div class="scrolls">
                            @foreach($new_workers as $nw)
                            <div class="padded" style="background:white; border-bottom: 1px solid #f2f2f2;">
                                <div class="col-md-3 col-xs-5 no-padding">
                                    @if($nw->profilePic)
                                        <img src="{{$nw->profilePic}}" style="border: 1px solid #f2f2f2; width:100px; max-width:100%; display:table; margin-left:auto; margin-right:auto;">
                                    @else
                                        <img src="../images/default_profile_pic.png" style="border: 1px solid #f2f2f2; width:100px; max-width:100%; display:table; margin-left:auto; margin-right:auto;">
                                    @endif
                                </div>
                                <div class="col-md-9 col-xs-7" style="margin:auto;">
                                    <span style="font-size:12px; color:#000;">
                                        <b style="font-size:15px;">
                                            {{substr_replace($nw->firstName, str_repeat('*', strlen($nw->firstName)-1), 1)}}
                                            &nbsp;
                                            {{substr_replace($nw->lastName, str_repeat('*', strlen($nw->lastName)-1), 1)}}
                                        </b><br>
                                        <b>Profile Rating:</b> {{($nw->total_profile_progress ? $nw->total_profile_progress : 0)}}%<br>
                                        <!--
                                        <a href="#">{{$nw->username}}</a><br>
                                        <a href="/{{$nw->username}}" class="viewSal">View Full Profile</a>
                                        -->
                                    </span>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- <h1>Find Jobs that Matched Your Skills</h1>
                <hr>
                <p style="color:#ECF0F1">Proveek is an online platform that allows an individual or company to outsource jobs or hire skilled or manual laborers near their area.</p>
 -->
                <!-- SEARCH BOX -->
                <!-- <div class="col-xs-2"> --><!--used to center the textbox --><!-- </div> -->
                <!-- <div class="col-xs-8">
                    <div class="input-group">
                      <span class="input-group-addon" id="sizing-addon1"><span class=" glyphicon glyphicon-search"></span></span>
                      <input type="text" class="form-control" placeholder="Tell us what you need..." aria-describedby="basic-addon1" style="text-align:center;">
                    </div>
                </div> -->
                <!-- <div class="col-xs-2">used to center the textbox</div> -->       
                <!-- END OF SEARCH BOX -->

                <!-- SEARCH BUTTONS -->
		
                <!-- <div class="btn" style="padding-top: 20px;">
                    <a href="#GlobalModal" data-toggle="modal"  style="text-decoration:none;">
                        <button type="button" class="btn btn-primary btn-md" style="width: 180px; border-top-right-radius: 1em; border-bottom-right-radius: 1em;">Job Provider</button>
                        <button type="button" class="btn btn-primary btn-md" style="width: 180px;border-top-left-radius: 1em; border-bottom-left-radius: 1em;">Job Seeker</button>
                    </a>
                </div> -->
		
                <!-- END OF SEARCH BUTTONS -->
                <!-- <div class="text-center div_header">
                  <a href="#services" class="page-scroll">
                       <i class="fa fa-4x fa-angle-down"></i>
                  </a>
                </div> -->
                <!--<a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>-->
            </div>
        </div>
        </div>
    </header>
    <!-- END OF -->


<!-- SKILLS AND SERVICES -->
    <section id="services" style="padding-top:40px; padding-bottom:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                	<i class="fa fa-5x fa-users wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Skills and Services Offered</h2>
                    <hr class="primary">
                    <p>Please select from the catergories</p>
                </div>
            </div>
        </div>
    </section>
    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                    	<i class="fa fa-5x fa-building-o wow bounceIn text-primary" style="padding-top:50px;"></i>
                    	<h3>Construction / Factory Workers</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Construction / Factory Workers
                                </div>
                                <div class="project-name">
                                    <!-- 123,456 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <!-- <img src="#" class="img-responsive" alt=""> -->
                        <i class="fa fa-5x fa-cogs wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".1s"></i>
                        <h3>Automotive / Electronics</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Automotive / Electronics
                                </div>
                                <div class="project-name">
                                    <!-- 3,987,543 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-dollar wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".2s"></i>
                        <h3>Sales Agents / Salesclerk</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Sales Agents / Salesclerk
                                </div>
                                <div class="project-name">
                                   <!-- 9,123,456 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-user-md wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".3s"></i>
                        <h3>House Helpers / Caregivers</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    House Helpers / Caregivers
                                </div>
                                <div class="project-name">
                                    <!-- 546,152 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-wrench wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".4s"></i>
                        <h3>Repair &amp Maintenance Services</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Repair &amp Maintenance Services
                                </div>
                                <div class="project-name">
                                    <!-- 9,436 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-stethoscope wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".5s"></i>
                        <h3>Personal Care &amp Wellness</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Personal Care &amp Wellness
                                </div>
                                <div class="project-name">
                                    <!-- 5,859 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-cutlery wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".6s"></i>
                        <h3>Hotel &amp Restaurant Crew</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Hotel &amp Restaurant Crew
                                </div>
                                <div class="project-name">
                                    <!-- 1,285,956 resumes -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="#GlobalModal" data-toggle="modal" class="portfolio-box text-center" style="text-decoration:none;">
                        <i class="fa fa-5x fa-ellipsis-h wow bounceIn text-primary" style="padding-top:50px;" data-wow-delay=".7s"></i>
                        <h3>More</h3>
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    More
                                </div>
                                <div class="project-name">
                                    <span class="glyphicon glyphicon-option-horizontal text-default"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
<!-- END OF SKILLS AND SERVICES -->

<!-- POST A JOB -->
 <!-- 	<section class="bg-primary" style="background-image: url(frontend/img/header.jpg); background-position: center; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top: 40px; padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                	<i class="fa fa-5x fa-search wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Can't find what you're looking for?</h2><br>
                    <a href="#GlobalModal" data-toggle="modal" class="btn btn-default btn-lg" style="border-radius: 4em; width: 250px; outline:none;">Post a Job</a>
                    <!--<a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section> -->
<!-- END OF POST A JOB -->

<!-- TESTIMONIAL SLIDER -->
   <!--  <section style="background-color: white; background-position: top; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top: 40px; padding-bottom: 40px">
		<div class="item">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-lg-1"></div>
			        <div class="col-lg-10">
				        <div style="width:100%; color:#222" class="text-center">
					        <i class="fa fa-5x fa-comments-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
					        <h2>Testimonials</h2>
				        </div>
			        	<hr class="default" style="">
				        <ul id="lightSlider" class="content-slider" style="color: #222;">
				            <li>
				            	<div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Best Blue-collar job listing site in the Philippines. Period."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-AQUEOUS Inc.</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Proveek means Providers and Seekers, Great Idea!"</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-PewDiePie</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"15 million ducks out of 10."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Entrio Productions</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Made with love."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-BootPly.com</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Perfect place for blue-collar job seekers!"</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Awwwards.com</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10">
						                    <h3 style="font-style:oblique">"Made with Bootstrap 3, images from Unsplash.com, and powered by PHP."</h3>
						                    <div style="text-align:right;" class="text-default">
						                    <p>-Proveek</p>
						                    </div>
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				        </ul>
			        </div>
			        <div class="col-lg-1"></div>
			    </div>
		    </div>
	    </div>
    </section> -->
<!-- END OF TESTIMONIAL SLIDER -->

<!-- PARTNERSHIP SLIDER -->
    <section class="bg-primary" style="background-image: url(frontend/img/blur_03.jpg); background-position: top; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; padding-top:40px; padding-bottom: 40px">
		<div class="item">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-lg-1"></div>
			        <div class="col-lg-10">
				        <div style="width:100%; color:#222" class="text-center">
					        <i class="fa fa-5x fa-chain wow bounceIn text-primary" data-wow-delay=".2s"></i>
					        <h2 style="">Featured On</h2>
				        </div>
			        	<hr class="default" style="">
				        <ul id="lightSlider0" class="content-slider" style="color: #222;">
				            <li>
				            	<div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_tia.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_mst.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_philStar.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_bloomBusi.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				            <li>
				                <div class="row">
				            		<div class="col-md-1"></div>
				            			<div class="col-md-10 text-center">
						                    <img class="img-responsive" src="frontend/img/featuredOn/logo_dealStreet.png">
					                    </div>
				                    <div class="col-md-1"></div>
				                </div>
				            </li>
				        </ul>
			        </div>
			        <div class="col-lg-1"></div>
			    </div>
		    </div>
	    </div>
    </section>
<!-- END OF PARTNERSHIP SLIDER -->

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



<!-- MODALS -->
    <div class="modal modal-vcenter fade lato-text" id="GlobalModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: url(frontend/img/modalBg.jpg)">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <i class="fa fa-user-plus fa-5x text-primary"></i>
                    <h2 style="text-transform:uppercase;">Find Skilled Workers for your Job</h2>
                </div>
                <div class="modal-body text-center" style="padding-bottom:0">
                    <p style="font-size:16px;">Sign up as Employer now, post jobs and find workers suitable for that job. A 3-month subscription is active upon signing up.</p>
                </div>
                <div class="modal-footer text-center" style="text-align:center; padding-bottom:20px;">
                    <a href="/employer" class="btn btn-primary btn-md" style="border:1px solid #2980b9; font-size:16pt; padding:15px 30px 15px 30px;border-radius: 4px;">SIGN UP</a>
                </div>
            </div>
        </div>
    </div>

    {{--ERRORS MODAL--}}

    <div class="modal modal-vcenter fade lato-text" id="MODAL_ERROR" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center" style="padding-bottom:0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <center><i class="fa fa-warning fa-4x" style="color: #E74C3C"></i></center>
                    <div id="MODAL_LIST_ERRORS" style="text-align: center;">
                        {{--ERRORS GO HERE--}}
                    </div>
                </div>
                <div class="modal-footer text-center" style="text-align:center; padding-bottom:20px;">
                </div>
            </div>
        </div>
    </div>
<!-- END OF MODAL -->



<!-- All scripts and plugin should be placed here so the page can load -->
<!-- jQuery -->
    <script src="frontend/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
    <script src="frontend/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
    <script src="frontend/js/jquery.easing.min.js"></script>
    <script src="frontend/js/jquery.fittext.js"></script>
    <script src="frontend/js/wow.min.js"></script>
    <script src="frontend/js/vegas.js"></script>
    <script src="frontend/js/lightslider.js"></script>
<!-- Custom Theme JavaScript -->
    <script src="frontend/js/creative.js"></script>

    <script src="frontend/js/jquery.nicescroll.js"></script>
    <script src="frontend/js/custom.js"></script>
<!-- HTML SMOOTH MOUSEWHEEL SCROLLING -->
    <script>
    $(document).ready(

      function() { 

        $("html").niceScroll();

      }
    );
    </script>
<!-- END OF SMOOTH MOUSEWHEEL SCROLLING -->

<!-- FOR HEADER SLIDER -->
    <script>
        $('header').vegas({
          overlay: true,
          preload: true,
          preloadImage: true,
          transition: 'fade', 
          overlay: true,
          transitionDuration: 4000,
          delay: 10000,
          animation: 'fade',
          shuffle: true,
          timer:false,
          animationDuration: 20000,
          slides: [
            { src: 'frontend/img/slideshow/01.jpg' },
            { src: 'frontend/img/slideshow/03.jpg' },
            { src: 'frontend/img/slideshow/05.jpg' },
            { src: 'frontend/img/slideshow/07.jpg' },
            { src: 'frontend/img/slideshow/02.jpg' },
            { src: 'frontend/img/slideshow/04.jpg' },
            { src: 'frontend/img/slideshow/06.jpg' },
          ]
        });
    </script>
<!-- END OF HEADER SLIDER -->

<!-- SLIDER PUBLIC SETTING -->
<!-- NOTE: For one slider only -->
	<script>
// SLIDER PROPERTIES FOR COMMENTS/FEEDBACK SLIDERS
	$(document).ready(function() {
	    $("#lightSlider").lightSlider({
	        item: 3,
	        autoWidth: false,
	        slideMove: 1, // slidemove will be 1 if loop is true
	        slideMargin: 100,
	 
	        addClass: '',
	        mode: "slide",
	        useCSS: true,
	        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
	        easing: 'linear', //'for jquery animation',////
	 
	        speed: 600, //ms'
	        auto: true,
	        loop: true,
	        slideEndAnimation: true,
	        pause: 6000,
	 
	        keyPress: false,
	        controls: false,
	        prevHtml: '',
	        nextHtml: '',
	 
	        rtl:false,
	        adaptiveHeight:false,
	 
	        vertical:false,
	        verticalHeight:500,
	        vThumbWidth:100,
	 
	        thumbItem:10,
	        pager: true,
	        gallery: false,
	        galleryMargin: 5,
	        thumbMargin: 5,
	        currentPagerPosition: 'middle',
	 
	        enableTouch:true,
	        enableDrag:true,
	        freeMove:true,
	        swipeThreshold: 40,
	 
	        responsive : [],
	 
	        onBeforeStart: function (el) {},
	        onSliderLoad: function (el) {},
	        onBeforeSlide: function (el) {},
	        onAfterSlide: function (el) {},
	        onBeforeNextSlide: function (el) {},
	        onBeforePrevSlide: function (el) {}
	    });
	});

// SLIDER PROPERTIES FOR PARTNERSHIP SLIDER
	$(document).ready(function() {
	    $("#lightSlider0").lightSlider({
	        item: 3,
	        autoWidth: false,
	        slideMove: 1, // slidemove will be 1 if loop is true
	        slideMargin: 100,
	 
	        addClass: '',
	        mode: "slide",
	        useCSS: true,
	        cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
	        easing: 'linear', //'for jquery animation',////
	 
	        speed: 600, //ms'
	        auto: true,
	        loop: true,
	        slideEndAnimation: true,
	        pause: 6000,
	 
	        keyPress: false,
	        controls: false,
	        prevHtml: '',
	        nextHtml: '',
	 
	        rtl:false,
	        adaptiveHeight:false,
	 
	        vertical:false,
	        verticalHeight:500,
	        vThumbWidth:100,
	 
	        thumbItem:10,
	        pager: true,
	        gallery: false,
	        galleryMargin: 5,
	        thumbMargin: 5,
	        currentPagerPosition: 'middle',
	 
	        enableTouch:true,
	        enableDrag:true,
	        freeMove:true,
	        swipeThreshold: 40,
	 
	        responsive : [],
	 
	        onBeforeStart: function (el) {},
	        onSliderLoad: function (el) {},
	        onBeforeSlide: function (el) {},
	        onAfterSlide: function (el) {},
	        onBeforeNextSlide: function (el) {},
	        onBeforePrevSlide: function (el) {}
	    });
	});
	</script>
<!-- END OF SLIDER PUBLIC SETTING -->

<!-- SCRIPT TO VERTICALLY CENTER MODAL -->
    <script>
        /* center modal */
        function centerModals($element) {
          var $modals;
          if ($element.length) {
            $modals = $element;
          } else {
            $modals = $('.modal-vcenter:visible');
          }
          $modals.each( function(i) {
            var $clone = $(this).clone().css('display', 'block').appendTo('body');
            var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
            top = top > 0 ? top : 0;
            $clone.remove();
            $(this).find('.modal-content').css("margin-top", top);
          });
        }
        $('.modal-vcenter').on('show.bs.modal', function(e) {
          centerModals($(this));
        });
        $(window).on('resize', centerModals);
    </script>
<!-- END OF -->

@extends('modals')
@section('modal-content')
@stop

</body>

</html>
