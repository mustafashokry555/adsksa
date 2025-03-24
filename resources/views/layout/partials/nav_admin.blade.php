<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>{{ __('admin.sidebar.main') }}</span>
                </li>
                <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><i class="feather-grid"></i>
                        <span>{{ __('admin.sidebar.dashboard') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('speciality.*') ? 'active' : '' }}">
                    <a href="{{ route('speciality.index') }}"><i class="feather-package"></i>
                        <span>{{ __('admin.sidebar.specialities') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('insurances.*') ? 'active' : '' }}">
                    <a href="{{ route('insurances.index') }}"><i class="feather-package"></i>
                        <span>{{ __('admin.sidebar.insurances') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('hospital.*') ? 'active' : '' }}">
                    <a href="{{ route('hospital.index') }}"><i class="feather-home"></i>
                        <span>{{ __('admin.sidebar.hospitals') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('offers.*') ? 'active' : '' }}">
                    <a href="{{ route('offers.index') }}"><i class="feather-gift"></i> <span>Offers</span></a>
                </li>
                @if (auth()->user()->is_admin())
                    <li class="{{ Request::routeIs('hospital-types.*') ? 'active' : '' }}">
                        <a href="{{ route('hospital-types.index') }}"><i class="feather-list"></i> <span>Hospital Types</span></a>
                    </li>
                    <li class="{{ Request::routeIs('religions.*') ? 'active' : '' }}">
                        <a href="{{ route('religions.index') }}"><i class="feather-book"></i> <span>Religions</span></a>
                    </li>
                @endif
                <li class="{{ Request::routeIs('doctor.*') ? 'active' : '' }}">
                    <a href="{{ route('doctor.index') }}"><i class="feather-user-plus"></i>
                        <span>{{ __('admin.sidebar.doctors') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('patient.*') ? 'active' : '' }}">
                    <a href="{{ route('patient.index') }}"><i class="feather-users"></i>
                        <span>{{ __('admin.sidebar.patients') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('countries.*') ? 'active' : '' }}">
                    <a href="{{ route('countries.index') }}"><i class="feather-flag"></i> <span>Countries</span></a>
                </li>
                <li class="{{ Request::routeIs('cities.*') ? 'active' : '' }}">
                    <a href="{{ route('cities.index') }}"><i class="feather-map"></i> <span>Cities</span></a>
                </li>
                <li class="{{ Request::routeIs('areas.*') ? 'active' : '' }}">
                    <a href="{{ route('areas.index') }}"><i class="feather-map-pin"></i> <span>Areas</span></a>
                </li>
                <li class="{{ Request::routeIs('banner.*') ? 'active' : '' }}">
                    <a href="{{ route('banner.index') }}"><i class="feather-bookmark"></i> <span>Banners</span></a>
                </li>
                <li class="{{ Request::routeIs('appointments') ? 'active' : '' }}">
                    <a href="{{ route('appointments') }}"><i class="feather-calendar"></i>
                        <span>{{ __('admin.sidebar.appointments') }}</span></a>
                </li>
                {{-- <li class="{{ Request::routeIs('blogs') ? 'active' : '' }}">
                    <a href="{{ route('blogs') }}"><i class="feather-grid"></i> <span>{{ __('admin.sidebar.blogs')  }}</span></a>
                </li> --}}
                <li class="{{ Request::routeIs('invoices') ? 'active' : '' }}">
                    <a href="{{ route('invoices') }}"><i class="feather-users"></i>
                        <span>{{ __('admin.sidebar.invoices') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="feather-users"></i>
                        <span>{{ __('admin.sidebar.settings') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('newsletters') ? 'active' : '' }}">
                    <a href="{{ route('newsletters') }}"><i class="feather-users"></i>
                        <span>{{ __('admin.sidebar.newsletters') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('reviews') ? 'active' : '' }}">
                    <a href="{{ route('reviews') }}"><i class="feather-star"></i>
                        <span>{{ __('admin.sidebar.reviews') }}</span></a>
                </li>
                {{--                            <li class="{{ Request::is('admin/appointment-list','admin/past-appointments','admin/upcoming-appointments') ? 'active' : '' }}"> --}}
                {{--                                <a href="{{url('admin/upcoming-appointments')}}"><i class="feather-calendar"></i> <span>Appointments</span></a> --}}
                {{--                            </li> --}}
                {{--							<li  class="{{ Request::is('admin/transaction') ? 'active' : '' }}"> --}}
                {{--								<a href="{{url('admin/transaction')}}"><i class="feather-credit-card"></i> <span>Transactions</span></a> --}}
                {{--							</li> --}}
                <li
                    class="submenu {{ Request::is('admin/appointment-report', 'admin/income-report', 'admin/invoice-report', 'admin/user-reports') ? 'active' : '' }}">
                    <a href="#"><i class="feather-file-text"></i> <span> {{ __('admin.sidebar.reports') }}</span>
                        <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('appointment_reports') ? 'active' : '' }}"
                                href="{{ route('appointment_reports') }}">{{ __('admin.sidebar.appointment_report') }}</a>
                        </li>
                        <li><a class="{{ Request::routeIs('income_reports') ? 'active' : '' }}"
                                href="{{ route('income_reports') }}">{{ __('admin.sidebar.income_report') }}</a></li>
                        <li><a class="{{ Request::routeIs('invoice_reports') ? 'active' : '' }}"
                                href="{{ route('invoice_reports') }}">{{ __('admin.sidebar.invoice_reports') }}</a>
                        </li>
                        <li><a class="{{ Request::routeIs('user_reports') ? 'active' : '' }}"
                                href="{{ route('user_reports') }}">{{ __('admin.sidebar.user_reports') }}</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('admin.sidebar.pharmacy') }}</span>
                </li>
                <li class="submenu {{ Request::is('admin/pharmacy-list', 'admin/pharmacy-category') ? 'active' : '' }}">
                    <a href="#"><i class="feather-file-plus"></i> <span>
                            {{ __('admin.sidebar.pharmacies') }}</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/pharmacy-list') ? 'active' : '' }}"
                                href="{{ url('admin/pharmacy-list') }}">{{ __('admin.sidebar.all_pharmacies') }}</a>
                        </li>
                        <li><a class="{{ Request::is('admin/pharmacy-category') ? 'active' : '' }}"
                                href="{{ url('admin/pharmacy-category') }}">{{ __('admin.sidebar.caategories') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="submenu {{ Request::is('admin/product-list', 'admin/product-category') ? 'active' : '' }}">
                    <a href="#"><i class="feather-shopping-cart"></i> <span>
                            {{ __('admin.sidebar.product_list') }}</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a class="{{ Request::is('admin/product-list') ? 'active' : '' }}"
                                href="{{ url('admin/product-list') }}">{{ __('admin.sidebar.all_products') }}</a></li>
                        <li><a class="{{ Request::is('admin/product-category') ? 'active' : '' }}"
                                href="{{ url('admin/product-category') }}">{{ __('admin.sidebar.categories') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('admin.sidebar.blog') }}</span>
                </li>
                <li
                    class="submenu {{ Request::is('admin/blog', 'admin/active-blog', 'admin/add-blog', 'admin/edit-blog', 'admin/blog-details', 'admin/pending-blog') ? 'active' : '' }}">
                    <a href="#"><i class="feather-grid"></i> <span> {{ __('admin.sidebar.blog') }} </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a class="{{ Request::is('admin/blog', 'admin/active-blog', 'admin/pending-blog') ? 'active' : '' }}"
                                href="{{ url('/blogs') }}"> {{ __('admin.sidebar.blogs') }} </a>
                        </li>
                        <!--  -->
                        <li><a class="{{ Request::is('admin/add-blog') ? 'active' : '' }}"
                                href="{{ url('blogs/create-blog') }}"> {{ __('admin.sidebar.add_blog') }} </a></li>

                    </ul>
                </li>
                <li class="menu-title">
                    <span>{{ __('admin.sidebar.pages') }}</span>
                </li>
                <li class="{{ Request::routeIs('profile.*') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}"><i class="feather-user"></i>
                        <span>{{ __('admin.sidebar.profile') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('contactus-list.*') ? 'active' : '' }}">
                    <a href="{{ route('contactuslist') }}"><i class="feather-user"></i>
                        <span>{{ __('admin.sidebar.contact_us') }}</span></a>
                </li>
                <li class="{{ Request::routeIs('change_password') ? 'active' : '' }}">
                    <a href="{{ route('change_password') }}"><i class="feather-lock"></i>
                        <span>{{ __('admin.sidebar.change_password') }}</span></a>
                </li>

            </ul>
            </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
