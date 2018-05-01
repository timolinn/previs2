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
            <h3>CHECKOUT</h3>
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
                <form method="post" action="{{ route('create-order') }}">
                {{ csrf_field() }}
                  <ul class="nav nav-pills nav-fill">
                  @auth
                    <li class="nav-item"><a href="#" class="nav-link disabled" onclick="javascript:void(0);" > <i class="fa fa-map-marker"></i><br>Address</a></li>
                  @else
                    <li class="nav-item"><a href="{{ route('checkout') }}" class="nav-link"> <i class="fa fa-map-marker"></i><br>Address</a></li>
                  @endauth
                    <li class="nav-item"><a href="{{ route('review-order') }}" class="nav-link active"><i class="fa fa-truck"></i><br>Order Review</a></li>
                    <!-- <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-money"></i><br>Payment Method</a></li>
                    <li class="nav-item"><a href="#" class="nav-link disabled"><i class="fa fa-eye"></i><br>Order Review</a></li> -->
                  </ul>

                  <div class="content">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th>Discount</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($cartItems as $cItem)
                        <tr>
                          <td><a href="#"><img src="{{ asset($cItem->options->image) }}" alt="{{ $cItem->name }}"></a></td>
                          <td><a href="#">{{ $cItem->name }}</a></td>
                          <td>{{ $cItem->qty }}</td>
                          <td>₦{{ $cItem->price }}.00</td>
                          <td>₦{{ $cItem->qty * $cItem->price }}.00</td>
                        </tr>
                    @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="5">Total</th>
                          <th>${{ $totalAmount}}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <div class="box-footer d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left-col"><a href="{{ route('cart') }}" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i>Back to Cart</a></div>
                  <div class="right-col">
                    <button type="submit" class="btn btn-template-main">Place the order<i class="fa fa-chevron-right"></i></button>
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
