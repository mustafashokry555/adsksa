@extends('layout.mainlayout_admin')
@section('title', 'Profile')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Profile Information -->
            <div class="row">
                @if(session()->has('flash'))
                    <x-alert>{{ session('flash')['message'] }}</x-alert>
                @endif
                <div class="col-md-8 col-lg-8 col-xl-6">
                    <div class="profile-info">
                        <h4>My Profile</h4>
                        <div class="profile-list">
                            <div class="profile-detail">
                                <label class="avatar profile-cover-avatar">
                                    @if($admin->profile_image ?? '')
                                        <img class="avatar-img"
                                             src="{{ asset($admin->profile_image) }}"
                                             alt="Profile Image">
                                    @else
                                        <img class="avatar-img"
                                             src="{{ URL::asset('/assets_admin/img/profiles/avatar-02.jpg')}}"
                                             alt="Profile Image">
                                    @endif
                                </label>
                                <div class="pro-name">
                                    @if($admin->username ?? '')
                                        <p>@ {{ $admin->username }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                    <h4>{{ $admin->name }}</h4>
                                </div>
                                <a href="{{ route('profile.edit', $admin) }}" class="edit-pro"><i
                                        class="feather-edit"></i> Edit</a>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="pro-title">Personal Information</h6>
                                    <div class="col-md-12">
                                        <h5>Description</h5>
                                        @if($admin->description ?? '')
                                            <p>{{ $admin->description }}</p>
                                        @else
                                            <p>N/A</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h5>Date of Birth</h5>
                                    @if($admin->date_of_birth)
                                        <p>{{ $admin->date_of_birth }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h5>Gender</h5>
                                    @if($admin->gender ?? '')
                                        @if($admin->gender == 'M')
                                            <p>Male</p>
                                        @elseif($admin->gender == 'F')
                                            <p>Female</p>
                                        @elseif($admin->gender == 'O')
                                            <p>Others</p>
                                        @endif
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h5>Age</h5>
                                    @if($admin->age ?? '')
                                        <p>{{ $admin->age }} years</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <h6 class="pro-title">Address & Location</h6>
                                </div>
                                <div class="col-md-3">
                                    <h5>Address</h5>
                                    @if($admin->address ?? '')
                                        <p>{{ $admin->address }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <h5>Country</h5>
                                    @if($admin->country ?? '')
                                        <p>{{ $admin->country }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <h5>State</h5>
                                    @if($admin->state ?? '')
                                        <p>{{ $admin->state }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <h5>Zip code</h5>
                                    @if($admin->zip_code ?? '')
                                        <p>{{ $admin->zip_code }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="profile-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pro-title d-flex justify-content-between">
                                        <h6>Account Information</h6>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Email Address</h5>
                                    <p>{{ $admin->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Phone Number</h5>
                                    @if($admin->mobile ?? '')
                                        <p>{{ $admin->mobile }}</p>
                                    @else
                                        <p>N/A</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h5>Social Links</h5>
                                    <ul class="social-icon">
                                        <li>
                                            @if($admin->twitter ?? '')
                                                <a href="{{ $admin->twitter }}"><i class="feather-twitter"></i></a>
                                            @else
                                                <a href="#"><i class="feather-twitter"></i></a>
                                            @endif

                                        </li>
                                        <li>
                                            @if($admin->facebook ?? '')
                                                <a href="{{ $admin->facebook }}"><i class="feather-facebook"></i></a>
                                            @else
                                                <a href="#"><i class="feather-facebook"></i></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if($admin->linkedin ?? '')
                                                <a href="{{ $admin->linkedin }}"><i class="feather-linkedin"></i></a>
                                            @else
                                                <a href="#"><i class="feather-linkedin"></i></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if($admin->instagram ?? '')
                                                <a href="{{ $admin->instagram }}"><i class="feather-instagram"></i></a>
                                            @else
                                                <a href="#"><i class="feather-instagram"></i></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if($admin->youtube ?? '')
                                                <a href="{{ $admin->youtube }}"><i class="feather-youtube"></i></a>
                                            @else
                                                <a href="#"><i class="feather-youtube"></i></a>
                                            @endif
                                        </li>
                                        <li>
                                            @if($admin->pinterest ?? '')
                                                <a href="{{ $admin->pinterest }}"><i class="feather-youtube"></i></a>
                                            @else
                                                <a href="#"><i class="feather-pinterest"></i></a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>
    <!-- /Main Wrapper -->

@endsection
