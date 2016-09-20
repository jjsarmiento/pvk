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

<style type="text/css">
	body{
		font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif;
	}
	.vegas-wrapper {
	    background: rgba(0,0,0,0.5);
	}
	@media (max-width: 991px) {
		.imahe {
			display: none;
		}
		.imahes {
			width: 230px !important;
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

                    <li>
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>


                    <li class = "active">
                       <a class="page-scroll" href="#page-top">About Us</a>
                         

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
            <div class="vegas.overlay lato-text" style="height:100%; width:100%; opacity:1;background-color:rgba(0,0,0,.8);"></div>
            	<div class="container col-md-8 col-md-offset-2">
		        	<div class="row desk text-center padded">
		        		<h1 style="text-align: center;">About Us</h1><br>
		            	<div class="col-md-4">
		            		<img class="imahes" src="/images/youseek.png" style="width:100%;">
		            	</div>
						<div class="col-md-8" style="text-align:left;">
			            	<p>
			            		Proveek is not just an ordinary online recruitment platform. It strives to be the best in connecting job providers to job seekers by providing opportunities to everyone. 
			            	</p>
							<p>
			            		Proveek is a group of people believing that each one of us is meant for greater things and wider landscapes. We believe that one of the ways in achieving greatness, not only success, is having a good job. 
			            	</p>					
			            	<p>
			            		Through Proveek, skilled workers like TESDA graduates and undergraduates have equal opportunities of landing not only a job but also a career that can lead to a brighter future. We believe that citizens with good jobs build great nation. Thus, Proveek is confident that nations can be great once more, one job at a time. 
			            	</p>
						</div>
		        	</div>	            		
            	</div>
            </div>
    </header>
    <!-- END OF -->

    <section class="container" id="works" style="display:none; padding:0px 40px 0px 40px;">
        <div class="container-fluid">
                        <div class="row desk text-center col-md-6">
                <div class="col-md-12">
                    <img class="imahe" src="/images/shakehands.jpg" style="width:100%;">
                </div>
            </div>
            <div class="row desk text-center col-md-5" style="padding: 38px 0px 40px 0px;">
				<div class="col-md-12">
	                <i class="fa fa-5x fa-bullseye wow bounceIn text-primary" data-wow-delay=".2s"></i>
	                <h2 class="section-heading">Mission</h2>
	                <hr class="text-primary">
	                <p>
	                	Our Mission is to Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse hendrerit massa lorem, sed semper neque ultricies vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
	                </p>
				</div> 

				<div class="col-md-12">
	                <i class="fa fa-5x fa-eye wow bounceIn text-primary" data-wow-delay=".2s"></i>
	                <h2 class="section-heading">Vision</h2>
	                <hr class="text-primary"> 
	                <p>
	                	Our Vision is to Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse hendrerit massa lorem, sed semper neque ultricies vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
	                </p>	                
				</div> 
            </div>

        </div>
    </section>

    <section id="works" style="display:none; padding: 50px; background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('../images/BGQuote.jpg'); background-position: center top;">
        <div class="container-fluid container">
            <div class="row desk text-center">
				<div class="col-md-12" style="color:white;">
	                <i class="fa fa-5x fa-book wow bounceIn text-primary" data-wow-delay=".2s" style="color:white;"></i>
	                <h2 class="section-heading">History</h2>
	                <hr class="text-primary" style="border-color:white;">
					<p>
						Founded in Fusce sit amet tincidunt quam. Duis cursus sagittis nibh in interdum. Fusce auctor luctus eros non imperdiet. Praesent vel nibh nisi. Mauris eget dolor eu urna pharetra fermentum. Morbi egestas pretium molestie. Ut lobortis mauris sapien, ut condimentum felis consectetur non. Vivamus id magna et sem gravida rutrum.
					</p>
     
					<p>
						Sed pretium diam at justo aliquam condimentum. Curabitur condimentum posuere arcu non scelerisque. Mauris a nulla imperdiet, ullamcorper augue in, dignissim neque. Aenean hendrerit erat pellentesque massa ultricies, in ornare velit commodo. Morbi ac est orci. Proin suscipit at ipsum eu dictum.
					</p>
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
                                    <!-- <li>{{ HTML::link('/pricing', 'Pricing')}}</li> -->
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
