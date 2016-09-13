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

    .block-update-card {
        padding: 0.8em;
      height: 100%;
      border: 1px #FFFFFF solid;
      /*width: 380px;*/
      float: left;
      /*margin-left: 10px;*/
      /*margin-top: 0;*/
      /*padding: 0;*/
      box-shadow: 1px 1px 8px #d8d8d8;
      background-color: #FFFFFF;
    }
    .block-update-card .h-status {
      width: 100%;
      height: 7px;
      background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
    }
    .block-update-card .v-status {
      width: 5px;
      height: 80px;
      float: left;
      margin-right: 5px;
      background: repeating-linear-gradient(45deg, #606dbc, #606dbc 10px, #465298 10px, #465298 20px);
    }
    .block-update-card .update-card-MDimentions {
      width: 80px;
      height: 80px;
    }
    .block-update-card .update-card-body {
      margin-top: 10px;
      margin-left: 5px;
    }
    .block-update-card .update-card-body h4 {
      color: #737373;
      font-weight: bold;
      /*font-size: 13px;*/
    }
    .block-update-card .update-card-body p {
      color: #737373;
      font-size: 12px;
    }
    .block-update-card .card-action-pellet {
      padding: 5px;
    }
    .block-update-card .card-action-pellet div {
      margin-right: 10px;
      font-size: 15px;
      cursor: pointer;
      color: #dddddd;
    }
    .block-update-card .card-action-pellet div:hover {
      color: #999999;
    }
    .block-update-card .card-bottom-status {
      color: #a9a9aa;
      font-weight: bold;
      font-size: 14px;
      border-top: #e0e0e0 1px solid;
      padding-top: 5px;
      margin: 0px;
    }
    .block-update-card .card-bottom-status:hover {
      background-color: #dd4b39;
      color: #FFFFFF;
      cursor: pointer;
    }

    /*
    Creating a block for social media buttons
    */
    .card-body-social {
      font-size: 30px;
      margin-top: 10px;
    }
    .card-body-social .git {
      color: black;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .twitter {
      color: #19C4FF;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .google-plus {
      color: #DD4B39;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .facebook {
      color: #49649F;
      cursor: pointer;
      margin-left: 10px;
    }
    .card-body-social .linkedin {
      color: #007BB6;
      cursor: pointer;
      margin-left: 10px;
    }
    </style>
    <!-- END OF STYLE -->
    <script>
        $(document).ready(function(){

            CHAINLOCATION($('#employer_region'), $('#employer_city'));
            CHAINLOCATION($('#employer_region'), $('#employer_province'));
            CHAINLOCATION($('#employer_province'), $('#employer_city'));

            $('#SRCHBTN_SKILL').click(function(){
                var SKLL = $('#taskitems').val(),
                    CTGRY = $('#taskcategory').val(),
                    regions = $('#employer_region').val(),
                    city = $('#employer_city').val(),
                    province = $('#employer_province').val(),
                    profilePercentage = $('#employer_profilePercentage').val();

                location.href="/moreWorkers="+CTGRY+'='+SKLL+'='+regions+'='+city+'='+province+'='+profilePercentage;
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
                       <!--  <a class="" href="HowItWorks.html">How It Works</a> -->
                        {{ HTML::link('/howitworks', 'How It Works')}}

                    </li>

                    <li>
                     <!--   <a class="" href="WhyProveek.html">Why Choose Proveek</a> -->
                         {{ HTML::link('/whychooseproveek', 'Why Choose Proveek')}}

                    </li>
                    <li>
                        {{--<a class="page-scroll" href="#page-top">Job Ads Category</a>--}}
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
        <div class="vegas.overlay" style="height:100%; width:100%; background-color: rgba(0,0,0,.5); color:black;">
            <div class="header-content">
                <div class="header-content-inner">
                    <div class="widget-container padded">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <select id="employer_region" name="employer_region" data-loctype="REGION_TO_CITY" class="form-control">
                                            <option value="ALL">All regions</option>
                                            @foreach($regions as $r)
                                                <option value="{{$r->regcode}}" <?php if($region == $r->regcode){ echo 'selected'; } ?> >{{$r->regname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Province</label>
                                        <select id="employer_province" data-loctype="REGION_TO_PROVINCE" data-loctypeother="PROVINCE_TO_CITY" name="employer_province" class="form-control">
                                            <option value="ALL">All provinces</option>
                                            @foreach($provinces as $p)
                                                <option value="{{$p->provcode}}" <?php if($p->provcode == $province){ echo 'selected'; } ?> >{{$p->provname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <select id="employer_city" data-loctype="REGION_TO_CITY" name="employer_city" class="form-control">
                                            <option value="ALL">All cities</option>
                                            @foreach($cities as $c)
                                                <option value="{{$c->citycode}}" <?php if($c->citycode == $city){echo 'selected';} ?> >{{$c->cityname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Skill Category</label>
                                        <select name="taskcategory" id="taskcategory" class="form-control">
                                            <option value="ALL">Display from all categories</option>
                                            @foreach($categories as $category)
                                                <option <?php if($categoryId == $category->categorycode){echo "selected";} ?> value="{{ $category->categorycode }}">{{ $category->categoryname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select name="taskitems" id="taskitems" class="form-control">
                                            <option value="ALL">Display all skills</option>
                                            @foreach($categorySkills as $skill)
                                                <option <?php if($skillId == $skill->itemcode){echo "selected";} ?> value="{{ $skill->itemcode }}">{{ $skill->itemname }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Percentage</label>
                                        <select class="form-control" name="employer_profilePercentage" id="employer_profilePercentage">
                                            <option <?php if($profilePercentage == 'DESC'){ echo 'selected'; } ?> value="DESC">Highest to Lowest</option>
                                            <option <?php if($profilePercentage == 'ASC'){ echo 'selected'; } ?> value="ASC">Lowest to Highest</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="SRCHBTN_SKILL"><i class="fa fa-search"></i> Search for workers</button>
                                </div>
                                <div class="col-md-8">
                                    @if($users->count() == 0)
                                        <center><i>No data available</i></center>
                                    @else
                                        <h4>{{$users->count()}} result(s) found</h4>
                                        @foreach($users as $user)
                                            <div class="media block-update-card">
                                                <a class="pull-left" href="/{{$user->username}}">
                                                    @if($user->profilePic)
                                                        <img class="media-object update-card-MDimentions" src="{{$user->profilePic}}">
                                                    @else
                                                        <img class="media-object update-card-MDimentions" src="/images/default_profile_pic.png">
                                                    @endif
                                                </a>
                                                <div class="media-body update-card-body">
                                                    <a href="/{{$user->username}}">
                                                        <h4 class="media-heading">
                                                            {{substr_replace($user->firstName, str_repeat('*', strlen($user->firstName)-1), 1)}}
                                                            &nbsp;
                                                            {{substr_replace($user->lastName, str_repeat('*', strlen($user->lastName)-1), 1)}}
                                                            <span style="color: #3498db">{{'@'.$user->username}}</span>
                                                        </h4>
                                                    </a>
                                                    <span>{{$user->address}}, {{$user->regname}}, {{$user->cityname}}, {{$user->bgyname}}</span><br>
                                                    <span><b>Profile Rating: </b>70%</span><br>
                                                    <span><b>Last login: </b>2 Days ago</span>
                                                </div>
                                            </div>
                                        @endforeach
                                        {{$users->links()}}
                                    @endif
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
