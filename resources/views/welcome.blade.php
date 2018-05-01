@extends('layouts.home')

@section('content')

	<!-- <div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<li class="menu_item has-children">
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
				<li class="menu_item"><a href="/">home</a></li>
				<li class="menu_item"><a href="#">shop</a></li>
				<li class="menu_item"><a href="#">contact</a></li>
			</ul>
		</div>
	</div> -->

	<!-- Slider -->

	<div class="main_slider" style="background-image:url({{ asset('imgs/chicken.jpg') }})">
			@if ($message = session('error'))
                        <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ $message }}</li>
              </ul>
            @endif
            @if ($message = session('success'))
            <ul class="alert alert-success" style="list-style-type:none;background:#FE4C50;color:white;">
                      <li>{{ $message }}</li>
              </ul>
            @endif
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<!-- <h6>Spring / Summer Collection 2017</h6> -->
						<h1>Get Massive Discounts on Previs</h1>
						<div class="red_button shop_now_button"><a href="/register">join us</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Banner -->

	<div class="banner">
		<div class="container">
			<div class="row">
			<div class="col-md-4">
					<!-- <div class="banner_item align-items-center" style="background-image:url({{ asset('imgs/chicken_plate.jfif') }})">
						<div class="banner_category">
							<a href="categories.html">food</a>
						</div>
					</div> -->
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url({{ asset('imgs/chicken_plate.jfif') }})">
						<div class="banner_category">
							<a href="categories.html">food</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Available Deals</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<!-- <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".women">women's</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".accessories">accessories</li>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".men">men's</li> -->
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
	<div class="product-item col-md-3"></div>
						<!-- Product 1 -->
						@isset($items)
						@foreach($items as $item)
						<div class="product-item col-md-6">
							<div class="product discount product_filter">
								<div class="product_image">
									<img src="{{ asset($item->image_path) }}" class="rounded img-fluid" style="max-height:180px;" alt="">
								</div>
								<div class="favorite favorite_left"></div>
								<!-- <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span>-$20</span></div> -->
								<div class="product_info">
									<h6 class="product_name"><a style="font-weight: normal;font-size:12px;" href="{{ route('show-item', ['id' => $item->id])}}">{!! ucfirst($item->item_name) !!}</a></h6>
									<div class="product_price">₦ {{ $item->item_price }}</div>
								</div>
							</div>
							<div class="red_button add_to_cart_button">
								<a href="#" class="addToCart pull-right" data-iid="{{$item->id}}"><i class="fa fa-2x pull-left" aria-hidden="true"></i>add to cart</a>

							</div>
						</div>
						@endforeach
						@endisset

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deal of the week -->

	<div class="deal_ofthe_week">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<div class="deal_ofthe_week_img">
						<img src="{{ asset('imgs/eggs.jfif') }}" alt="">
					</div>
				</div>
				<div class="col-lg-6 text-right deal_ofthe_week_col">
					<div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
						<div class="section_title">
							<h2>Deal Of The Week</h2>
						</div>
						<ul class="timer">
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="day" class="timer_num">03</div>
								<div class="timer_unit">Day</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="hour" class="timer_num">15</div>
								<div class="timer_unit">Hours</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="minute" class="timer_num">45</div>
								<div class="timer_unit">Mins</div>
							</li>
							<li class="d-inline-flex flex-column justify-content-center align-items-center">
								<div id="second" class="timer_num">23</div>
								<div class="timer_unit">Sec</div>
							</li>
						</ul>
						<div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-6 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cash on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
						<h4>Newsletter</h4>
						<p>Subscribe to our newsletter and get 10% off your first purchase</p>
					</div>
				</div>
				<div class="col-lg-6">
					<form action="post">
						<div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
							<input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
							<button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

@stop