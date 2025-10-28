<!DOCTYPE html>
<!-- saved from url=(0033)https://arabcares.com/services-1/ -->
<html dir="ltr" lang="en-US" prefix="og: https://ogp.me/ns#" class="no-js">

<head>
    @include('web.layout.head')
    @yield('style')
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
</head>
@php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Facades\Auth;

    $notifications = [];
    if (Auth::check()) {
        $notifications = \App\Models\Notification::query()
            ->where('to_id', Auth::user()->id)
            ->where('isRead', 1)
            ->get();
    }
@endphp

<body
    class="wp-singular page-template-default page page-id-847 wp-custom-logo wp-theme-anomica truebooker eio-default tm-headerstyle-classicinfo themetechmount-footer-default themetechmount-topbar-no themetechmount-wide themetechmount-page-full-width tm-empty-sidebar elementor-default elementor-kit-8 elementor-page elementor-page-847 e--ua-blink e--ua-chrome e--ua-webkit"
    data-elementor-device-mode="desktop" style="">
    <div class="tm-page-loader-wrapper" style="display: none;"></div>
    <div id="tm-home"></div>
    <div class="main-holder">
        <div id="page" class="hfeed site">
            <header id="masthead"
                class=" tm-header-style-classicinfo tm-main-menu-total-25 tm-main-menu-more-than-six tm-header-overlay">
                <div class="tm-header-block  tm-mmenu-active-color-skin tm-dmenu-active-color-skin tm-dmenu-sep-grey">
                    <div id="tm-stickable-header-w" class="tm-stickable-header-w tm-bgcolor-custom" style="height:67px">
                        <div id="site-header"
                            class="site-header tm-bgcolor-custom tm-sticky-bgcolor-white tm-responsive-icon-dark tm-mmmenu-override-yes tm-above-content-yes tm-stickable-header"
                            style="">
                            <div class="site-header-main tm-wrap container tm-container-for-header">
                                <div class="site-branding tm-wrap-cell">
                                    <div class="headerlogo themetechmount-logotype-image tm-stickylogo-no">
                                        <span class="site-title">
                                            <a class="home-link" href="https://arabcares.com/"
                                                title="Arab Care ® عرب كير" rel="home">
                                                <span class="tm-sc-logo tm-sc-logo-type-image">
                                                    <img class="themetechmount-logo-img standardlogo"
                                                        alt="Arab Care ® عرب كير"
                                                        src="{{ URL::asset('images/' . $setting->logo) }}">
                                                </span>
                                            </a>
                                        </span>
                                        <h2 class="site-description">IT solution provider عرب كير</h2>
                                    </div>
                                </div><!-- .site-branding -->
                                <div id="site-header-menu" class="site-header-menu tm-wrap-cell">
                                    <div class="tm-header-text-above-menu">
                                        <div class="tm_top_details">
                                            <ul class="top-contact">
                                                <li>
                                                    <i class="fa fa-phone-alt"></i>{{ $setting->phone }}
                                                </li>
                                                <li>
                                                    <i class="fa fa-envelope-o"></i><a
                                                        href="mailto:info@arabcares.com">{{ $setting->email }}</a>
                                                </li>
                                                <li>
                                                    <i class="fa fa-clock-o"></i>Office Hour: 08:00am - 6:00pm
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="themetechmount-social-links-wrapper">
                                            <ul class="social-icons">
                                                <li class="tm-social-facebook">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="{{ $setting->facebook }}" data-tooltip="Facebook">
                                                        <i class="tm-anomica-icon-facebook"></i><span
                                                            class="tm-hide tm-socialname">Facebook</span>
                                                    </a>
                                                </li>
                                                <li class="tm-social-twitter">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="{{ $setting->twitter }}" data-tooltip="Twitter">
                                                        <i class="tm-anomica-icon-twitter"></i><span
                                                            class="tm-hide tm-socialname">Twitter</span>
                                                    </a>
                                                </li>
                                                {{-- <li class="tm-social-flickr">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="https://arabcares.com/services-1/#"
                                                        data-tooltip="Flickr"><i
                                                            class="tm-anomica-icon-flickr"></i><span
                                                            class="tm-hide tm-socialname">Flickr</span>
                                                    </a>
                                                </li> --}}
                                                <li class="tm-social-linkedin">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="{{ $setting->linkedin }}" data-tooltip="LinkedIn"><i
                                                            class="tm-anomica-icon-linkedin"></i><span
                                                            class="tm-hide tm-socialname">LinkedIn</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <nav id="site-navigation" class="main-navigation" aria-label="Primary Menu"
                                        data-sticky-height="70">
                                        <div class="tm-header-text-area">
                                            <div class="header-info-widget">
                                                <!-- Visual Composer plugin not installed. Please install it to make this shortcode work. -->
                                            </div>
                                        </div>
                                        {{-- <div class="tm-header-icons ">
                                            <div class="tm-header-icon tm-header-search-link">
                                                <a href="https://arabcares.com/services-1/#" class="sclose"><i
                                                        class="tm-anomica-icon-search"></i></a>
                                                <div class="tm-search-overlay">
                                                    <form method="get" class="tm-site-searchform"
                                                        action="https://arabcares.com/">
                                                        <div class="w-search-form-h">
                                                            <div class="w-search-form-row">
                                                                <div class="w-search-input">
                                                                    <input type="search" class="field searchform-s"
                                                                        name="s"
                                                                        placeholder="Type Word Then Enter..">
                                                                    <button type="submit">
                                                                        <span class="tm-anomica-icon-search">
                                                                        </span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <button id="menu-toggle" class="menu-toggle">
                                            <span class="tm-hide">Toggle menu</span><i class="tm-anomica-icon-bars"></i>
                                        </button>

                                        <div class="nav-menu">
                                            <ul id="menu-mymainmenu" class="nav-menu">
                                                <li id="menu-item-4459"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-4459 {{ Request::is('new') ? 'current-menu-item current_page_item' : '' }}">
                                                    <a href="{{ url('/') }}">{{ __('web.home') }}</a>
                                                </li>
                                                @auth
                                                    <li
                                                        class="{{ Request::is('patient_dashboard') ? 'current-menu-item current_page_item' : '' }}">
                                                        <a
                                                            href="{{ route('patient_dashboard') }}">{{ __('web.dashboard') }}</a>
                                                    </li>

                                                    <!-- Notifications -->
                                                    <li id="menu-item-4528"
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4528 lastsecond">
                                                        <a href="{{ route('notifications') }}">
                                                            <i class="fa fa-bell"></i>
                                                            <span class="badge badge-danger">
                                                                {{ $notifications ? count($notifications) : 0 }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <!-- /Notifications -->

                                                    <li id="menu-item-5039"
                                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5039">
                                                        <style>
                                                            .profile-link_list::after {
                                                                display: none !important;
                                                            }
                                                        </style>
                                                        <a href="#" class="dropdown-toggle nav-link profile-link_list"
                                                            data-bs-toggle="dropdown">
                                                            <span class="user-img">
                                                                @if (auth()->user()->profile_image ?? '')
                                                                    <img class="rounded-circle"
                                                                        src="{{ asset(auth()->user()->profile_image) }}"
                                                                        width="31" alt="{{ auth()->user()->name }}">
                                                                @else
                                                                    <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                        alt="User Image"
                                                                        class="avatar-img rounded-circle">
                                                                @endif
                                                            </span>
                                                        </a>
                                                        <ul class="sub-menu">
                                                            <li id="menu-item-4878"
                                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4878">

                                                                <a>
                                                                    {{-- <div class="avatar avatar-sm"> --}}
                                                                    @if (auth()->user()->profile_image ?? '')
                                                                        <img src="{{ asset(auth()->user()->profile_image) }}"
                                                                            alt="{{ auth()->user()->name }}"
                                                                            class="avatar-img rounded-circle"
                                                                            style="width: 10%;">
                                                                    @else
                                                                        <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                                                            alt="User Image"
                                                                            class="avatar-img rounded-circle"
                                                                            style="width: 10%;">
                                                                    @endif
                                                                    <span>
                                                                        {{ auth()?->user()?->name }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li id="menu-item-5031"
                                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5031">
                                                                <a
                                                                    href="{{ url('patient-dashboard') }}">{{ __('web.dashboard') }}</a>
                                                            </li>
                                                            <li id="menu-item-5031"
                                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5031">
                                                                <a
                                                                    href="{{ route('profile.index') }}">{{ __('web.profile') }}</a>
                                                            </li>
                                                            <li id="menu-item-5031"
                                                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5031">
                                                                <a onclick="document.getElementById('formlogout').submit();"
                                                                    href="#">{{ __('web.signOut') }}</a>
                                                                <form id="formlogout" method="POST"
                                                                    action="{{ route('logout') }}">
                                                                    @csrf
                                                                </form>
                                                            </li>
                                                        </ul>
                                                        <span class="righticon"><i
                                                                class="tm-anomica-icon-angle-down"></i></span>
                                                    </li>
                                                @else
                                                    <li id="menu-item-4528"
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4528 lastsecond">
                                                        <a class="nav-link theme-btn btn-four" href="{{ url('login') }}"
                                                            style="height: 50px;
                                                                margin: 10px 5px;
                                                                align-items: center;
                                                                display: flex;
                                                                border: none !important;
                                                                background-color: #18CCDC;
                                                            ;">
                                                            {{ __('web.signIn') }}
                                                        </a>
                                                    </li>
                                                    <li id="menu-item-4528"
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4528 lastsecond">
                                                        <a class="nav-link theme-btn btn-four register-btn"
                                                            href="{{ url('register') }}"style="height: 50px;
                                                                            margin: 10px 5px;
                                                                            align-items: center;
                                                                            display: flex;
                                                                            border: none !important;
                                                                            background-color: #FFFFFF
                                                                        ;">
                                                            {{ __('web.signUp') }}
                                                        </a>
                                                    </li>
                                                @endauth
                                                <li id="menu-item-5039"
                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5039">
                                                    <a href="#">
                                                        @if (App::getLocale() == 'ar')
                                                            <img src="{{ asset('assets/img/Ar-flag.svg') }}"
                                                                alt="Arabic" class="flag-icon"><span>العربية</span>
                                                        @else
                                                            <img src="{{ asset('assets/img/Eng-flag.svg') }}"
                                                                alt="English" class="flag-icon"><span>English</span>
                                                        @endif
                                                    </a>
                                                    {{-- <a href="https://arabcares.com/services-1/#">Products</a> --}}
                                                    <ul class="sub-menu">
                                                        <li id="menu-item-4878"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4878">
                                                            <a href="{{ route('changeLang', ['lang' => 'en']) }}">
                                                                <img src="{{ asset('assets/img/Eng-flag.svg') }}"
                                                                    alt="English" class="flag-icon">
                                                                English
                                                            </a>
                                                        </li>
                                                        <li id="menu-item-5031"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5031">
                                                            <a href="{{ route('changeLang', ['lang' => 'ar']) }}">
                                                                <img src="{{ asset('assets/img/Ar-flag.svg') }}"
                                                                    alt="Arabic" class="flag-icon">
                                                                العربية
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <span class="righticon"><i
                                                            class="tm-anomica-icon-angle-down"></i></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav><!-- .main-navigation -->
                                </div><!-- .site-header-menu -->
                            </div><!-- .site-header-main -->
                        </div>
                    </div>

                    <div
                        class="tm-titlebar-wrapper tm-bg tm-bgcolor-custom tm-titlebar-align-default tm-textcolor-dark tm-bgimage-yes tm-breadcrumb-bgcolor-custom">
                        <div class="tm-titlebar-wrapper-bg-layer tm-bg-layer"></div>
                        <div class="tm-titlebar entry-header">
                            <div class="tm-titlebar-inner-wrapper">
                                <div class="tm-titlebar-main">
                                    <div class="container">
                                        <div class="container">
                                            <div class="tm-titlebar-main-inner">
                                                @yield('main-content')
                                            </div>
                                        </div>
                                    </div><!-- .tm-titlebar-main -->
                                </div><!-- .tm-titlebar-inner-wrapper -->
                            </div><!-- .tm-titlebar-inner-wrapper -->
                        </div><!-- .tm-titlebar -->
                    </div><!-- .tm-titlebar-wrapper -->
                </div>
            </header><!-- .site-header -->
            <main>
                @yield('content')
                {{-- <br><br><br><br><br><br><br><br><br> --}}
            </main>
        </div><!-- #primary .content-area -->
    </div><!-- .site-content-inner -->
    </div>
    </div>

    @include('web.layout.footer')

    </div>

    </div>

    <!-- To Top -->
    <div id="totop" class="totop-button totop-button-default" style="display: none;">
        <a id="totop" href="https://arabcares.com/services-1/#top">
            <i class="tm-anomica-icon-angle-up"></i>
        </a>
        <i class="tm-anomica-icon-angle-up"></i>
    </div>
    @include('web.layout.scripts')
    @yield('script')
</body>

</html>
