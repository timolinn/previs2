<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ env('APP_NAME')}}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Previs Discount Club. This is a club that subsidizes purchase of commodities for its members">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/styles/bootstrap4/bootstrap.min.css') }}">
<link  rel="stylesheet" type="text/css" href="{{ asset('coloshop/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.red.css') }}" id="theme-stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('coloshop/styles/responsive.css') }}">
<style>
.dropdowner {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
	width: 350px;
	border-radius: 1px;
	border: 1px solid grey;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.3);
    padding: 13px 16px;
    z-index: 1;
	right: 0;
	/* color: #FE4C50; */
}

.dropdowner:hover .dropdown-content {
    display: block;
}

#drop-content {
	display: flex;
	flex-direction: row-reverse;
	align-items: baseline;
	align-content: center;
	flex-wrap:wrap;
}

.drop-item {
	flex-grow: 1;
	align-self: center;
}

.drop-item-dt {
	flex-grow: 2;
}

.drop-item-link {
	display: flex;
	align-content: flex-start;
	justify-content: space-between;
}

.drop-item-empty {
	display: flex;
	background: #FE4C50;
}

.drop-item-empty a {
	align-self: center;
	background: #FE4C50;
	border-radius: 0 !important;
	/* border: 2px solid black; */
	padding-left: 50% !important;
	padding-right: 50% !important;
}

.drop-item-link a {
	background: #FE4C50;
	align-self: center;
	border-radius: 0 !important;
	padding-left: 15% !important;
	padding-right: 15% !important;
}

.drop-item-link a:last-child {
	border: 2px solid #FE4C50;
	background: transparent;
}

.drop-item-link a:last-child:hover {
	color: white;
	background: #FE4C50;
}

.drop-item-link:hover {
	/* background: #FE4C50 !important; */
}

.fa-spinner {
	color: white;
	margin:12px;
	animation: spinner .6s linear infinite;
}

@keyframes spinner {
  to {transform: rotate(360deg);}
}

</style>

@yield('css')

</head>

<body>

<div class="super_container">

	<!-- Header -->
	<header class="header trans_300">

		<!-- Top Navigation -->

		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top_nav_left">free shipping on all office orders over $50</div>
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="top_nav_menu">

								<!-- Currency / Language / My Account -->


								<li class="account">
									@auth
									<a href="{{ route('account', ['user' => Auth::user()->user_name])}}">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection">
										<form action="/logout" method="post">
                              				{{ csrf_field() }}
                                    <button type="submit" class="btn-link btn"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign out</button>
                              		</form>
									</ul>
									@else
									<a href="#">
										My Account
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection">
										<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
										<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
									</ul>
									@endauth
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="{{ route('home') }}">pre<span>vis</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="{{ route('home') }}">home</a></li>
								<li><a href="#">shop</a></li>
								<li><a href="contact.html">contact</a></li>
							</ul>
							<ul class="navbar_user">
								@auth
									<li><a href="{{ route('account', ['user' => Auth::user()->user_name])}}"><i class="fa fa-user" aria-hidden="true"></i></a></li>
								@endauth
								<li class="checkout dropdowner">
									<a href="#" class="dropdowner" id="cart">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items"></span>
									</a>

										 <!-- cart contents -->
									<div class="dropdown-content" id="dropdown-content">
									</div>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</header>
	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
					@auth
						<a href="#">
							My Account
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="account_selection">
							<li><a href="/logout"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign Out</a></li>
						</ul>
					@else
						<a href="#">
							My Account
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="account_selection">
							<li><a href="/login"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
							<li><a href="/register"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
						</ul>
					@endauth
				</li>
				<li class="menu_item"><a href="/">home</a></li>
				<li class="menu_item"><a href="#">shop</a></li>
				<li class="menu_item"><a href="#">contact</a></li>
			</ul>
		</div>
	</div>