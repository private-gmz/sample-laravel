@extends('frontend.main_master')
@section('content')
@section('title')
Tag Wise Product
@endsection


<div class="body-content outer-top-xs">
  <div class='container'>
    @include('frontend.common.sidebar_filter')
    <div class='col-md-9'>



      <div class="clearfix filters-container m-t-10">
        <div class="row">
          <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
              <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                      class="icon fa fa-th-large"></i>Grid</a> </li>
                <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
              </ul>
            </div>
            <!-- /.filter-tabs -->
          </div>
          <!-- /.col -->

          <div class="col col-sm-6 col-md-4 text-right">

            <!-- /.pagination-container -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>


      <!--    //////////////////// START Product Grid View  ////////////// -->

      <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
          <div class="tab-pane active " id="grid-container">
            <div class="category-product">
              <div class="row">



                @foreach($products as $product)
                <div class="col-sm-6 col-md-4 wow fadeInUp">
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
                            @if(session()->get('language') == 'hindi') {{ $product->product_name_hin }} @else {{
                            $product->product_name_en }} @endif</a></h3>
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
                            <li>
                              <button class="btn btn-primary icon" type="button" title="Wishlist"
                                id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i class="fa fa-heart"></i>
                              </button>
                            </li>
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
              <!-- /.row -->
            </div>
            <!-- /.category-product -->

          </div>
          <!-- /.tab-pane -->

          <!--            //////////////////// END Product Grid View  ////////////// -->




          <!--            //////////////////// Product List View Start ////////////// -->



          <div class="tab-pane " id="list-container">
            <div class="category-product">



              @foreach($products as $product)
              <div class="category-product-inner wow fadeInUp">
                <div class="products">
                  <div class="product-list product">
                    <div class="row product-list-row">
                      <div class="col col-sm-4 col-lg-4">
                        <div class="product-image">
                          <div class="image"> <img src="{{ asset($product->product_thambnail) }}" alt=""> </div>
                        </div>
                        <!-- /.product-image -->
                      </div>
                      <!-- /.col -->
                      <div class="col col-sm-8 col-lg-8">
                        <div class="product-info">
                          <h3 class="name"><a
                              href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                              @if(session()->get('language') == 'hindi') {{ $product->product_name_hin }} @else {{
                              $product->product_name_en }} @endif</a></h3>
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


                          @if ($product->discount_price == NULL)
                          <div class="product-price"> <span class="price"> ${{ $product->selling_price }} </span> </div>
                          @else
                          <div class="product-price"> <span class="price"> ${{ $product->discount_price }} </span> <span
                              class="price-before-discount">$ {{ $product->selling_price }}</span> </div>
                          @endif

                          <!-- /.product-price -->
                          <div class="description m-t-10">
                            @if(session()->get('language') == 'hindi') {{ $product->short_descp_hin }} @else {{
                            $product->short_descp_en }} @endif</div>
                          <div class="cart clearfix animate-effect">
                            <div class="action">
                              <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                  <button class="btn btn-primary icon" type="button" title="Add Cart"
                                    data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}"
                                    onclick="productView(this.id)"> <i class="fa fa-shopping-cart"></i> </button>
                                  <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                </li>
                                <li>
                                  <button class="btn btn-primary icon" type="button" title="Wishlist"
                                    id="{{ $product->id }}" onclick="addToWishList(this.id)"> <i
                                      class="fa fa-heart"></i> </button>
                                </li>
                              </ul>
                            </div>
                            <!-- /.action -->
                          </div>
                          <!-- /.cart -->

                        </div>
                        <!-- /.product-info -->
                      </div>
                      <!-- /.col -->
                    </div>



                    @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price) * 100;
                    @endphp

                    <!-- /.product-list-row -->
                    <div>
                      @if ($product->discount_price == NULL)
                      <div class="tag new"><span>new</span></div>
                      @else
                      <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                      @endif
                    </div>



                  </div>
                  <!-- /.product-list -->
                </div>
                <!-- /.products -->
              </div>
              <!-- /.category-product-inner -->
              @endforeach



              <!--            //////////////////// Product List View END ////////////// -->








            </div>
            <!-- /.category-product -->
          </div>
          <!-- /.tab-pane #list-container -->
        </div>
        <!-- /.tab-content -->
        <div class="clearfix filters-container">
          <div class="text-right">
            <div class="pagination-container">
              <ul class="list-inline list-unstyled">
                {{ $products->links() }}
              </ul>
              <!-- /.list-inline -->
            </div>
            <!-- /.pagination-container -->
          </div>
          <!-- /.text-right -->

        </div>
        <!-- /.filters-container -->

      </div>
      <!-- /.search-result-container -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


  <!-- /.container -->

</div>
<!-- /.body-content -->






















@endsection