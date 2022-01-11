<header class="main-header">



  <!-- nav bar-->

  <!-- ============================================== NAVBAR ============================================== -->
  <div class="navbar shadow-5-strong" role="navigation">
    <div class="navbar-header">
      <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed"
        type="button">
        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
        <span class="icon-bar"></span> </button>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6">

          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }} dropdown yamm-fw"> <a href="{{ url('/') }}"> Home </a>
                </li>

                <!--   // Get Category Table Data -->
                @php
                $categories = App\Models\Category::orderBy('category_name_en','ASC')->get();
                @endphp


                @foreach($categories as $category)
                <li class="dropdown yamm mega-menu"> <a href="" data-hover="dropdown" class="dropdown-toggle"
                    data-toggle="dropdown">
                    {{$category->category_name_en }} 
                  </a>
                  <ul class="dropdown-menu container">
                    <li>
                      <div class="yamm-content">
                        <div class="row">

                          <!--   // Get SubCategory Table Data -->
                          @php
                          $subcategories =
                          App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name_en','ASC')->get();
                          @endphp
                          <ul>
                            @forelse($subcategories as $subcategory)
                            <li>
                              <a
                                href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                                <h2 class="title">
                                   {{ $subcategory->subcategory_name_en }}
                                </h2>
                              </a>
                            </li>
                            @empty
                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                              <a href="{{ url('category/product/'.$category->id ) }}">
                                <h2 class="title">
                                  {{ $category->category_name_en}}
                                </h2>
                              </a>
                              @endforelse
                              <!-- // End SubCategory Foreach -->


                              <!-- /.yamm-content -->
                            </div>
                        </div>
                    </li>
                  </ul>
                </li>
                @endforeach
                <!-- // End Category Foreach -->
                <li> <a href="{{ route('shop.page') }}">Shop</a> </li>
                <!-- links for guest or auth user -->
                @auth
                <li class="dropdown yamm mega-menu"> <a href="" data-hover="dropdown" class="dropdown-toggle"
                    data-toggle="dropdown">
                    {{Auth::user()->name}}
                  </a>
                  <ul class="dropdown-menu container">
                    <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                    <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>Checkout</a></li>

                    <li><a href="{{ route('order.tracking') }}" type="button"><i class="icon fa fa-check"></i>Order
                        Traking</a></li>

                    <li>
                      <a href="{{ route('user.profile') }}"><i class="icon fa fa-user"></i>User Profile</a>



                    </li>
                  </ul>
                </li>
                @else
                <li> <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Login/Register</a></li>
                @endauth

              </ul>



              </ul>
              <!-- /.navbar-nav -->

            </div>
            <!-- /.nav-outer -->
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.nav col -->
        <div class="col-xs-12 col-sm-12 col-md-4 top-search-holder">
          <!-- /.contact-row -->
          <!-- ============================================================= SEARCH AREA ============================================================= -->
          <div class="search-area">
            <form method="post" action="{{ route('product.search') }}">
              @csrf
              <div class="control-group">
                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" id="search"
                  name="search" placeholder="Search here..." />
                <button class="search-button" type="submit"></button>
              </div>
            </form>
            <div id="searchProducts"></div>
          </div>
          <!-- /.search-area -->
          <!-- ============================================================= SEARCH AREA : END ============================================================= -->
        </div>
        <!-- /.top-search-holder -->



        <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">


          <!-- ===== === SHOPPING CART DROPDOWN ===== == -->

          <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
              <div class="items-cart-inner">
                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                <div class="total-price-basket"> <span class="lbl">cart -</span>
                  <span class="total-price"> <span class="sign">$</span>
                    <span class="value" id="cartSubTotal"> </span> </span>
                </div>
              </div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!--   // Mini Cart Start with Ajax -->

                <div id="miniCart">

                </div>

                <!--   // End Mini Cart Start with Ajax -->

              </li>
            </ul>
            <!-- /.dropdown-menu-->
          </div>
          <!-- /.dropdown-cart -->

          <!-- == === SHOPPING CART DROPDOWN : END=== === -->
        </div>
        <!-- /.container -->
      </div>
      <!-- /.navbar-default -->


      <!-- ============================================== NAVBAR : END ============================================== -->


    </div>

    <!-- /.top-cart-row -->
  </div>
  <!-- /.row -->






</header>


<style>
  .navbar-nav>li>a {
    color: white;
    font-size: 15px;
    font-weight: 900;
  }

  .search-area {
    position: relative;
  }

  #searchProducts {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: #ffffff;
    z-index: 999;
    border-radius: 8px;
    margin-top: 5px;
  }
</style>


<script>
  function search_result_hide() {
    $("#searchProducts").slideUp();
  }

  function search_result_show() {
    $("#searchProducts").slideDown();
  }


</script>