<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Worker's Category</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->

    {{ HTML::style('frontend/css/Lato.css') }}
    {{ HTML::style('frontend/css/Open_Sans.css') }}
    {{ HTML::style('frontend/css/Merriweather.css') }}
    <!--
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    -->
    <link rel="stylesheet" href="frontend/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="frontend/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="frontend/css/creative.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="frontend/css/vegas.css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    [endif]-->

    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
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

        .panel-group .panel {
        	border-top: none !important;
        }

		.panel-default>.panel-heading {
		    color: #333;
		    background-color: #f2f2f2 !important;
		    border-color: #ddd;
		}
		a.collapse:focus, a.collapse:hover {
		    text-decoration: none !important;
		    background: #959595 !important;
		    color: white !important;
		}
		.panel-title > a {
			padding: 15px;
		}
		.panel-title {
		    border: 1px solid #ddd !important;
		}
		.panel-body {
		    border: 1px solid #f2f2f2;
		}
		@media (max-width: 568px){
			.row.padded.cont {
				width: 100% !important;
			}
		}

        a.FAQbutton {
            color: white;
            background: transparent;
            border: 2px solid white;
            border-radius: 3px;
            padding: 15px;
        }
        a.FAQbutton:hover{
            background: white;
            opacity: 0.7;
            color: #333;
            transition: 0.3s;
            text-decoration: none;
        }
        a.seemore {
		    color: white;
		    background: transparent;
		    border: 2px solid white;
		    padding: 10px 25px;
		    border-radius: 3px;        	
        }
        a.seemore:hover{
        	transition:0.3s;
        	background: white;
        	color:#333;
        	text-decoration: none;
        }
        #moreJobs{
        	display: none;
        	background: white;
        	padding:20px;
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
                        {{ HTML::link('/', 'Worker')}}
                    </li>

                    <li>
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
                        {{ HTML::link('/faq', 'Faq')}}
                    </li>

                    <li class="active">
                        <a class="page-scroll" href="#page-top">Job Ads Category</a>
                        <!-- {{ HTML::link('/pricing', 'Pricing')}} -->
                    </li>

                    <li>
                        <!--<a class="" href="#">Login / Sign Up</span></a> -->
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
                    <h2 style="text-transform:none; font-size:30px; font-size: 40px; font-weight: bold;">{{$category_title}}</h2>
                    <hr>
                    <p style="color:#ECF0F1">
                        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec odio mauris. Vestibulum ante ipsum primis in faucibus orci mollis lorem vel ultricies.--}}
                    </p>


                    <div class="col-md-5 padded" style="height: auto; text-align:left; color:#000; font-family: 'Lato';">
                        <div class="widget-container padded" style="min-height: 320px; border-radius: 10px; margin-top: -10px;">
                            <div class="form-group col-md-6">
                                <label>Keyword</label>
                                <input value="" name="jobSearch_keyword" id="jobSearch_keyword" type="text" placeholder="Enter keyword for title / custom skill" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Work Duration</label>
                                <select id="jobSearch_workDuration" name="jobSearch_workDuration" class="form-control">
                                    <option selected="" value="ALL">All duration</option>
                                    <option value="LT6MOS">Less than 6 months</option>
                                    <option value="GT6MOS">Greater than 6 months</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Region</label>
                                <select id="jobSearch_region" name="jobSearch_region" data-loctype="REGION_TO_CITY" class="form-control">
                                    <option value="ALL">All regions</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>City</label>
                                <select id="jobSearch_city" data-loctype="REGION_TO_CITY" name="jobSearch_city" class="form-control">
                                    <option value="ALL">All citites</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Skill Category</label>
                                <select id="jobSearch_category" name="jobSearch_category" class="form-control">
                                    <option value="ALL">All skill categories</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Skill</label>
                                <select id="jobSearch_skill" name="jobSearch_skill" class="form-control">
                                    <option value="ALL">Display all from category</option>
                                                            </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Order by</label>
                                <select id="jobSearch_orderBy" name="jobSearch_orderBy" class="form-control">
                                    <option value="ASC">Newest first</option>
                                    <option selected="" value="DESC">Oldest first</option>
                                </select>
                            </div>
                        </div>
                        <div class="panel-footer" style="margin-top: -10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; border-top: 1px solid #929292;">
                            <button id="INIT_JOBSEARCH" class="btn btn-primary btn-block" style="border-radius: 0.3em;">Search</button>
                            <!-- <a href="/jobSearch:NO_KW_INPT:ALL:ALL:ALL:ALL:ALL:DESC" class="btn btn-success btn-xs btn-block" style="border-radius: 0.3em;">Show All Jobs</a> -->
                        </div>
                    </div>


                    <div class="col-md-7">
                        @foreach($jobs as $job)
                        <div class="col-md-4" style="padding:5px;">
                            <div style="background: white; padding: 15px; border-radius: 7px;">
                                <div style="display:flex;padding-bottom:5px;">
                                    <div style="flex:11;">
                                        <a href="/login" style="text-decoration:none;">
                                            <h3 class="lato-text" style="font-weight: bold; margin:0 0 10px 0 !important; color:#2980b9">
                                                {{$job->title}}
                                            </h3>

                                            <div class="row" style="color:#95A5A6; font-size: 0.8em;">
                                                <div class="col-md-5">
                                                    <span style="padding:0;margin:0;">
                                                        <i class="fa fa-briefcase"></i>
                                                        @if($job->hiring_type == 'LT6MOS')
                                                            Less than 6 months
                                                        @else
                                                            Greater than 6 months
                                                        @endif
                                                    </span><br>
                                                    <span class="text-right" style="padding:0;margin:0;">
                                                        @if($job->expired)
                                                            <span class="badge" style="background-color: #E74C3C">EXPIRED</span>
                                                        @else
                                                            <i class="fa fa-clock-o"></i> Expires at {{ date('m/d/y', strtotime($job->expires_at)) }}
                                                        @endif
                                                    </span>
                                                </div>

                                                <div class="col-md-7">
                                                    <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                                    <span class="badge" style="background-color:#2ECC71;">Login to view salary</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-md-12" style="padding: 20px;">
                            <a href="/login" class="seemore">SEE MORE</a>
                        </div>
                    </div>


            	</div>
        	</div>
        </div>
    </header>
    <!-- END OF -->

    <div class="col-md-12" id="moreJobs">
    	<div class="container">
	    	<h1>Others</h1>
	        @for($i=1; $i<7; $i++)

	        <div class="col-md-4" style="padding:10px;">
	        	<div style="background: #333; padding: 15px; border-radius: 7px;">
	                <div style="display:flex;padding-bottom:5px;">
	                    <div style="flex:11;">
	                        <a href="/login" style="text-decoration:none;">
	                            <h3 class="lato-text" style="font-weight: bold; margin:0 0 10px 0 !important; color:#2980b9 text-align: center;">
	                                Job Title
	                            </h3>

	                            <div class="row" style="color:#95A5A6; font-size: 0.8em;">
	                                <div class="col-md-5">
	                                    <span style="padding:0;margin:0;">
	                                        <i class="fa fa-briefcase"></i>Less than 6 months</span><br>
	                                    <span class="text-right" style="padding:0;margin:0;">
	                                        <i class="fa fa-clock-o"></i> Expires at 08/15/16</span>
	                                </div>

	                                <div class="col-md-7">
	                                    <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> REGION I (ILOCOS REGION), ADAMS</span><br>
	                                    <span class="badge" style="background-color:#2ECC71;">Login to view salary</span>
	                                </div>
	                            </div>
	                        </a>
	                    </div>
	                </div>	                    		
	        	</div>
	        </div>
	        @endfor
    	</div>
    </div>



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
                                    <li><a href="#">About</a></li>
                                    <li>{{ HTML::link('/howitworks', 'How It Works')}}</li>
                                    <li>  {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}</li>
                                    //<li>{{ HTML::link('/pricing', 'Pricing')}}</li>//
                                   <li><a href="/workercategory">Workers</a></li>
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

	<script type="text/javascript">

	$(document).ready(function(){
	    $("a.seemore").click(function(){
	        $("#moreJobs").css("display", "block");
	    });
	});

	</script>

</body>

</html>
