@php
    use Illuminate\Support\Facades\Auth;
    $notifications = \App\Models\Notification::query()
        ->where('to_id', Auth::user()->id)
        ->where('isRead',1)
        ->get();
@endphp
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
                    <!-- Notifications -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="section-heading">
                                <li>
                                    <a href="{{ route('notifications') }}">
                                        <i class="feather-bell"></i> <span class="badge"></span>
                                    </a>
                                    <p class="mb-0"><span class="badge badge-danger">{{$notifications?count($notifications):0}}</span></p>
                                </li>
                            </div>
                        </div>
                    </div>
                    <!-- /Notifications -->

                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if (\Auth::user()->profile_image ?? '')
                                    <img class="rounded-circle"
                                        src="{{ asset( \Illuminate\Support\Facades\Auth::user()->profile_image) }}"
                                        width="31" alt="{{\Auth::user()->name}}">
                                @else
                                    <img class="rounded-circle" src="{{ URL::asset('/assets/img/patients/patient.jpg') }}"
                                        width="31" alt="Ryan Taylor">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    @if (\Auth::user()->profile_image)
                                        <img src="{{ asset( \Illuminate\Support\Facades\Auth::user()->profile_image) }}"
                                            alt="{{auth()->user()->name}}" class="avatar-img rounded-circle">
                                    @else
                                        <img src="{{ URL::asset('/assets/img/patients/patient.jpg') }}" alt="User Image"
                                            class="avatar-img rounded-circle">
                                    @endif
                                </div>
                                <div class="user-text">
                                    <h6>{{ auth()->user()->name }}</h6>
                                    <p class="text-muted mb-0">Doctor</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ url('home') }}">Dashboard</a>
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
