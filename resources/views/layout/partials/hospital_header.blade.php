<div class="main-wrapper">

    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ URL::asset('images/' . $setting->logo) }}" class="img-fluid ml-4" alt="Logo"
                        style="height: 3rem;">
                </a>
            </div>
            <ul class="nav header-navbar-rht">
                @auth
                <li class="nav-item">
					<a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
						<i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
					</a>
				</li>
                <!-- <div class="row">
                    <div class="col-md-4">
                        <strong>Select Language: </strong>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control changeLang">
                            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>Arabic</option>
                        </select>
                    </div>
                </div> -->
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if (\Auth::user()->profile_image ?? '')
                                    <img class="rounded-circle" src="{{ asset( auth()->user()->profile_image) }}"
                                        width="31" alt="{{ \Auth::user()->name }}">
                                @else
                                    <img class="rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                        width="31" alt="Ryan Taylor">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    @if (\Auth::user()->profile_image ?? '')
                                        <img src="{{ asset(auth()->user()->profile_image) }}"
                                            alt="{{ auth()->user()->name }}" class="avatar-img rounded-circle">
                                    @else
                                        <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="User Image"
                                            class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="user-text">
                                    <h6>{{ auth()->user()->name }}</h6>
                                    <p class="text-muted mb-0">Hospital Admin</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                            <a onclick="document.getElementById('formlogout').submit();" class="dropdown-item"
                                href="#">
                                Logout
                            </a>
                            <form id="formlogout" method="POST" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link header-login" href="{{ route('login') }}">login / Signup </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>
    <!-- /Header -->


</div>
<script>

</script>
