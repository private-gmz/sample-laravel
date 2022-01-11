<form action="{{ route('shop.filter') }}" id='filter-form' method="post">
  @csrf



  <div class='row'>
    <div class='col-md-3 sidebar'>
      <div class="sidebar-module-container">
        <div class="sidebar-filter">
          <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
          <div class="sidebar-widget wow fadeInUp">
            <h3 class="section-title">shop by</h3>
            <div class="widget-header">
              <h4 class="widget-title">Category</h4>
            </div>
            <div class="sidebar-widget-body">
              <div class="accordion">

                @if(!empty($_GET['category']))
                @php
                $filterCat = explode(',',$_GET['category']);
                @endphp
                @endif



                @foreach($categories as $category)
                <div class="accordion-group">
                  <div class="accordion-heading">

                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="category[]"
                        value="{{ $category->category_slug_en }}" @if(!empty($filterCat) &&
                        in_array($category->category_slug_en,$filterCat)) checked @endif">

                      {{ $category->category_name_en }}

                    </label>


                  </div>
                  <!-- /.accordion-heading -->


                </div>
                <!-- /.accordion-group -->
                @endforeach

              </div>
              <!-- /.accordion -->
            </div>
            <!-- /.sidebar-widget-body -->

            <!-- /.sidebar-widget -->





            <!-- /.sidebar-widget-body -->
          </div>
          <!-- /.sidebar-widget -->
          @foreach($attributes as $attribute)
          <div class="sidebar-widget">
            <div class="widget-header">
              <h4 class="widget-title">{{$attribute->name}}</h4>
            </div>
            <div>
              <select class='select mltislct' name='attributes[]' data-mdb-placeholder="Example placeholder" multiple>
                @foreach($attribute->values as $val)
                <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          @endforeach
          <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

          <!-- ============================================== PRICE SILDER============================================== -->
          <div class="sidebar-widget wow fadeInUp">
            <div class="widget-header">
              <h4 class="widget-title">Price Slider</h4>
            </div>
            <div class="sidebar-widget-body m-t-10">
              <div class="price-range-holder"> <span class="min-max"> <span class="pull-left"></span> <span
                    class="pull-right"></span> </span>

                <input type="text" class="price-slider" value="" name="price">
              </div>
              <!-- /.price-range-holder -->
              <input type="submit" class="lnk btn btn-primary" value="Show Now">
            </div>
            <!-- /.sidebar-widget-body -->
          </div>
          <!-- /.sidebar-widget -->
</form>
<!-- ============================================== PRICE SILDER : END ============================================== -->

</div>
<!-- /.sidebar-filter -->
</div>
<!-- /.sidebar-module-container -->
</div>
<!-- /.sidebar -->