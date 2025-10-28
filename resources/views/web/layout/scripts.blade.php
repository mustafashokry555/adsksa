<script type="speculationrules">
        {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"\/*"},{"not":{"href_matches":["\/wp-*.php","\/wp-admin\/*","\/wp-content\/uploads\/*","\/wp-content\/*","\/wp-content\/plugins\/*","\/wp-content\/themes\/anomica\/*","\/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
    </script>
<!-- Instagram Feed JS -->
<script>
    var sbiajaxurl = "https://arabcares.com/wp-admin/admin-ajax.php";
</script>
<script>
    const lazyloadRunObserver = () => {
        const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
        const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    let lazyloadBackground = entry.target;
                    if (lazyloadBackground) {
                        lazyloadBackground.classList.add('e-lazyloaded');
                    }
                    lazyloadBackgroundObserver.unobserve(entry.target);
                }
            });
        }, {
            rootMargin: '200px 0px 200px 0px'
        });
        lazyloadBackgrounds.forEach((lazyloadBackground) => {
            lazyloadBackgroundObserver.observe(lazyloadBackground);
        });
    };
    const events = [
        'DOMContentLoaded',
        'elementor/lazyload/observe',
    ];
    events.forEach((event) => {
        document.addEventListener(event, lazyloadRunObserver);
    });
</script>
<script>
    SR7.E.php.warnings = {
        "getArrSliders": "get_sliders",
        "getAlias": "get_alias",
        "getTitle": "get_title"
    };
</script>
<link rel="stylesheet" id="tm-cs-google-fonts-css"
    href="{{ asset('web/assets/css/css(3).css') }}" media="all">
<script src="{{ asset('web/assets/js/hooks.min.js') }}" id="wp-hooks-js">
</script>
<script src="{{ asset('web/assets/js/i18n.min.js') }}" id="wp-i18n-js">
</script>
<script id="wp-i18n-js-after">
    /* <![CDATA[ */
    wp.i18n.setLocaleData({
        'text direction\u0004ltr': ['ltr']
    });
    /* ]]> */
</script>
<script src="{{ asset('web/assets/js/index.js') }}" id="swv-js"></script>
<script id="contact-form-7-js-before">
    /* <![CDATA[ */
    var wpcf7 = {
        "api": {
            "root": "https:\/\/arabcares.com\/wp-json\/",
            "namespace": "contact-form-7\/v1"
        }
    };
    /* ]]> */
</script>
<script src="{{ asset('web/assets/js/index(1).js') }}"
    id="contact-form-7-js"></script>
<script src="{{ asset('web/assets/js/perfect-scrollbar.jquery.min.js') }}"
    id="perfect-scrollbar-js"></script>
<script src="{{ asset('web/assets/js/select2.min.js') }}" id="select2-js">
</script>
<script src="{{ asset('web/assets/js/isotope.pkgd.min.js') }}"
    id="isotope-js"></script>
<script src="{{ asset('web/assets/js/jquery.mousewheel.min.js') }}"
    id="jquery-mousewheel-js"></script>
<script src="{{ asset('web/assets/js/jquery.flexslider-min.js') }}"
    id="jquery-flexslider-js"></script>
<script src="{{ asset('web/assets/js/jquery.sticky-kit.min.js') }}"
    id="jquery-sticky-kit-js"></script>
<script src="{{ asset('web/assets/js/slick.min.js') }}" id="slick-js">
</script>
<script src="{{ asset('web/assets/js/jquery.prettyPhoto.js') }}"
    id="prettyphoto-js"></script>
<script src="{{ asset('web/assets/js/dflip.min.js') }}"
    id="dflip-script-js"></script>
<script src="{{ asset('web/assets/js/functions.js') }}"
    id="anomica-functions-js"></script>
<script src="{{ asset('web/assets/js/jquery.waypoints.min.js') }}"
    id="waypoints-js"></script>
<script src="{{ asset('web/assets/js/numinate.min.js') }}" id="numinate-js">
</script>
<script src="{{ asset('web/assets/js/circle-progress.min.js') }}"
    id="jquery-circle-progress-js"></script>
<script src="{{ asset('web/assets/js/webpack.runtime.min.js') }}"
    id="elementor-webpack-runtime-js"></script>
<script src="{{ asset('web/assets/js/frontend-modules.min.js') }}"
    id="elementor-frontend-modules-js"></script>
<script src="{{ asset('web/assets/js/core.min.js') }}"
    id="jquery-ui-core-js"></script>
<script id="elementor-frontend-js-before">
    /* <![CDATA[ */
    var elementorFrontendConfig = {
        "environmentMode": {
            "edit": false,
            "wpPreview": false,
            "isScriptDebug": false
        },
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close",
            "a11yCarouselPrevSlideMessage": "Previous slide",
            "a11yCarouselNextSlideMessage": "Next slide",
            "a11yCarouselFirstSlideMessage": "This is the first slide",
            "a11yCarouselLastSlideMessage": "This is the last slide",
            "a11yCarouselPaginationBulletMessage": "Go to slide"
        },
        "is_rtl": false,
        "breakpoints": {
            "xs": 0,
            "sm": 480,
            "md": 768,
            "lg": 1025,
            "xl": 1440,
            "xxl": 1600
        },
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Mobile Portrait",
                    "value": 767,
                    "default_value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {
                    "label": "Mobile Landscape",
                    "value": 880,
                    "default_value": 880,
                    "direction": "max",
                    "is_enabled": false
                },
                "tablet": {
                    "label": "Tablet Portrait",
                    "value": 1024,
                    "default_value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {
                    "label": "Tablet Landscape",
                    "value": 1200,
                    "default_value": 1200,
                    "direction": "max",
                    "is_enabled": false
                },
                "laptop": {
                    "label": "Laptop",
                    "value": 1366,
                    "default_value": 1366,
                    "direction": "max",
                    "is_enabled": false
                },
                "widescreen": {
                    "label": "Widescreen",
                    "value": 2400,
                    "default_value": 2400,
                    "direction": "min",
                    "is_enabled": false
                }
            },
            "hasCustomBreakpoints": false
        },
        "version": "3.32.3",
        "is_static": false,
        "experimentalFeatures": {
            "e_font_icon_svg": true,
            "additional_custom_breakpoints": true,
            "container": true,
            "e_optimized_markup": true,
            "e_pro_free_trial_popup": true,
            "nested-elements": true,
            "home_screen": true,
            "global_classes_should_enforce_capabilities": true,
            "e_variables": true,
            "cloud-library": true,
            "e_opt_in_v4_page": true,
            "import-export-customization": true
        },
        "urls": {
            "assets": "https:\/\/arabcares.com\/wp-content\/plugins\/elementor\/assets\/",
            "ajaxurl": "https:\/\/arabcares.com\/wp-admin\/admin-ajax.php",
            "uploadUrl": "https:\/\/arabcares.com\/wp-content\/uploads"
        },
        "nonces": {
            "floatingButtonsClickTracking": "c86f576d76"
        },
        "swiperClass": "swiper",
        "settings": {
            "page": [],
            "editorPreferences": []
        },
        "kit": {
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "global_image_lightbox": "yes",
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description"
        },
        "post": {
            "id": 847,
            "title": "%D8%B9%D8%B1%D8%A8%20%D9%83%D9%8A%D8%B1%20Arab%20care%20-%20%D8%B9%D8%B1%D8%A8%20%D9%83%D9%8A%D8%B1%20%D8%AA%D8%B7%D8%A8%D9%8A%D9%82%20%D8%A7%D9%84%D8%AE%D8%AF%D9%85%D8%A9%20%D8%A7%D9%84%D8%B0%D8%A7%D8%AA%D9%8A%D8%A9%20%D9%84%D9%84%D9%85%D8%B1%D9%8A%D8%B6",
            "excerpt": "",
            "featuredImage": false
        }
    };
    /* ]]> */
</script>
<script src="{{ asset('web/assets/js/frontend.min.js') }}"
    id="elementor-frontend-js"></script><span id="elementor-device-mode" class="elementor-screen-only">
</span>
<script data-cfasync="false">
    var dFlipLocation = 'https://arabcares.com/wp-content/plugins/3d-flipbook-dflip-lite/assets/';
    var dFlipWPGlobal = {
        "text": {
            "toggleSound": "Turn on\/off Sound",
            "toggleThumbnails": "Toggle Thumbnails",
            "toggleOutline": "Toggle Outline\/Bookmark",
            "previousPage": "Previous Page",
            "nextPage": "Next Page",
            "toggleFullscreen": "Toggle Fullscreen",
            "zoomIn": "Zoom In",
            "zoomOut": "Zoom Out",
            "toggleHelp": "Toggle Help",
            "singlePageMode": "Single Page Mode",
            "doublePageMode": "Double Page Mode",
            "downloadPDFFile": "Download PDF File",
            "gotoFirstPage": "Goto First Page",
            "gotoLastPage": "Goto Last Page",
            "share": "Share",
            "mailSubject": "I wanted you to see this FlipBook",
            "mailBody": "Check out this site {{ url('/') }}",
            "loading": "DearFlip: Loading "
        },
        "viewerType": "flipbook",
        "moreControls": "download,pageMode,startPage,endPage,sound",
        "hideControls": "",
        "scrollWheel": "false",
        "backgroundColor": "#777",
        "backgroundImage": "",
        "height": "auto",
        "paddingLeft": "20",
        "paddingRight": "20",
        "controlsPosition": "bottom",
        "duration": 800,
        "soundEnable": "true",
        "enableDownload": "true",
        "showSearchControl": "false",
        "showPrintControl": "false",
        "enableAnnotation": false,
        "enableAnalytics": "false",
        "webgl": "true",
        "hard": "none",
        "maxTextureSize": "1600",
        "rangeChunkSize": "524288",
        "zoomRatio": 1.5,
        "stiffness": 3,
        "pageMode": "0",
        "singlePageMode": "0",
        "pageSize": "0",
        "autoPlay": "false",
        "autoPlayDuration": 5000,
        "autoPlayStart": "false",
        "linkTarget": "2",
        "sharePrefix": "flipbook-"
    };
</script>



<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Feather Icon JS -->
<script src="{{ asset('assets/libs/feather/feather.min.js') }}"></script>
<!-- Swiper JS -->
<script src="{{ asset('assets/libs/swiper/js/swiper.min.js') }}"></script>
<!-- Slick -->
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/pages/slick.init.js') }}"></script>
<!-- sticky-sidebar -->
<script src="{{ asset('assets/libs/theia-sticky-sidebar/dist/ResizeSensor.js') }}"></script>
<script src="{{ asset('assets/libs/theia-sticky-sidebar/dist/theia-sticky-sidebar.js') }}"></script>
<!-- Select2 JS-->
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/select.init.js') }}"></script>
<!-- Daterangepicker js -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/daterangepicker.init.js') }}"></script>
<!-- Datatables js -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- Daterangepicker js -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/datetimepicker.init.js') }}"></script>
<!-- Apecharts js -->
<script src="{{ asset('assets/libs/apex/apexcharts.min.js') }}"></script>
<!-- Jquery-ui -->
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<!-- Full Calendar js -->
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/libs/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/fullcalendar.init.js') }}"></script>
<!-- Fancybox  js -->
<script src="{{ asset('assets/libs/fancybox/jquery.fancybox.min.js') }}"></script>
<!-- Circle Progress JS -->
<script src="{{ asset('assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/progress-bar.init.js') }}"></script>
<!-- Bootstrap Tagsinput JS -->
<script src="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Dropzone JS -->
<script src="{{ asset('assets/js/pages/dropzone.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/profile-settings.init.js') }}"></script>
<!-- Owl carousel JS -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
@if (Route::is(['onboarding-phone', 'patient-phone']))
    <!-- IntlTelInput JS -->
    <script src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('assets/js/intlTelInput.min.js') }}"></script>
@endif
<!-- Animation js -->
<script src="{{ asset('assets/libs/aos/aos.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/app.js') }}"></script>
@if (Route::is(['map-grid', 'map-list', 'map-list-1']))
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
    <script src="{{ asset('assets/js/map.js') }}"></script>
@endif
@if (Route::is(['onboarding-phone', 'patient-phone']))
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            autoHideDialCode: true,
            autoPlaceholder: "polite",
            formatOnDisplay: true,
            placeholderNumberType: "MOBILE",
            separateDialCode: true,
            utilsScript: "assets/js/utils.js",
        });
    </script>
@endif
<script>
    // alert("adjhfdakj");
    new DataTable('#datatable1', {
        order: [
            [0,
                'desc'
            ] // Use the appropriate column index (0 is the first column) and 'desc' for descending order
        ]
    });

    new DataTable('#datatable2', {
        order: [
            [0,
                'desc'
            ] // Use the appropriate column index (0 is the first column) and 'desc' for descending order
        ]
    });


    $('.best-doctors-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: true,
        focusOnSelect: true
    });
</script>
{{--
<script src="{{ URL::asset('/assets_admin/js/app.js')}}"></script> --}}
