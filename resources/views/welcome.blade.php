<?php $page = 'index-13'; ?>
@extends('layout.mainlayout_index1')
@section('title', 'Welcome')
@section('content')
    <!-- Header -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('components.patient_header')
    <style>
        .search_bar {
            display: flex;
            gap: 10px;
            padding: 10px;
            border: 1px solid;
            border-radius: 9px;
            align-items: end;
        }

        .search_bar .drop_down_wrap .dropdown {
            background: transparent;
        }

        .search_bar .drop_down_wrap {
            padding: 5px;
            /* border: 1px solid; */
            border-radius: 5px;
            width: 20%;
            padding-bottom: 0px;
        }

        .drop_down_wrap input {
            width: 100%;
        }

        .search_bar .drop_down_wrap .dropdown button {
            background: transparent;
            color: #000;
            padding: 0px;
            border: 0px;
        }

        .search_bar .drop_down_wrap .dropdown button:focus {
            outline: none;
            box-shadow: none;
        }

        .btn_search {
            flex: 1;
            background-color: #1aeebe;
            border: 0px;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            font-size: 17px;
            font-weight: 500;
        }

        .main-menu-wrapper {
            margin-left: 391px;
        }
    </style>


    <!-- /Header -->
    <div class="row align-items-center">
        <!-- <div class="col-lg-12 col-md-12"></div> -->
        
    </div>
    </div>
    </section>

    <section class="login">
        <div class="content" style="min-height: 273.9px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-12 col-md-12">
                                    <div class="home-four-doctor">
                                        <div class="home-four-header">
                                            <!-- <h2 style="color: #272b41">{{ __('web.Search Doctor, Make an') }} <span>{{ __('web.Appointment') }}</span></h2> -->
                                            <h2 style="color: #009eff">{{__('Find Doctor') }} <span style="color: #12b3ab">{{ __('make an ') }}<span style="color: #1aeebe">{{ __('web.Appointment') }}</span></h2>
                                        </div>
                                        <form method="GET" action="{{ route('single_search_doctor') }}" class="banner-four-search">
                                            <div dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="search_bar" style="background-color:white">
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Enter_country') }}</label>
                                                    <div class="dropdown">
                                                        <select id="countrySelect" name="country" class="select form-control" >
                                                            <option selected disabled>{{ __('web.Enter_country') }}</option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Enter State') }}</label>
                                                    <div class="dropdown">
                                                        <select id="stateSelect" name="state" class="select form-control" >
                                                            <option selected disabled>{{ __('web.Enter State') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Select a Insurance') }}</label>
                                                    <div class="dropdown">
                                                        <select id="insuranceSelect" name="insurance" class="select form-control">
                                                            <option selected disabled>{{ __('web.Select a Insurance') }}</option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach($insurances as $insurance)
                                                                <option value="{{ $insurance->id }}">{{ $insurance->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="drop_down_wrap">
                                                    <label>{{ __('web.Select a specility') }}</label>
                                                    <div class="dropdown">
                                                        <select id="specialitySelect" name="speciality" class="select form-control">
                                                            <option selected disabled>{{ __('web.Select a specility') }}</option>
                                                            <option value='all'>{{ __('web.All') }}</option>
                                                            @foreach($specialities as $speciality)
                                                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                        
                                                <button class="btn_search">{{ __('web.Search') }}</button>
                                            </div>
                                        </form>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session()->has('flash'))
        <x-alert>{{ session('flash')['message'] }}</x-alert>
    @endif
    <!-- /Home Banner -->

    <!-- Looking Section Four -->
    {{-- @include('components.patient_search_section') --}}
    <!-- /Looking Section Four -->

    <!-- Clinic Section Four -->
    {{-- @include('components.patient_clinic_section') --}}
    <!-- /Clinic Section Four -->

    <!-- Doctor Section Four -->
    {{-- @include('components.patient_doctor_section') --}}
    <!-- /Doctor Section Four -->

    <!-- Features Clinic Four -->
    {{-- @include('components.patient_clinic_features_section') --}}
    <!-- /Features Clinic Four -->

    <!-- Blog Section Four -->
    {{-- <x-patient_blogs_section :blogs="$blogs" /> --}}
    <!-- /Blog Section Four -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // Add event listener for country select
        document.getElementById('countrySelect').addEventListener('change', function() {
            loadCities(this.value);
        });

        // Load all cities when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            loadCities(); // Call without countryId to load all cities
        });

        async function loadCities(countryId = null) {
            const stateSelect = document.getElementById('stateSelect');
            
            // Reset the state dropdown
            stateSelect.innerHTML = `
                <option selected disabled>${'{{ __("web.Enter State") }}'}</option>
                <option value="all">${'{{ __("web.All") }}'}</option>
            `;

            try {
                // Build the URL based on whether we have a countryId
                const url = countryId 
                    ? `/get-states?country_id=${countryId}`
                    : '/get-states'; // Endpoint for all cities

                const response = await fetch(url);
                const data = await response.json();

                // Enable the state select and add the options
                stateSelect.disabled = false;
                data.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                });
            } catch (error) {
                console.error('Error loading cities:', error);
                stateSelect.disabled = true;
            }
        }
        
    </script>


@endsection
