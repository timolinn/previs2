 <!-- Main Header -->
 @extends('layouts.home')

        @section('content')
        <!-- <br><br><br><br><br> -->
    <div class="banner" style="padding-top: 15%;" >
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner_item align-items-center" style="background-image:url({{ asset('imgs/chicken_plate.jfif') }})">
						<!-- <div class="banner_category">
							<a href="#">checkout</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
      <div id="content">
        <div class="container">
          <div class="row">
            <div id="checkout" class="col-lg-9">
              <div class="box border-bottom-0">
              @if ($message = session('error'))
                        <ul class="alert alert-danger" style="list-style-type: none">
                      <li>{{ $message }}</li>
              </ul>
            @endif
            @if ($message = session('success'))
            <ul class="alert alert-success" style="list-style-type: none">
                      <li>{{ $message }}</li>
              </ul>
            @endif
            @if($errors->any())
                 <div class="alert alert-danger" style="list-style-type: none">
                 <ul>
            @foreach ($errors->all() as $message)
                      <li>{{ $message }}</li>
            @endforeach
                  </ul>
                  </div>
             @endif
            <h3>CHECKOUT</h3>
                <form method="post" action="{{ route('register') }}">
                  <ul class="nav nav-pills nav-fill">
                    <li class="nav-item"><a href="{{ route('checkout') }}" class="nav-link active"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                    <li class="nav-item"><a href="{{ route('review-order') }}" class="nav-link"><i class="fa fa-truck"></i><br>Order Review</a></li>
                    <!-- <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li>
                    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-eye"></i><br>Order Review</a></li> -->
                  </ul>
                  {{ csrf_field() }}
                  <input type="hidden" name="checkout" value="1">
                  <div class="content">
                    <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="firstname">Username</label>
                          <input required name="username" value="{{ old('username') }}" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="firstname">Firstname</label>
                          <input required name="firstname" value="{{ old('firstname') }}" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="lastname">Lastname</label>
                          <input required name="lastname" value="{{ old('lastname') }}" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input required name="email" value="{{ old('email') }}" type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="phone">Telephone</label>
                          <input required name="phonenumber" value="{{ old('phonenumber') }}" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="email">Password</label>
                          <input required name="password" type="password" class="form-control">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="email">Retype your passsword</label>
                          <input required name="password_confirmation" type="password" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                    <div class="left-col"><a href="{{ route('cart')}}" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i>Back to basket</a></div>
                    <div class="right-col">
                      <button type="submit" class="btn btn-template-main">Continue to Order Review<i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-3">
              <div id="order-summary" class="box mb-4 p-0">
                <div class="box-header mt-0">
                  <h3>Order summary</h3>
                </div>
                <p class="text-muted text-small">Shipping and additional costs are calculated based on the values you have entered.</p>
                <div class="table-responsive">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Order subtotal</td>
                        <th>{{ $totalAmount }}</th>
                      </tr>
                      <tr>
                        <td>Delivery Cost</td>
                        <th><strong>Free</strong></th>
                      </tr>
                      <tr>
                        <td>Payment Method</td>
                        <th>Cash  On Delivery</th>
                      </tr>
                      <tr class="total">
                        <td>Total</td>
                        <th>₦{{ $totalAmount }}</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        @stop
