<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Hospital Profile')
@section('main-content')

    <section class="hospital-profile">
        <div class="content">
            <div class="container">

                <style>
                    .owl-nav button.owl-next span,
                    .owl-nav button.owl-prev span {
                        transform: none;
                    }

                    .owl-nav {
                        text-align: center;
                        display: block !important;
                    }

                    .owl-nav .owl-prev,
                    .owl-nav .owl-next {
                        background: #f4f4f4;
                        padding: 10px 20px;
                        border-radius: 30px;
                        margin: 5px;
                    }

                    .owl-nav .owl-prev:hover,
                    .owl-nav .owl-next:hover {
                        background: #7c7a7a;
                        color: #fff;
                    }

                    .owl-dots {
                        display: none;
                    }

                    .item img {
                        display: block;
                        width: 100%;
                        height: 350px;
                        object-fit: cover;
                        border-radius: 10px;
                    }
                </style>

                <!-- Hospital Widget -->
                <div class="card">
                    <div class="card-body py-2">
                        <div class="hospital-widget row">
                            <div class="col-md-8">
                                <div class="owl-carousel hospital-carousel">
                                    @if (count($hospital->images_links) > 0)
                                        @foreach ($hospital->images_links as $img)
                                            <div class="item"><img src="{{ $img }}" alt="Hospital Image"></div>
                                        @endforeach
                                    @else
                                        <div class="item"><img src="{{ $hospital->image }}" alt="Hospital Image"></div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{ $hospital?->hospital_name ?? '' }}</h4>
                                    <div class="rating">
                                        @php $rat_num = number_format($review_value); @endphp
                                        @for ($i = 1; $i <= $rat_num; $i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        @for ($j = $rat_num; $j < 5; $j++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        <span class="d-inline-block average-rating">{{ $reviews->count() }}</span>
                                    </div>
                                    <div class="clinic-details">
                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                            {{ $hospital->location ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="clini-infos">
                                    <ul>
                                        <li><i class="fas fa-user-md"></i> {{ $hospital->doctors->count() }}
                                            {{ __('web.doctors') }}</li>
                                        <li><i class="fas fa-stethoscope"></i> {{ $hospital->specialities->count() }}
                                            {{ __('web.specilities') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('flash'))
                            <x-alert>{{ session('flash')['message'] }}</x-alert>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible mt-3" role="alert">
                                <strong>Warning!</strong> {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /Hospital Widget -->

                {{-- ========== DOCTORS SECTION ========== --}}
                <div class="card mt-4">
                    <div class="card-body py-2">
                        <h4 class="text-center p-3 pb-0">{{ __('web.doctors') }}</h4>
                        @if ($hospital->doctors->count() > 0)
                            <div class="row">
                                @foreach ($hospital->doctors as $doctor)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="doctor-widget">
                                                    <div class="doc-info-left">
                                                        <div class="doctor-img">
                                                            <a href="{{ route('doctor_profile', $doctor->id) }}">
                                                                <img src="{{ asset($doctor->profile_image) }}"
                                                                    style="height: 185px" class="img-fluid"
                                                                    alt="User Image">
                                                            </a>
                                                        </div>
                                                        <div class="doc-info-cont">
                                                            <h4 class="doc-name"><a
                                                                    href="{{ route('doctor_profile', $doctor->id) }}">Dr.
                                                                    {{ $doctor->name }}</a>
                                                            </h4>
                                                            @if ($doctor->speciality->name ?? '')
                                                                <!-- <p class="doc-speciality">{{ $doctor->speciality->name }}</p> -->
                                                                <h5 class="doc-department"><img
                                                                        src="{{ asset($doctor->speciality->image) }}"
                                                                        class="img-fluid"
                                                                        alt="Speciality">{{ $doctor->speciality->name }}
                                                                </h5>
                                                            @else
                                                                <p class="doc-speciality">Speciality</p>
                                                            @endif

                                                            @php
                                                                $reviews = App\Models\Review::query()
                                                                    ->where('doctor_id', $doctor->id)
                                                                    ->get();
                                                                $review_sum = App\Models\Review::where(
                                                                    'doctor_id',
                                                                    $doctor->id,
                                                                )->sum('star_rated');
                                                                if ($reviews->count() > 0) {
                                                                    $review_value = $review_sum / $reviews->count();
                                                                } else {
                                                                    $review_value = 0;
                                                                }
                                                            @endphp

                                                            <div class="rating">
                                                                @php
                                                                    $rat_num = number_format($review_value);
                                                                @endphp
                                                                @for ($i = 1; $i <= $rat_num; $i++)
                                                                    <i class="fas fa-star filled"></i>
                                                                @endfor
                                                                @for ($j = $rat_num; $j < 5; $j++)
                                                                    <i class="fas fa-star"></i>
                                                                @endfor
                                                                <span
                                                                    class="d-inline-block average-rating">{{ $reviews->count() }}</span>
                                                            </div>
                                                            <div class="doc-info-right">
                                                                <div class="clinic-booking">
                                                                    <a class="view-pro-btn " style="width: 180px !important"
                                                                        href="{{ route('doctor_profile', $doctor->id) }}">
                                                                        {{ __('web.doc_profile') }}
                                                                    </a>
                                                                    <a class="apt-btn" style="width: 180px !important"
                                                                        href="{{ route('create_appointment', $doctor->id) }}">
                                                                        {{ __('web.book_appoint') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <p class="text-center mt-3 text-muted">{{ __('web.no_doctors_for_hospital') }}</p>
                        @endif
                    </div>
                </div>
                {{-- ========== END DOCTORS ========== --}}

            </div>
        </div>
    </section>

    <!-- Include Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            // Main Hospital Carousel
            $('.hospital-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                navText: [
                    '<span class="owl-prev-btn">&lsaquo;</span>',
                    '<span class="owl-next-btn">&rsaquo;</span>'
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    992: {
                        items: 1
                    }
                }
            });
        });
    </script>

@endsection
