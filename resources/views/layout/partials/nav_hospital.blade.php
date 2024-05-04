<!-- Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                @php
                    $hospital = \App\Models\Hospital::query()
                        ->where('id', auth()->user()->hospital_id)
                        ->first();
                @endphp
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <div class="widget-profile pro-widget-content">
                        <div class="profile-info-widget">
                            {{-- {{ $hospital->image }} --}}

                            <a href="#" class="booking-doc-img">
                                @if (auth()->user()->profile_image ?? '')
                                {{-- @if($hospital->image) --}}
                                    <img src="{{ asset(auth()->user()->profile_image) }}" alt="{{auth()->user()->name}}">
                                @else
                                    <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg') }}"
                                        alt="User Image">
                                @endif
                            </a>
                            <div class="profile-det-info">
                                <h3>{{ auth()->user()->name }}</h3>

                                <div class="patient-details">
                                    <h5 class="mb-0">{{ auth()->user()->address }}, {{ auth()->user()->state }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-widget">
                        <nav class="dashboard-menu">
                            <ul>
                                <li class="{{ Request::is('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">
                                        <i class="fas fa-columns"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('doctor.*') ? 'active' : '' }}">
                                    <a href="{{ route('doctor.index') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>My Doctors</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('insurances.*') ? 'active' : '' }}">
                                    <a href="{{ route('insurances.index') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Insurances</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('patient.*') ? 'active' : '' }}">
                                    <a href="{{ route('patient.index') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>My Patients</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('appointments') ? 'active' : '' }}">
                                    <a href="{{ route('appointments') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Appointments</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('blogs') ? 'active' : '' }}">
                                    <a href="{{ route('blogs') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Blogs</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('invoices') ? 'active' : '' }}">
                                    <a href="{{ route('invoices') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Invoices</span>
                                    </a>
                                </li>
                                <li class="{{ Request::routeIs('reviews') ? 'active' : '' }}">
                                    <a href="{{ route('reviews') }}">
                                        <i class="fas fa-star"></i>
                                        <span>Reviews</span>
                                    </a>
                                </li>
                                <!-- <li class="{{ Request::routeIs('schedule_settings') ? 'active' : '' }}">
                                    <a href="{{ route('schedule_settings') }}">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>Schedule Settings</span>
                                    </a>
                                </li> -->
                                {{--                <li> --}}
                                {{--                    <a href="{{url('appointments')}}"> --}}
                                {{--                        <i class="fas fa-calendar-check"></i> --}}
                                {{--                        <span>Appointments</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li class="{{ Request::routeIs('patient.*') ? 'active' : '' }}"> --}}
                                {{--                    <a href="{{ route('patient.index') }}"> --}}
                                {{--                        <i class="fas fa-user-injured"></i> --}}
                                {{--                        <span>My Patients</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('schedule-timings')}}"> --}}
                                {{--                        <i class="fas fa-hourglass-start"></i> --}}
                                {{--                        <span>Schedule Timings</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('available-timings')}}"> --}}
                                {{--                        <i class="fas fa-clock"></i> --}}
                                {{--                        <span>Available Timings</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('invoices')}}"> --}}
                                {{--                        <i class="fas fa-file-invoice"></i> --}}
                                {{--                        <span>Invoices</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('accounts')}}"> --}}
                                {{--                        <i class="fas fa-file-invoice-dollar"></i> --}}
                                {{--                        <span>Accounts</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('reviews')}}"> --}}
                                {{--                        <i class="fas fa-star"></i> --}}
                                {{--                        <span>Reviews</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                {{--                <li> --}}
                                {{--                    <a href="{{url('chat-doctor')}}"> --}}
                                {{--                        <i class="fas fa-comments"></i> --}}
                                {{--                        <span>Message</span> --}}
                                {{--                        <small class="unread-msg">23</small> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                <li class="{{ Request::routeIs('profile.*') ? 'active' : '' }}">
                                    <a href="{{ route('profile.index') }}">
                                        <i class="fas fa-user-cog"></i>
                                        <span>Profile Settings</span>
                                    </a>
                                </li>
                                {{--                <li> --}}
                                {{--                    <a href="{{url('social-media')}}"> --}}
                                {{--                        <i class="fas fa-share-alt"></i> --}}
                                {{--                        <span>Social Media</span> --}}
                                {{--                    </a> --}}
                                {{--                </li> --}}
                                <li class="{{ Request::routeIs('change_password') ? 'active' : '' }}">
                                    <a href="{{ route('change_password') }}">
                                        <i class="fas fa-lock"></i>
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="document.getElementById('formlogout').submit();" href="#">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>

                                    <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /Profile Sidebar -->
            </div>
