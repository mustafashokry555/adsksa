<?php $page = 'index-13'; ?>
{{-- @extends('layout.mainlayout_index1') --}}
@extends('web.layout.layout')
@section('title', 'Hospital Profile')
@section('main-content')
    {{-- @section('content') --}}
    <!-- Header -->
    {{-- @include('components.patient_header') --}}
    <!-- /Header -->

    <div class="row align-items-center mt-4">

    </div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="hospital-profile">
        <!-- Page Content -->
        <div class="content">
            <div class="container">
                <style>
                    .owl-nav .owl-prev,
                    .owl-nav .owl-next {
                        background: #f4f4f4;
                        padding: 10px 14px;
                        border-radius: 50%;
                        margin: 5px;
                    }

                    .owl-nav .owl-prev:hover,
                    .owl-nav .owl-next:hover {
                        background: #7c7a7a;
                        color: #fff;
                    }

                    .item img {
                        display: block;
                        width: 100%;
                        height: 350px;
                        object-fit: cover;
                    }

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
                    }

                    .owl-dots {
                        display: none;
                    }

                    .item img {
                        display: block;
                        width: 100%;
                        height: 350px;
                    }
                </style>
                <!-- hospital Widget -->
                <div class="card">
                    <div class="card-body py-2">
                        <div class="hospital-widget row">
                            <div class="col-md-8">
                                <div class="owl-carousel hospital-images-carousel">
                                    @if (count($hospital->images_links) > 0)
                                        @foreach ($hospital->images_links as $img)
                                            <div class="item"><img src="{{ $img }}" alt="Hospital Image 1"></div>
                                        @endforeach
                                    @else
                                        <div class="item"><img src="{{ $hospital->image }}" alt="Hospital Image 1"></div>
                                    @endif
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="doc-info-cont">
                                    <h4 class="doc-name">{{ $hospital?->hospital_name ?? '' }}</h4>
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
                                {{-- <h4 class="doc-name">{{ __('web.aboutUs') }}</h4>
                                <p>
                                    {{ $hospital->about2 ?? '' }}</p>
                                </p> --}}
                            </div>
                        </div>
                        @if ($errors->any())
                            <br>
                            <div class="alert alert-danger">
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
                            <div class="alert alert-warning alert-dismissible" role="alert">

                                <strong>Warning !</strong> {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /hospital Widget -->

                <style>
                    .amenities-container ul {
                        list-style-type: none;
                        padding: 0;
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-around;
                    }

                    .amenities-container li {
                        background: #ffffff;
                        border: 1px solid #cccccc;
                        border-radius: 10px;
                        padding: 10px 20px;
                        margin: 10px;
                        display: flex;
                        align-items: center;
                        font-size: 16px;
                        color: #333;
                    }

                    .amenities-container img {
                        margin-right: 10px;
                        color: #666666;
                    }

                    /* Hover effect */
                    .amenities-container li:hover {
                        background: #e9e9e9;
                        cursor: pointer;
                    }

                    .amenities-container ul {
                        list-style-type: none;
                        padding: 0;
                        margin: 0;
                    }

                    .amenities-container li {
                        background: #ffffff;
                        border: 1px solid #cccccc;
                        border-radius: 10px;
                        padding: 10px 20px;
                        margin: 10px;
                        display: flex;
                        align-items: center;
                        font-size: 16px;
                        color: #333;
                    }

                    .amenities-container li img {
                        margin-right: 10px;
                        height: 30px;
                        /* Adjust based on your design */
                        width: auto;
                    }

                    .no-specialty {
                        color: #888888;
                        background: #f0f0f0;
                        border: 1px solid #cccccc;
                        border-radius: 10px;
                        padding: 15px 20px;
                        margin: 10px;
                        text-align: center;
                        font-size: 16px;
                    }

                    /* Optional: hover effect for list items */
                    .amenities-container li:hover {
                        background-color: #e9e9e9;
                        cursor: pointer;
                    }
                </style>

                {{-- Doctors --}}
                <div class="card">
                    <div class="card-body py-2">
                        <h4 class="text-center p-3 pb-0">{{ __('web.doctors') }}</h4>
                        <div class="amenities-container">
                            @if ($hospital->doctors->count() > 0)
                                <div class="row">
                                    @foreach ($hospital->doctors->take(6) as $doctor)
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
                                                                        <a class="view-pro-btn "
                                                                            style="width: 180px !important"
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
                                    @if ($hospital->doctors->count() > 6)
                                        <div class="col-12 text-center">
                                            <a href="{{ route('hospital_doctors', $hospital->id) }}"
                                                class="btn btn-primary">{{ __('web.show_more') }}</a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="no-specialty">{{ __('web.no_doctors_for_hospital') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Doctors --}}
                {{-- Specialities --}}
                <div class="card">
                    <div class="card-body py-2">
                        <h4 class="text-center p-3 pb-0">{{ __('web.specilities') }}</h4>
                        <div class="amenities-container">
                            @if ($hospital->specialities->count() > 0)
                                <ul>
                                    @foreach ($hospital->specialities->take(14) as $speciality)
                                        <li><img class="" src="{{ $speciality->image }}"> {{ $speciality->name }}
                                        </li>
                                    @endforeach
                                </ul>
                                @if ($hospital->specialities->count() > 14)
                                    <div class="col-12 text-center">
                                        <a href="{{ route('hospital_specialties', $hospital->id) }}"
                                            class="btn btn-primary">{{ __('web.show_more') }}</a>
                                    </div>
                                @endif
                            @else
                                <p class="no-specialty">{{ __('web.no_specialties_for_hospital') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Specialities --}}

                {{-- Offers --}}
                <div class="card">
                    <div class="card-body py-2">
                        <h4 class="text-center p-3 pb-0">{{ __('web.offers') }}</h4>
                        <div class="amenities-container">
                            @if ($hospital->offers->count() > 0)
                                <div class="row">
                                    @foreach ($hospital->offers->take(6) as $offer)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="doctor-widget">
                                                        <div class="doc-info-left">
                                                            <div class="doctor-img">
                                                                <div class="owl-carousel offer-images-carousel">
                                                                    @foreach ($offer->images as $img)
                                                                        <div class="item">
                                                                            @if ($offer->type == 'video')
                                                                                <a target="_blank"
                                                                                    href="{{ $offer->video_link }}">
                                                                                    <img src="{{ $img }}"
                                                                                        style="height: 185px"
                                                                                        alt="Offer Image">
                                                                                </a>
                                                                            @else
                                                                                <img src="{{ $img }}"
                                                                                    style="height: 185px"
                                                                                    alt="Offer Image">
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="doc-info-cont" style="position: relative">
                                                                <h4 class="doc-name text-info">
                                                                    @if ($offer->type == 'video')
                                                                        <a target="blank"
                                                                            href="{{ $offer->video_link }}">{{ $offer->title }}</a>
                                                                    @else
                                                                        {{ $offer->title }}
                                                                    @endif
                                                                </h4>
                                                                <h5 class="doc-department">
                                                                    {{ $offer->content }}
                                                                </h5>
                                                                {{-- <div class="doc-info-right" style="position: absolute; bottom: 0; ">
                                                                    <div class="clinic-booking">
                                                                        @if ($offer->type == 'video')
                                                                            <a class="view-pro-btn" style="width: 180px !important; " target="blank" href="{{ $offer->video_link }}">
                                                                                {{ __('web.show_offer') }}
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div> --}}
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($hospital->offers->count() > 6)
                                        <div class="col-12 text-center">
                                            <a href="{{ route('hospital_offers', $hospital->id) }}"
                                                class="btn btn-primary">{{ __('web.show_more') }}</a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="no-specialty">{{ __('web.no_offers_for_hospital') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Offers --}}
                <!-- hospital Details Tab -->
                {{--  --}}
            </div>
            <!-- /Page Content -->
    </section>
    <!-- /Page Content -->
    <!-- Owl CSS (include in <head> or before carousel markup) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- jQuery (only one copy!) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl JS (before your custom init script) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        $(document).ready(function() {
            // Hospital main images carousel
            $('.hospital-images-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                navText: ['<span class="owl-prev-btn">&lsaquo;</span>',
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

            // Offer images carousels (there may be multiple)
            $('.offer-images-carousel').each(function() {
                $(this).owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    items: 1,
                    navText: ['<span class="owl-prev-btn">&lsaquo;</span>',
                        '<span class="owl-next-btn">&rsaquo;</span>'
                    ]
                });
            });

            // Optional: if some carousels are inside hidden elements (tabs/modal), refresh on show:
            // $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            //     $('.hospital-images-carousel, .offer-images-carousel').trigger('refresh.owl.carousel');
            // });

        });
    </script>

@endsection
