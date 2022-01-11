@extends('frontend.main_master')
@section('content')

@section('title')
{{ $product->product_name_en }} Product Details
@endsection

<style>
	.checked {
		color: orange;
	}
</style>


<!-- ===== ======== HEADER : END ============================================== -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">



					<!-- ====== === HOT DEALS ==== ==== -->
					@include('frontend.common.hot_deals')
					<!-- ===== ===== HOT DEALS: END ====== ====== -->





				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
				<div class="detail-block">
					<div class="row  wow fadeInUp">

						<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
							<div class="product-item-holder size-big single-product-gallery small-gallery">

								<div id="owl-single-product">
									@if($multiImag->isEmpty())
									<div class="single-product-gallery-item">
										<a data-lightbox="image-1" data-title="Gallery"
											href="{{ asset('upload/products/thambnail/no_image.jpg') }} ">
											<img class="img-responsive" alt=""
												src="{{ asset('upload/products/thambnail/no_image.jpg') }} "
												data-echo="{{ asset('upload/products/thambnail/no_image.jpg' ) }} " />
										</a>
									</div><!-- /.single-product-gallery-item -->
									@else
									@foreach($multiImag as $img)
									<div class="single-product-gallery-item" id="slide{{ $img->id }}">
										<a data-lightbox="image-1" data-title="Gallery"
											href="{{ asset($img->photo_name ) }} ">
											<img class="img-responsive" alt="" src="{{ asset($img->photo_name ) }} "
												data-echo="{{ asset($img->photo_name ) }} " />
										</a>
									</div><!-- /.single-product-gallery-item -->
									@endforeach
									@endif

								</div><!-- /.single-product-slider -->


								<div class="single-product-gallery-thumbs gallery-thumbs">

									<div id="owl-single-product-thumbnails">

										@foreach($multiImag as $img)
										<div class="item">
											<a class="horizontal-thumb active" data-target="#owl-single-product"
												data-slide="1" href="#slide{{ $img->id }}">
												<img class="img-responsive" width="85" alt=""
													src="{{ asset($img->photo_name ) }} "
													data-echo="{{ asset($img->photo_name ) }} " />
											</a>
										</div>
										@endforeach




									</div><!-- /#owl-single-product-thumbnails -->



								</div><!-- /.gallery-thumbs -->

							</div><!-- /.single-product-gallery -->
						</div><!-- /.gallery-holder -->



						<div class='col-sm-6 col-md-7 product-info-block'>
							<div class="product-info">


								<h1 class="name" id="pname">
									@if(session()->get('language') == 'hindi') {{ $product->product_name_hin }} @else {{
									$product->product_name_en }} @endif
								</h1>
								<!-- rating stars here -->
								<div class="rating-reviews m-t-20">
									<div class="row">
										<div class="col-sm-3">
											@php
											$avarage =
											App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
											\App\Helpers\Helpers::get_rating($avarage);
											$reviewcount =
											App\Models\Review::where('product_id',$product->id)->where('status',1)->count();
											@endphp
										</div>
										<div class="col-sm-8">
											<div class="reviews">
												<a href="#" class="lnk">({{ $reviewcount}} Reviews)</a>
											</div>
										</div>
									</div><!-- /.row -->
								</div><!-- /.rating-reviews -->

								<!-- end rating -->


								<div class="stock-container info-container m-t-10">
									<div class="row">
										<div class="col-sm-2">
											<div class="stock-box">
												<span class="label">Availability :</span>
											</div>
										</div>
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="value">In Stock</span>
											</div>
										</div>
									</div><!-- /.row -->
								</div><!-- /.stock-container -->

								<div class="description-container m-t-20">
									{{ $product->short_descp_en }}
								</div><!-- /.description-container -->

								<div class="price-container info-container m-t-20">
									<div class="row">


										<div class="col-sm-6">
											<div class="price-box">
												@if ($product->discount_price == NULL)
												<span class="price">${{ $product->selling_price }}</span>
												@else
												<span class="price">${{ $product->discount_price }}</span>
												<span class="price-strike">${{ $product->selling_price }}</span>
												@endif


											</div>
										</div>

										<div class="col-sm-6">
											<div class="favorite-button m-t-10">
												<button class="btn btn-primary icon" type="button" title="Wishlist"
													id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i
														class="fa fa-heart"></i> </button>
											</div>
										</div>

									</div><!-- /.row -->
								</div><!-- /.price-container -->


								<!--     /// Add Product Color And Product Size ///// -->

								<div class="row">
									@php
									$allAttributes = App\Models\Attributes::all();
									@endphp
									@foreach($allAttributes as $attribute)

									<div class="col-sm-4">

										<div class="form-group">

											<ul class="list-inline"><strong>{{$attribute->name}}: </strong>

												@foreach($attributes as $attr_val)
												@if($attr_val->val->attribute_id == $attribute->id)
												<li class="list-inline-item">{{$attr_val->val->name}}</li>
												@endif
												@endforeach
											</ul>

										</div> <!-- // end form group -->

									</div> <!-- // end col 6 -->
									@endforeach
								</div>



								<!--     /// End Add Product Color And Product Size ///// -->








								<div class="quantity-container info-container">
									<div class="row">

										<input type="hidden" id="product_id" value="{{ $product->id }}" min="1">

										<div class="col-sm-7">
											<button class="btn btn-primary icon" type="button" title="Add Cart"
												data-toggle="modal" data-target="#exampleModal" id="{{$product->id}}"
												onclick="productView(this.id)"> Add to Cart </button>
										</div>


									</div><!-- /.row -->
								</div><!-- /.quantity-container -->



								<!-- Go to www.addthis.com/dashboard to customize your tools -->
								<div class="addthis_inline_share_toolbox_8tvu"></div>




							</div><!-- /.product-info -->
						</div><!-- /.col-sm-7 -->
					</div><!-- /.row -->
				</div>

				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#review">REVIEW</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">

								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">{{$product->short_descp_en}}</p>
									</div>
								</div><!-- /.tab-pane -->

								<div id="review" class="tab-pane">
									<div class="product-tab">

										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>

											@php
											$reviews =
											App\Models\Review::where('product_id',$product->id)->latest()->limit(5)->get();
											@endphp

											<div class="reviews">

												@foreach($reviews as $item)
												@if($item->status == 0)

												@else

												<div class="review">

													<div class="row">
														<div class="col-md-6">
															<img style="border-radius: 50%"
																src="{{ (!empty($item->user->profile_photo_path))? url('upload/user_images/'.$item->user->profile_photo_path):url('upload/no_image.jpg') }}"
																width="40px;" height="40px;"><b> {{ $item->user->name
																}}</b>

															@php
															\App\Helpers\Helpers::get_rating($item->rating);
															@endphp



														</div>

														<div class="col-md-6">

														</div>
													</div> <!-- // end row -->



													<div class="review-title">
														<span class="date"><i class="fa fa-calendar"></i>
															<span> {{
																Carbon\Carbon::parse($item->created_at)->diffForHumans()
																}} </span></span>
													</div>
													<div class="text">{{ $item->comment }}</div>
												</div>

												@endif
												@endforeach
											</div><!-- /.reviews -->


										</div><!-- /.product-reviews -->



										<div class="product-add-review">
											<h4 class="title">Write your own review</h4>
											<div class="review-table">

											</div><!-- /.review-table -->

											<div class="review-form">
												@guest
												<p> <b> For Add Product Review. You Need to Login First <a
															href="{{ route('login') }}">Login Here</a> </b> </p>

												@else

												<div class="form-container">

													<form role="form" class="cnt-form" method="post"
														action="{{ route('review.store') }}">
														@csrf

														<input type="hidden" name="product_id"
															value="{{ $product->id }}">


														<table class="table">
															<thead>
																<tr>
																	<th class="cell-label">&nbsp;</th>
																	<th>1 star</th>
																	<th>2 stars</th>
																	<th>3 stars</th>
																	<th>4 stars</th>
																	<th>5 stars</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td class="cell-label">Quality</td>
																	<td><input type="radio" name="quality" class="radio"
																			value="1"></td>
																	<td><input type="radio" name="quality" class="radio"
																			value="2"></td>
																	<td><input type="radio" name="quality" class="radio"
																			value="3"></td>
																	<td><input type="radio" name="quality" class="radio"
																			value="4" checked></td>
																	<td><input type="radio" name="quality" class="radio"
																			value="5"></td>
																</tr>

															</tbody>
														</table>




														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label for="exampleInputReview">Review </label>
																	<textarea class="form-control txt txt-review"
																		name="comment" id="exampleInputReview" rows="4"
																		placeholder=""></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														<div class="action text-right">
															<button type="submit"
																class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->

												@endguest


											</div><!-- /.review-form -->

										</div><!-- /.product-add-review -->

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->


							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ===== ======= UPSELL PRODUCTS ==== ========== -->
				@if($relatedProduct->isEmpty())
				@else
				<section class="section featured-product wow fadeInUp">
					<h3 class="section-title">Releted products</h3>
					<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">


						@foreach($relatedProduct as $product)

						<div class="item item-carousel">
							<div class="products">

								<div class="product">
									<div class="product-image">
										<div class="image">
											<a
												href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img
													src="{{ asset($product->product_thambnail) }}" alt=""></a>
										</div><!-- /.image -->

									</div><!-- /.product-image -->


									<div class="product-info text-left">
										<h3 class="name"><a
												href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
												@if(session()->get('language') == 'hindi') {{ $product->product_name_hin
												}} @else {{ $product->product_name_en }} @endif</a></h3>
										<div class="rating rateit-small"></div>
										<div class="description"></div>


										@if ($product->discount_price == NULL)
										<div class="product-price">
											<span class="price">
												${{ $product->selling_price }} </span>
										</div><!-- /.product-price -->
										@else

										<div class="product-price">
											<span class="price">
												${{ $product->discount_price }} </span>
											<span class="price-before-discount">$ {{ $product->selling_price }}</span>
										</div><!-- /.product-price -->
										@endif




									</div><!-- /.product-info -->
									<div class="cart clearfix animate-effect">
										<div class="action">
											<ul class="list-unstyled">
												<li class="add-cart-button btn-group">

													<button class="btn btn-primary icon" type="button" title="Add Cart"
														data-toggle="modal" data-target="#exampleModal"
														id="{{ $product->id }}" onclick="productView(this.id)"> <i
															class="fa fa-shopping-cart"></i> </button>

													<button class="btn btn-primary cart-btn" type="button">Add to
														cart</button>
												</li>



												<button class="btn btn-primary icon" type="button" title="Wishlist"
													id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i
														class="fa fa-heart"></i> </button>


											</ul>
										</div><!-- /.action -->
									</div><!-- /.cart -->
								</div><!-- /.product -->

							</div><!-- /.products -->
						</div><!-- /.item -->

						@endforeach





					</div><!-- /.home-owl-carousel -->
				</section><!-- /.section -->
				@endif
				<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->

	</div>






	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e4b85f98de5201f"></script>




	@endsection