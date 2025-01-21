<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Search Doctor')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="doctor-search">
        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
                        <!-- Search Filter -->
                        <div class="card search-filter">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Search Filter</h4>
                            </div>
                            <div class="card-body">
                                {{--                                <div class="filter-widget"> --}}
                                {{--                                    <div class=""> --}}
                                {{--                                        <input type="date" class="form-control " --}}
                                {{--                                               placeholder="Select Date"> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                <form method="get" action="{{ route('search_doctor') }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="Search Location">
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>Gender</h4>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender" value="M"
                                                    @if (request('gender') == 'M') checked @endif>
                                                <span class="checkmark"></span> Male Doctor
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender" value="F"
                                                    @if (request('gender') == 'F') checked @endif>
                                                <span class="checkmark"></span> Female Doctor
                                            </label>
                                        </div>
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="gender" value="O"
                                                    @if (request('gender') == 'O') checked @endif>
                                                <span class="checkmark"></span> Others
                                            </label>
                                        </div>
                                    </div>
                                    <div class="filter-widget">
                                        <h4>Select Specialist</h4>
                                        @forelse($specialities as $speciality)
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="speciality_id"
                                                        value="{{ $speciality->id }}"
                                                        @if (request('speciality_id') == $speciality->id) checked @endif>
                                                    <span class="checkmark"></span> {{ $speciality->name }}
                                                </label>
                                            </div>
                                        @empty
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" value="1" name="speciality_id" checked>
                                                    <span class="checkmark"></span> No Specaility Found
                                                </label>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div class="btn-search">
                                        <button type="submit" class="btn w-100 w-100">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Search Filter -->

                    </div>

                    <div class="col-md-12 col-lg-8 col-xl-9">

                        @forelse($doctors as $doctor)
                            <!-- Doctor Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="{{ route('doctor_profile', $doctor->id) }}">
                                                    <img src="{{ asset($doctor->profile_image) }}" class="img-fluid"
                                                        alt="User Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a
                                                        href="{{ route('doctor_profile', $doctor->id) }}">Dr.
                                                        {{ $doctor->name }}</a>
                                                </h4>
                                                @if ($doctor->speciality->name ?? '')
                                                    <p class="doc-speciality">{{ $doctor->speciality->name }}</p>
                                                    <h5 class="doc-department"><img
                                                            src="{{ asset('images/' . $doctor->speciality->image) }}"
                                                            class="img-fluid"
                                                            alt="Speciality">{{ $doctor->speciality->name }}</h5>
                                                @else
                                                    <p class="doc-speciality">Speciality</p>
                                                @endif

                                                <div class="rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">(17)</span>
                                                </div>
                                                <div class="clinic-details">
                                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                        {{ $doctor->address }}
                                                        ,
                                                        {{ $doctor->state }}
                                                    </p>
                                                    <ul class="clinic-gallery">
                                                        <li>
                                                            <a href="{{ url('assets/img/features/feature-01.jpg') }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ URL::asset('/assets/img/features/feature-01.jpg') }}"
                                                                    alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('assets/img/features/feature-02.jpg') }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ URL::asset('/assets/img/features/feature-02.jpg') }}"
                                                                    alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('assets/img/features/feature-03.jpg') }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ URL::asset('/assets/img/features/feature-03.jpg') }}"
                                                                    alt="Feature">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('assets/img/features/feature-04.jpg') }}"
                                                                data-fancybox="gallery">
                                                                <img src="{{ URL::asset('/assets/img/features/feature-04.jpg') }}"
                                                                    alt="Feature">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clinic-services">
                                                    @forelse($doctor->services as $service)
                                                        <span>{{ $service->service_title }}</span>
                                                    @empty
                                                        <span>No Services Found</span>
                                                    @endforelse

                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                <ul>
                                                    <li><i class="far fa-thumbs-up"></i> 98%</li>
                                                    <li><i class="far fa-comment"></i> 17 Feedback</li>
                                                    <li>
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        {{ $doctor->hospital->name }}
                                                    </li>
                                                    <li><i class="far fa-money-bill-alt"></i>
                                                        {{ $doctor->pricing == 'Free' ? 'Free' : 'SAR ' . $doctor->pricing }}
                                                        <i class="fas fa-info-circle" data-bs-toggle="tooltip"
                                                            title="Lorem Ipsum"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn"
                                                    href="{{ route('doctor_profile', $doctor->id) }}">View
                                                    Profile</a>
                                                <a class="apt-btn"
                                                    href="{{ route('create_appointment', $doctor->id) }}">Book
                                                    Appointment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->
                        @empty
                            <div>
                                <h4>No Doctor Found</h4>
                            </div>
                        @endforelse

                        {{--                        <div class="load-more text-center"> --}}
                        {{--                            <a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a> --}}
                        {{--                        </div> --}}
                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
    </section>
    <!-- /Page Content -->

@endsection
