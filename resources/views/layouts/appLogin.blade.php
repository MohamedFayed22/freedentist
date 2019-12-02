<html lang="en">

	<!-- begin::Head -->
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>Free Dentist</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<link href="{{ asset('public/bassets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="{{ asset('public/bassets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="../../../assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="{{ asset('public/bassets/demo/default/media/img/logo/favicon.ico') }}" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url({{ asset('public/bassets/app/media/img//bg/bg-3.jpg')}});">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container" style="width: 745px">
						<div class="m-login__logo">
							<a href="#">
								<img src="{{ asset('public/bassets/demo/default/media/img/logo/logo_default_dark.png')}}">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">Sign In To Admin</h3>
							</div>
	
	 @yield('content')
	 
	 </div>
						
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin::Global Theme Bundle -->
		<script src="{{ asset('public/bassets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{ asset('public/bassets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="{{ asset('public/bassets/snippets/custom/pages/user/login.js') }}" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>