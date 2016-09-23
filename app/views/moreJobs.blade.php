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
    <link rel="stylesheet" href="frontend/css/lightslider.css" type="text/css">
    <link rel="stylesheet" href="frontend/css/custom.css" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    [endif]-->

    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
    <script src="frontend/js/jquery.js"></script>
    {{ HTML::script('js/taskminator.js') }}
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
        body {
            font-family: 'Lato';
        }
        /* Let's get this party started */
        ::-webkit-scrollbar {
            width: 12px;
        }
         
        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
            -webkit-border-radius: 3px;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 3px;
            background: rgba(41,128,185,0.9);
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
        }
        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(41,128,185,0.9); 
        }

    </style>
    <!-- END OF STYLE -->
    <script>
        $(document).ready(function(){
            CHAINLOCATION($('#guest_region'), $('#guest_city'));
            CHAINCATEGORYANDSKILL($('#guest_category'), $('#guest_skill'));
            $('#guest_initSearch').click(function(){
                var keyword = ($('#guest_keyword').val() == '') ? 'ALL' : $('#guest_keyword').val(),
                    region = $('#guest_region').val(),
                    city = $('#guest_city').val(),
                    category = $('#guest_category').val(),
                    skills = $('#guest_skill').val(),
                    orderBy = $('#guest_orderBy').val(),
                    workDuration = $('#guest_workDuration').val();

                    location.href = '/moreJobs:'+keyword+':'+region+':'+city+':'+category+':'+skills+':'+orderBy+':'+workDuration;
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
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5); color:black;">
            <div class="header-content">
                <div class="header-content-inner">
                    <div class="widget-container padded fluid-height" style="height:600px; overflow-y: scroll;">
                        <div class="widget-content fluid-height">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title Keyword</label>
                                        <input type="text" value="{{@$search_keyword}}" class="form-control" placeholder="title" id="guest_keyword" name="guest_keyword"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select id="guest_region" name="guest_region" data-loctype="REGION_TO_CITY" class="form-control">
                                            <option value="ALL">All regions</option>
                                            @foreach($regions as $r)
                                                <option <?php if(@$search_region == $r->regcode){ echo 'selected'; } ?> value="{{$r->regcode}}">{{$r->regname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <select id="guest_city" data-loctype="REGION_TO_CITY" name="guest_city" class="form-control">
                                            <option value="ALL">All citites</option>
                                            @if($cities)
                                                @foreach($cities as $c)
                                                    <option <?php if(@$search_city == $c->citycode){ echo 'selected'; } ?> value="{{$c->citycode}}">{{$c->cityname}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Skill Category</label>
                                        <select id="guest_category" name="guest_category" class="form-control">
                                            <option value="ALL">All skill categories</option>
                                            @foreach($categories as $c)
                                                <option <?php if(@$search_category == $c->categorycode){ echo 'selected'; } ?> value="{{$c->categorycode}}">{{$c->categoryname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select id="guest_skill" name="guest_skill" class="form-control">
                                            <option value="ALL">Display all from category</option>
                                            @if($skills)
                                                @foreach($skills as $s)
                                                    <option <?php if(@$search_skill == $s->itemcode){ echo 'selected'; } ?> value="{{$s->itemcode}}">{{$s->itemname}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Work Duration</label>
                                        <select id="guest_workDuration" name="guest_workDuration" class="form-control">
                                            <option value="ALL">Display all work durations</option>
                                            <option <?php if(@$search_workDuration == 'LT6MOS'){ echo 'selected'; } ?> value="LT6MOS">Less Than 6 Months</option>
                                            <option <?php if(@$search_workDuration == 'GT6MOS'){ echo 'selected'; } ?> value="GT6MOS">Greater Than 6 Months</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Order By</label>
                                        <select id="guest_orderBy" name="guest_orderBy" class="form-control">
                                            <option <?php if(@$search_orderBy == 'ASC'){ echo 'selected'; } ?> value="ASC">Oldest to Newest</option>
                                            <option <?php if(@$search_orderBy == 'DESC'){ echo 'selected'; } ?> value="DESC">Newest to Oldest</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a href="#" id="guest_initSearch" class="btn btn-primary btn-block">Search</a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    @if($jobs->count() == 0)
                                        No data available
                                    @endif
                                    @foreach($jobs as $job)
                                        <div style="border-bottom: 1px solid #ECF0F1;" class="padded">
                                            <h3>{{$job->title}}</h3>
                                            <div class="row">
                                                <div class="col-md-6">
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
                                                <div class="col-md-6">
                                                    <span class="text-right" style="padding:0;margin:0;"><i class="fa fa-map-marker"></i> {{$job->regname}}, {{$job->cityname}}</span><br/>
                                                    <a href="/login" class="badge" style="background-color:#2ECC71;">Login to view salary</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{$jobs->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
        	</div>
        </div>
    </header>
    <!-- END OF -->



<!-- All scripts and plugin should be placed here so the page can load -->
<!-- jQuery -->

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
