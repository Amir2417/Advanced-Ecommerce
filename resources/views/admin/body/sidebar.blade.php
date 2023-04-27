<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ url('/admin/dashboard')}}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">

						  <h3><b>SkyLight</b> Shop</h3>
					 </div>
				</a>
			</div>
        </div>
      @php

        $prefix = Request::route()->getPrefix();
        $route = Route::current()->getName();

      @endphp
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ( $route == 'dashboard')?'active':''  }}">
          <a href="{{ url('admin/dashboard') }}">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>

        <li class="treeview {{ ($prefix == '/brand')?'active':''}}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Brands</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ( $route == 'all.brands')?'active':''  }}"><a href="{{ route('all.brands') }}"><i class="ti-more"></i>All Brands</a></li>

          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/category')?'active':''}}">
          <a href="#">
            <i data-feather="mail"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ( $route == 'all.category')?'active':''  }}"><a href="{{ route('all.category') }}"><i class="ti-more"></i>All Category</a></li>
            <li class="{{ ( $route == 'all.subcategory')?'active':''  }}"><a href="{{ route('all.subcategory')}}"><i class="ti-more"></i>SubCategory</a></li>
            <li class="{{ ( $route == 'all.subsubcategory')?'active':''  }}"><a href="{{ route('all.subsubcategory')}}"><i class="ti-more"></i>Sub SubCategory</a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ ($prefix == '/category')?'active':''}}">
            <li class="{{ ( $route == 'add-products')?'active':''  }}"><a href="{{ route('add-products')}}"><i class="ti-more"></i>Add Products</a></li>
            <li class="{{ ( $route == 'manage-products')?'active':''  }}"><a href="{{ route('manage-products')}}"><i class="ti-more"></i>Manage All Products</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
          <i data-feather="file"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ ($prefix == '/slider')?'active':''}}">
            <li class="{{ ( $route == 'manage-slider')?'active':''  }}"><a href="{{ route('manage-slider')}}"><i class="ti-more"></i>Slider</a></li>
          </ul>
        </li>
        {{-- Coupon --}}
        <li class="treeview">
          <a href="#">
          <i data-feather="file"></i>
            <span>Coupon</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ ($prefix == '/coupon')?'active':''}}">
            <li class="{{ ( $route == 'coupons')?'active':''  }}"><a href="{{ route('coupons')}}"><i class="ti-more"></i>Coupon Management</a></li>
            <li class="{{ ( $route == 'coupon.show')?'active':''  }}"><a href="{{ route('coupon.show')}}"><i class="ti-more"></i>Add Coupon</a></li>
          </ul>
        </li>
        {{-- Shipping --}}
        <li class="treeview">
          <a href="#">
          <i data-feather="file"></i>
            <span>Shipping Area </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ ($prefix == '/shipping')?'active':''}}">
            <li class="{{ ( $route == 'division_management')?'active':''  }}"><a href="{{ route('division_management')}}"><i class="ti-more"></i>Ship Division</a></li>
            <li class="{{ ( $route == 'district_management')?'active':''  }}"><a href="{{ route('district_management')}}"><i class="ti-more"></i>Ship District</a></li>
            <li class="{{ ( $route == 'state_management')?'active':''  }}"><a href="{{ route('state_management')}}"><i class="ti-more"></i>Ship State</a></li>

          </ul>
        </li>

        <li class="header nav-small-cap">Order</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu {{ ($prefix == '/orders')?'active':''}}">
            <li class="{{ ( $route == 'admin.pending.orders')?'active':''  }}"><a href="{{ route('admin.pending.orders') }}"><i class="ti-more"></i>Pending Orders</a></li>
            <li class="{{ ( $route == 'admin.confirm.orders')?'active':''  }}"><a href="{{ route('admin.confirm.orders') }}"><i class="ti-more"></i>Confirm Orders</a></li>
            <li class="{{ ( $route == 'admin.processing.orders')?'active':''  }}"><a href="{{ route('admin.processing.orders') }}"><i class="ti-more"></i>Processing Orders</a></li>
            <li class="{{ ( $route == 'admin.picked.orders')?'active':''  }}"><a href="{{ route('admin.picked.orders') }}"><i class="ti-more"></i>Picked Orders</a></li>
            <li class="{{ ( $route == 'admin.shipped.orders')?'active':''  }}"><a href="{{ route('admin.shipped.orders') }}"><i class="ti-more"></i>Shipped Orders</a></li>
            <li class="{{ ( $route == 'admin.delivered.orders')?'active':''  }}"><a href="{{ route('admin.delivered.orders') }}"><i class="ti-more"></i>Delivered Orders</a></li>
            <li class="{{ ( $route == 'admin.cancel.orders')?'active':''  }}"><a href="{{ route('admin.cancel.orders') }}"><i class="ti-more"></i>Cancel Orders</a></li>

          </ul>
        </li>

        <li class="treeview">
              <a href="#">
                <i data-feather="credit-card"></i>
                <span>Total Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
                <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
                <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
              </ul>
        </li>



      </ul>
    </section>
{{-- End Section  --}}
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>



