<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>DLPCMS - Error 404</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('dashboard_assets/img/favicon.png')}}">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('dashboard_assets/css/font-awesome.min.css')}}">

		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('dashboard_assets/css/feathericon.min.css')}}">

		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('dashboard_assets/css/style.css')}}">


    </head>
    <body class="error-page">

		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<div class="error-box">
				<h1>404</h1>
				<h3 class="h2 mb-3"><i class="fa fa-warning"></i> Oops! Page not found!</h3>
				<p class="h4 font-weight-normal">The page you requested was not found.</p>
				<a href="{{route('index')}}" class="btn btn-primary">Back to Home</a>
			</div>

        </div>


		<!-- jQuery -->
        <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('dashboard_assets/css/js/popper.min.js')}}"></script>
        <script src="{{asset('dashboard_assets/js/bootstrap.min.js')}}"></script>

		<!-- Custom JS -->
		<script  src="{{asset('dashboard_assets/js/script.js')}}"></script>

    </body>


</html>
