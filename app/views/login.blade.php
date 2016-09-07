<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proveek is an online platform that allows an individual or company to hire or outsource jobs from skilled or manual laborers near their area.">
    <meta name="author" content="Proveek Inc.">

    <title>Proveek | Login</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
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
    
    <style>
        .lato-text 
        {
            font-family: 'Lato', sans-serif;
        }

        .txtPadding
        {
            padding: 20px 15px 20px 15px;
        }

        .btnTheme
        {
            width:45%; border:1px solid #2980b9; border-radius:4px;
        }
        @media (max-width: 480px){
            a.btn, input.btn.btn-md.btn-primary.lato-text.btnTheme {
                width: 200px;
                font-size: 15px;
            }
            .col-xs-10 {
                padding: 10px !important;
            }            
        }
    </style>

</head>

<body id="page-top">
    <!-- HEADER SEARCH SECTION -->
    <header style="height:100%;">
    <!-- Used for Copyright (LOWER RIGHT of Screen) -->
        <div class="divFooterDark"style="position:fixed; right:5px; bottom:0;background:none;">
            <p style="color:#222; margin:auto; font-size:7pt;">© 2016 Proveek Inc.</p>
        </div>
        <div class="vegas.overlay" style="height:100%;background-color:rgba(255,255,255,.9);">
            <div class="header-content">
                <div class="header-content-inner wow fadeIn">
                    <div class="col-xs-1"><!-- Used to center Input Group --></div>
                <!-- MAIN CONTAINER FOR TEXTBOXES AND BUTTONS -->
                    <div class="col-xs-10" style="padding:40px;"> <!-- wow fadeIn data-wow-delay="2s" -->
                    <!-- LOGO -->
                            <div class="col-xs-12" style="text-align:center;"> <!-- wow fadeInDown data-wow-delay="2.2s" -->
                                <a href="/">
                                    <img src="frontend/img/proveek-logo-300.png" class="img-responsive center-block">
                                </a>
                            </div>
                            @if(Session::has('errorMsg'))
                                  <br><h5 style="color: red"> {{ Session::get('errorMsg') }} </h5><br>
                            @endif

                            @if(Session::has('successMsg'))
                                <br><h5 style="color: green"> {{ Session::get('successMsg') }} </h5><br>
                            @endif
                        {{ Form::open(array('url' => '/doLogin')) }}
                            <!-- INPUT GROUP for Username -->
                                <div class="col-lg-6 input-group lato-text" style="display:inline-block"> <!-- wow fadeInUp data-wow-delay="2.3s"  -->
                                    <!-- <span class="input-group-addon" id="sizing-addon1"><span class=" glyphicon glyphicon-user"></span></span> -->
                                    <!-- <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" style="padding: 20px 15px 20px 15px;"> -->
                                    {{ Form::text('username', Input::old('username'), array('class' => 'form-control txtPadding', 'placeholder' => 'USERNAME')) }}
                                </div>

                            <!-- INPUT GROUP for Password -->
                                <div class="col-lg-6 input-group lato-text" style="display:inline-block"> <!-- wow fadeInUp data-wow-delay="2.4s"  -->
                                    <!-- <span class="input-group-addon" id="sizing-addon2"><span class=" glyphicon glyphicon-asterisk"></span></span> -->
                                    <!-- <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" style="padding: 20px 15px 20px 15px;"> -->
                                    {{ Form::password('password' , array('class' => 'form-control txtPadding', 'placeholder' => 'PASSWORD')) }}
                                </div>

                            <!-- Login Button -->
                                <div class="" style="padding-top:20px; padding-bottom:20px;">
                                      <!-- <button type="button" class="btn btn-primary btn-md lato-text" style="width:45%;border:1px solid #2980b9; border-radius:4px;">Login</button> -->
                                      {{ Form::submit('LOGIN', array('class' => 'btn btn-md btn-primary lato-text btnTheme', 'style' => 'border:1px solid #2990b9;')) }}                     
                                </div>
                        {{ Form::close() }}
                        <a href="/" class="btn btn-success lato-text btnTheme btn-lg" data-toggle="modal">Register</a><br/><br/>
                        <a class="btn btn-primary lato-text btnTheme" style="border:1px solid #2980b9;" data-toggle="modal" data-target="#forgotPassModal">Forgot Password</a>

                    <!-- Additionals -->
                              {{--<div class="div_signUp lato-text" style="padding-top:20px;"> <!-- wow fadeIn data-wow-delay="2.6s"  -->--}}
                                  {{--<!-- <p style="color:#222; font-style:oblique; margin:auto;">Don't have an account? <a href="#" style="text-decoration:underline;">Sign Up</a> now.</p>--}}
                                  {{--<p style="color:#222; font-style:oblique;margin:auto;">Forgot your password? <a href="#" style="text-decoration:underline;">Click Here</a></p> -->--}}
                                  {{--<p style="color:#222; font-size: 18pt; padding:0;">Create account</p>--}}
                                  {{--<div class="col-lg-12">--}}
                                      {{--<div class="col-lg-3"></div>--}}
                                      {{--<div class="col-lg-3 text-center">--}}
                                              {{--<button type="button" class="lato-text taskminator-btn btn btn-lg btn-warning btn-block" onclick="location.href='/regTaskminator'" style="border-radius:4px;"></span>Worker</button>--}}
                                      {{--</div>--}}
                                      {{--<div class="col-lg-3 text-center">--}}
                                              {{--<button type="button" class="lato-text taskminator-btn btn btn-lg btn-warning btn-block" style="border-radius:4px;" onclick="location.href='/regClientComp'">Employer</button>--}}
                                      {{--</div>--}}
                                      {{--<div class="col-lg-3"></div>--}}
                                  {{--</div>--}}
                              {{--</div>--}}
                              
                    </div>
                    <div class="col-xs-1"><!-- Used to center Input Group --></div>
                </div>
            </div>
        </div>
    </header>
    <!-- END OF -->

<div class="modal fade lato-text" id="forgotPassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="margin: 0;">
                    <p>
                        You will receive a special link for resetting your password.<br/>
                        The account related to this email will be deactivated until password reset has been successful.
                    </p>
                    <form method="POST" action="/forgotPassword" id="forgotPassword">
                        <input type="text" style="display: none;"/>
                        <input type="hidden" name="process" value="FGPASS" />
                        <input type="text" class="form-control" placeholder="Enter your email" name="email" id="emailForgotPass"/>
                        <button type="button" class="btn btn-danger pull-right passBtn" data-msg="#forgotpass-msg" data-form="#forgotPassword" data-field="#emailForgotPass" style="margin: 0; margin-top: 0.4em;">Send</button>
                    </form>
                    <p id="forgotpass-msg" style="margin: 0; margin-top: 1em;">

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



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
    <script src="js/taskminator.js" type="text/javascript"></script>
    <script src="javascripts/modernizr.custom.js" type="text/javascript"></script>

<!-- Custom Theme JavaScript -->
    <script src="frontend/js/creative.js"></script>
    <script src="frontend/js/jquery.nicescroll.js"></script>

<!-- HTML SMOOTH MOUSEWHEEL SCROLLING -->
    <script>
    $(document).ready(

      function() { 

        $("html").niceScroll();

      }
    );
    </script>
<!-- END OF SMOOTH MOUSEWHEEL SCROLLING -->

<!-- TASKMINATOR CODE  -->
<script>
    $(document).ready(function(){
       $('.passBtn').click(function(){
           var inputLength = $($(this).attr('data-field')).val().length,
               input = $($(this).attr('data-field')),
               msgDiv = $($(this).attr('data-msg')) ;

           msgDiv.empty().append('Please wait.');
           input.prop('readonly', true);

           if(inputLength > 0){
               var form = $($(this).attr('data-form'));
               $.ajax({
                   type      :   form.attr('method'),
                   url       :   form.attr('action'),
                   data      :   form.serialize(),
                   success  :   function(data){
                        if(data['flag'] == 'SUCCESS'){
                            input.val('');
                            msgDiv.empty().append('<span style="color: green; font-size: 0.8em;">'+data['msg']+'</span>');
                        }else{
                            msgDiv.empty().append('<span style="color: red; font-size: 0.8em;">'+data['msg']+'</span>');
                        }

                       input.prop('readonly', false);
                       setTimeout(function(){ msgDiv.empty(); }, 5000);
                   },error  :   function(){
                       msgDiv.empty().append('<span style="color: red; font-size: 0.8em;">Request Failed. Your network connectivity might be unstable or<br/>Server might be down</span>');
                       input.prop('readonly', false);
                       setTimeout(function(){ msgDiv.empty(); }, 5000);
                   }
               });
           }else{
                msgDiv.empty().append('<span style="color: red; font-size: 0.8em;">Please input a registered email</span>');
           }
       })
    });
</script>

<!-- END OF TASKMINATOR CODE -->

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

</body>

</html>
