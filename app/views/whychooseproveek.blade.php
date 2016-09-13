<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Why Choose Proveek</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    
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

                    <li>
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>


                    <li class = "active">
                       <a class="page-scroll" href="#page-top">Why Choose Proveek</a>
                         

                    </li>
                    <!-- <li>
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
    <header>
        <div class="header-content">
            <div class="vegas.overlay" style="height:100%; width:100%; opacity:1;background-color:rgba(0,0,0,.8);"></div>
                <div class="header-content-inner wow fadeIn" style="background-color:rgba(0,0,0,.5); padding-top: 35px; padding-bottom:15px; border-radius: 8px;">
                    <h1>Proveek</h1>
                    <hr>
                    <p style="text-align:center">Proveek, formerly called TASKminator, is an online system that aims to connect Job providers (Employers) to Job Seekers (Workers) specifically skilled and manual laborers. The system seeks to empower the skilled and manual laborers by providing them an avenue to highlight their skills in an online profile for the whole wide world to see which may in turn increase their chance of getting a job as well as having additional source of income by doing part-time jobs. Also, the platform serves as an avenue for Job providers or employers to easily look for workers fitted for the job. Proveek is one of the finalists of Ideaspace Foundation Inc. incubation for the year 2015.</p>
                    <div class="text-center div_header">
                    <a href="#next" class="page-scroll">
                        <i class="fa fa-4x fa-angle-down"></i>
                    </a>
                    </div>
                </div>
            </div>
    </header>
    <!-- END OF -->

    <section id="next" style="padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <i class="fa fa-5x fa-wrench wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h2 class="section-heading">Why Choose Proveek?</h2>
                    <hr class="text-primary">

<!-- WHY PROVEEK? CONTAINER -->
                    <div class="col-lg-12">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".1s">
                            <img src="frontend/img/customIcons/group-user.png" style="margin:0; padding:0;">
                            <p style="padding-top:20px; text-align:center"><p style="padding: 0 0 0 0; margin:0; font-size:14pt; font-family: 'Lato', sans-serif;">Hire with ease.</p><br>
                            We provide you a wide range of pre-vetted workers to choose from.</p>
                        </div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".15s">
                            <img src="frontend/img/customIcons/group-user.png" style="margin:0; padding:0;">
                            <p style="padding-top:20px; text-align:center"><p style="padding: 0 0 0 0; margin:0; font-size:14pt; font-family: 'Lato', sans-serif;">Reduced expenses.</p><br>
                            We charge you only for the workers you choose.</p>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".20s">
                            <img src="frontend/img/customIcons/excel-badge.png" style="margin:0; padding:0;">
                            <p style="padding-top:20px; text-align:center"><p style="padding: 0 0 0 0; margin:0; font-size:14pt; font-family: 'Lato', sans-serif;">Guaranteed quality.</p><br>
                            Workers will be screened based on the recommendations of their LGUs or Trainers (in the case of TESDA). For better quality, all workers will be reviewed and rated by their client after each job done.</p>
                        </div>
                        <div class="col-lg-4 wow fadeIn" data-wow-delay=".25s">
                            <img src="frontend/img/customIcons/group-user.png" style="margin:0; padding:0;">
                            <p style="padding-top:20px; text-align:center"><p style="padding: 0 0 0 0; margin:0; font-size:14pt; font-family: 'Lato', sans-serif;">Help while being helped out.</p><br> 
                            You will help someone today to get a job to provide for his/her family.</p>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
<!-- END OF -->

                    <!-- <i class="fa fa-5x fa-group wow bounceIn text-primary" data-wow-delay=".1s"></i>
                    <h2 class="section-heading">The Proveek Team</h2>
                    <hr class="text-primary"> -->

<!-- PROVEEK TEAM CONTAINERS -->
                    <!-- <div class="col-lg-3 wow fadeIn" data-wow-delay=".1s">
                        <img src="frontend/img/team/03.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Joni Salang-oy</p>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".2s">
                        <img src="frontend/img/team/05.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Marc Briones</p>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".3s">
                        <img src="frontend/img/team/04.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Rhoda Lyn Ramos</p>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".4s">
                        <img src="frontend/img/team/02.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Mark Dean Raymundo</p>
                    </div>

                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".5s">
                        <img src="frontend/img/team/00.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Felicia Mae Sace</p>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay=".6s">
                        <img src="frontend/img/team/01.png" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Lambo</p>
                    </div> -->
                    <!-- <div class="col-lg-3 wow fadeIn" data-wow-delay=".7s">
                        <img src="frontend/img/team/00.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Reserved</p>
                    </div>
                    <div class="col-lg-3 wow fadeIn" data-wow-delay=".8s">
                        <img src="frontend/img/team/00.jpg" style="width:150px; height:150px; border-radius:100%;">
                        <p style="padding-top:20px">Reserved</p>
                    </div> -->
<!-- END OF -->
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

<!-- SLIDER PUBLIC SETTING -->
<!-- NOTE: For one slider only -->
	<script>

</body>

</html>
