<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Hospital Profile')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
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
                            <div class=" col-md-8">
                                <div class="owl-carousel">
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
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });

            // $(".owl-carousel2").owlCarousel({
            //     loop: true,
            //     margin: 10,
            //     nav: true,
            //     autoplay: true,
            //     autoplayTimeout: 3000,
            //     autoplayHoverPause: true,
            //     responsive: {
            //         0: {
            //             items: 1
            //         }
            //     }
            // });

        });
    </script>

@endsection
