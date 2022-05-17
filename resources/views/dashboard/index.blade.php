<!DOCTYPE html>
<html lang="en" dir="RTL">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Graduation - 	@yield('title') </title>
	
	@include('dashboard.layouts.head')

	@yield('js')

</head>

<body>

	<!-- Main navbar -->
	
	@include('dashboard.layouts.mainNavbar')
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			@include('dashboard.layouts.mainSidebar')
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				@include('dashboard.layouts.pageHeader')
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					

                     @yield('contents')

					

                     {{--
					<!-- Dashboard content -->
					<div class="row">
			


					</div>
					<!-- /dashboard content -->
					--}}

					<!-- Footer -->
				@include('dashboard.layouts.footer')
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
