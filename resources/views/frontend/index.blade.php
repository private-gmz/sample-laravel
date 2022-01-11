@extends('frontend.main_master')
@section('content')
@section('title')
GMZ Online Shop
@endsection



<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <!-- ============================================== SIDEBAR ============================================== -->
      @include('frontend.common.sidebar')
      <!-- ============================================== SIDEBAR : END ============================================== -->

      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">




        <!-- === ========= SECTION – HERO ==== ======= -->

        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

            @foreach($sliders as $slider)
            <div class="item" style="background-image: url({{ asset($slider->slider_img) }});">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">

                  <div class="big-text fadeInDown-1">{{ $slider->title }} </div>
                  <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{ $slider->description }}</span> </div>
                  <div class="button-holder fadeInDown-3"> <a href="{{ route('shop.page') }}"
                      class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                </div>
                <!-- /.caption -->
              </div>
              <!-- /.container-fluid -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.owl-carousel -->
        </div>

        <!-- ==== ===== SECTION – HERO : END === ============== -->




        <!-- = ===== SCROLL TABS =============== ========== -->

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>

              @foreach($categories as $category)
              <li><a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{
                  $category->category_name_en }}</a></li>
              @endforeach
              <!-- <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>

              <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> -->
            </ul>
            <!-- /.nav-tabs -->
          </div>
          <div class="tab-content outer-top-xs">



            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">

                  @foreach($products as $product)
                  <div class="item item-carousel">
                    <div class="products">
                      <div class="product">
                        <div class="product-image">
                          <div class="image"> <a
                              href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img
                                src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                          <!-- /.image -->

                          @php
                          $amount = $product->selling_price - $product->discount_price;
                          $discount = ($amount/$product->selling_price) * 100;
                          @endphp

                          <div>
                            @if ($product->discount_price == NULL)
                            <div class="tag new"><span>new</span></div>
                            @else
                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                            @endif
                          </div>
                        </div>

                        <!-- /.product-image -->

                        <div class="product-info text-left">
                          <h3 class="name"><a
                              href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                              {{ $product->product_name_en }}
                            </a></h3>
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
                          <div class="description"></div>

                          @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                          @else
                          <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span
                              class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                          @endif


                          <!-- /.product-price -->

                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                          <div class="action">
                            <ul class="list-unstyled">
                              <li class="add-cart-button btn-group">


                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal"
                                  data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i
                                    class="fa fa-shopping-cart"></i> </button>

                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>



                              <button class="btn btn-primary icon" type="button" title="Wishlist"
                                id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                              </button>

                            </ul>
                          </div>
                          <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                      </div>
                      <!-- /.product -->

                    </div>
                    <!-- /.products -->
                  </div>
                  <!-- /.item -->
                  @endforeach
                  <!--  // end all optionproduct foreach  -->




                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->






          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.scroll-tabs -->
        <!-- ============================================== SCROLL TABS : END ============================================== -->

        <!-- == === FEATURED PRODUCTS == ==== -->
        <section class="section featured-product wow fadeInUp">
          <h3 class="section-title">Featured products</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">


            @foreach($featured as $product)
            <div class="item item-carousel">
              <div class="products">
                <div class="product">
                  <div class="product-image">
                    <div class="image"> <a
                        href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img
                          src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                    <!-- /.image -->

                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    @endphp

                    <div>
                      @if ($product->discount_price == NULL)
                      <div class="tag new"><span>new</span></div>
                      @else
                      <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                      @endif
                    </div>
                  </div>

                  <!-- /.product-image -->

                  <div class="product-info text-left">
                    <h3 class="name"><a
                        href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                        {{ $product->product_name_en }}
                      </a></h3>
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
                    <div class="description"></div>

                    @if ($product->discount_price == NULL)
                    <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                    @else
                    <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span
                        class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                    @endif


                    <!-- /.product-price -->

                  </div>
                  <!-- /.product-info -->
                  <div class="cart clearfix animate-effect">
                    <div class="action">
                      <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">

                          <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal"
                            data-target="#exampleModal" id="{{ $product->id }}" onclick="productView(this.id)"> <i
                              class="fa fa-shopping-cart"></i> </button>

                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>



                        <button class="btn btn-primary icon" type="button" title="Wishlist" id="{{ $product->id }}"
                          onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i> </button>


                      </ul>
                    </div>
                    <!-- /.action -->
                  </div>
                  <!-- /.cart -->
                </div>
                <!-- /.product -->

              </div>
              <!-- /.products -->
            </div>
            <!-- /.item -->
            @endforeach


          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- == ==== FEATURED PRODUCTS : END ==== === -->

      </div>
      <!-- /.homebanner-holder -->
      <!-- ============================================== CONTENT : END ============================================== -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->


@endsection