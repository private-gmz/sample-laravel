@extends('frontend.main_master')
@section('content')
@section('title')
Shop Page
@endsection


<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Shop Page</a></li>

      </ul>
    </div>
    <!-- /.breadcrumb-inner -->
  </div>
  <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <!-- sidebar_filter -->
    @include('frontend.common.sidebar_filter')

    <div class='col-md-9'>



      <!-- == ==== SECTION – HERO === ====== -->



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



        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}


      </div>
      <!-- /.search-result-container -->

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->





</div>
<!-- /.container -->

</div>
<!-- /.body-content -->








@endsection