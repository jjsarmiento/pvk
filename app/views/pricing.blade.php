<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Pricing</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" type="image/x-icon" href="frontend/img/favicon.ico">

<!-- CUSTOM STYLE, ONLY FOR PRICING PAGE -->
    <style>
        .btnLink
        {
            transition: .2s ease-in;
            -webkit-transition: .2s ease-in;
            -o-transition: .2s ease-in;
            -moz-transition: .2s ease-in;
            color:#ECF0F1;
            background-color: #2980b9;
            margin:0;
            padding: 12px 15px 12px 15px;
            border-radius: 4px;
            font-size: 14pt;
            outline: none;
            text-decoration: none;
        }

        .btnLink:hover
        {
            background-color:#ECF0F1;
            color:#2980b9;
            text-decoration: none;
        }
        .privcingDiv{}

        .pricingDiv div
        {
            /*padding:10px;*/
        }

        .pricingContainerDark
        {
            /*margin: 5px;*/
            background-color: #EDF2F5;
            min-height:200px;
            border:2px solid #ECF0F1;
        }

        .pricingContainerLight
        {
            /*margin: 5px;*/
            background-color: #fff;
            min-height:200px;
            border:2px solid #ECF0F1; /*#ECF0F1*/
        }

        .pricingContainerDark .hLine
        {
            border:none;
            background:none;
            height:1px;
            max-width:100%;
            border-bottom: 1px solid #2980b9;
        }

        .pricingContainerLight .hLine
        {
            border:none;
            background:none;
            max-height:1px;
            max-width:100%;
            border-bottom: 1px solid #2980b9;
        }

        .pricingContainerDark .pHead
        {
            font-family: 'Lato', sans-serif;
            color: #292929; /*#ECF0F1 #EDF2F5 #2980b9*/
            font-size: 18pt;
            padding-top:20px;
        }

        .pricingContainerLight .pHead
        {
            font-family: 'Lato', sans-serif;
            font-size: 18pt;
            padding-top:20px;
            color: #292929;
        }

        .pricingContainerDark .pHeader
        {
            font-family: 'Lato', sans-serif;
            color: #2980B9;
            font-size: 32pt;
        }

        .pricingContainerLight .pHeader
        {
            font-family: 'Lato', sans-serif;
            font-size: 32pt;
            color: #2980B9;
        }

        .pricingDiv ul
        {
            list-style-type: none;
            text-align:left;
            padding-left:5%;
            padding-right:5%;
            font-family: 'Lato', sans-serif;
        }

        .pricingDiv li
        {
            text-align: left;
            color: #2980B9; /*2980B9*/
            padding-top:3%;
            padding-bottom:3%;
            font-size:14pt;
            border-bottom:1px solid #ccc;
            /*font-weight: bold;*/
        }

        .pricingDiv .text-fade
        {
            opacity:.3;
            color:#292929;
        }

    </style>
    <!-- END OF STYLE -->
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
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>

                    <li>
                     <!--   <a class="" href="WhyProveek.html">Why Choose Proveek</a> -->
                         {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}

                    </li>
                    <li class = "active">
                        <a class="page-scroll" href="#page-top">Pricing</a>
                        <!-- {{ HTML::link('/pricing', 'Pricing')}} -->
                    </li>
                    <li>
                          {{ HTML::link('/login', 'Sign In')}}
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- HEADER SEARCH SECTION -->
    <header>
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5);">
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 style="text-transform:none">Tell us what you need and we’ll choose the people for you!</h1>
                    <hr>
                    <p style="color:#ECF0F1">
                        We’ll provide pre-screened, pre-interviewed and background checked profiles to you and you’ll just pay for what you hire.
                    </p>
                    <a class="btnLink" style="text-decoration:none;" href="#GlobalModal" data-toggle="modal">Get Quotation Now</a>
                    <p style="margin-bottom:0; margin-top:2%;">or</p>
                    <div class="text-center div_header">
                        <a href="#next" class="page-scroll">
                            <i class="fa fa-4x fa-angle-down"></i>
                        </a>
                    </div>
            	</div>
        	</div>
        </div>
    </header>
    <!-- END OF -->

<!-- BODY PRICE PACKAGE -->
    <section id="next" style="padding-top:40px; padding-bottom:0px;">
        <div class="container-fluid">
            <div class="row pricingDiv">
                <div class="col-lg-12 text-center">
                    <i class="fa fa-5x fa-archive wow bounceIn text-primary"></i>
                    <h2 class="section-heading">Packages Offered</h2>
                    <hr class="primary">
                </div>
                <div class="col-lg-3 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".1s">
                    <div class="pricingContainerLight text-center">
                        <div>
                            <p class="pHead">FREE</p>
                            <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>0.00<sub style="font-size:14pt">/mo</sub></p>
                            <hr class="hLine">
                            <p class="pHeader" style="color:#292929; font-size:12pt;">FEATURES</p>
                            <ul>
                                <li style="border-bottom:1px solid #ccc">Browse</li>
                                <li>Book Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">3 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>Notify no. of Workers</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">3 Workers<sub style="font-size:10pt">/wk</sub></p>
                                <li class="text-fade">Notification Via SMS or Email</li>
                                <li class="text-fade">Access to Pre-Assess or Shortlisted Resumes</li>
                                <li class="text-fade">No. of Post Job Ads</li>
                                <li class="text-fade">Discount per Contact Details Taken</li>
                                <li class="text-fade">Guaranteed Hire Per Month</li>
                                <li class="text-center" style="border:none;padding-top:20px;">
                                    <div class="text-center">
                                        <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                            Apply
                                        </a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".2s">
                    <div class="pricingContainerDark text-center">
                        <div>
                            <p class="pHead">BASIC</p>
                            <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>2,499.00<sub style="font-size:14pt">/mo</sub></p>
                            <hr class="hLine">
                            <p class="pHeader" style="color:#292929; font-size:12pt;">FEATURES</p>
                            <ul>
                                <li style="border-bottom:1px solid #ccc">Browse</li>
                                <li>Notifications via SMS or Email</li>
                                <li>Book Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">50 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>Notify no. of Workers</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">25 Workers<sub style="font-size:10pt">/wk</sub></p>
                                <li>Access to Pre-Assess or Shortlisted Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">3 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>No. of Post Job Ads</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">5 Job Ads<sub style="font-size:10pt">/mo</sub></p>
                                <li>Discount per Contact Details Taken</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">15% per resume</p>
                                <li>Guaranteed Hire Per Month</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">1 - 5</p>
                                <li class="text-center" style="border:none;padding-top:20px;">
                                    <div class="text-center">
                                        <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                            Apply
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".3s">
                    <div class="pricingContainerDark text-center">
                        <div>
                            <p class="pHead">PREMIUM</p>
                            <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>4,999.00<sub style="font-size:14pt">/mo</sub></p>
                            <hr class="hLine">
                            <p class="pHeader" style="color:#292929; font-size:12pt;">FEATURES</p>
                            <ul>
                                <li style="border-bottom:1px solid #ccc">Browse</li>
                                <li>Notifications via SMS or Email</li>
                                <li>Book Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">100 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>Notify no. of Workers</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">50 Workers<sub style="font-size:10pt">/wk</sub></p>
                                <li>Access to Pre-Assess or Shortlisted Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">5 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>No. of Post Job Ads</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">10 Job Ads<sub style="font-size:10pt">/mo</sub></p>
                                <li>Discount per Contact Details Taken</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">25% per resume</p>
                                <li>Guaranteed Hire Per Month</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">5 - 6</p>
                                <li class="text-center" style="border:none;padding-top:20px;">
                                    <div class="text-center">
                                        <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                            Apply
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".4s">
                    <div class="pricingContainerDark text-center">
                        <div>
                            <p class="pHead">ULTIMATE</p>
                            <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>8,499.00<sub style="font-size:14pt">/mo</sub></p>
                            <hr class="hLine">
                            <p class="pHeader" style="color:#292929; font-size:12pt;">FEATURES</p>
                            <ul>
                                <li style="border-bottom:1px solid #ccc">Browse</li>
                                <li>Notifications via SMS or Email</li>
                                <li>Book Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">200 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>Notify no. of Workers</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">100 Workers<sub style="font-size:10pt">/wk</sub></p>
                                <li>Access to Pre-Assess or Shortlisted Resumes</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">10 Resumes<sub style="font-size:10pt">/wk</sub></p>
                                <li>No. of Post Job Ads</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">15 Job Ads<sub style="font-size:10pt">/mo</sub></p>
                                <li>Discount per Contact Details Taken</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">50% per resume</p>
                                <li>Guaranteed Hire Per Month</li>
                                <p class="pHeader" style="font-size:12pt; padding-top:1%; padding-bottom:5%; margin:0; color:#292929; font-style:oblique">11 - 15</p>
                                <li class="text-center" style="border:none;padding-top:20px;">
                                    <div class="text-center">
                                        <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                            Apply
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END OF -->

<!-- BODY PRICE PACKAGE 2 -->
    <section id="next" style="padding-top:0px; padding-bottom:40px">
        <div class="container-fluid">
            <div class="row pricingDiv">
                <div class="col-lg-12 text-center">
                    <div class="col-lg-12">
                        <i class="fa fa-5x fa-group wow bounceIn text-primary"></i>
                        <h2 class="section-heading">Mass Hiring</h2>
                        <hr class="primary">
                        <p>If Hiring 15 or More Workers per Month</p>
                        <a class="btnLink" style="text-decoration:none;" href="#GlobalModal" data-toggle="modal">Get Quotation Now</a>
                        <!-- <p style="margin-bottom:1%; margin-top:2%;font-size:20pt;">or</p> -->
                    </div>
                    <div class="col-lg-12 text-center" style="padding-top:40px;">
                        <!-- <h2 style="text-transform:none">Tell us what you need and we’ll choose the people for you!</h2>
                        <p>
                            We’ll provide pre-screened, pre-interviewed and background checked profiles to you and you’ll just pay for what you hire.
                        </p> -->
                        <i class="fa fa-5x fa-puzzle-piece wow bounceIn text-primary"></i>
                        <h2 class="section-heading">Recruitment Add-ons</h2>
                        <hr>
                        <div class="col-lg-4 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".1s">
                            <div class="pricingContainerDark text-center">
                                <div>
                                    <p class="pHead">FEATURED JOB-AD</p>
                                    <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>1,499.00<sub style="font-size:14pt">/mo</sub></p>
                                    <hr class="hLine">
                                    <ul>
                                        <li class="text-center" style="border:none;padding-top:20px;">
                                            <div class="text-center">
                                                <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                                    Apply
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".2s">
                            <div class="pricingContainerDark text-center">
                                <div>
                                    <p class="pHead">BACKGROUND CHECK</p>
                                    <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>3,499.00<sub style="font-size:14pt">/ worker</sub></p>
                                    <hr class="hLine">
                                    <ul>
                                        <li class="text-center" style="border:none;padding-top:20px;">
                                            <div class="text-center">
                                                <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                                    Apply
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 text-center wow fadeIn" style="padding-bottom:5%;" data-wow-delay=".3s">
                            <div class="pricingContainerDark text-center">
                                <div>
                                    <p class="pHead">PROCESS PAPERS<sub>(SSS, Pag-ibig, etc.)</sub></p>
                                    <p class="pHeader"><sup style="font-size:14pt">&#x20B1</sup>499.00<sub style="font-size:14pt">/ worker</sub></p>
                                    <hr class="hLine">
                                    <ul>
                                        <li class="text-center" style="border:none;padding-top:20px;">
                                            <div class="text-center">
                                                <a class="btnLink" href="#GlobalModal" data-toggle="modal" style="display:block;">
                                                    Apply
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <a class="btnLink" style="text-decoration:none;" href="#GlobalModal" data-toggle="modal">Get Quotation Now</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- END OF -->

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
                                    //<li>{{ HTML::link('/pricing', 'Pricing')}}</li>//
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
                                <a href="https://www.facebook.com/proveek"><i class="fa fa-facebook-square fa-3x wow bounceIn" data-wow-delay=".2s"></i></a>
                                <a href="https://twitter.com/Proveek"><i class="fa fa-twitter-square fa-3x wow bounceIn" data-wow-delay=".3s"></i></a>
                                <!-- <a href="#"><i class="fa fa-instagram fa-3x wow bounceIn" data-wow-delay=".4s"></i></a>
                                <a href="https://plus.google.com/108796854139900682022/posts"><i class="fa fa-google-plus-square fa-3x wow bounceIn" data-wow-delay=".5s"></i></a> -->
                                <a href="#"><i class="fa fa-envelope-square fa-3x wow bounceIn" data-wow-delay=".6s"></i></a>
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
    <div class="modal modal-vcenter fade" id="GlobalModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background-image: url(frontend/img/modalBg.jpg)">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <i class="fa fa-user-plus fa-5x text-primary"></i>
                    <h2 style="text-transform:uppercase;">Find Jobs That Matched Your Skills</h2>
                </div>
                <div class="modal-body text-center" style="padding-bottom:0">
                    <p>We are currently signing up our first set of workers.<br> If you are a skilled or manual laborer and want to put your profile for employers to easily find you, sign up now and start getting job notifications!</p>
                </div>
                <div class="modal-footer text-center" style="text-align:center; padding-bottom:20px;">
                    <a href="/login" class="btn btn-primary btn-md" style="font-size:15pt; padding:15px 30px 15px 30px;border-radius: 4px;">SIGN UP</a>
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
          transitionDuration: 4000,
          delay: 10000,
          animation: 'random',
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

</body>

</html>
