    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid content-wrap">
            
            <!-- Settings -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-links">
                        @if(!Route::is(['settings']))
                        <li><a href="{{url('admin/settings')}}">General Settings</a></li>
                        @endif
                        @if(Route::is(['settings']))
                        <li class="active"><a href="{{url('admin/settings')}}">General Settings</a></li>
                        @endif
                        @if(!Route::is(['login-settings']))
                        <li><a href="{{url('admin/login-settings')}}">Login Settings</a></li>
                        @endif
                        @if(Route::is(['login-settings']))
                        <li class="active"><a href="{{url('admin/login-settings')}}">Login Settings</a></li>
                        @endif
                        @if(!Route::is(['setting-preference']))
                        <li><a href="{{url('admin/setting-preference')}}">Preferences</a></li>
                        @endif
                        @if(Route::is(['setting-preference']))
                        <li class="active"><a href="{{url('admin/setting-preference')}}">Preferences</a></li>
                        @endif
                        @if(!Route::is(['setting-notifications']))
                        <li><a href="{{url('admin/setting-notifications')}}">Notification</a></li>
                        @endif
                        @if(Route::is(['setting-notifications']))
                        <li class="active"><a href="{{url('admin/setting-notifications')}}">Notification</a></li>
                        @endif
                        @if(!Route::is(['email-settings']))
                        <li><a href="{{url('admin/email-settings')}}">Email Settings</a></li>
                        @endif
                        @if(Route::is(['email-settings']))
                        <li class="active"><a href="{{url('admin/email-settings')}}">Email Settings</a></li>
                        @endif
                        @if(!Route::is(['payment-gateway']))
                        <li><a href="{{url('admin/payment-gateway')}}">Payment Gateway</a></li>
                        @endif
                        @if(Route::is(['payment-gateway']))
                        <li class="active"><a href="{{url('admin/payment-gateway')}}">Payment Gateway</a></li>
                        @endif
                        @if(!Route::is(['sms-gateway']))
                        <li><a href="{{url('admin/sms-gateway')}}">SMS Gateway</a></li>
                        @endif
                        @if(Route::is(['sms-gateway']))
                        <li class="active"><a href="{{url('admin/sms-gateway')}}">SMS Gateway</a></li>
                        @endif
                    </ul>
                </div>
            </div>