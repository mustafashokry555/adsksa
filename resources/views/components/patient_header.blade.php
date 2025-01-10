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
<style>
    .flag-icon {
        width: 20px;
        margin-right: 5px;
    }
    .wrapper-dropdown-5 {
        /* Size & position */
        position: relative;
        width: 140px;
        margin: 10px 0 0 20px;
        padding: 8px 10px;

        /* Styles */
        background: #fff;
        border-radius: 5px;
        border: 1px solid #0071DC;
        color: #0071DC;
        /* box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2); */
        cursor: pointer;
        outline: none;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
    }

    .wrapper-dropdown-5:after {
        /* Little arrow */
        content: "";
        width: 0;
        height: 0;
        position: absolute;
        top: 50%;
        right: 15px;
        margin-top: -3px;
        border-width: 6px 6px 0 6px;
        border-style: solid;
        border-color: #0071DC transparent;
    }

    .wrapper-dropdown-5 .dropdown {
        /* Size & position */
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        padding: 0;
        
        /* Styles */
        background: #fff;
        border-radius: 0 0 5px 5px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-top: none;
        border-bottom: none;
        list-style: none;
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;

        /* Hiding */
        max-height: 0;
        overflow: hidden;
    }

    .wrapper-dropdown-5 .dropdown li {
        padding: 0 10px;
    }

    .wrapper-dropdown-5 .dropdown li a {
        display: block;
        text-decoration: none;
        color: #333;
        padding: 10px 0;
        transition: all 0.3s ease-out;
        border-bottom: 1px solid #e6e8ea;
    }

    .wrapper-dropdown-5 .dropdown li:last-of-type a {
        border: none;
    }

    .wrapper-dropdown-5 .dropdown li i {
        margin-right: 5px;
        color: inherit;
        vertical-align: middle;
    }

    /* Hover state */

    .wrapper-dropdown-5 .dropdown li:hover a {
        color: #0071DC;
    }

    /* Active state */

    .wrapper-dropdown-5.active {
        border-radius: 5px 5px 0 0;
        background: #0071DC;
        box-shadow: none;
        border-bottom: none;
        color: white;
    }

    .wrapper-dropdown-5.active:after {
        border-color: #0071DC transparent;
    }

    .wrapper-dropdown-5.active .dropdown {
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
        max-height: 400px;
    }

    @media (max-width: 992px) {
        .wrapper-dropdown-5 {
            margin: 5px auto;
        }
    }
</style>

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
                                {{-- <li class="{{ Request::routeIs('blog-list') ? 'active' : '' }}">
                                    <a href="{{ route('blog-list') }}">{{ __('web.blog') }}</a>
                                </li> --}}
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
                                        <a class="dropdown-item"
                                            href="{{ url('patient-dashboard') }}">{{ __('web.dashboard') }}</a>
                                        <a class="dropdown-item"
                                            href="{{ route('profile.index') }}">{{ __('web.profile') }}</a>
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
                                <ul class="nav header-navbar-rht right-menu"
                                    style="justify-content: center;margin-top: 10px;">
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


                            <div id="dd" class="wrapper-dropdown-5" tabindex="1">
                                @if (App::getLocale() == 'ar')
                                    <img src="{{ asset('assets/img/Ar-flag.svg') }}" alt="Arabic" class="flag-icon"><span>العربية</span>
                                @else
                                    <img src="{{ asset('assets/img/Eng-flag.svg') }}" alt="English" class="flag-icon"><span>English</span>
                                @endif
                                <ul class="dropdown">
                                    <li>
                                        <a href="{{ route('changeLang', ['lang' => 'en']) }}">
                                            <img src="{{ asset('assets/img/Eng-flag.svg') }}" alt="English" class="flag-icon">
                                            English
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('changeLang', ['lang' => 'ar']) }}">
                                            <img src="{{ asset('assets/img/Ar-flag.svg') }}" alt="Arabic" class="flag-icon">
                                            العربية
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            {{-- <ul class="nav header-navbar-rht right-menu"
                                style="justify-content: center;margin-top: 10px;">
                                <li class="nav-item" style="border-radius: 5px; background-color: #fff">
                                    @if (App::getLocale() == 'ar')
                                        <a class="nav-link" href="{{ route('changeLang', ['lang' => 'en']) }}">
                                            EN
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{ route('changeLang', ['lang' => 'ar']) }}">
                                            ع
                                        </a>
                                    @endif
                                </li>
                            </ul> --}}
                        </div>
                    </nav>
                </div>
            </header>
        {{-- </div>
    </section> --}}
    <script src="{{ asset('assets/js/jquery-3.2.1.slim.min.js')}}"></script>
    <script>
        function DropDown(el) {
            this.dd = el;
            this.initEvents();
        }
        DropDown.prototype = {
            initEvents: function() {
                var obj = this;

                obj.dd.on('click', function(event) {
                    $(this).toggleClass('active');
                    event.stopPropagation();
                });
            }
        }

        $(function() {

            var dd = new DropDown($('#dd'));

            $(document).click(function() {
                // all dropdowns
                $('.wrapper-dropdown-5').removeClass('active');
            });

        });
    </script>
