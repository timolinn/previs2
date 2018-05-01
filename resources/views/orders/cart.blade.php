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
          <div class="row bar">
            <div class="col-lg-12">
              <p class="text-muted lead">You currently have {{ $numberOfItems }} item(s) in your cart.</p>
            </div>
            <div id="basket" class="col-lg-12">
              <div class="box mt-0 pb-0 no-horizontal-padding">
                <form method="get" action="{{ route('checkout') }}">
                {{ csrf_field() }}
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Unit price</th>
                          <th colspan="2">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($cartItems as $cItem)
                        <tr>
                          <td><a href="#"><img src="{{ asset($cItem->options->image) }}" alt="{{ $cItem->name }}" class="img-fluid rounded"></a></td>
                          <td><a href="#">{{ $cItem->name }}</a></td>
                          <td>
                            <input type="number" value="{{ $cItem->qty }}" class="form-control">
                          </td>
                          <td>₦{{ $cItem->price }}.00</td>
                          <td>₦{{ $cItem->qty * $cItem->price }}.00</td>
                          <td><a href="{{ route('delete-item', ['rowId' => $cItem->rowId ])}}"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="5">Total</th>
                          <th colspan="2">₦{{ $totalAmount }}</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="box-footer d-flex justify-content-between align-items-center">
                    <div class="left-col"><a href="{{ route('home') }}" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                    <div class="right-col">
                      <button class="btn btn-secondary"><i class="fa fa-refresh"></i> Update cart</button>
                      <button type="submit" class="btn btn-template-outlined">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
        @stop
