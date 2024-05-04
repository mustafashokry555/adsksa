<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head_pharmacy_admin')
  </head>

  <body>
  @if(!Route::is(['login','register','forgot-password','lock-screen','error-404','error-500']))
  @include('layout.partials.header_pharmacy_admin')
 @include('layout.partials.nav_pharmacy_admin')
 @endif
 @yield('content')
 @include('layout.partials.footer_pharmacy_admin_scripts')
  </body>
</html>