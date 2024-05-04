@extends('layout.mainlayout_hospital')
@section('title', 'Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if(session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                @if($hospital_admin->profile_image ?? '')
                                    <img src="{{ asset($hospital_admin->profile_image) }}"
                                         class="img-fluid" alt="User Image">
                                @else
                                    <img src="{{ URL::asset('/assets/img/doctors/doctor-thumb-02.jpg')}}"
                                         class="img-fluid" alt="User Image">
                                @endif
                            </div>
                            <div class="doc-info-cont">
                                {{--                                    <h4 class="doc-name">{{ $hospital->hospital_name }}</h4>--}}
                                <p class="doc-name">{{ $hospital_admin->name }}</p>
                                <p class="doc-name">{{ $hospital_admin->username }}</p>

                                {{--                                    <p class="doc-department"><img src="{{ URL::asset('/assets/img/specialities/specialities-05.png')}}" class="img-fluid" alt="Speciality">Dentist</p>--}}
                                {{--                                    <div class="rating">--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star"></i>--}}
                                {{--                                        <span class="d-inline-block average-rating">(35)</span>--}}
                                {{--                                    </div>--}}
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <a href="{{ route('profile.edit', $hospital_admin) }}" class="edit-pro"><i
                                        class="feather-edit"></i> {{ __('hospital.profile.edit')  }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">
                    <!-- Tab Menu -->
                    {{--                        <nav class="user-tabs mb-4">--}}
                    {{--                            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a class="nav-link active" href="{{url('#doc_overview')}}" data-bs-toggle="tab">Overview</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a class="nav-link" href="{{url('#doc_locations')}}" data-bs-toggle="tab">Locations</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a class="nav-link" href="{{url('#doc_reviews')}}" data-bs-toggle="tab">Reviews</a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a class="nav-link" href="{{url('#doc_business_hours')}}" data-bs-toggle="tab">Business Hours</a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </nav>--}}
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">

                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <h6 class="pro-title">{{ __('hospital.profile.personal_information')  }}</h6>

                                            <div class="col-md-12">
                                                <h5>{{ __('hospital.profile.about_me')  }}</h5>
                                                @if($hospital_admin->description ?? '')
                                                    <p>{{ $hospital_admin->description }}</p>
                                                @else
                                                    <p>N/A</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4 mb-3">
                                            <h5>Date of Birth</h5>
                                            @if($hospital_admin->date_of_birth)
                                                <p>{{ $hospital_admin->date_of_birth }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div> -->
                                        <!-- <div class="col-md-4 mb-3">
                                            <h5>Gender</h5>
                                            @if($hospital_admin->gender ?? '')
                                                @if($hospital_admin->gender == 'M')
                                                    <p>Male</p>
                                                @elseif($hospital_admin->gender == 'F')
                                                    <p>Female</p>
                                                @elseif($hospital_admin->gender == 'O')
                                                    <p>Others</p>
                                                @endif
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div> -->
                                        <!-- <div class="col-md-4 mb-3">
                                            <h5>Age</h5>
                                            @if($hospital_admin->age ?? '')
                                                <p>{{ $hospital_admin->age }} years</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div> -->
                                        <div class="col-md-12">
                                            <h6 class="pro-title">{{ __('hospital.profile.address_and_location')  }}</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>{{ __('hospital.profile.address')  }}</h5>
                                            @if($hospital_admin->address ?? '')
                                                <p>{{ $hospital_admin->address }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <h5>{{ __('hospital.profile.country')  }}</h5>
                                            @if($hospital_admin->country ?? '')
                                                <p>{{ $hospital_admin->country }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <h5>{{ __('hospital.profile.state')  }}</h5>
                                            @if($hospital_admin->state ?? '')
                                                <p>{{ $hospital_admin->state }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <h5>{{ __('hospital.profile.zip_code')  }}</h5>
                                            @if($hospital_admin->zip_code ?? '')
                                                <p>{{ $hospital_admin->zip_code }}</p>
                                            @else
                                                <p>N/A</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Services List -->
                                    <!-- <div class="service-list">
                                        <h4>Services</h4>
                                        <ul class="clearfix">
                                            <li>Tooth cleaning</li>
                                            <li>Root Canal Therapy</li>
                                            <li>Implants</li>
                                            <li>Composite Bonding</li>
                                            <li>Fissure Sealants</li>
                                            <li>Surgical Extractions</li>
                                        </ul>
                                    </div> -->
                                    <!-- /Services List -->
                                    <div class="profile-list">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pro-title d-flex justify-content-between">
                                                    <h6>{{ __('hospital.profile.account_information')  }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <h5>{{ __('hospital.profile.email_address')  }}</h5>
                                                <p>{{ $hospital_admin->email }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <h5>{{ __('hospital.profile.mobile')  }}</h5>
                                                @if($hospital_admin->mobile ?? '')
                                                    <p>{{ $hospital_admin->mobile }}</p>
                                                @else
                                                    <p>N/A</p>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <h5>{{ __('hospital.profile.social_links')  }}</h5>
                                                <div class="social-icon d-flex justify-content-between mt-2">
                                                    <div>
                                                        @if($hospital_admin->twitter ?? '')
                                                            <a href="{{ $hospital_admin->twitter }}"><i
                                                                    class="feather-twitter"></i></a>
                                                        @else
                                                            <a href="#"><i class="feather-twitter"></i></a>
                                                        @endif

                                                    </div>
                                                    <div>
                                                        @if($hospital_admin->facebook ?? '')
                                                            <a href="{{ $hospital_admin->facebook }}"><i
                                                                    class="feather-facebook"></i></a>
                                                        @else
                                                            <a href="#"><i class="feather-facebook"></i></a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if($hospital_admin->linkedin ?? '')
                                                            <a href="{{ $hospital_admin->linkedin }}"><i
                                                                    class="feather-linkedin"></i></a>
                                                        @else
                                                            <a href="#"><i class="feather-linkedin"></i></a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if($hospital_admin->instagram ?? '')
                                                            <a href="{{ $hospital_admin->instagram }}"><i
                                                                    class="feather-instagram"></i></a>
                                                        @else
                                                            <a href="#"><i class="feather-instagram"></i></a>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if($hospital_admin->youtube ?? '')
                                                            <a href="{{ $hospital_admin->youtube }}"><i
                                                                    class="feather-youtube"></i></a>
                                                        @else
                                                            <a href="#"><i class="feather-youtube"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->
                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
