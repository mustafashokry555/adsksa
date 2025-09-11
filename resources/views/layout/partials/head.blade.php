<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>@yield('title')</title>
<!-- Favicons -->
<link type="image/x-icon" href="{{ asset('images/' . $setting->favicon) }}" rel="icon">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
<!-- Fontawesome CSS -->
<link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/fontawesome/css/all.min.css') }}">
<!-- Feathericon CSS -->
<link rel="stylesheet" href="{{ asset('assets/libs/feather/feather.css') }}">
<!-- Owl carousel CSS -->
<link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}">
<!-- Swiper CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/swiper/css/swiper.min.css') }}">
<!-- Daterangepicker CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/daterangepicker/daterangepicker.css') }}">
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-datetimepicker.min.css') }}">
<!-- Full Calendar CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/fullcalendar/fullcalendar.min.css') }}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/select2/dist/css/select2.min.css') }}">
<!-- Apecharts CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/apex/apexcharts.css') }}">
<!-- Jquery-ui CSS -->
<link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.min.css') }}">
<!-- Fancybox  CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/fancybox/jquery.fancybox.min.css') }}">
<!-- Bootstrap Tagsinput CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<!-- Dropzone CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/dropzone/dropzone.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">

@if (Route::is(['onboarding-phone', 'patient-phone']))
    <!-- IntlTelInput CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
@endif
<!-- Animation CSS -->
<link rel="stylesheet" href="{{ asset('/assets/libs/aos/aos.css') }}">
<!-- Main CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

<!-- Datatables css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
