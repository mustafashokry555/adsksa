<div>
    @php use Illuminate\Support\Facades\Request; @endphp
    <div>
        <header class="header">
            <div class="nav-bg home-four-nav">
                <nav class="navbar navbar-expand-lg header-nav nav-transparent">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
									<span class="bar-icon blue-bar">
										<span></span>
										<span></span>
										<span></span>
									</span>
                        </a>
                        @auth
                            <a href="{{ route('home') }}" class="navbar-brand logo">
                                <img src="{{ URL::asset('/assets/img/logo-one.png')}}" class="img-fluid" alt="Logo">
                            </a>
                        @else
                            <a href="/" class="navbar-brand logo">
                                <img src="{{ URL::asset('/assets/img/logo-one.png')}}" class="img-fluid" alt="Logo">
                            </a>
                        @endauth
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            @auth
                                <a href="{{ route('home') }}" class="menu-logo">
                                    <img src="{{ URL::asset('/assets/img/logo-one.png')}}" class="img-fluid"
                                         alt="Logo">
                                </a>
                            @else
                                <a href="{{ url('/') }}" class="menu-logo">
                                    <img src="{{ URL::asset('/assets/img/logo-one.png')}}" class="img-fluid"
                                         alt="Logo">
                                </a>
                            @endauth
                            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                    class="fas fa-times"></i>
                            </a>
                        </div>
                        @auth
                            <li class="nav-item dropdown has-arrow logged-item">
                                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
					                    <span class="user-img">
                                            @if(auth()->user()->profile_image ?? '')
                                                <img class="rounded-circle"
                                                     src="{{ asset(auth()->user()->profile_image) }}"
                                                     width="31"
                                                     alt="Ryan Taylor">
                                            @else
                                                <img src="{{ URL::asset('/assets/img/patients/patient.jpg')}}"
                                                     alt="User Image"
                                                     class="avatar-img rounded-circle">
                                            @endif
					                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style="z-index: 9999;">
                                    <div class="user-header">
                                        <div class="avatar avatar-sm">
                                            @if(auth()->user()->profile_image ?? '')
                                                <img
                                                    src="{{ asset(auth()->user()->profile_image) }}"
                                                    alt="User Image"
                                                    class="avatar-img rounded-circle">
                                            @else
                                                <img src="{{ URL::asset('/assets/img/patients/patient.jpg')}}"
                                                     alt="User Image"
                                                     class="avatar-img rounded-circle">
                                            @endif
                                        </div>
                                        <div class="user-text">
                                            <h6>{{ auth()->user()->name }}</h6>
                                            <p class="text-muted mb-0">{{ auth()->user()->username }}</p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="{{url('patient-dashboard')}}">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                    <a
                                        onclick="document.getElementById('formlogout').submit();"
                                        class="dropdown-item"
                                        href="#"
                                    >
                                        Logout
                                    </a>
                                    <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <ul class="nav header-navbar-rht right-menu">
                                <li class="nav-item">
                                    <a class="nav-link theme-btn btn-four" href="{{url('login')}}">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link theme-btn btn-four-light" href="{{url('register')}}">Sign
                                        Up</a>
                                </li>
                            </ul>
                        @endauth

                    </div>
                </nav>
            </div>
        </header>
    </div>

</div>
