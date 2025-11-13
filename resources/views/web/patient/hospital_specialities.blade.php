<?php $page = 'index-13'; ?>
@extends('web.layout.layout')
@section('title', 'Hospital Profile')
@section('main-content')
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

                {{-- Specialities --}}
                <div class="card">
                    <div class="card-body py-2">
                        <h4 class="text-center p-3 pb-0">{{ __('web.specilities') }}</h4>
                        <div class="amenities-container">
                            @if ($hospital->specialities->count() > 0)
                                <ul>
                                    @foreach ($hospital->specialities as $speciality)
                                        <li><img class="" src="{{ $speciality->image }}"> {{ $speciality->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="no-specialty">{{ __('web.no_specialties_for_hospital') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Specialities --}}
                <!-- hospital Details Tab -->
            </div>
            <!-- /Page Content -->
    </section>
    <!-- /Page Content -->
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
