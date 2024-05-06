@php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Facades\Auth;

    $setting = \App\Models\Settings::query()->first();

    $notifications = [];
    if (Auth::check()) {
        $notifications = \App\Models\Notification::query()
            ->where('to_id', Auth::user()->id)
            ->where('isRead', 1)
            ->get();
    }
@endphp


<div class="main-wrapper">
    <!-- Home Banner -->
    <section class="home-four-banner" style="overflow: visible">
        <!--Top Header -->
        <div class="home-four-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-top aos" data-aos="fade-up">
                            <ul>
                                @if ($setting->phone ?? '')
                                    <li><i class="feather-phone me-1"></i> {{ $setting->phone }}</li>
                                @else
                                    <li><i class="feather-phone me-1"></i></li>
                                @endif
                                @if ($setting->email ?? '')
                                    <li><i class="feather-mail me-1"></i>{{ $setting->email }}</li>
                                @else
                                    <li><i class="feather-mail me-1"></i></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="right-top aos" data-aos="fade-up">
                            <ul>
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                            class="fab fa-facebook hi-icon"></i></a></li>
                                <li><a href="{{ $setting->linkedin }}" target="_blank"><i
                                            class="fab fa-linkedin hi-icon"></i></a></li>
                                {{--                                <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram hi-icon"></i></a></li> --}}
                                <li><a href="{{ $setting->twitter }}" target="_blank"><i
                                            class="fab fa-twitter hi-icon"></i></a></li>
                                <li><a href="{{ $setting->youtube }}" target="_blank"><i
                                            class="fab fa-youtube hi-icon"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Top Header -->
        <div class="container">
            <header class="header">
                <div class="nav-bg home-four-nav">
                    <nav style="justify-content: space-between"
                        class="navbar navbar-expand-lg header-nav nav-transparent">
                        <div class="navbar-header">
                            <a id="mobile_btn" href="javascript:void(0);">
                                <span class="bar-icon blue-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            @auth
                                <a href="{{ url('/') }}" class="navbar-brand logo">
                                    <img src="{{ asset('/assets/img/logo.jpg') }}" class="img-fluid" alt="Logo"
                                        style="height: 3rem">
                                </a>
                            @else
                                <a href="/" class="navbar-brand logo">
                                    <img src="{{ asset('/assets/img/logo.jpg') }}" class="img-fluid" alt="Logo"
                                        style="height: 3rem">
                                </a>
                            @endauth
                        </div>
                        <div style="margin-left: 0px" class="main-menu-wrapper align-items-center">
                            <div class="menu-header">
                                @auth
                                    <a href="{{ url('/') }}" class="menu-logo">
                                        <img src="{{ asset('/assets/img/logo.jpg') }}" class="img-fluid" alt="Logo"
                                            style="height: 3rem">
                                    </a>
                                @else
                                    <a href="{{ url('/') }}" class="menu-logo">
                                        <img src="{{ asset('/assets/img/logo.jpg') }}" class="img-fluid" alt="Logo"
                                            style="height: 3rem">
                                    </a>
                                @endauth
                                <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                        class="fas fa-times"></i>
                                </a>
                            </div>
                            <ul class="main-nav black-font grey-font mx-4">
                                @auth
                                    <li class="{{ Request::routeIs('/') ? 'active' : '' }}">
                                        <a href="{{ url('/') }}">{{ __('web.home') }}</a>
                                    </li>
                                @else
                                    <li class="{{ Request::routeIs('/') ? 'active' : '' }}">
                                        <a href="/">{{ __('web.home') }}</a>
                                    </li>
                                @endauth
                                <li class="{{ Request::routeIs('blog-list') ? 'active' : '' }}">
                                    <a href="{{ route('blog-list') }}">{{ __('web.blog') }}</a>
                                </li>
                                <li class="{{ Request::routeIs('about-us') ? 'active' : '' }}">
                                    <a href="{{ route('about-us') }}">{{ __('web.aboutUs') }}</a>
                                </li>
                                <li class="{{ Request::routeIs('contact-us') ? 'active' : '' }}">
                                    <a href="{{ route('contact-us') }}">{{ __('web.contactUs') }}</a>
                                </li>
                                @auth
                                    <li class="{{ Request::routeIs('patient_dashboard') ? 'active' : '' }}">
                                        <a href="{{ route('patient_dashboard') }}">{{ __('web.dashboard') }}</a>
                                    </li>
                                @endauth
                            </ul>

                            @auth
                                <!-- Notifications -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="section-heading">
                                            <div class="notification_icon">
                                                <a href="{{ route('notifications') }}">
                                                    <i class="feather-bell"></i> <span class="badge"></span>
                                                </a>
                                                <span
                                                    class="badge badge-danger">{{ $notifications ? count($notifications) : 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Notifications -->
                            @endauth

                            @auth
                                <div class="nav-item dropdown has-arrow logged-item">
                                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                        <span class="user-img">
                                            @if (auth()->user()->profile_image ?? '')
                                                <img class="rounded-circle"
                                                    src="{{ asset(auth()->user()->profile_image) }}" width="31"
                                                    alt="{{ auth()->user()->name }}">
                                            @else
                                                <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                    alt="User Image" class="avatar-img rounded-circle">
                                            @endif
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" style="z-index: 9999;">
                                        <div class="user-header">
                                            <div class="avatar avatar-sm">
                                                @if (auth()->user()->profile_image ?? '')
                                                    <img src="{{ asset(auth()->user()->profile_image) }}"
                                                        alt="{{ auth()->user()->name }}"
                                                        class="avatar-img rounded-circle">
                                                @else
                                                    <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                        alt="User Image" class="avatar-img rounded-circle">
                                                @endif
                                            </div>
                                            <div class="user-text">
                                                <h6>{{ auth()?->user()?->name }}</h6>
                                                <p class="text-muted mb-0">{{ auth()?->user()?->username }}</p>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ url('patient-dashboard') }}">{{ __('web.dashboard') }}</a>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('web.profile') }}</a>
                                        <a onclick="document.getElementById('formlogout').submit();" class="dropdown-item"
                                            href="#">
                                            {{ __('web.signOut') }}
                                        </a>
                                        <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @else
                                <ul class="nav header-navbar-rht right-menu">
                                    <li class="nav-item">
                                        <a class="nav-link theme-btn btn-four" href="{{ url('login') }}">
                                            {{ __('web.signIn') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link theme-btn btn-four-light" href="{{ url('register') }}">
                                            {{ __('web.signUp') }}
                                        </a>
                                    </li>
                                </ul>
                            @endauth
                            <ul class="nav header-navbar-rht right-menu">
                                @if (App::getLocale() == 'ar')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('changeLang', ['lang' => 'en']) }}">
                                            EN
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('changeLang', ['lang' => 'ar']) }}">
                                            ع
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
