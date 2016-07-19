<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>arc-edi</title>

<!-- Bootstrap -->
<link href="/assets/bower/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
<link href="/assets/css/main.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<header id="header" role="banner" style="z-index: 1000;">
		<div class="container">
			<div id="navbar" class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse"
						data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#main-slider"><i
								class="glyphicon glyphicon-home"></i></a></li>
						<li><a href="<?php echo url('expenses'); ?>">Pagos</a></li>
						<li><a href="#portfolio">Portfolio</a></li>
						<li><a href="#pricing">Pricing</a></li>
						<li><a href="#about-us">About Us</a></li>
						<li><a href="{{ url('/logout') }}">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<!--/#header-->
	<section id="services" style="padding: 85px 0;">
		<div class="container">@yield("content")</div>
	</section>
	<div id="ficha"></div>

	@include('layouts.templates')
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="/assets/bower/jquery/dist/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/assets/bower/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/underscore/underscore-min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/backbone/backbone-min.js"></script>
	<script type="text/javascript"
		src="/assets/bower/backbone-validation/dist/backbone-validation-min.js"></script>

	<script type="text/javascript"
		src="/assets/bower/moment/min/moment-with-locales.min.js"></script>

	<script type="text/javascript"
		src="/assets/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<link rel="stylesheet"
		href="/assets/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

	<script type="text/javascript" src="/assets/js/arcedu.js"></script>
	@yield("script")
</body>
</html>