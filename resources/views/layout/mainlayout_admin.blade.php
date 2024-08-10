<!DOCTYPE html>
<html>

<head>
    @include('layout.partials.head_admin')
</head>

{{-- 
@if (session()->get('locale') == 'ar')
  <body dir="rtl" lang="ar">
@else 
@endif
--}}

<body dir="ltr" lang="en">
    @include('layout.partials.header_admin')
    @include('layout.partials.nav_admin')

    @yield('content')
    @include('layout.partials.footer_admin-scripts')
</body>
</body>
