<footer id="colophon" class="site-footer">
    <div class="footer_inner_wrapper footer tm-bg tm-bgcolor-darkgrey tm-bgimage-no" style="padding: 0px">
        <div class="site-footer-bg-layer tm-bg-layer"></div>
        <div class="site-footer-w">
            <div class="footer-rows">
                <div class="footer-rows-inner">

                    <div id="first-footer"
                        class="sidebar-container first-footer  tm-bg tm-bgcolor-skincolor tm-textcolor-white tm-bgimage-yes tm-footerrow-sepnone tm-widgetsep-no"
                        role="complementary">
                        <div class="first-footer-bg-layer tm-bg-layer"></div>
                        <div class="container tm-container-for-footer">
                            <div class="first-footer-inner">
                                <div class="row multi-columns-row">

                                    <div class="widget-area col-xs-12 col-sm-3 col-md-3 col-lg-3 first-widget-area">
                                        <aside id="custom_html-2" class="widget_text widget widget_custom_html">
                                            <div class="textwidget custom-html-widget">
                                                <div class="footer_logo">
                                                    <img src="{{ asset('web/assets/img/logo-Mark-white.png') }}"
                                                        alt="ARAB CARE" width="50" height="100">
                                                </div>
                                            </div>
                                        </aside>
                                    </div><!-- .widget-area -->
                                    <div class="widget-area col-xs-12 col-sm-4 col-md-4 col-lg-4 first-widget-area">
                                        <div class="tm-quicklink-box">
                                            <div class="tm-lefticon-box">
                                                <span class="ti-location-pin"></span>
                                            </div>
                                            <div class="tm-righttext-box">
                                                <h6 class="custom-heading">{{ $setting->address }}</h6>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div><!-- .widget-area -->
                                    <div class="widget-area col-xs-12 col-sm-5 col-md-5 col-lg-5 first-widget-area">
                                        <aside id="block-7" class="widget widget_block">
                                            <div class="tm-quick-ctabuttons">
                                                <div class="footer-outline-btn">
                                                    <div
                                                        class="elementor-element tm-btn-color-white tm-btn-style-outline tm-btn-shape-square tm-icon-align-left elementor-widget elementor-widget-button">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-button-wrapper"><a
                                                                    href="mailto:{{ $setting->email }}"
                                                                    class="elementor-button-link elementor-button elementor-size-sm"
                                                                    role="button"><span
                                                                        class="elementor-button-content-wrapper"><span
                                                                            class="elementor-button-icon elementor-align-icon-left"><i
                                                                                aria-hidden="true"
                                                                                class="far fa-envelope"></i></span><span
                                                                            class="elementor-button-text">
                                                                            {{ $setting->email }}</span></span></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="footer-outline-btn-right">
                                                    <div
                                                        class="elementor-element tm-btn-color-white tm-btn-style-outline tm-btn-shape-square tm-icon-align-left elementor-widget elementor-widget-button">
                                                        <div class="elementor-widget-container">
                                                            <div class="elementor-button-wrapper"><a
                                                                    href="tel:{{ $setting->phone }}"
                                                                    class="elementor-button-link elementor-button elementor-size-sm"
                                                                    role="button"><span
                                                                        class="elementor-button-content-wrapper"><span
                                                                            class="elementor-button-icon elementor-align-icon-left"><i
                                                                                aria-hidden="true"
                                                                                class="fas fa-phone-alt"></i></span><span
                                                                            class="elementor-button-text">
                                                                            {{ $setting->phone }}</span></span></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </aside>
                                    </div><!-- .widget-area -->

                                </div><!-- .row.multi-columns-row -->
                            </div><!-- .first-footer-inner -->
                        </div><!--  -->
                    </div><!-- #secondary -->

                    <div id="second-footer"
                        class="sidebar-container second-footer tm-bg tm-bgcolor-transparent tm-textcolor-white tm-bgimage-yes tm-footerrow-sepnone"
                        role="complementary">
                        <div class="second-footer-bg-layer tm-bg-layer"></div>
                        <div class="container tm-container-for-footer">
                            <div class="second-footer-inner">
                                <div class="row multi-columns-row">

                                    <div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <p></p>
                                        <div class="tm-quicklink-box-2">
                                            <div class="tm-lefticon-box">
                                                <span class="kw_anomica flaticon-clock"></span>
                                            </div>
                                            <div class="tm-righttext-box">
                                                <p>Talk To Our Support</p>
                                                <h5 class="custom-heading">{{ $setting->phone }}</h5>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div><!-- .widget-area -->

                                    <div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <aside id="nav_menu-1" class="widget widget_nav_menu">
                                            <h3 class="widget-title">Policies</h3>
                                            <div class="menu-policyesmenu-container">
                                                <ul id="menu-policyesmenu-1" class="menu">
                                                    <li
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-4693">
                                                        <a rel="privacy-policy"
                                                            href="{{ route('privacy') }}">{{ __('web.privacy_policy') }}</a></li>
                                                    <li
                                                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4701">
                                                        <a href="{{ route('terms-conditions') }}">{{ __('web.terms_conditions') }}</a></li>
                                                </ul>
                                            </div>
                                        </aside>
                                    </div><!-- .widget-area -->

                                    <div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <aside id="block-11" class="widget widget_block widget_media_image">
                                            <figure class="wp-block-image size-full"><a
                                                    href="https://apps.apple.com/sa/app/arab-care/id6744697761?platform=iphone"><img
                                                        decoding="async" width="138" height="40"
                                                        src="{{ asset('web/assets/img/appstore-2.png') }}"
                                                        alt class="wp-image-4731"></a></figure>
                                        </aside>
                                        <aside id="block-12" class="widget widget_block widget_media_image">
                                            <figure class="wp-block-image size-full is-resized"><a
                                                    href="https://play.google.com/store/apps/details?id=com.saberson.arabcare&amp;hl=ar&amp;pli=1"><img
                                                        decoding="async" width="138" height="40"
                                                        src="{{ asset('web/assets/img/googleplay-1.png') }}"
                                                        alt class="wp-image-4732" style="width:140px;height:auto"></a>
                                            </figure>
                                        </aside>
                                    </div><!-- .widget-area -->

                                    <div class="widget-area col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                    </div><!-- .widget-area -->

                                </div><!-- .row.multi-columns-row -->
                            </div><!-- .second-footer-inner -->
                        </div><!--  -->
                    </div><!-- #secondary -->

                </div><!-- .footer-inner -->
            </div><!-- .footer -->

            <div id="bottom-footer-text"
                class="bottom-footer-text tm-bottom-footer-text site-info  tm-bg tm-bgcolor-custom tm-textcolor-white tm-bgimage-no tm-bordercolor-none">
                <div class="bottom-footer-bg-layer tm-bg-layer"></div>
                <div class="container tm-container-for-footer">
                    <div class="bottom-footer-inner">
                        <div class="row multi-columns-row">
                            <div class="col-xs-12 col-sm-6 tm-footer2-left ">
                                Copyright © 2025 <a href="{{ url('/') }}">Arab Care ®
                                    عرب كير </a>. All rights reserved.
                            </div><!--.footer menu -->
                            <div class="col-xs-12 col-sm-6 tm-footer2-right ">
                                <div class="tm-footer-left-nav-menu">
                                    {{-- <ul class="footer-nav-menu">
                                        <li
                                            class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-3985">
                                            <a href="https://arabcares.com/services-1/">Services</a>
                                        </li>
                                        <li
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3983">
                                            <a href="https://arabcares.com/about-us-2/">About Us</a>
                                        </li>
                                        <li
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3984">
                                            <a href="https://arabcares.com/contact-us-2/">contact Us</a>
                                        </li>
                                    </ul> --}}
                                    <img class="wp-image-4514 alignright"
                                        src="{{ asset('web/assets/img/mada-300x51.png') }}"
                                        alt width="165" height="28">
                                </div>
                                <div class="tm-footer-left-nav-menu"></div>
                                &nbsp;
                            </div><!--.copyright -->
                        </div><!-- .row.multi-columns-row -->
                    </div><!-- .bottom-footer-inner -->
                </div><!--  -->
            </div><!-- .footer-text -->
        </div><!-- .footer-inner-wrapper -->
    </div><!-- .site-footer-inner -->
</footer><!-- .site-footer -->
