<!DOCTYPE html>
<html lang="en">
<head>
	<title>A&I-28|Home</title>
	<meta charset="utf-8">
	<link rel="icon" href="http://dzyngiri.com/favicon.png" type="image/x-icon">
	<link rel="shortcut icon" href="http://dzyngiri.com/favicon.png" type="image/x-icon" />
	<meta name="description" content="Codester is a free responsive Bootstrap template by Dzyngiri">
	<meta name="keywords" content="free, template, bootstrap, responsive">
	<meta name="author" content="Inbetwin Networks">
	<link rel="stylesheet" href="assets/codester/css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/codester/css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/codester/css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/codester/css/touchTouch.css" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/codester/css/kwicks-slider.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="assets/bower/jquery/dist/jquery.js"></script>

	<script type="text/javascript" src="assets/codester/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="assets/codester/js/jquery.kwicks-1.5.1.js"></script>
	<script type="text/javascript" src="assets/codester/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="assets/codester/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="assets/codester/js/touchTouch.jquery.js"></script>
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='assets/codester/js/jquery.preloader.js'></"+"script>");}	</script>

	<script>
		jQuery(window).load(function() {
			$x = $(window).width();
			if($x > 1024)
			{
				jQuery("#content .row").preloader();    }

			jQuery('.magnifier').touchTouch();
			jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});
		});

	</script>

	<!--[if lt IE 8]>
	<div style='text-align:center'><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://www.theie6countdown.com/img/upgrade.jpg"border="0"alt=""/></a></div>
	<![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<!--<![endif]-->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" href="assets/codester/css/docs.css" type="text/css" media="screen">
	<link rel="stylesheet" href="assets/codester/css/ie.css" type="text/css" media="screen">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>
	<![endif]-->

	<!--Google analytics code-->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-29231762-1']);
		_gaq.push(['_setDomainName', 'dzyngiri.com']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>

<body>
<div class="spinner"></div>
<!-- header start -->
<header>
	<div class="container clearfix">
		<div class="row">
			<div class="span12">
				<div class="navbar navbar_">
					<div class="container">
						<h1 class="brand brand_"><a href="{{ url('/') }}"><img alt="" src="assets/images/logo-transparente1.png"> </a></h1>
						<a class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">Menu <span class="icon-bar"></span> </a>
						<div class="nav-collapse nav-collapse_  collapse">
							<ul id="ulMeniArcEdi" class="nav sf-menu">
								<li class="active"><a href="{{ url('/') }}">Home</a></li>
								<li><a href="{{ url('/contact') }}">Contact</a></li>
								@if (Auth::guest())
									<li><a href="{{ url('/login') }}">Ingresar</a></li>
								@else
									<li><a href="{{ url('/admin') }}">Admin</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
											{{ Auth::user()->name }} <span class="caret"></span>
										</a>

										<ul class="dropdown-menu">
											<li><a href="{{ url('/env') }}">Ambientes</a></li>
											<li><a href="#">Usuarios</a></li>
											<li><a href="#">Cuenta</a></li>
											<li role="separator" class="divider"></li>
											<li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
										</ul>
									</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="bg-content">
	@yield('content')
</div>

<!-- footer -->
<footer>
	<div class="container clearfix">
		<div class="privacy pull-left">&copy; 2016 | <a href="#">arcquars - lugubria</a> | </div>
	</div>
</footer>
<script src="/assets/bower/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>