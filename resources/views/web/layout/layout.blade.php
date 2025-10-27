<!DOCTYPE html>
<!-- saved from url=(0033)https://arabcares.com/services-1/ -->
<html dir="ltr" lang="en-US" prefix="og: https://ogp.me/ns#" class="no-js">

<head>
    @include('web.layout.head')
    @yield('style')
</head>

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
                                                        src="{{ asset('web/assets/img/logo-Mark-1.png') }}">
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

                                        {{-- <div class="themetechmount-social-links-wrapper">
                                            <ul class="social-icons">
                                                <li class="tm-social-facebook">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="https://arabcares.com/services-1/#"
                                                        data-tooltip="Facebook">
                                                        <i class="tm-anomica-icon-facebook"></i><span
                                                            class="tm-hide tm-socialname">Facebook</span>
                                                    </a>
                                                </li>
                                                <li class="tm-social-twitter">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="https://arabcares.com/services-1/#"
                                                        data-tooltip="Twitter">
                                                        <i class="tm-anomica-icon-twitter"></i><span
                                                            class="tm-hide tm-socialname">Twitter</span>
                                                    </a>
                                                </li>
                                                <li class="tm-social-flickr">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="https://arabcares.com/services-1/#"
                                                        data-tooltip="Flickr"><i
                                                            class="tm-anomica-icon-flickr"></i><span
                                                            class="tm-hide tm-socialname">Flickr</span>
                                                    </a>
                                                </li>
                                                <li class="tm-social-linkedin">
                                                    <a class=" tooltip-top" target="_blank"
                                                        href="https://arabcares.com/services-1/"
                                                        data-tooltip="LinkedIn"><i
                                                            class="tm-anomica-icon-linkedin"></i><span
                                                            class="tm-hide tm-socialname">LinkedIn</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <nav id="site-navigation" class="main-navigation" aria-label="Primary Menu"
                                        data-sticky-height="70">
                                        <div class="tm-header-text-area">
                                            <div class="header-info-widget">
                                                <!-- Visual Composer plugin not installed. Please install it to make this shortcode work. -->
                                            </div>
                                        </div>
                                        <div class="tm-header-icons ">
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
                                        </div>
                                        <button id="menu-toggle" class="menu-toggle">
                                            <span class="tm-hide">Toggle menu</span><i class="tm-anomica-icon-bars"></i>
                                        </button>

                                        <div class="nav-menu">
                                            <ul id="menu-mymainmenu" class="nav-menu">
                                                <li id="menu-item-4459"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-4459">
                                                    <a href="https://arabcares.com/">Home</a>
                                                </li>
                                                <li id="menu-item-4607"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-847 current_page_item menu-item-4607">
                                                    <a href="https://arabcares.com/services-1/"
                                                        aria-current="page">Services</a>
                                                </li>
                                                <li id="menu-item-5039"
                                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-5039">
                                                    <a href="https://arabcares.com/services-1/#">Products</a>
                                                    <ul class="sub-menu">
                                                        <li id="menu-item-4878"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4878">
                                                            <a href="https://arabcares.com/our-product/">Arab Care
                                                                App</a>
                                                        </li>
                                                        <li id="menu-item-5031"
                                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5031">
                                                            <a href="https://arabcares.com/profile/">Profile</a>
                                                        </li>
                                                    </ul>
                                                    <span class="righticon"><i
                                                            class="tm-anomica-icon-angle-down"></i></span>
                                                </li>
                                                <li id="menu-item-4528"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4528 lastsecond">
                                                    <a href="https://arabcares.com/about-us-2/">About Us</a>
                                                </li>
                                                <li id="menu-item-4460"
                                                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4460 last">
                                                    <a href="https://arabcares.com/contact-us-2/">Contact Us</a>
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
