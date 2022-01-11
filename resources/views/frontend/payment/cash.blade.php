@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('title')
Cash On Delivery
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{url('/')}}">Home</a></li>
				<li class='active'>Cash On Delivery</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->


<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-6">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="unicase-checkout-title">Your Shopping Amount </h4>
								</div>
								<div class="">
									<ul class="nav nav-checkout-progress list-unstyled">

										<li>
											@if(Session::has('coupon'))

											<strong>SubTotal: </strong> ${{ $cartTotal }}
											<hr>

											<strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name']
											}}
											( {{ session()->get('coupon')['coupon_discount'] }} % )
											<hr>

											<strong>Coupon Discount : </strong> ${{
											session()->get('coupon')['discount_amount'] }}
											<hr>

											<strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount']
											}}
											<hr>


											@else

											<strong>SubTotal: </strong> ${{ $cartTotal }}
											<hr>

											<strong>Grand Total : </strong> ${{ $cartTotal }}
											<hr>


											@endif

										</li>

										<li><strong>shipping city: </strong>{{ $data['city_name'] }}</li>
										<li><strong>shipping district: </strong>{{ $data['district_name'] }}</li>
										<li><strong>shipping address: </strong>{{ $data['address'] }}</li>

										<li>
											<form action="{{ route('cash.order') }}" method="post" id="payment-form">
												@csrf
												<div class="form-row">

													<label for="card-element">

														<input type="hidden" name="name"
															value="{{ $data['shipping_name'] }}">
														<input type="hidden" name="email"
															value="{{ $data['shipping_email'] }}">
														<input type="hidden" name="phone"
															value="{{ $data['shipping_phone'] }}">
														<input type="hidden" name="city_id"
															value="{{ $data['city_id'] }}">
														<input type="hidden" name="district_id"
															value="{{ $data['district_id'] }}">
														<input type="hidden" name="address"
															value="{{ $data['address'] }}">
														<input type="hidden" name="notes" value="{{ $data['notes'] }}">
													</label>




												</div>
												<br>
												<button class="btn btn-primary">Submit Payment</button>
											</form>
										</li>

									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- checkout-progress-sidebar -->
				</div> <!--  // end col md 6 -->
			</div>
			@endsection