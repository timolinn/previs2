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
	border-radius: 5px;
	border: 1px solid grey;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
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
										<i class="fa fa-user"></i>
									</a>
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
							<a href="#">pre<span>vis</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="/">home</a></li>
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

									<div class="dropdown-content" id="dropdown-content">
										<div id="drop-content">
											<div class="pull-right drop-item-dt">
												<p style="color:#FE4C50;" >
												Roasted Chicken <small style="color:#989898;"  class="pull-right" >Qty: 20</small>
												</p>
												<p class="pull-right"><i class="fa fa-fa-money"></i>₦ 3000.00</p>
											</div>
											<div class="pull-left drop-item">
												<img src="{{ asset('imgs/goat.jpg') }}" class="mx-auto d-bloc img-fluid" width="100" height="250" alt="User Image">
											</div>
										</div>
										<div class="dropdown-divider"></div>
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