<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="timer_assets/assets/img/favicon.png">

    <title>Webuild - Free Bootstrap coming soon template with countdown</title>

    <!-- Bootstrap -->
    <link href="timer_assets/assets/css/bootstrap.css" rel="stylesheet">
	<link href="timer_assets/assets/css/bootstrap-theme.css" rel="stylesheet">

    <!-- siimple style -->
    <link href="timer_assets/assets/css/style.css" rel="stylesheet">

    {{ HTML::script('frontend/js/html5shiv.js') }}
    {{ HTML::script('frontend/js/respond.min.js') }}
  </head>

  <body>

	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>Proveek</h1>
					<h2 class="subtitle">We're working hard to improve our website and we'll be ready to launch after</h2>
					<div id="countdown"></div>
				<!--	<form class="form-inline signup" role="form">
					  <div class="form-group">
					    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address">
					  </div>
					  <button type="submit" class="btn btn-theme">Get notified!</button>
					</form>
					-->
				</div>

			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
                        <!--
						<p class="copyright">Copyright &copy; 2016. Al rights reserved. <a href="http://bootstraptaste.com/">Bootstrap Themes</a> by BootstrapTaste</p>

                            All links in the footer should remain intact.
                            Licenseing information is available at: http://bootstraptaste.com/license/
                            You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=WeBuild
                        -->
				</div>
			</div>
		</div>
	</div>
    {{ HTML::script('frontend/js/jquery.js') }}
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="timer_assets/assets/js/bootstrap.min.js"></script>
	<script src="timer_assets/assets/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
  $('#countdown').countdown('2016/09/21', function(event) {
    $(this).html(event.strftime('%w week %d days <br /> %H:%M:%S'));
  });
</script>
  </body>
</html>
