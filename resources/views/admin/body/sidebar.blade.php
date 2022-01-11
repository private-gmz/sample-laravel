@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp


<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="{{ ($route == 'dashboard')? 'active':'' }}" style = "background: linear-gradient(45deg , #26af8f, #442866);">
        <a href="{{ url('admin/dashboard') }}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @can('category')
      <li class="treeview {{ ($prefix == '/category')?'active':'' }}  ">
        <a href="#">
          <i data-feather="mail"></i> <span>Category </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category') }}"><i
                class="ti-more"></i>All Category</a></li>
          <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory') }}"><i
                class="ti-more"></i>All SubCategory</a></li>


        </ul>
      </li>
      @endif

      @can('product')

      <li class="treeview {{ ($prefix == '/product')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'add-product')? 'active':'' }}"><a href="{{ route('add-product') }}"><i
                class="ti-more"></i>Add Products</a></li>

          <li class="{{ ($route == 'manage-product')? 'active':'' }}"><a href="{{ route('manage-product') }}"><i
                class="ti-more"></i>Manage Products</a></li>

        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/Attributes')?'active':'' }}  ">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Attributes</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.attribites')? 'active':'' }}">
            <a href="{{ route('all.attribites') }}"><i class="ti-more"></i>Manage Attribites</a>
          </li>
          <li class="{{ ($route == 'all.values')? 'active':'' }}">
            <a href="{{ route('all.values') }}"><i class="ti-more"></i>Manage Values</a>
          </li>
        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/review')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Review</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'pending.review')? 'active':'' }}"><a href="{{ route('pending.review') }}"><i
                class="ti-more"></i>Pending Review</a></li>

          <li class="{{ ($route == 'publish.review')? 'active':'' }}"><a href="{{ route('publish.review') }}"><i
                class="ti-more"></i>Publish Review</a></li>


        </ul>
      </li>
      @endif

      @can('site')


      <li class="treeview {{ ($prefix == '/slider')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-slider')? 'active':'' }}"><a href="{{ route('manage-slider') }}"><i
                class="ti-more"></i>Manage Slider</a></li>



        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/setting')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'site.setting')? 'active':'' }}"><a href="{{ route('site.setting') }}"><i
                class="ti-more"></i>Site Setting</a></li>

          <li class="{{ ($route == 'seo.setting')? 'active':'' }}"><a href="{{ route('seo.setting') }}"><i
                class="ti-more"></i>Seo Setting</a></li>


        </ul>
      </li>

      @endif

      @can('shipping')


      <li class="treeview {{ ($prefix == '/shipping')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Shipping Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-city')? 'active':'' }}"><a href="{{ route('manage-city') }}"><i
                class="ti-more"></i>Ship City</a></li>

          <li class="{{ ($route == 'manage-district')? 'active':'' }}"><a href="{{ route('manage-district') }}"><i
                class="ti-more"></i>Ship District</a></li>



        </ul>
      </li>
      @endif


      @can('orders')

      <li class="treeview {{ ($prefix == '/orders')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Orders </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'pending-orders')? 'active':'' }}"><a href="{{ route('pending-orders') }}"><i
                class="ti-more"></i>Pending Orders</a></li>

          <li class="{{ ($route == 'confirmed-orders')? 'active':'' }}"><a href="{{ route('confirmed-orders') }}"><i
                class="ti-more"></i>Confirmed Orders</a></li>

          <li class="{{ ($route == 'processing-orders')? 'active':'' }}"><a href="{{ route('processing-orders') }}"><i
                class="ti-more"></i>Processing Orders</a></li>

          <li class="{{ ($route == 'picked-orders')? 'active':'' }}"><a href="{{ route('picked-orders') }}"><i
                class="ti-more"></i> Picked Orders</a></li>

          <li class="{{ ($route == 'shipped-orders')? 'active':'' }}"><a href="{{ route('shipped-orders') }}"><i
                class="ti-more"></i> Shipped Orders</a></li>

          <li class="{{ ($route == 'delivered-orders')? 'active':'' }}"><a href="{{ route('delivered-orders') }}"><i
                class="ti-more"></i> Delivered Orders</a></li>

          <li class="{{ ($route == 'cancel-orders')? 'active':'' }}"><a href="{{ route('cancel-orders') }}"><i
                class="ti-more"></i> Cancel Orders</a></li>



        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/return')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Return Order</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'return.request')? 'active':'' }}"><a href="{{ route('return.request') }}"><i
                class="ti-more"></i>Return Request</a></li>

          <li class="{{ ($route == 'all.request')? 'active':'' }}"><a href="{{ route('all.request') }}"><i
                class="ti-more"></i>All Request</a></li>


        </ul>
      </li>

      @endif


      @can('stock')


      <li class="treeview {{ ($prefix == '/stock')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Manage Stock </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'product.stock')? 'active':'' }}"><a href="{{ route('product.stock') }}"><i
                class="ti-more"></i>Product Stock</a></li>


        </ul>
      </li>


      <li class="treeview {{ ($prefix == '/reports')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>All Reports </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-reports')? 'active':'' }}"><a href="{{ route('all-reports') }}"><i
                class="ti-more"></i>All Reports</a></li>


        </ul>
      </li>

      <li class="treeview {{ ($prefix == '/coupons')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'manage-coupon')? 'active':'' }}"><a href="{{ route('manage-coupon') }}"><i
                class="ti-more"></i>Manage Coupon</a></li>



        </ul>
      </li>
      @endif




      @can('master')
      <li class="treeview {{ ($prefix == '/Roles')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Roles</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.roles')? 'active':'' }}">
            <a href="{{ route('all.roles') }}"><i class="ti-more"></i>Manage Roles</a>
          </li>
          <li class="{{ ($route == 'all.permissions')? 'active':'' }}">
            <a href="#"><i class="ti-more"></i>Manage Permissions</a>
          </li>
        </ul>
      </li>


      <li class="treeview {{ ($prefix == '/alluser')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>All Users </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all-users')? 'active':'' }}"><a href="{{ route('all-users') }}"><i
                class="ti-more"></i>All Users</a></li>


        </ul>
      </li>


      <li class="treeview {{ ($prefix == '/adminuserrole')?'active':'' }}  ">
        <a href="#">
          <i data-feather="file"></i>
          <span>Admin User Role </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ ($route == 'all.admin.user')? 'active':'' }}"><a href="{{ route('all.admin.user') }}"><i
                class="ti-more"></i>All Admin User </a></li>


        </ul>
      </li>

      @endif


    </ul>
  </section>
</aside>