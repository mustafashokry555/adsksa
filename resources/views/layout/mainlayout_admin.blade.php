<!DOCTYPE html>
<html lang="en">
  @if(session()->get('locale')=='ar')
  <html dir="rtl" lang="ar">
@else
<html dir="ltr" lang="en">
  @endif
  <head>
    @include('layout.partials.head_admin')
  </head>

  <body>
    @include('layout.partials.header_admin')
    @include('layout.partials.nav_admin')

    @yield('content')
    @include('layout.partials.footer_admin-scripts')
  </body>
</html>
