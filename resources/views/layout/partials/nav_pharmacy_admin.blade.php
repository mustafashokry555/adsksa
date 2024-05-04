<!-- Sidebar -->
<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="{{ Request::is('pharmacy-admin/index_pharmacy_admin') ? 'active' : '' }}"> 
								<a href="{{url('index_pharmacy_admin')}}"><i class="feather-home"></i> <span>Dashboard</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="feather-shopping-cart"></i> <span> Products</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('pharmacy-admin/products','pharmacy-admin/edit-product') ? 'active' : '' }}" href="{{ url('pharmacy-admin/products') }}">Products</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/add-product') ? 'active' : '' }}" href="{{ url('pharmacy-admin/add-product') }}">Add Product</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/outstock') ? 'active' : '' }}" href="{{ url('pharmacy-admin/outstock') }}">Out Stock</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/expired') ? 'active' : '' }}" href="{{ url('pharmacy-admin/expired') }}">Expired</a></li>
								</ul>
							</li>
							<li class="{{ Request::is('pharmacy-admin/categories') ? 'active' : '' }}"> 
								<a href="{{url('pharmacy-admin/categories')}}"><i class="feather-layout"></i> <span>Categories</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="feather-star"></i> <span> Purchase</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('pharmacy-admin/purchase','pharmacy-admin/edit-purchase') ? 'active' : '' }}" href="{{ url('pharmacy-admin/purchase') }}">Purchase</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/add-purchase') ? 'active' : '' }}" href="{{ url('pharmacy-admin/add-purchase') }}">Add Purchase</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/order') ? 'active' : '' }}" href="{{ url('pharmacy-admin/order') }}">Orders</a></li>
								</ul>
							</li>
							<li class="{{ Request::is('pharmacy-admin/sales') ? 'active' : '' }}"><a href="{{url('pharmacy-admin/sales')}}"><i class="feather-activity"></i> <span>Sales</span></a></li>
							<li class="submenu">
								<a href="#"><i class="feather-user"></i> <span> Supplier</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('pharmacy-admin/supplier','pharmacy-admin/edit-supplier') ? 'active' : '' }}" href="{{ url('pharmacy-admin/supplier') }}">Supplier</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/add-supplier') ? 'active' : '' }}" href="{{ url('pharmacy-admin/add-supplier') }}">Add Supplier</a></li>
								</ul>
							</li>
							<li class="{{ Request::is('pharmacy-admin/transactions-list') ? 'active' : '' }}"><a href="{{url('pharmacy-admin/transactions-list')}}"><i class="feather-credit-card"></i> <span>Transaction</span></a></li>
							<li class="submenu">
								<a href="#"><i class="feather-file-text"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="{{ Request::is('pharmacy-admin/invoice') ? 'active' : '' }}" href="{{ url('pharmacy-admin/invoice') }}">Invoice</a></li>
									<li><a class="{{ Request::is('pharmacy-admin/invoice-report') ? 'active' : '' }}" href="{{ url('pharmacy-admin/invoice-report') }}">Invoice Reports</a></li>
								</ul>
							</li>
							<li class="menu-title"> 
								<span>Pages</span>
							</li>
							<!-- <li class="{{ Request::is('pharmacy-admin/product-list') ? 'active' : '' }}">
							<a href="product-list"><i class="fe fe-layout"></i> <span>Product List</span></a>
							</li> -->
							<li class="{{ Request::is('pharmacy-admin/profile') ? 'active' : '' }}"> 
								<a href="{{url('pharmacy-admin/profile')}}"><i class="feather-user"></i> <span>Profile</span></a>
							</li>
							<li class="{{ Request::is('pharmacy-admin/settings') ? 'active' : '' }}"> 
								<a href="{{url('pharmacy-admin/settings')}}"><i class="feather-sliders"></i> <span>Settings</span></a>
							</li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->