@extends('frontend.main_master')
@section('content')
@section('title')
Subcategory Product
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



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
              <div class="row" id="grid_view_product">


                @include('frontend.product.grid_view_product')



              </div>
              <!-- /.row -->
            </div>
            <!-- /.category-product -->

          </div>
          <!-- /.tab-pane -->

          <!--            //////////////////// END Product Grid View  ////////////// -->




          <!--            //////////////////// Product List View Start ////////////// -->



          <div class="tab-pane " id="list-container">
            <div class="category-product" id="list_view_product">



              @include('frontend.product.list_view_product')



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




    <div class="ajax-loadmore-product text-center" style="display: none;">
      <img src="{{ asset('frontend/assets/images/loader.svg') }}" style="width: 120px; height: 120px;">

    </div>






  </div>
  <!-- /.row -->
  <!-- ============================================== BRANDS CAROUSEL ============================================== -->
  <div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
      <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
        <div class="item m-t-15"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item m-t-10"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->

        <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
              src="assets/images/blank.gif" alt=""> </a> </div>
        <!--/.item-->
      </div>
      <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

  </div>
  <!-- /.logo-slider -->
  <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
</div>
<!-- /.container -->

</div>
<!-- /.body-content -->


<script>
  function loadmoreProduct(page) {
    $.ajax({
      type: "get",
      url: "?page=" + page,
      beforeSend: function (response) {

        $('.ajax-loadmore-product').show();
      }

    })


      .done(function (data) {
        if (data.grid_view == " " || data.list_view == " ") {
          return;
        }
        $('.ajax-loadmore-product').hide();

        $('#grid_view_product').append(data.grid_view);
        $('#list_view_product').append(data.list_view);
      })

      .fail(function () {
        alert('Something Went Wrong');
      })

  }


  var page = 1;
  $(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
      page++;
      loadmoreProduct(page);
    }

  });



</script>





@endsection