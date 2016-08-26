<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | How Proveek Works</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/lightslider.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">

</head>

<style type="text/css">
    a.tooltips {outline:none; }
    a.tooltips strong {line-height:30px;}
    a.tooltips:hover {text-decoration:none;} 
    a.tooltips span {
        z-index:10;display:none; padding:14px 20px;
        margin-top:-30px; margin-left:28px;
        width:300px; line-height:16px;
    }
    a.tooltips:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fffAF0;}
    .callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
        
    /*CSS3 extras*/
    a.tooltips span
    {
        border-radius:4px;
        box-shadow: 5px 5px 8px #CCC;
    }
    .col-md-4 .hayt img {
        height: 50px;
    }

    span.OrClass{
        height: 115px;
        width: 320px;
        font-size: 35px;
        display: table-cell;
        margin: auto;
        color: rgb(102, 102, 102);
        visibility: visible;
        animation-delay: 0.3s;
        animation-name: fadeIn;
        vertical-align: middle;
        text-align: center;
    }
    @media (max-width: 991px) {
        .desk {
            display: none;
        }
        .mob {
            display:block !important;
        }
        a.tooltips span {
            margin-left: -175px;
            box-shadow: 0px 3px 8px #CCC;
        }
        img.callout {
            display: none;
        }
        .hire {
                margin-left: -165px !important;
        }
    }
</style>

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

                    <li>
                        {{ HTML::link('/employer', 'Employer')}}
                    </li>

                    <li class="active">
                        <a class="page-scroll" href="#page-top">How It Works</a>
                    </li>

                    <li>
                     <!--   <a class="" href="WhyProveek.html">Why Choose Proveek</a> -->
                         {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}

                    </li>
                    <!-- <li>
                        {{ HTML::link('/pricing', 'Pricing')}}
                    </li> -->
                    <li>
                        <!--<a class="" href="#">Login / Sign Up</span></a> -->
                        {{ HTML::link('/login', 'Sign In')}}
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

<!-- HEADER SECTION -->
    <header style="background-image:url(frontend/img/slideshow/03.jpg);">
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5);">
            <div class="header-content">
                <div class="header-content-inner wow bounceIn" data-wow-delay=".1s">
                    <!-- <h1 style="margin-top:60px; margin-bottom:20px;">How Proveek Works</h1> -->
                    <!-- 16:9 aspect ratio -->
                    <div class="container-fluid">
                        <div class="row">
            			    
                                <div class="col-lg-12 text-center">
                                    <div class="embed-responsive embed-responsive-16by9">
                                    <!-- IFRAME -->
                                  <!--    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tntOCGkgt98"></iframe> -->
                                    <iframe src="../video/PROVEEK.mp4" allowfullscreen></iframe>

                                    </div>
                    				<div class="text-center div_header">
                                	  <a href="#works" class="page-scroll">
                                           <i class="fa fa-4x fa-angle-down"></i>
                                	  </a>
                                    </div>
                                </div>
			              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!-- END OF -->

<!-- STEPS ON HOW IT WORKS -->
    <section id="works" style="padding-top:40px;padding-bottom:40px;">
        <div class="container-fluid">
            <div class="row desk">
                <div class="col-lg-6 text-center" style="border-right: 1px solid #ccc;">
                    <i class="fa fa-5x fa-user-plus wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h2 class="section-heading">For Job Providers</h2>
                    <hr class="text-primary">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 padded">
                        <div class="row" >
                            <div class="col-md-4 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/browse.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Browse
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Browse</strong><br />
                                        You can browse on the pool of worker's profile.
                                    </span>
                                </a>
                            </div>  
                            <div class="col-md-4 padded" style="border-left: 1px solid #666; border-right: 1px solid #666; height:115px;">
                                <!--BLANK-->
                            </div>
                            <div class="col-md-4 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/postajob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Post a job
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Post a job</strong><br />
                                        You can post a job and wait for workers to apply.
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="row" >
                            <div class="col-md-4 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>  
                            <div class="col-md-4" style="border-left: 1px solid #666; border-right: 1px solid #666; height:115px;">
                                <span class="wow fadeIn OrClass" data-wow-delay=".3s">OR</span>
                            </div>
                            <div class="col-md-4 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                        </div>

                        <div class="row" >
                            <div class="col-md-4 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/choose.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Choose
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Choose</strong><br />
                                        You can directly choose a profile and invite them to apply to your job ad or you can bookmark their profile for future references or for bulk invitations.
                                    </span>
                                </a>
                            </div>  
                            <div class="col-md-4" style="border-left: 1px solid #666; border-right: 1px solid #666; height:115px;">
                                <!--BLANK-->
                            </div>
                            <div class="col-md-4 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/compare.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Compare
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Compare</strong><br />
                                        Compare the profile of the workers who apply for the job.
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="row" >
                            <div class="col-md-4 padded">
                                <img src="frontend/img/pw_jobP/right.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>  
                            <div class="col-md-4 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/hire.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Hire
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Hire</strong><br />
                                        You can check out the contact details of the workers who you invite to apply or who you choose from the pool of workers who applied to your job ad. Contact them and hire them.
                                    </span>
                                </a>
                            </div>  
                            <div class="col-md-4 padded">
                                <img src="frontend/img/pw_jobP/left.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-1"></div>
                </div>
<!-- HARD CODE DESIGN DIAGRAM -->
                    <!-- <div class="col-lg-12">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5 text-center" style="">
                            <i class="fa fa-5x fa-search wow bounceIn text-primary" data-wow-delay=".1s"></i>
                            <p>Browse</p>
                            <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                                <i class="fa fa-5x fa-long-arrow-down text-default"></i>
                            </div>

                            <i class="fa fa-5x fa-hand-pointer-o wow bounceIn text-primary" style="padding-top:15px;" data-wow-delay=".2s"></i>
                            <p>Choose</p>

                            <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                                <i class="fa fa-5x fa-level-up text-default rotate90deg"></i>
                            </div>
                        </div>
                        <div class="col-lg-5 text-center">
                            <i class="fa fa-5x fa-sticky-note-o wow bounceIn text-primary" data-wow-delay=".1s"></i>
                            <p>Post a Job</p>
                            <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                                <i class="fa fa-5x fa-long-arrow-down text-default"></i>
                            </div>

                            <i class="fa fa-5x fa-balance-scale wow bounceIn text-primary" style="padding-top:15px;" data-wow-delay=".2s"></i>
                            <p>Compare</p>

                            <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                                <i class="fa fa-5x fa-level-down text-default rotate90deg"></i>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-sm-4 text-center">
                    <i class="fa fa-5x fa-users wow bounceIn text-primary"></i>
                    <p>Hire</p>
                </div> -->
<!-- END OF -->
                <div class="col-lg-6 text-center">
                    <i class="fa fa-5x fa-hand-paper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                    <h2 class="section-heading">For Job Seekers</h2>
                    <hr class="text-primary">
                    <br>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 padded">
                        <div class="row padded">
                            <div class="col-md-4">
                                <img src="frontend/img/pw_jobS/down.png" class="wow fadeIn" data-wow-delay=".3s">
                            </div>  
                            <div class="col-md-4">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/signup.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Sign Up
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Sign Up</strong><br />
                                        Make sure to provide a correct, complete and updated profile for you to be hired easily.
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <img src="frontend/img/pw_jobS/down2.png" class="wow fadeIn" data-wow-delay=".3s">
                            </div>
                        </div>

                        <div class="row padded">
                            <div class="col-md-4">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/waitforjob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Wait for Job Invitation
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Wait for Job Invitation</strong><br />
                                        You can wait for Employers to send you invitation to apply to their Jobs Ads.
                                    </span>
                                </a>
                            </div>  
                            <div class="col-md-4" style="border-left: 1px solid #666; border-right: 1px solid #666;">
                                <span class="wow fadeIn OrClass" data-wow-delay=".3s">OR</span>
                            </div>
                            <div class="col-md-4">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/bidforjob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Apply for a Job
                                    <span style="margin-left: -425px !important; box-shadow: -5px 5px 8px #CCC;">
                                        <img class="callout" style="left: 298px; -ms-transform: rotate(180deg); -webkit-transform: rotate(180deg); transform: rotate(180deg);" src="frontend/img/callout.gif" />
                                        <strong>Apply for a Job</strong><br />
                                        You can search for a job and directly send your application.
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="row padded">
                            <div class="col-md-4">
                                <img src="frontend/img/pw_jobS/right.png" class="wow fadeIn" data-wow-delay=".3s">
                            </div>  
                            <div class="col-md-4">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/gethired.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Get Hired
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Get Hired</strong><br />
                                        Wait for the employer to contact you once you are shortlisted for the job.
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <img src="frontend/img/pw_jobS/left.png" class="wow fadeIn" data-wow-delay=".3s">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                    <!--First tooltips-->

<!-- HARD CODE DESIGN DIAGRAM -->
                   <!--  <div class="col-lg-4">
                        <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                            <i class="fa fa-5x fa-level-up text-default rotate180deg"></i>
                        </div>
                        <i class="fa fa-5x fa-sticky-note-o wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <p>Wait for Job Offer</p>
                        <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                                <i class="fa fa-5x fa-level-up text-default rotate90deg"></i>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <i class="fa fa-5x fa-sign-in text-primary"></i>
                        <p>Sign up</p>
                    </div>

                    <div class="col-lg-4">
                        <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                            <i class="fa fa-5x fa-level-down text-default rotate360deg"></i>
                        </div>
                        <i class="fa fa-5x fa-legal wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <p>Bid for a Job</p>
                        <div class="text-center" style="padding-top:20px; padding-bottom:20px;">
                            <i class="fa fa-5x fa-level-down text-default rotate90deg"></i>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <i class="fa fa-5x fa-thumbs-o-up text-primary"></i>
                        <p>Get Hired</p>
                    </div> -->
<!-- END OF -->
                </div>
            </div>

            <div class="row mob" style="display:none;">
                <div class="col-lg-6 text-center" style="border-right: 1px solid #ccc;">
                    <i class="fa fa-5x fa-user-plus wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h2 class="section-heading">For Job Providers</h2>
                    <hr class="text-primary">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row" >
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/browse.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Browse
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Browse</strong><br />
                                        You can browse on the pool of worker's profile.
                                    </span>
                                </a>
                            </div> 
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div> 
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/choose.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Choose
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Choose</strong><br />
                                        You can directly choose a profile and invite them to apply to your job ad or you can bookmark their profile for future references or for bulk invitations.
                                    </span>
                                </a>
                            </div>  
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/hire.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Hire
                                    <span class="hire">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Hire</strong><br />
                                        You can check out the contact details of the workers who you invite to apply or who you choose from the pool of workers who applied to your job ad. Contact them and hire them.
                                    </span>
                                </a>
                            </div> 
                            <div class="col-md-12">
                            <hr style="max-width:100%; border-width: 1px;">
                                <span class="wow fadeIn" data-wow-delay=".3s"  style="font-size: 35px; padding:20px;">OR</span>
                            <hr style="max-width:100%; border-width: 1px;">
                            </div>          

                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/postajob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Post a job
                                    <span style="margin-left:-180px;">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Post a job</strong><br />
                                        You can post a job and wait for workers to apply.
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/compare.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Compare
                                    <span style="margin-left:-180px;">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Compare</strong><br />
                                        Compare the profile of the workers who apply for the job.
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobP/hire.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Hire
                                    <span class="hire">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Hire</strong><br />
                                        You can check out the contact details of the workers who you invite to apply or who you choose from the pool of workers who applied to your job ad. Contact them and hire them.
                                    </span>
                                </a>
                            </div> 
                        </div>
                    </div>
                    <div class="col-lg-1"></div>                    
                </div>
                <hr style="max-width: 100%; border-color: #dadada; border-width: 1px; margin-bottom: 40px;">
                <div class="col-lg-6 text-center">
                    <i class="fa fa-5x fa-hand-paper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                    <h2 class="section-heading">For Job Seekers</h2>
                    <hr class="text-primary">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/signup.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Sign Up
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Sign Up</strong><br />
                                        Make sure to provide a correct, complete and updated profile for you to be hired easily.
                                    </span>
                                </a>
                            </div>
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/waitforjob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Wait for Job Invitation
                                    <span style="margin-left: -227px;">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Wait for Job Invitation</strong><br />
                                        You can wait for Employers to send you invitation to apply to their Jobs Ads.
                                    </span>
                                </a>
                            </div> 
                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>
                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/gethired.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Get Hired
                                    <span style="margin-left: -182px;">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Get Hired</strong><br />
                                        Wait for the employer to contact you once you are shortlisted for the job.
                                    </span>
                                </a>
                            </div>

                            <div class="col-md-12">
                            <hr style="max-width:100%; border-width: 1px;">
                                <span class="wow fadeIn" data-wow-delay=".3s"  style="font-size: 35px; padding:20px;">OR</span>
                            <hr style="max-width:100%; border-width: 1px;">
                            </div> 

                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/signup.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Sign Up
                                    <span>
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Sign Up</strong><br />
                                        Make sure to provide a correct, complete and updated profile for you to be hired easily.
                                    </span>
                                </a>
                            </div> 

                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>

                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/bidforjob.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Apply for a Job
                                    <span style="margin-left: -202px;">
                                        <img class="callout" style="left: 298px; -ms-transform: rotate(180deg); -webkit-transform: rotate(180deg); transform: rotate(180deg);" src="frontend/img/callout.gif" />
                                        <strong>Apply for a Job</strong><br />
                                        You can search for a job and directly send your application.
                                    </span>
                                </a>
                            </div>

                            <div class="col-md-12 padded">
                                <img src="frontend/img/pw_jobP/down.png" class="hayt wow fadeIn" data-wow-delay=".3s">
                            </div>

                            <div class="col-md-12 padded">
                                <a class="tooltips">
                                    <img src="frontend/img/pw_jobS/gethired.png" class="hayt wow fadeIn" data-wow-delay=".3s"><br>
                                    Get Hired
                                    <span style="margin-left: -182px;">
                                        <img class="callout" src="frontend/img/callout.gif" />
                                        <strong>Get Hired</strong><br />
                                        Wait for the employer to contact you once you are shortlisted for the job.
                                    </span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
    </section>
<!-- END OF IT -->

<!-- POST A JOB -->
 <!-- 	<section class="bg-primary" style="background-image: url(frontend/img/header.jpg); background-position: center; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover; border-top: 1px solid #222; border-bottom: 1px solid #222; padding-top: 40px; padding-bottom: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                	<i class="fa fa-5x fa-plus wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Can't find what you're looking for?</h2><br>
                    <a href="#" class="btn btn-default btn-lg" style="border-radius: 4em; width: 250px">Post a Job</a>
                    <!--<a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section> -->
<!-- END OF POST A JOB -->

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
          slides: []
        });
    </script>
<!-- END OF HEADER SLIDER -->

</body>

</html>
